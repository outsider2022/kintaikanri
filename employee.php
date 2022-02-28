<?php
//SESSIONスタート
//session_start();

//関数を呼び出す
require_once('funcs.php');

//ログインチェック
//loginCheck();

//以下ログインユーザーのみ

$pdo = db_conn();
//２．データ取得SQL作成
//　社員情報を取得
$stmt = $pdo->prepare("SELECT a.*,b.departmentname,c.workplacename FROM employee_mst a 
inner join department_mst b on a.departmentno=b.departmentno left outer join workplace_mst c on a.workplaceno=c.workplaceno where a.activeindicator='Y' order by a.empno;");
$status = $stmt->execute();

//　部門の一覧を取得　ココカラ
$stmt2 = $pdo->prepare("SELECT * FROM department_mst where activeindicator ='Y' order by departmentno asc;");
$status2 = $stmt2->execute();

$view2="";//空のviewを作成
if($status2==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt2->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
    while( $result2 = $stmt2->fetch(PDO::FETCH_ASSOC)){ 
        $view2 .= "<option value='".$result2['departmentno'];
        $view2 .= "'>".$result2['departmentname']."</option>";
       }
    }
//　部門の一覧を取得　ココマデ

//　出社先の一覧を取得　ココカラ
$stmt3 = $pdo->prepare("SELECT * FROM workplace_mst where activeindicator ='Y' order by workplaceno asc;");
$status3 = $stmt3->execute();

$view3="";//空のviewを作成
if($status3==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt3->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while( $result3 = $stmt3->fetch(PDO::FETCH_ASSOC)){ 
        $view3 .= "<option value='".$result3['workplaceno'];
        $view3 .= "'>".$result3['workplacename']."</option>";
       }
    }
//　出社先の一覧を取得　ココマデ


//３．データ表示
$view="";
if($status==false) {
  sql_error($stmt);
}else{
    $view .= '<p>';
    $view .= '<TABLE border="1" width="1300" style="font-size: 10pt">';
    //タイトル表示
    $view .= '<tr bgcolor="#FFDBC9">';
    $view .= '<th>社員番号</th>';
    $view .= '<th>社員名＿漢字</th>';
    $view .= '<th>社員名＿カナ</th>';
    $view .= '<th>所属部門</th>';
    $view .= '<th>Email</th>';
    $view .= '<th>TEL</th>';
    $view .= '<th>通常の勤務先</th>';
    $view .= '<th></th>';
    $view .= '</tr>';
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .= '<tr>';
//    $view .= '<th><a href="detail.php?empno='.$r["empno"].'</a></th>';
    $view .= '<th><a href="empdetail.php?empno='.$r["empno"].'">'.$r["empno"].'</a></th>';
    $view .= '<th>'.$r["empname"].'</th>';
    $view .= '<th>'.$r["empnamekana"].'</th>';
    $view .= '<th>'.$r["departmentname"].'</th>';
    $view .= '<th>'.$r["mail"].'</th>';
    $view .= '<th>'.$r["telno"].'</th>';
    $view .= '<th>'.$r["workplacename"].'</th>';
    $view .= '<th><a href="empdelete.php?empno='.$r["empno"].'">';
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
<title>社員管理</title>
<link rel="stylesheet" href="css/base.css">
<style></style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
      <a href="menu.php">メニューへ戻る</a>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="empinsert.php">
    <fieldset>
    <legend>◆社員追加◆</legend><br>
     <label>社員番号：<input type="text" name="empno" maxlength="12" size="12"></label><br>
     <label>社員名＿漢字：<input type="text" name="empname"></label><br>
     <label>社員名＿カナ：<input type="text" name="empnamekana"></label><br>
     <!-- 所属部門のプルダウン -->
     <label>所属部門:</label>
　      <select name='departmentname'>
  　    <option hidden>選択してください</option>
          <?php
            echo $view2; ?>
      </select><br>
    <label>Email：<input type="email" name="mail"></label><br>
     <label>TEL：<input type="text" name="telno"></label><br>
     <!-- 勤務先のプルダウン --> 
     <label>通常の勤務先：</label>
        <select name='workplacename'>
  　    <option hidden>選択してください</option>
          <?php
            echo $view3; ?>
        </select><br><br>
     <input type="submit" value="追加">
    </fieldset>
</form>
<br>
<legend>◆登録済社員名◆</legend>
<div>
    <?= $view ?>
</div>

<!-- Main[End] -->

</body>
</html>
