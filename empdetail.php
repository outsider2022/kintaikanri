<?php
//1.外部ファイル読み込みしてDB接続(funcs.phpを呼び出して)
require_once('funcs.php');
$pdo = db_conn();

//2.対象のIDを取得
$empno = $_GET['empno'];

//3．データ取得SQLを作成（SELECT文）
//　社員情報を取得　ココカラ
$stmt = $pdo->prepare("SELECT * FROM employee_mst WHERE empno=:empno;");
$stmt->bindValue(':empno',$empno,PDO::PARAM_INT);
$status = $stmt->execute();

$view = '';
if ($status == false) {
    sql_error($status);
} else {
    $result = $stmt->fetch();
}
//　社員情報を取得　ココマデ


//　部門の一覧を取得　ココカラ
$stmt2 = $pdo->prepare("SELECT * FROM department_mst where activeindicator ='Y' order by departmentno asc;");
$status2 = $stmt2->execute();

$view2="";//空のviewを作成
if($status2==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt2->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
    //Selectデータの数だけ自動でループ
    while( $result2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
        //既存値を初期値にする
        if( $result2['departmentno'] == $result['departmentno']) {
            $view2 .= "<option value='".$result2['departmentno'];
            $view2 .= "' selected>".$result2['departmentname']."</option>";
        }
        else{
            $view2 .= "<option value='".$result2['departmentno'];
            $view2 .= "'>".$result2['departmentname']."</option>";
        }
       }
    }
//　部門の一覧を取得　ココマデ



//　出社先の一覧を取得　ココカラ
$stmt3 = $pdo->prepare("SELECT * FROM workplace_mst where activeindicator ='Y' order by workplaceno asc;");
$status3 = $stmt3->execute();

$view3="";//空のviewを作成
if($status3==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt3->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
    //Selectデータの数だけ自動でループ
    while( $result3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
        //既存値を初期値にする
        if($result3['workplaceno'] == $result['workplaceno']){
            $view3 .= "<option value='".$result3['workplaceno'];
            $view3 .= "' selected>".$result3['workplacename']."</option>";
        }
        else{ 
            $view3 .= "<option value='".$result3['workplaceno'];
            $view3 .= "'>".$result3['workplacename']."</option>";
        }
       }
    }


?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>社員情報のデータ修正</title>
    <link rel="stylesheet" href="css/base.css">
    <style></style>
</head>

<body>
    <header>
        <a href="employee.php">社員一覧</a></div>
    </header>

    <!-- method, action, 各inputのnameを確認してください。  -->
    <form method="POST" action="empupdate.php">
        <div>
            <fieldset>
                <legend>◆社員情報更新画面◆</legend>
                <label>社員番号：<?= $result['empno'] ?></label><br>
                <label>社員名：<input type="text" name="empname" value="<?= $result['empname'] ?>"></label><br>
                <label>社員名カナ：<input type="text" name="empnamekana" value="<?= $result['empnamekana'] ?>"></label><br>
                <label>所属部門:</label>
　                  <select name='departmentname'>
  　                    <option hidden>選択してください</option>
                        <?php echo $view2; ?>
                    </select><br>
                <label>メール：<input type="email" name="mail" value="<?= $result['mail'] ?>"></label><br>
                <label>電話番号：<input type="text" name="telno" value="<?= $result['telno'] ?>"></label><br>
                <label>通常の勤務先：</label>
                    <select name='workplacename'>
  　                    <option hidden>選択してください</option>
                        <?php echo $view3; ?>
                    </select><br><br>
                <input type="hidden" name="empno" value="<?= $result['empno'] ?>">
                <input type="submit" value="更新">
            </fieldset>
        </div>
    </form>
</body>

</html>