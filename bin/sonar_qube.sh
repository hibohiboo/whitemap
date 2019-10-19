#!/bin/bash

# このシェルスクリプトのディレクトリの絶対パスを取得。
bin_dir=$(cd $(dirname $0) && pwd)
parent_dir=$(cd $bin_dir/.. && pwd)
docker_dir=$(cd $parent_dir/laravel_docker/laradock && pwd)
container_name=sonarqube
arg1=${1:-none}
cd $docker_dir

if [ $arg1 = "init-log" ]; then
  echo "start my log"
  cd $docker_dir && docker-compose run --user=root --rm sonarqube chown sonarqube:sonarqube /opt/sonarqube/logs
  exit 0
elif [ $arg1 = "init-db" ]; then
  echo "start my db"
  cd $docker_dir && docker-compose exec --user=root postgres /bin/bash
  exit 0
elif [ $arg1 = "bash" ]; then
  echo "start my bash"
  cd $docker_dir && docker-compose run $container_name /bin/bash
  exit 0
elif [ $arg1 = "up" ]; then
  echo "start my up"
  cd $docker_dir &&  docker-compose up sonarqube
  exit 0
fi

# $container_nameの有無をgrepで調べる
docker ps | grep $container_name

# grepの戻り値$?の評価。 grep戻り値 0:一致した 1:一致しなかった
if [ $? -eq 0 ]; then
  # 一致したときの処理
  cd $docker_dir && docker-compose up -d sonarqube
else
  # 一致しなかった時の処理
  # コンテナを立ち上げて接続
  cd $docker_dir && docker-compose up -d sonarqube
fi



## docker-compose up -d sonarqube
## (If you encounter a database error)
## docker-compose exec --user=root postgres
## source docker-entrypoint-initdb.d/init_sonarqube_db.sh
## (If you encounter logs error)
## docker-compose run --user=root --rm sonarqube chown sonarqube:sonarqube /opt/sonarqube/logs
