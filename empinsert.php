<?php
//1. POSTデータ取得
$empno   = $_POST["empno"];
$empname   = $_POST["empname"];
$empnamekana   = $_POST["empnamekana"];
$departmentno   = $_POST["departmentname"];
$mail   = $_POST["mail"];
$telno   = $_POST["telno"];
$workplaceno   = $_POST["workplacename"];


//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO employee_mst(empno,empname,empnamekana,departmentno,mail,telno,workplaceno,activeindicator,createdatetime,updatedatetime)VALUES(:empno,:empname,:empnamekana,:departmentno,:mail,:telno,:workplaceno,'Y',sysdate(),sysdate())");
$stmt->bindValue(':empno', $empno, PDO::PARAM_STR);
$stmt->bindValue(':empname', $empname, PDO::PARAM_STR); 
$stmt->bindValue(':empnamekana', $empnamekana, PDO::PARAM_STR); 
$stmt->bindValue(':departmentno', $departmentno, PDO::PARAM_STR); 
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR); 
$stmt->bindValue(':telno', $telno, PDO::PARAM_STR); 
$stmt->bindValue(':workplaceno', $workplaceno, PDO::PARAM_STR); 
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("employee.php");
}
?>
