<?php
// SESSIONスタート
session_start();
// SESSION変数を取得
$id = $_SESSION["id"];
$password = $_SESSION["password"];
echo $id;
echo $pass;
?>