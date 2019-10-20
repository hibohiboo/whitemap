## ララベルで使用できるコマンド

```bash
php artisan migrate # マイグレーションでテーブルを作成
php artisan passport:install # passportに必要な情報をDBに登録：
php artisan migrate:rollback # 上記のマイグレーションを取り消す。
php artisan make:migration create_tags_table # tagsテーブルを作成
php artisan make:model Models/Tag # Tagモデルをapp/Modelsディレクトリ配下に作成
php artisan make:seeder UsersTableSeeder # Seeder作成
php artisan db:seed --class=UsersTableSeeder # Seeder実行。--classを付けないとDatabaseSeederに定義されたSeederを実行
php artisan migrate:refresh --seed # db作成しなおし
```

## 参考

[Laravel 6.0 Artisan コンソール](https://readouble.com/laravel/6.0/ja/artisan.html)
[全 68 種類！Laravel 5.6 の artisan コマンドまとめ](https://blog.capilano-fw.com/?p=768)
