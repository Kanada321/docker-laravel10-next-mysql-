構築手順
元：https://github.com/Kanada321/docker-laravel-react-typescript
参考：https://zenn.dev/ponta/books/95e0984aa9dcbd/viewer/74503b
https://qiita.com/higemegane1992/items/defd193f4c8752ca9996

nginxでは、/apiは、laravelを/はnextを参照するようにしている

環境構築
next

docker-compose build
Next.jsをインストールします。
docker-compose run --rm next npx create-next-app . --ts
全てyesで入れます。
"next": "14.2.3"が入りました。

docker compose up

下記の全てのURLでNEXT.jsの画面が見えることを確認する
http://localhost:3000/
http://localhost:802/
https://localhost:4432/

Laravel
10でいれる
docker-compose exec api composer create-project --prefer-dist laravel/laravel="10.*" .

laravelの.envを設定する

backend/routes/api.php
Route::get('/', function () {
    return response('Hello World', 200)
        ->header('Content-Type', 'text/plain');
});

ブラウザで接続
http://localhost:802/api/
Hello Worldが表示される

Laravel側認証
docker-compose exec next npm install axios
docker-compose exec next npm install @types/axios
https://qiita.com/masakiwakabayashi/items/58734b3988d5fac814fb

https://qiita.com/yugami/items/f46aaaff7be32922d0f3
https://zenn.dev/yamadadayo123/articles/6cb4f586de0183
https://qiita.com/zaburo/items/65de44194a2e67b59061
https://qiita.com/ucan-lab/items/3e7045e49658763a9566


