<?php
//1. POSTデータ取得
$workdate   = $_POST["workdate"];
$empno   = $_POST["empno"];
$workplacename   = $_POST["workplacename"];
$recordID   = $_POST["recordID"];
//現時刻の取得
date_default_timezone_set('Asia/Tokyo');
$endtime = date("H:i");

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//必須項目の入力チェック
if($workplacename=="選択してください") {
  echo '必須項目が入力されていません。<br><br>';
  echo '<a href="' . $_SERVER['HTTP_REFERER'] . '">前に戻る</a>';
}else{
    //データ登録SQL作成
    //現在の滞在場所のレコードを更新し、移動先の追加のレコードを作る
    //★★★要修正！★★★　作成者、更新者をセッションから持ってくる
    $stmt2 = $pdo->prepare("UPDATE transaction SET endtime='$endtime',updatedatetime=sysdate(),updated_name='00000000' where recordID=$recordID;");

    $stmt2->bindValue(':recordID', $recordID, PDO::PARAM_INT);
    $status2 = $stmt2->execute(); //実行

    $stmt3 = $pdo->prepare("INSERT INTO transaction(recordID, workdate, starttime, endtime, empno, workplaceno, remarks, createdatetime, created_name, updatedatetime, updated_name) 
    VALUES (NULL,:workdate,'$endtime',NULL,:empno,:workplacename,NULL,sysdate(),'00000000',sysdate(),'00000000');");
    
    $stmt3->bindValue(':workdate', $workdate, PDO::PARAM_STR);  
    $stmt3->bindValue(':empno', $empno, PDO::PARAM_STR); 
    $stmt3->bindValue(':workplacename', $workplacename, PDO::PARAM_STR); 

    $status3 = $stmt3->execute(); //実行

  }

//４．データ登録処理後
if($status2==false){
  sql_error($stmt2);
}else{
  redirect("workreg.php?empno=".$empno);
}
?>
