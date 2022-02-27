<?php
//セッションをスタート
//session_start();

//関数を呼び出して
require_once('funcs.php');

//ログインチェック
//loginCheck();

//1. データ取得
$empno = $_GET["empno"];

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//出社先の一覧を取得　ココカラ
$stmt2 = $pdo->prepare("SELECT * FROM workplace_mst where activeindicator ='Y' order by workplaceno asc;");
$status2 = $stmt2->execute();

$view2="";//空のviewを作成
if($status2==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt2->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while( $result2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
        $view2 .= "<option value='".$result2['workplaceno'];
        $view2 .= "'>".$result2['workplacename']."</option>";
       }
}
//出社先の一覧を取得　ココマデ


//トランザクションデータ取得　ココカラ
$stmt = $pdo->prepare("SELECT a.*,b.empname,c.workplacename,d.departmentname from transaction a 
inner join employee_mst b on a.empno=b.empno 
inner join workplace_mst c on a.workplaceno=c.workplaceno 
inner join department_mst d on b.departmentno=d.departmentno 
where a.empno = :empno and b.activeindicator='Y' and a.workdate<>CURRENT_DATE() and a.endtime is null order by a.workdate,a.starttime asc;");

$stmt->bindValue(':empno', $empno, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

$view="";

if($status==false) {
  sql_error($stmt);
}else{
  $view .= '<p>';
  $view .= '<TABLE border="1" width="1300" style="font-size: 10pt">';
  //タイトル表示
  $view .= '<tr bgcolor="#ff4500">';
  $view .= '<th>日付</th>';
  $view .= '<th>滞在開始時間</th>';
  $view .= '<th>滞在終了時間</th>';
  $view .= '<th>社員番号</th>';
  $view .= '<th>社員名</th>';
  $view .= '<th>所属先</th>';
  $view .= '<th>滞在先</th>';
  $view .= '<th></th>';
  $view .= '</tr>';
while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){
  //終了日が入っていないものは移動ボタンを表示
    $view .= '<tr>';
    $view .= '<th>'.$r["workdate"].'</th>';
    $view .= '<th>'.$r["starttime"].'</th>';
    $view .= '<th>未登録</th>';
    $view .= '<th>'.$r["empno"].'</th>';
    $view .= '<th>'.$r["empname"].'</th>';
    $view .= '<th>'.$r["departmentname"].'</th>';
    $view .= '<th>'.$r["workplacename"].'</th>';
    $view .= '<th>'.'<a href="workdetail.php?recordID='.$r['recordID'].'">修正</a>'.'</th>';

  }
}

//トランザクションデータ取得　ココマデ

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>未登録</title>
  <link href="css/base.css" rel="stylesheet">
  <style></style>
</head>
<body>

<!-- Head[Start] -->
<header>
    <div><a href="menu.php">メニューへ</a></div>
    <div><a href="workdetails.php">詳細一覧</a></div>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div style="text-align:center">退勤情報が登録されていないデータが存在します。<br>
退勤時間を登録してください。
</div>
<form method="POST" action="workinsert2.php">
<div style= "margin-left: 50px; width:1450px">
    <?=$view?>
    </TR>
    </TABLE>
</div>

</div>
</form>
<!-- Main[End] -->

</form>

</body>
</html>
