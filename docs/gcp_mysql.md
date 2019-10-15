## MySQL インスタンスの作成

- インスタンスを作成
  ![](./img/gcp_mysql/2019-10-13-16-11-34.png)

- MySQL を選択
  ![](./img/gcp_mysql/2019-10-13-16-12-18.png)

* 名前を入力。
  - インスタンス名には機密情報や個人を特定できる情報を含めない。
    - インスタンス名は外部から閲覧可能。
  - インスタンス名にプロジェクト ID を含める必要はない。
    - この処理は必要に応じて自動的に行う（ログファイルの場合など）
* リージョンを入力
  - インスタンスと同じリージョンにすること
    - asia-northeast1 (東京))
  - ゾーンは任意のままでよい
* 詳細設定
  - ストレージを HDD にすると安い。これは後から変えられないので注意。
    - SSD の半分くらい(SSD は 20 円/単位, HDD は 12 円/単位)
  - CPU は一番性能の低いものをとりあえず。
    - db-f1-micro
  - フラグを入力。日本時間にする。
    - `default_timezone` を `+09:00`にする

![](./img/gcp_mysql/2019-10-13-16-19-46.png)

![](./img/gcp_mysql/2019-10-14-10-13-57.png)

時間の確認

```
show variables like '%time_zone%';
```

### gcloud に接続

```
./bin/gcp_bash.sh
gcloud auth login
gcloud sql instances describe インスタンス名 | grep connectionName
```

`connectionName: プロジェクトID:asia-northeast1:インスタンス名`が返される。`プロジェクトID:asia-northeast1:インスタンス名`が接続文字列となる。

#### バックグラウンドでプロキシを動かす

末尾に&をつけて、バックグラウンドで動かす。
実行した後、Enter を押さないと止まったように見える。

```
cloud_sql_proxy -instances=whitemap-255523:asia-northeast1:db02=tcp:3306 &
```

#### MySQL に接続してインスタンスを作る

```
gcloud sql databases create laravel --instance=インスタンス名
```

プラットフォームから確認する。

![](./img/gcp_mysql/2019-10-13-16-49-27.png)
![](./img/gcp_mysql/2019-10-13-16-52-04.png)
![](./img/gcp_mysql/2019-10-13-16-53-22.png)

#### テーブルの作成

passport も入れてあるので、その分の artisan も追加。

```
export DB_DATABASE=laravel DB_USERNAME=root DB_PASSWORD=YOUR_DB_PASSWORD DB_HOST=127.0.0.1
php artisan session:table
php artisan migrate --force
php artisan passport:install
```

#### 接続ユーザの作成

```
gcloud sql users create [USER_NAME] --host='%' --instance=db01 --password=[PASSWORD]
```

### コンソールについて

以下から接続できる。
![](./img/gcp_mysql/2019-10-13-22-07-55.png)
コンソールで、作成したユーザで入れることを確認したほうがよいかと。

#### 設定ファイルの修正

```
runtime: php72

env_variables:
  APP_KEY: YOUR_APP_KEY
  APP_STORAGE: /tmp
  VIEW_COMPILED_PATH: /tmp
  CACHE_DRIVER: database
  SESSION_DRIVER: database
  ## Set these environment variables according to your CloudSQL configuration.
  DB_DATABASE: YOUR_DB_DATABASE
  DB_USERNAME: YOUR_DB_USERNAME
  DB_PASSWORD: YOUR_DB_PASSWORD
  DB_SOCKET: "/cloudsql/YOUR_CONNECTION_NAME"
  APP_LOG: errorlog
```

### passport の外だし

```
php artisan vendor:publish --tag=passport-config
```

.env に書き込む

```
PASSPORT_PRIVATE_KEY="-----BEGIN RSA PRIVATE KEY-----
<private key here>
-----END RSA PRIVATE KEY-----"

PASSPORT_PUBLIC_KEY="-----BEGIN PUBLIC KEY-----
<public key here>
-----END PUBLIC KEY-----"
```

