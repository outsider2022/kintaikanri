<?php
//セッションをスタート
session_start();

//関数を呼び出して
require_once('funcs.php');

//ログインチェック
loginCheck();


//1. データ取得
$empno = $_GET["empno"];

//var_dump($empno)


//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();


//社員データ取得　ココカラ
$stmt = $pdo->prepare("SELECT a.*,b.*,c.workplacename FROM employee_mst a 
inner join department_mst b on a.departmentno=b.departmentno 
left outer join workplace_mst c on a.workplaceno=c.workplaceno 
where a.empno = :empno AND a.activeindicator='Y';");

$stmt->bindValue(':empno', $empno, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

$view="";
if($status==false) {
  sql_error($stmt);
}else{
    $r = $stmt->fetch();
}
//社員データ取得　ココマデ

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
      //デフォルトの出社先が入っている場合はそちらを初期表示する
      if( $result2['workplaceno'] == $r['workplaceno']) {
        $view2 .= "<option value='".$result2['workplaceno'];
        $view2 .= "' selected>".$result2['workplacename']."</option>";
      } 
      else{
        $view2 .= "<option value='".$result2['workplaceno'];
        $view2 .= "'>".$result2['workplacename']."</option>";
       }
      }
}
//出社先の一覧を取得　ココマデ

//現日時の取得
date_default_timezone_set('Asia/Tokyo');
$cur_date=date("Y-m-d");
$starttime = date("H:i");

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
<div style="text-align:center"><b>出社登録を行います。出社先を確認して登録ボタンを押してください。</b></div>
<div style="text-align:right"><button onclick="" id="gpstest">位置情報を取得する</button></div>
<form method="POST" action="workinsert.php">
<div style= "margin-left: 50px; width:1450px">
    <TABLE border="1" width="1300" style="font-size: 10pt">
    <TR bgcolor="#afeeee">
    <TH>日付</TH>
    <TH>滞在開始時間</TH> 
    <TH>滞在終了時間</TH>
    <TH>社員番号</TH>
    <TH>社員名</TH>
    <TH>所属</TH>
    <TH>出社先</TH>
    <TH></TH>
    </TR>
    <TR>
    <TH><label><input type="date" name="workdate" value=<?=$cur_date?>></label></TH>
    <TH><label><input type="time" name="starttime" value=<?=$starttime?>></lebel></TH>
    <TH><label>----</label></TH>
    <TH><?=$r["empno"]?></TH>
    <TH><?=$r["empname"]?></TH>
    <TH><?=$r["departmentname"]?></TH>
    <TH><select name='workplacename'><option hidden>選択してください</option><?php echo $view2; ?></select></TH>
    <TH><input type="submit" value="出社登録"></TH>
    </TR>
    </TABLE>
</div>
     
     <input type="hidden" name="empno" value="<?=$empno?>">
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
