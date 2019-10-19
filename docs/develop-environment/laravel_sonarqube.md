# laravel sonarqube

## 必要な Dockerfile

- postgres
- sonarqube

## .env

.env を修正. sonarqube

```conf
### SONARQUBE ################################################
## docker-compose up -d sonarqube
## (If you encounter a database error)
## docker-compose exec --user=root postgres
## source docker-entrypoint-initdb.d/init_sonarqube_db.sh
## (If you encounter logs error)
## docker-compose run --user=root --rm sonarqube chown sonarqube:sonarqube /opt/sonarqube/logs

SONARQUBE_HOSTNAME=127.0.0.1
SONARQUBE_PORT=9000
SONARQUBE_POSTGRES_INIT=true
SONARQUBE_POSTGRES_HOST=postgres
SONARQUBE_POSTGRES_DB=sonar
SONARQUBE_POSTGRES_USER=sonar
SONARQUBE_POSTGRES_PASSWORD=sonarPass
```

.laradock/data/配下に置くように変更

```diff
- DATA_PATH_HOST=~/.laradock/data
+ DATA_PATH_HOST=./.laradock/data
```

## ファイルのパーミション

```
2019-10-19 01:53:08,586 main ERROR Unable to create file /opt/sonarqube/logs/es.log java.io.IOException: Permission denied
```

## データベースを設定

```
docker-compose up -d sonarqube
## (If you encounter a database error)
## docker-compose exec --user=root postgres
## source docker-entrypoint-initdb.d/init_sonarqube_db.sh
```

のように書かれている。
[ボリュームにデータを永続化した場合、/docker-entrypoint-initdb.d のスクリプトはコンテナ起動ごとに実行されない](https://qiita.com/kimullaa/items/70eaec61c02d2513e76c)とあるように、
永続化されないのが問題のようだ。

ところが、`docker-compose up -d sonarqube`を実行するとコンテナがエラーで落ちてしまっていて、
`exec`で実行中のコンテナにログインできない。

```diff
  postgres:
    build: ./postgres
    volumes:
+ #      - ${DATA_PATH_HOST}/postgres:/var/lib/postgresql/data
      - ${POSTGRES_ENTRYPOINT_INITDB}:/docker-entrypoint-initdb.d
```

ボリュームを保存しようとしているところをコメントアウトすると、正常に動いたので、どうやらここがエラーのポイントの模様。

```diff
- #      - ${DATA_PATH_HOST}/postgres:/var/lib/postgresql/data
+       - /postgres:/var/lib/postgresql/data
```

ボリュームを保存するフォルダを ubuntu の直下のフォルダに指定したところ、動作に成功した。

## .env をもとに戻す

windows との相性がわるいので、 ~/.laradock/data/配下に置くように変更

```diff
- DATA_PATH_HOST=./.laradock/data
+ DATA_PATH_HOST=~/.laradock/data
```

... これでも動かない。
ただ、以下の作業はできるようになった。

```
docker-compose exec --user=root postgres
source docker-entrypoint-initdb.d/init_sonarqube_db.sh
```

しかし、以下のように言われてしまうのでこれも問題の模様。

```
ERROR:  role "sonar" already exists
```

動かなかったときに、うかつに共用フォルダ以下にデータ置き場を作ってしまったのが問題であった。
初回に設定不足で DB の init が動かなかった場合については、
`sudo rm -rf ~/.laradock/data/postgres`で解決を試すべきだった。
以下のように、データボリュームを使ったがこれもだめ。

```
   - postgresData:/var/lib/postgresql/data

volumes:
  postgresData:
```

いったん、DB の永続化はなしで試してみる。

## 仮想メモリを増やす

メモリを確認

```
sysctl vm.max_map_count
```

- sonarqube は内部で ElasticSearch を使用しているため、メモリを大量に使う。

```
sudo sysctl -w vm.max_map_count=262144
```

上記で足りなかった。

```
sudo sysctl -w vm.max_map_count=524288
```

## ログの設定

```
docker-compose run --user=root --rm sonarqube chown sonarqube:sonarqube /opt/sonarqube/logs
```

## 参考

[Laradock 3](https://laradock.io/documentation/#install-sonarqube-automatic-code-review-tool)
[issue](https://github.com/SonarSource/docker-sonarqube/issues/282#issuecomment-507735864)
[仮想メモリ - Elasticsearch 導入前に気を付けておきたいこと！](https://qiita.com/uzresk/items/e0b10c14875b79c450f2#%E4%BB%AE%E6%83%B3%E3%83%A1%E3%83%A2%E3%83%AA)
[Docker for Windows で postgres コンテナの Volume マウントを安全にする](https://qiita.com/megmogmog1965/items/e7cd4500006c3b6b1894)]
