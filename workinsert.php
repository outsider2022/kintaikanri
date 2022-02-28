<?php
//1. POSTデータ取得
$workdate   = $_POST["workdate"];
$starttime   = $_POST["starttime"];
$empno   = $_POST["empno"];
$workplacename   = $_POST["workplacename"];

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//必須項目の入力チェック
if(empty($workdate)==true || empty($starttime)==true || $workplacename=="選択してください") {
  echo '必須項目が入力されていません。<br><br>';
  //var_dump($workdate,$starttime,$empno,$workplacename);
  echo '<a href="' . $_SERVER['HTTP_REFERER'] . '">前に戻る</a>';
}else{
    //データ登録SQL作成
    //★★★要修正！★★★　作成者、更新者をセッションから持ってくる
    $stmt2 = $pdo->prepare("INSERT INTO transaction(recordID,workdate,starttime,endtime,empno,workplaceno,createdatetime,created_name,updatedatetime,updated_name)
      VALUES(NULL,:workdate,:starttime,NULL,:empno,:workplacename,sysdate(),'00000000',sysdate(),'00000000');");

    $stmt2->bindValue(':workdate', $workdate, PDO::PARAM_STR);  
    $stmt2->bindValue(':starttime', $starttime, PDO::PARAM_STR); 
    $stmt2->bindValue(':empno', $empno, PDO::PARAM_STR); 
    $stmt2->bindValue(':workplacename', $workplacename, PDO::PARAM_STR); 
    $status2 = $stmt2->execute(); //実行
}

//４．データ登録処理後
if($status2==false){
  sql_error($stmt2);
}else{
  redirect("workreg.php?empno=".$empno);
}
?>
