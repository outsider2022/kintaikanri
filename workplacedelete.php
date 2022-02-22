<?php
//セッションをスタート
//session_start();

//関数を呼び出して
require_once('funcs.php');

//ログインチェック
//loginCheck();


//1. データ取得
$workplaceno = $_GET["workplaceno"];

//var_dump($workplaceno)


//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();


//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE workplace_mst SET activeindicator = 'N' WHERE workplaceno = :workplaceno;" );
$stmt->bindValue(':workplaceno', $workplaceno, PDO::PARAM_INT); 
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("workplace.php");
}
?>
