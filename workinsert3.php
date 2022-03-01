<?php

//セッションをスタート
session_start();

//退勤処理、データ修正

//1. POSTデータ取得
$recordID   = $_POST["recordID"];
$starttime   = $_POST["starttime"];
$endtime   = $_POST["endtime"];
$remarks   = $_POST["remarks"];

$id=$_SESSION['id'];

//入力エラーの有無確認FLG
$HbFlg="";
//画面遷移確認用FLG（1＝退勤処理、それ以外はデータ修正）
$screen_chk="";

//時間の整合性チェック
if ($endtime < $starttime){
  echo '終了時間が開始時間より前になっています。<br><br>';
  echo '<a href="' . $_SERVER['HTTP_REFERER'] . '">前に戻る</a>';
  $HbFlg="1";
}elseif($endtime==null){
  //終了時間が連携されていない場合（退勤処理から来ている場合）は現時刻の取得
  date_default_timezone_set('Asia/Tokyo');
  $endtime = date("H:i");
  //退勤処理から来ている場合にはClose画面に遷移させる為、FLGを立てる
  $screen_chk="1";
}

//時間の整合性チェックで問題がない場合のみ後続処理
if ($HbFlg<>"1"){
  var_dump($HbFlg,$endtime,$recordID);

  //DB接続します
require_once('funcs.php');

//ログインチェック
loginCheck();


$pdo = db_conn();

//データ更新SQL作成
$stmt2 = $pdo->prepare("UPDATE transaction SET endtime=:endtime,remarks=:remarks,updated_name=$id,updatedatetime=sysdate() where recordID=:recordID;");
$stmt2->bindValue(':recordID', $recordID, PDO::PARAM_INT);
$stmt2->bindValue(':endtime', $endtime, PDO::PARAM_STR);
$stmt2->bindValue(':remarks', $remarks, PDO::PARAM_STR);
$status2 = $stmt2->execute(); //実行


//データ登録処理後
  if($status2==false){
    sql_error($stmt2);
  }else{
    if ($screen_chk=="1"){
      redirect("close.php");
    }else{
      redirect("menu.php");
    }
  }
}else{ 

}

?>
