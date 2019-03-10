# FindWiki
Wikipediaで閲覧することができるのページ一覧を表示するアプリケーションとなります。

## 【機能】
下記の機能を持ちます。
- Wikiページタイトル一覧表示
- Wikiページタイトル検索
- Wikiページページング移動
- Wikiページリンク移動

### IF
|  パラメータ  |  Name  |  説明  |
| ---- | ---- | ---- |
|  表示件数  |  display  |  画面に表示する件数  |
|  オフセット  |  offset  |  検索結果全体の表示ページ数  |
|  タイトル検索文字  |  title  |  タイトル名で曖昧検索する文字  |

### 画面イメージ
<img src="http://drive.google.com/uc?export=view&id=1ujg9UhEuBwG4OHUCX33j3Ynsff9jQeej" alt="画面" title="画面" >

## 【環境】
下記の環境で動作します。
- CentOS7
- MySQL5.7
- Apache2.4
- php7

### MySQL
下記と同名でDBを作成してください。
もしDB名を変更する場合はコードを修正してください。
```
mysql> create database wiki;
```

 `ddl.sql.gz` を解凍してインポートしてください。

```
$ mysql -u root -p wiki < ddl.sql
```

### Apache
下記のPKGを `yum install` してください。versionは適宜選定してください。
- mod_php
- php-pdo
- php-mysqlnd

 `httpd.conf` に下記の設定を追加してください。
```
// mod_php
LoadModule php7_module <libphp7>
// MySQL
SetEnv DB_HOST <host or IP>
SetEnv DB_PORT <port>
SetEnv DB_USER <username>
SetEnv DB_PASS <password>
```
