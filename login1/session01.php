<?php
// SESSIONスタート
session_start();
// SESSIONのidを取得
$sid = session_id();
// SESSION変数にデータを登録
$_SESSION["id"] = "00930448";
$_SESSION["password"] = YTC;
echo $sid;
?>
