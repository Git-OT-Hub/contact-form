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

## テストを実施する場合
### テスト用の環境構築
1. docker compose exec mysql bash
2. mysql -u root -p
3. CREATE DATABASE laravel_test_db;
4. SHOW databases; で「laravel_test_db」が作成されていることを確認
5. .env ファイルから .env.testing を作成し、環境変数をテスト用に変更
6. docker compose exec php bash で php コンテナに入る
7. php artisan key:generate --env=testing
8. php artisan config:clear
9. php artisan migrate --env=testing

※ テストコードを実行する際は、事前に「npm run dev」でフロントエンドのビルドツール(vite)を起動させておいてください。

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
