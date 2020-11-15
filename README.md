# OthelloGame

## 仕様

* オセロゲーム
* コンソール上で実装
* NPC対戦
    * 着手可能手をランダムに指す。
    * 最大枚数を取得する手を返す。

### OS

* debian 10.6

### php

* php7

### DB

* ~~mysql5.6~~
    * debianではmariaDBがデフォルト
    * mysqlを入れるのは手間がかかるのでmariaDBをインストール

* mariaDB 
* 記録する内容
    * プレイヤー
        * player_id
        * password
    * 対戦ログ