<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link href="css/base.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
<title>ログイン</title>
</head>
<body>

<header>
<h1>出社先管理システム　ログイン画面</h1>
</header>
<p>社員番号、パスワードをご入力の上、「ログイン」ボタンをクリックしてください。</p>
<form name="form1" action="login_act.php" method="post">
<div class="login_form_btm">
社員番号: <input type="text" name="id" placeholder="社員番号を入力してください"><br>
パスワード: <input type="password" name="password" placeholder="パスワードを入力してください">
</div>
<button type="submit">ログイン</button>
</form>
</body>
</html>