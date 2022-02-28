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
where a.empno = :empno and b.activeindicator='Y' and a.workdate=CURRENT_DATE() order by starttime asc,createdatetime asc;");

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
  $view .= '<th>移動先</th>';
  $view .= '<th></th>';
  $view .= '</tr>';
while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){
  //終了日が入っていないものは移動ボタンを表示
  if(is_null($r["endtime"])) {
    $view .= '<tr>';
    $view .= '<th>'.$r["workdate"].'</th>';
    $view .= '<th>'.$r["starttime"].'</th>';
    $view .= '<th>----</th>';
    $view .= '<th>'.$r["empno"].'</th>';
    $view .= '<th>'.$r["empname"].'</th>';
    $view .= '<th>'.$r["departmentname"].'</th>';
    $view .= '<th>'.$r["workplacename"].'</th>';
    $view .= '<TH><select name="workplacename"><option hidden>選択してください</option>'.$view2.'</select></TH>';
    $view .= '<th><input type="submit" value="移動"></th>';

    $view .= '<input type="hidden" name="recordID" value='.$r["recordID"].'>';
    $view .= '<input type="hidden" name="workdate" value='.$r["workdate"].'>';
    $view .= '<input type="hidden" name="empno" value='.$r["empno"].'>';

    $view3 .= '<input type="hidden" name="recordID" value='.$r["recordID"].'>';
  
  }else{
    $view .= '<tr>';
    $view .= '<th>'.$r["workdate"].'</th>';
    $view .= '<th>'.$r["starttime"].'</th>';
    $view .= '<th>'.$r["endtime"].'</th>';
    $view .= '<th>'.$r["empno"].'</th>';
    $view .= '<th>'.$r["empname"].'</th>';
    $view .= '<th>'.$r["departmentname"].'</th>';
    $view .= '<th>'.$r["workplacename"].'</th>';
    $view .= '<th></th>';
    $view .= '<th></th>';
  }
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
    <div><a href="workdetails.php">詳細一覧</a></div>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div style="text-align:center">オフィスの移動やフロアの移動をする場合には移動時点で移動先を追加してください。</div>
<div style="text-align:right"><button onclick="" id="gpstest">位置情報を取得する</button></div>
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

<p style="text-align:center">他のオフィスへ移動せずに本日の出社勤務が終了となる場合には以下をクリックしてください。</p>

<form method="POST" action="workinsert3.php">

<div style="text-align:center"><input type="submit" value="退勤処理" style="width:200px;height:100px;font-weight : bold;"></div>

<?=$view3?>

</form>

</body>
</html>
