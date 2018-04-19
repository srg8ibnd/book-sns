<?php
session_start();
if( isset($_SESSION['user']) != "") {
	header("Location: mypage.php");
}

include_once 'DbManager.php';

if(isset($_POST['signup'])) {


try {

	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password = password_hash($password, PASSWORD_BCRYPT);

	$query = "INSERT INTO users(user_name,email,password) VALUES('$username','$email','$password')";
	$data = $dbh->query($query);
	$dbh=null;

	echo '<div class="alert alert-success" role="alert">登録しました</div>';


} catch (\Exception $e) {
	echo '<div class="alert alert-danger" role="alert">エラーが発生しました。</div>';
}
}
?>


<?php require 'header.php'; ?>
<div class="contents">
<form method="post">
	<h1>会員登録</h1>
	<div class="form-group">
		<input type="text" class="form-control" name="username" placeholder="ユーザー名" required />
	</div>
	<div class="form-group">
		<input type="email"  class="form-control" name="email" placeholder="メールアドレス" required />
	</div>
	<div class="form-group">
		<input type="password" class="form-control" name="password" placeholder="パスワード" required />
	</div>
	<button type="submit" class="btn btn-default" name="signup">会員登録する</button>
	<a href="login.php">ログインはこちら</a>
</form>

</div>
</body>
</html>
