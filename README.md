# Atte
勤怠管理アプリ

<img width="1039" alt="スクリーンショット 2024-05-10 18 22 59" src="https://github.com/KuritaNagomi/Beginner-exercises20240510/assets/147139384/da9a2d16-35ba-4bf1-80bf-24e8ddb5c84c">

##目的
勤怠管理を円滑にするため

##URL
開発環境　http://localhost/

phpMyAdmin http://localhost:8080/

##他のリポジトリ

##機能一覧
ユーザー登録機能、メール認証機能、ログイン機能、出勤打刻、退勤打刻、休憩開始打刻、休憩終了打刻、日付ごとに一覧表示、社員一覧表示、各社員の勤怠履歴表示

##使用技術
Laravel 8.83.27, php

##テーブル設計

<img width="505" alt="スクリーンショット 2024-05-10 11 02 58" src="https://github.com/KuritaNagomi/Beginner-exercises20240510/assets/147139384/fffaae7c-0eaa-41a1-974e-79bedee76360">

##ER図

![atte drawio](https://github.com/KuritaNagomi/Beginner-exercises20240510/assets/147139384/ea2aff37-f5e4-442f-8239-56b5c987cab8)

##環境構築
Dockerビルド

git clone git@github.com:KuritaNagomi/beginner-exercises20240510.git

docker-compose up -d --build

Laravel環境構築

docker-compose exec php bash

composer install

.env.exampleファイルから.envを作成し、環境変数を変更

php artisan key:generate
php artisan migrate
php artisan db:seed
