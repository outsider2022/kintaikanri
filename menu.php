<?php
//セッションをスタート
session_start();

//ログインユーザーidとroleを取得
$lid = $_SESSION['id'];
$role = $_SESSION['ROLE'];

// テスト：idとroleを直打ち
// $lid = "00056125";
// $role = 1;
// roleはmenuで取得済みなので、SQLはなし

// データ表示
$view="";
// roleが1：管理者画面も追加
if ($role == 1) {
  $view .= '<a href="workregchk.php?empno='.$lid.'">出社登録</a>';
  $view .= '<br><br>';
  $view .= '<a href="worklist.php?empno='.$lid.'">登録内容確認</a>';
  $view .= '<br><br>';
  $view .= '<a href="workplace.php">出勤先管理</a>';
  $view .= '<br><br>';
  $view .= '<a href="department.php">部門管理</a>';
  $view .= '<br><br>';
  $view .= '<a href="employee.php">社員マスタ管理</a>';
  $view .= '<br><br>';
  $view .= '<a href="administratorconfirm.php">管理者確認ページ</a>';
  $view .= '<br><br>';
} else {
  // roleが1以外：出社登録、登録内容確認
  $view .= '<a href="workregchk.php?empno='.$lid.'">出社登録</a>';
  $view .= '<br><br>';
  $view .= '<a href="worklist.php?empno='.$lid.'">登録内容確認</a>';
  $view .= '<br><br>'; 
}

 ?>


<!DOCTYPE html>
<html lang="ja">
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/base.css">
    <title>メニュー一覧</title>
</head>
<!-- ここからヘッダー -->
<body>
<header>
  <p>
  <var></var>
  </p>
    <h1 class="header-title">メインメニュー</h1>
    <nav class="nav">
      <ul class="menu-group">
        <li class="menu-item"><a href="logout.php">ログアウト</a></li>

      </ul>
    </nav>
  </header>
</body>

<!-- ここからテキストリンク -->
<!-- <div class="menu_box">
     <div class="menu"> -->
         <!-- <a href="workregchk.php?empno=00056125">出社登録</a>
         <br><br>
         <a href="workdetails.php?empno=">登録内容確認</a>
         <br><br>
         <a href="administratorconfirm.php">管理者確認ページ</a> -->
         <?=$view; ?>
     <!-- </div>
</div> -->




</html>
