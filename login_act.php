<?php
//最初にSESSIONを開始！！ココ大事！！
session_start();
//POST値
$id = $_POST['id'];
$password = $_POST['password'];

//1.  DB接続します
require_once('funcs.php');
$pdo = db_conn();

//2. データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM user WHERE id = :id;");
$stmt->bindValue(':id',$id, PDO::PARAM_STR);
//$stmt->bindValue(':password',$password, PDO::PARAM_STR); 
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
// var_dump($val['id']);
// var_dump($val['password']);
// var_dump($val['ROLE']);

//5. 該当レコードがあればSESSIONに値を代入
//* if(password_verify($lpw, $val["lpw"])){
if( password_verify($password, $val["password"]) ){
  //Login成功時
  $_SESSION['chk_ssid']  = session_id();//SESSION変数にidを保存
  $_SESSION['id']      = $val['id'];//SESSION変数にuser_idを保存
  $_SESSION['ROLE'] = $val['ROLE'];//SESSION変数にuser_ROLEを保存
  redirect('menu.php');
}else{
  //Login失敗時(Logout経由)
  redirect('index.php');
}

exit();
?>


