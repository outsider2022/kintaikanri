<?php
//1. POSTデータ取得
$departmentno   = $_POST["departmentno"];
$departmentname  = $_POST["departmentname"];

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO department_mst(departmentno,departmentname,activeindicator)VALUES(:departmentno,:departmentname,'Y')");
$stmt->bindValue(':departmentno', $departmentno, PDO::PARAM_STR); 
$stmt->bindValue(':departmentname', $departmentname, PDO::PARAM_STR); 
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("department.php");
}
?>
