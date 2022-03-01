<?php
//セッションをスタート
session_start();

//関数を呼び出して
require_once('funcs.php');

//ログインチェック
loginCheck();

//1. データ取得
$empno = $_GET["empno"];

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();


//トランザクションデータ取得　ココカラ
$stmt = $pdo->prepare("SELECT a.*,b.empname,c.workplacename,d.departmentname from transaction a 
inner join employee_mst b on a.empno=b.empno 
inner join workplace_mst c on a.workplaceno=c.workplaceno 
inner join department_mst d on b.departmentno=d.departmentno 
where a.empno = :empno and b.activeindicator='Y' order by createdatetime asc;");

$stmt->bindValue(':empno', $empno, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

$view="";
$view3="";

if($status==false) {
  sql_error($stmt);
}else{
  $view .= '<p>';
  $view .= '<TABLE border="1" width="1300" style="font-size: 10pt">';
  //タイトル表示
  $view .= '<tr bgcolor="#ffdead">';
  $view .= '<th>日付</th>';
  $view .= '<th>滞在開始時間</th>';
  $view .= '<th>滞在終了時間</th>';
  $view .= '<th>社員番号</th>';
  $view .= '<th>社員名</th>';
  $view .= '<th>所属先</th>';
  $view .= '<th>滞在先</th>';
  $view .= '</tr>';
while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<tr>';
    $view .= '<th>'.$r["workdate"].'</th>';
    $view .= '<th>'.$r["starttime"].'</th>';
    $view .= '<th>'.$r["endtime"].'</th>';
    $view .= '<th>'.$r["empno"].'</th>';
    $view .= '<th>'.$r["empname"].'</th>';
    $view .= '<th>'.$r["departmentname"].'</th>';
    $view .= '<th>'.$r["workplacename"].'</th>';
  }
}


//トランザクションデータ取得　ココマデ

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>出社登録</title>
  <link href="css/base.css" rel="stylesheet">
  <style></style>
</head>
<body>

<!-- Head[Start] -->
<header>
    <div><a href="menu.php">メニューへ</a></div>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div style="text-align:center">登録一覧</div>
<form method="POST" action="workinsert2.php">
<div style= "margin-left: 50px; width:1450px">
    <?=$view?>
    </TR>
    </TABLE>
</div>

</div>
</form>
<!-- Main[End] -->
<br><br>

<?=$view3?>

</form>

</body>
</html>
