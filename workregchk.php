<?php
//セッションをスタート
//session_start();

//関数を呼び出して
require_once('funcs.php');

//ログインチェック
//loginCheck();


//1. データ取得
$empno = $_GET["empno"];

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//最初の出勤登録がされているかどうかのチェック
$stmt = $pdo->prepare("SELECT count(*) FROM transaction 
where empno = :empno AND workdate=CURRENT_DATE();");
$stmt->bindValue(':empno', $empno, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行
$count = $stmt->fetchcolumn();

//前日以前の終了日未入力データのチェック
$stmt2 = $pdo->prepare("SELECT count(*) FROM transaction 
where empno = :empno and workdate<>CURRENT_DATE() and endtime is null;");
$stmt2->bindValue(':empno', $empno, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt2->execute(); //実行
$count2 = $stmt2->fetchcolumn();

//本日の退勤処理データのチェック
$stmt3 = $pdo->prepare("SELECT count(*) FROM transaction 
where empno = :empno and workdate=CURRENT_DATE() and endtime is null;");
$stmt3->bindValue(':empno', $empno, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt3->execute(); //実行
$count3 = $stmt3->fetchcolumn();

//当日データが登録されていない場合は初回出社登録画面へ
if($status==false) {
      //execute（SQL実行時にエラーがある場合）
    $error = $stmt2->errorInfo();
    exit("ErrorQuery:".$error[2]);
}else{
    //本日のデータがあるかの確認
    if ($count > 0) {
        //退勤処理がされていなければ(終了時間未登録データがあれば)通常の登録画面へ
        if ($count3 > 0){
          redirect("workreg.php?empno=".$empno);
        //既に退勤処理済の場合は、再登録不可とする
        }else{
          redirect("inform.php");
        }
    //前日以前の退勤未登録データがあれば再登録画面へ
    }elseif ($count2 > 0){
      redirect("workre-reg.php?empno=".$empno);
    }else{
      //出勤登録画面へ
      redirect("workfirstreg.php?empno=".$empno);
    }
}
?>
