## view に bootstarp を導入

```
composer require laravel/ui --dev
```

```
php artisan ui bootstrap
```

```
npm install
```

以下のエラーで落ちた。

```
ENOENT: no such file or directory, open '/var/www/node_modules/yargs/node_modules/yargs-parser/package.json.2616725530'
```

[laradock と nuxt で開発環境構築](https://qiita.com/aoarashi/items/535feeca48d15516d450)をみると、同じく落ちているよう。

```
laradock@be06cfe4e524:/var/www$ npm --version
6.11.3
laradock@be06cfe4e524:/var/www$ node --version
v12.11.1
```

```
npm install -g npm@5.7.1
npm install
```

上記をしても解決しない。
原因が違う気がする。
そういえば、以前も、コンテナ上の npm install に失敗した覚えが。。
[npm install すると text file is busy となるエラー](https://qiita.com/hibohiboo/items/cbcff1faa9935671bc5a)
これを試してみる。

```diff:laravel_docker/laradock/workspace/Dockerfile
#
#--------------------------------------------------------------------------
# Final Touch
#--------------------------------------------------------------------------
#
+ RUN mkdir -p /var/www/node_modules
+ RUN chmod 777 /var/www/node_modules

USER root
```

```diff:laravel_docker/laradock/docker-compose.yml
    volumes:
      - ${APP_CODE_PATH_HOST}:${APP_CODE_PATH_CONTAINER}${APP_CODE_CONTAINER_FLAG}
+      - /var/www/node_modules # コンテナ内のnode_modulesを使用. npm install でエラーとなるため。
```

```
./bin/bash.sh
npm i
```

動いた！ こちらの原因は、 windows のファイルシステムだった模様。
npm install しているときの一時ファイルが深すぎたり、とかだろうか。

以下のコマンドで、取得したファイルのビルドなどを開始する。

```
npm run watch-poll
```

これによって作成されるバンドルファイルを、レイアウトファイルから読み込むなどする。

```diff:larabel_docker/whitemap/resources/views/layouts/app.blade.php
        </nav>
        @yield('content')
    </div>

    <!-- Scripts -->
+    <script src="{{ asset('js/app.js') }}"></script>
  </body>
</html>

```

[ここまでのソース](https://github.com/hibohiboo/whitemap/tree/587ffa617f70f62079c7e67191cc9fcba2e07870/laravel_docker)

## typescript の導入

### インストール

```
npm install --save-dev ts-loader typescript
```

### 設定

```json
{
  "compilerOptions": {
    "outDir": "./built/",
    "sourceMap": true,
    "strict": true,
    "noImplicitReturns": true,
    "noImplicitAny": true,
    "module": "es2015",
    "experimentalDecorators": true,
    "emitDecoratorMetadata": true,
    "moduleResolution": "node",
    "target": "es6",
    "lib": ["es2016", "dom"]
  },
  "include": ["resources/ts/**/*"]
}
```

- experimentalDecorators: decolater を使用可能になる。
  - [参考](http://js.studio-kingdom.com/typescript/handbook/decorators)

* mix に ts 使用を追加

```diff:webpack.mix.js
+ mix.ts("resources/ts/welcome/index.ts", "public/js/welcome");
```

### 使用

```diff:resources/view/welcome.blade.php
@section('scripts')
+ <script src="{{ mix('js/welcome/index.js') }}"></script>
@endsection
```

### 外部モジュールの読み込み

以下を追記。cdn から読み込みソースはくみこまないようにする。

```js:webpack.mix.js
mix.webpackConfig({
  externals: {
    jquery: "jQuery",
    firebase: "firebase",
    firebaseui: "firebaseui",
    axios: "axios"
  }
});
```

使用。`import * as`か`import`かの読み込みかたの違いはライブラリの export の形式による。

```
import * as firebase from "firebase";
import axios from "axios";
```

## 参考

[Laravel6.0 で Vue.js と Bootstrap を使う方法](https://www.webopixel.net/php/1554.html)
[laravel frontend](https://laravel.com/docs/6.x/frontend)
[laravel/ui](https://github.com/laravel/ui)
[laradock と nuxt で開発環境構築](https://qiita.com/aoarashi/items/535feeca48d15516d450)
[Laravel5.5 インストールから Bootstrap4 を導入するまで](https://qiita.com/hondy12345/items/fef482c347b883acff84)
[Laravel Mix](https://readouble.com/laravel/6.0/ja/mix.html)
[typescript の利用](https://bsblog.casareal.co.jp/archives/1993)
[typescript で import しなくても jquery が使えるようになっていたので、他の外部ライブラリとして chart.js を読み込んでみたメモ](https://qiita.com/hibohiboo/items/400a4206bbceb56e45e5)
