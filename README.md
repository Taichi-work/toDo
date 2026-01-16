# Laravel ToDo App

Laravel + Breeze + Tailwind CSS を用いて作成した、  
**ユーザー認証付きの ToDo 管理アプリケーション**です。

タスクの作成・編集・削除に加え、  
**期限管理・完了状態の切り替え・認可（Policy）**を実装しています。

---

## 📌 プロジェクト概要

### プロジェクト名
Laravel ToDo App

### 概要
ログインしたユーザーごとにタスク（ToDo）を管理できる Web アプリケーションです。  
未完了・完了済みのタスクを分けて表示し、期限が近いタスクを優先的に確認できます。

### 想定ユーザー
- 個人でタスク管理をしたいユーザー
- Laravel 学習者・ポートフォリオ閲覧者

### 解決する課題
- タスクの「期限」「完了状態」を一目で把握できない
- 他ユーザーのデータが操作できてしまうセキュリティリスク

→ **認証・認可（Policy）を用いて安全に解決**

---

## 🛠 技術スタック

### 言語
- PHP 8.x
- JavaScript

### フレームワーク
- Laravel 12
- Laravel Breeze（Blade）

### ライブラリ / ツール
- Tailwind CSS
- Vite
- Alpine.js（Breeze 依存）

### その他
- Docker / Laravel Sail
- MySQL
- Git / GitHub

---

## ✨ 主な機能

- ユーザー登録 / ログイン（Laravel Breeze）
- タスクの CRUD（作成・編集・削除）
- タスクの完了 / 未完了切り替え
- 期限（日付）設定機能
- 期限切れタスクの視覚的強調表示
- 作成日の表示
- Policy による認可制御（自分のタスクのみ操作可能）
- Tailwind CSS によるレスポンシブ UI

---

## 🔮 今後の改善予定
タスクの並び替え（期限順・作成日順）

優先度（High / Medium / Low）の追加

カレンダービュー表示

フロントエンドのアニメーション強化

テストコード（Feature / Policy Test）の追加

---

## 🧑‍💻 使い方
ユーザー登録またはログイン

「タスクを追加」から新規 ToDo を作成

チェックボックスで完了 / 未完了を切り替え

編集・削除は自分のタスクのみ可能

期限切れタスクは色で判別可能

---

## 🚀 セットアップ方法

### 1. リポジトリをクローン
```bash
git clone https://github.com/yourname/laravel-todo-app.git
cd laravel-todo-app
2. 環境変数の設定
bash
コードをコピーする
cp .env.example .env
3. コンテナ起動（Laravel Sail）
bash
コードをコピーする
./vendor/bin/sail up -d
4. 依存関係のインストール
bash
コードをコピーする
./vendor/bin/sail composer install
./vendor/bin/sail npm install
5. アプリケーションキー生成
bash
コードをコピーする
./vendor/bin/sail artisan key:generate
6. マイグレーション実行
bash
コードをコピーする
./vendor/bin/sail artisan migrate
7. フロントエンドビルド
bash
コードをコピーする
./vendor/bin/sail npm run dev
8. ブラウザでアクセス
arduino
コードをコピーする
http://localhost
