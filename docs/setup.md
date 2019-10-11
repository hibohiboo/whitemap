## gcp へのアップロード

laravel_docker/whitemap/app.yaml の準備

```
runtime: php72

env_variables:
  APP_KEY: YOUR_APP_KEY
  APP_STORAGE: /tmp
  VIEW_COMPILED_PATH: /tmp
  SESSION_DRIVER: cookie
  APP_LOG: errorlog
```

laravel_docker/whitemap/.gcloudignore に追記

```diff
/vendor/
+ .env
+ /storage/
```

laravel_docker/whitemap/composer.json に追記

```diff
        "post-create-project-cmd": [
            "@php artisan key:generate --ansi"
        ],
+        "gcp-build": [
+            "composer install --no-dev"
+        ],
+        "post-install-cmd": [
+            "chmod -R 755 bootstrap/cache",
+            "php artisan cache:clear"
+        ]
```

ログインして、デプロイする。
初回デプロイではリージョンを聞かれるので慎重に選ぶ。選びなおせない。
東京なら、[2] asia-northeast1 (supports standard and flexible)を選ぶこと。

```
vagrant@ubuntu-bionic[master]:/vagrant/project/whitemap$ ./bin/gcp_bash.sh
bash-5.0# gcloud auth login
Go to the following link in your browser:

    https://accounts.google.com/o/oauth2/auth?client_id=（省略)


Enter verification code: 4/sAFkwmLC4KLgJEOE9FJra7e_7l689-WoqepTZwnvFjH3ruIppBIypDU
WARNING: (省略))
bash-5.0# gcloud app deploy
You are creating an app for project [プロジェクトID].
WARNING: Creating an App Engine application for a project is irreversible and the region
cannot be changed. More information about regions is at
<https://cloud.google.com/appengine/docs/locations>.

Please choose the region where you want your App Engine application
located:

 [1] asia-east2    (supports standard and flexible)
 [2] asia-northeast1 (supports standard and flexible)
 (省略)

Please enter your numeric choice:  2

Creating App Engine application in project [whitemap-255523] and region [asia-northeast1]....done.
Services to deploy:

descriptor:      [/var/www/app.yaml]
source:          [/var/www]
target project:  [whitemap-255523]
target service:  [default]
target version:  [20191010t232024]
target url:      [https://whitemap-255523.appspot.com]


Do you want to continue (Y/n)?  Y

Beginning deployment of service [default]...
╔════════════════════════════════════════════════════════════╗
╠═ Uploading 78 files to Google Cloud Storage               ═╣
╚════════════════════════════════════════════════════════════╝
File upload done.
Updating service [default]...done.
Setting traffic split for service [default]...done.
Deployed service [default] to [https://プロジェクトID.appspot.com]

You can stream logs from the command line by running:
  $ gcloud app logs tail -s default

To view your application in the web browser run:
  $ gcloud app browse --project=プロジェクトID
bash-5.0#
```
