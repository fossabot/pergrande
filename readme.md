[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2Fkorai0001%2Fpergrande.svg?type=shield)](https://app.fossa.io/projects/git%2Bgithub.com%2Fkorai0001%2Fpergrande?ref=badge_shield)

オンライン家計簿システム

① ソフトの目的
作者である紅雷が、家計簿をつけようと思い立ってでっちあげた、収入/支出管理用WEBアプリケーションです。  
WEBインターフェイスを使って収入/支出を入力し検索集計する事が可能です  
PC用画面と、スマートフォン用の画面があります  
 
② ライセンス  
このアプリケーションに含まれるソース一式は、  
すべてGPL v2.0のライセンスにおいて再頒布を許可することとします。  
GPL v2.0に関する詳しい情報は  
http://www.gnu.org/licenses/gpl-2.0.html  
で確認してください。  
また、将来このアプリケーションがGPL v3.0以降に  
ライセンスを移行することはありません。  
  
③設定方法  
mysqlとphpが動作するサーバーを用意します  
kakeibo/kakeiboというユーザーを用意し、同名のDBを用意します  
(WEBサーバーと違うマシンにDBがある場合、config.phpを書き換えてください)  
setupフォルダ内のcreate.sql及びinsert.sqlのデータを流し込んでテーブルと初期データを設定します  
  
管理ユーザーとしてadmin/passwordでログインできるユーザーを初期データで流し込んでいますので、  
そのユーザーで、ログインし、管理画面で自分自身を作ってください。  
  
わかってると思うけど、パスワードの暗号方式はちゃんとしたのに変えて運用した方がいいと思うよ  
デフォルトで仕込んであるものは暗号とはいいがたい代物だ  


## License
[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2Fkorai0001%2Fpergrande.svg?type=large)](https://app.fossa.io/projects/git%2Bgithub.com%2Fkorai0001%2Fpergrande?ref=badge_large)