app.yaml は以下のようにする。

```
runtime: php72

env_variables:
  APP_KEY: YOUR_APP_KEY
  APP_STORAGE: /tmp
  VIEW_COMPILED_PATH: /tmp
  CACHE_DRIVER: database
  SESSION_DRIVER: database
  ## Set these environment variables according to your CloudSQL configuration.
  DB_DATABASE: YOUR_DB_DATABASE
  DB_USERNAME: YOUR_DB_USERNAME
  DB_PASSWORD: YOUR_DB_PASSWORD
  DB_SOCKET: "/cloudsql/YOUR_CONNECTION_NAME"
  APP_LOG: errorlog
  PASSPORT_PRIVATE_KEY: |
    -----BEGIN RSA PRIVATE KEY-----
    <private key here>
    -----END RSA PRIVATE KEY-----
  PASSPORT_PUBLIC_KEY: |
    -----BEGIN PUBLIC KEY-----
    <public key here>
    -----END PUBLIC KEY-----
```

### cloud sql について

![](./img/gcp_mysql/2019-10-13-20-36-40.png)
ほとんどデータいれていない状態で、1.13GiB あって少し驚いたけど、
メタデータとかも容量に含まれているのね。

### root で接続できなかった。

再起動して、パスワード変更したら直った。
いったい。。。

### 文字コードについて

デフォルトは utf8。
utf8mb4 にするなら、データベースを作るときに気を付けること。

```
CREATE DATABASE example CHARACTER SET utf8mb4;
```

```
mysql> show variables like 'character%';
+--------------------------+----------------------------+
| Variable_name            | Value                      |
+--------------------------+----------------------------+
| character_set_client     | utf8                       |
| character_set_connection | utf8                       |
| character_set_database   | utf8mb4                    |
| character_set_filesystem | binary                     |
| character_set_results    | utf8                       |
| character_set_server     | utf8                       |
| character_set_system     | utf8                       |
| character_sets_dir       | /usr/share/mysql/charsets/ |
+--------------------------+----------------------------+
8 rows in set (0.04 sec)
```

### 本番用はアカウントを作ったほうがいい模様。

![](./img/gcp_mysql/2019-10-13-22-30-38.png)
![](./img/gcp_mysql/2019-10-13-22-31-22.png)
![](./img/gcp_mysql/2019-10-13-22-34-20.png)
![](./img/gcp_mysql/2019-10-13-22-36-25.png)

## 参考

[Run Laravel on Google App Engine standard environment](https://cloud.google.com/community/tutorials/run-laravel-on-appengine-standard)
[Google App Engine で Laravel を動かして Cloud SQL へ接続してみた](https://memento-mori.jp/blog/back-end/google-app-engine_on_laravel)
[Cloud SQL for MySQL インスタンス](https://cloud.google.com/sql/docs/mysql/create-instance)
[【Docker】AlpineLinux を使った Laravel 環境構築](https://qiita.com/gatapon/items/cfdceedee29570185325)
[Cloud SQL for MySQL ユーザ作成](https://cloud.google.com/sql/docs/mysql/create-manage-users?hl=ja)
[passport](https://readouble.com/laravel/6.0/ja/passport.html)
[Laravel Passport の暗号キー情報を環境変数(.env ファイル)で保持する方法](https://qiita.com/hypermkt/items/6ad0c9535dd1b22ca3be)
[複数行の yaml](https://magazine.rubyist.net/articles/0009/0009-YAML.html#%E8%A4%87%E6%95%B0%E8%A1%8C%E3%81%AE%E6%96%87%E5%AD%97%E5%88%97)
[Laravel5.5 を Google App Engine で動かす](https://qiita.com/fullkawa/items/4d6b080385de5523835c)
[Cloud SQL のタイムゾーンを変える](https://maretol.hatenablog.jp/entry/2017/04/03/141318)
