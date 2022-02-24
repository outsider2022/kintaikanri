<?php

echo("ファイルを出力しました。");
  // try {

  //   //CSV形式で情報をファイルに出力のための準備
  //   // $csvFileName = "file.csv";
  //   // $fileName = time() . rand() . '.csv';
  //   $res = fopen('task.csv', 'w');
  //   if ($res === FALSE) {
  //       throw new Exception('ファイルの書き込みに失敗しました。');
  //   }

  //   // 項目名を配列に格納
  //   $header = ["担当者", "重要度", "タスク名", "タイトル内容", "進捗状況", "期限"];
  //   // 項目名を出力
  //   mb_convert_variables('SJIS', 'UTF-8', $header);
  //   fputcsv($res, $header);

  //   // 出力テスト用配列
  //   // $data = array(
  //   //     array(
  //   //     "担当者" => "高橋",
  //   //     "重要度" => "!",
  //   //     "タスク名" => "aaa",
  //   //     "タイトル内容" => "aaaaa",
  //   //     "進捗状況" => "未着手",
  //   //     "期限" => "2021/11/30"
  //   //     ),
  //   //     array(
  //   //       "担当者" => "高橋",
  //   //       "重要度" => "!",
  //   //       "タスク名" => "aaa",
  //   //       "タイトル内容" => "aaaaa",
  //   //       "進捗状況" => "未着手",
  //   //       "期限" => "2021/11/30"
  //   //       )         
  //   // );

  //   //var_dump($date);

  //   // ループしながら出力
  //   foreach($data as $dataInfo) {
  //     // 文字コード変換。エクセルで開けるようにする
  //     mb_convert_variables('SJIS', 'UTF-8', $dataInfo);

  //     // ファイルに書き出しをする
  //     fputcsv($res, $dataInfo);
  //   }
  //   // ファイルを閉じる
  //   fclose($res);

  //   // ダウンロード開始

  //   // ファイルタイプ（csv）
  //   header('Content-Type: application/octet-stream');

  //   // ファイル名
  //   // header('Content-Disposition: attachment; filename=' . $fileName); 
  //   header('Content-Disposition: attachment; filename=' . 'task.csv');
  //   // ファイルのサイズ　ダウンロードの進捗状況が表示
  //   // header('Content-Length: ' . filesize($csvFileName)); 
  //   header('Content-Length: ' . filesize('task.csv')); 
  //   header('Content-Transfer-Encoding: binary');
  //   // ファイルを出力する
  //   // readfile($csvFileName);
  //   readfile('task.csv');

  // }catch(Exception $e) {

  //   // 例外処理をここに書きます
  //   echo $e->getMessage();

  // }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>管理者確認画面</title>
<link rel="stylesheet" href="css/base.css">
<style></style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
      <a href="menu.php">メニューへ戻る</a>
      <br>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="administratorsearch.php">
  <fieldset>
  <legend>◆該当人物の行動履歴の検索◆</legend><br>
    <label>日付<input type="date" name="date" maxlength="4" size="4" required></label><br>
    <label>社員番号：<input type="" name="empno" required></label><br>
    <input type="submit" value="検索">
  </fieldset>
</form>
<br>
<legend>◆該当人物の行動履歴を表示します◆</legend>
<div>
    <?= $view ?>
    
</div>

<!-- <legend>◆接触者を表示します◆</legend>
<div>
    <?= $view2 ?>
    
</div> -->

<!-- エクセル出力のボタン -->
<form method="POST" action="fileexport.php">
  <input type="hidden" name="date" value="<?=$date ?>">
  <input type="hidden" name="empno" value="<?=$empno ?>">
  <input type="submit" value="接触者をファイルに出力する">
</form>

<!-- Main[End] -->

</body>
</html>
