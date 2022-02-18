<?php
//SESSIONスタート
//session_start();

//関数を呼び出す
require_once('funcs.php');

//ログインチェック
//loginCheck();

//以下ログインユーザーのみ

$pdo = db_conn();
//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM workplace_mst where activeindicator='Y' order by workplaceno;");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  sql_error($stmt);
}else{
    $view .= '<p>';
    $view .= '<TABLE border="1" width="1000" style="font-size: 10pt">';
    //タイトル表示
    $view .= '<tr bgcolor="#FFDBC9">';
    $view .= '<th width="50">No.</th>';
    $view .= '<th width="150">出社先</th>';
    $view .= '<th width="100">郵便番号</th>';
    $view .= '<th width="600">住所</th>';
    $view .= '<th></th>';
    $view .= '</tr>';
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .= '<tr>';
    ;
    $view .= '<th>'.$r["workplaceno"].'</th>';
    $view .= '<th>'.$r["workplacename"].'</th>';
    $view .= '<th>'.$r["postcode"].'</th>';
    $view .= '<th>'.$r["address"].'</th>';
    $view .= '<th><a href="workplacedelete.php?workplaceno='.$r["workplaceno"].'">';
    $view .= '[<i ></i>削除]';
    $view .= '</a></th>';
    $view .= '</tr>';
  }
}
    $view .= '</TABLE>';
    $view .= '</p>';
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>出勤先管理</title>
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
<form method="POST" action="workplaceinsert.php">
    <fieldset>
    <legend>◆出社先追加◆</legend><br>
     <label>No.：<input type="text" name="workplaceno" maxlength="4" size="4"></label><br>
     <label>出社先：<input type="text" name="workplacename"></label><br>
     <label>郵便番号：<input type="text" name="postcode" maxlength="7" size="7"></label><br>
     <label>住所：<input type="text" name="address" maxlength="40" size="40"></label><br>
     <br>
     <input type="submit" value="追加">
    </fieldset>
</form>
<br>
<legend>◆登録済出社先◆</legend>
<div>
    <?= $view ?>
</div>

<!-- Main[End] -->

</body>
</html>
