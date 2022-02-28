<?php
//最初にSESSIONを開始！！ココ大事！！
session_start();

//POST値
// $lid = $_POST['lid'];
// $lpw = $_POST['lpw'];
$lid = $_POST['user_id'];
$lpw = $_POST['password'];

// echo($lid);
// echo($lpw);

//1.  DB接続します
require_once('funcs.php');
$pdo = db_conn();

//2. データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM user");//ここをlidだけに変更
// デバッグ
// $stmt->bindValue(':lid',$lid, PDO::PARAM_STR);
// $stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
// echo($stmt);
// $stmt->bindValue(':lpw',$lpw, PDO::PARAM_STR); 
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
// var_dump($val['id']);
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()

//5. 該当レコードがあればSESSIONに値を代入この部分のif文をpassword_verifyに変更
// if( password_verify($lpw, $val["password"]) ){
//   //Login成功時
//   //省略
//   // $_SESSION['user_id']  = session_id();
//   redirect('menu.php');
// }else{
//   //省略
// }

if( $lpw == $val["password"]) ){
  //Login成功時
  //省略
  $_SESSION['user_id'] = $lid;//SESSION変数に管理者権限のflagを保存
  redirect('./menu.php');

}else{
  //省略
  redirect('insert.php');
}
redirect('./menu.php');
exit();

?>