<?php
// 登録情報確認画面

//SESSIONスタート
//session_start();

//関数を呼び出す
require_once('funcs.php');

//ログインチェック
//loginCheck();

//以下ログインユーザーのみ

//テーブルのヘッダー表示
$view = '';
$view .= '<p>';
$view .= '<TABLE border="1" width="1000" style="font-size: 10pt">';
//タイトル表示
$view .= '<tr bgcolor="#FFDBC9">';
$view .= '<th width="50">No.</th>';
$view .= '<th width="200">出勤日</th>';
$view .= '<th width="200">出勤時間</th>';
$view .= '<th width="200">退勤時間</th>';
$view .= '<th width="200">社員番号</th>';
$view .= '<th width="250">社員名</th>';
$view .= '<th width="300">所属</th>';
$view .= '<th width="250">出社先</th>';
$view .= '<th width="400">備考</th>';
$view .= '</tr>';

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>登録内容確認画面</title>
<link rel="stylesheet" href="css/base.css">
<style></style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
      <a href="menu.php">メニューへ戻る</a>
      <br>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="administratorsearch.php">

</form>
<br>
<legend>◆登録内容確認（過去７日分）◆</legend>
<div>
    <?= $view ?>
</div>

<!-- Main[End] -->

</body>
</html>