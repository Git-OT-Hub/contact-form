# お問い合わせフォーム

## 環境構築
### Dockerビルド
1. git clone git@github.com:Git-OT-Hub/contact-form.git
2. docker compose up -d --build

※ MySQL, phpMyAdmin は、OSによって起動しない場合があるため、それぞれのPCに合わせて docker-compose.yml ファイルを編集してください。

### Laravel環境構築
1. docker compose exec php bash
2. composer install
3. .env.example ファイルから .env を作成し、環境変数を変更
4. php artisan key:generate
5. php artisan migrate
6. php artisan db:seed

### フロントエンドのビルドツール(vite)を起動
1. docker compose exec php bash
2. npm install
3. npm run dev

## 使用技術(実行環境)
### フロントエンド
- HTML
- CSS
- JavaScript
### バックエンド
- PHP 8.2.28
- Laravel 10.48.29
### DB
- MySQL 8.0

## ER図
[![Image from Gyazo](https://i.gyazo.com/68f386ebdecac7161a2948010f297aa5.png)](https://gyazo.com/68f386ebdecac7161a2948010f297aa5)

## URL
- 開発環境：http://localhost/
- phpMyAdmin：http://localhost:8080/
