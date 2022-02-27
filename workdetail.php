<?php

require_once('funcs.php');
$pdo = db_conn();


$recordID = $_GET['recordID'];

//データ取得
$stmt = $pdo->prepare("SELECT a.*,b.empname,c.workplacename FROM transaction a inner join employee_mst b on a.empno=b.empno inner join workplace_mst c on a.workplaceno=c.workplaceno
  WHERE recordID=:recordID;");
$stmt->bindValue(':recordID',$recordID,PDO::PARAM_INT);
$status = $stmt->execute();

//データ表示
$view = '';
if ($status == false) {
    sql_error($status);
} else {
    $result = $stmt->fetch();
}

$go_back = '<a href="' . $_SERVER['HTTP_REFERER'] . '">前に戻る</a>';

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ修正</title>
    <link href="css/base.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <header>
        <div><?= $go_back ?></div>
    </header>

    <form method="POST" action="workinsert3.php">
        <div class="jumbotron" style="padding-left: 100px" >
            <fieldset>
                <legend>退勤時間修正</legend>
                <label>日付：　<?= $result['workdate'] ?></label><br>
                <label>滞在開始時間：　<?= $result['starttime'] ?></label><br>
                <label>滞在終了時間：<input type="time" name="endtime" value="<?= $result['endtime'] ?>" required="required"></label><br>
                <label>社員番号： <?= $result['empno'] ?></label><br>
                <label>社員名： <?= $result['empname'] ?></label><br>
                <label>滞在先： <?= $result['workplacename'] ?></label><br>
                <label>備考：<input type="text" name="remarks" maxlength="100" required="required"></label><br>
                <a>※備考欄に退勤処理が出来なかった理由を記載してください。</a>
                <input type="hidden" name="starttime" value="<?= $result['starttime'] ?>"><br>
                <input type="hidden" name="recordID" value="<?= $result['recordID'] ?>"><br>
                <input type="submit" value="更新">
            </fieldset>
        </div>
    </form>
</body>

</html>