<?php
//1. POSTデータ取得
$workplaceno   = $_POST["workplaceno"];
$workplacename  = $_POST["workplacename"];
$postcode  = $_POST["postcode"];
$address  = $_POST["address"];

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO workplace_mst(workplaceno,workplacename,postcode,address,activeindicator)VALUES(:workplaceno,:workplace,:postcode,:address,'Y')");
$stmt->bindValue(':workplaceno', $workplaceno, PDO::PARAM_STR);
$stmt->bindValue(':workplace', $workplacename, PDO::PARAM_STR); 
$stmt->bindValue(':postcode', $postcode, PDO::PARAM_STR); 
$stmt->bindValue(':address', $address, PDO::PARAM_STR); 
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("workplace.php");
}
?>
