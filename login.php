<?php
ob_start();
session_start();
if( isset($_SESSION['user']) != "") {
	header("Location: mypage.php");
}
include_once 'DbManager.php';
?>

<?php
if(isset($_POST['login'])) {

	try {

		$email = $_POST['email'];
		$password = $_POST['password'];

		$query = "SELECT * FROM users WHERE email='$email'";
		$data = $dbh->query($query);

		while ($result = $data->fetch(PDO::FETCH_ASSOC)) {
			$db_hashed_pwd = $result['password'];
			$user_id = $result['user_id'];
		}

		if (password_verify($password, $db_hashed_pwd)) {
			$_SESSION['user'] = $user_id;
			header("Location: mypage.php");
			exit;
		} else { ?>
			<div class="alert alert-danger" role="alert">メールアドレスとパスワードが一致しません。</div>
		<?php }

		$dbh=null;

	} catch (\Exception $e) {
		die($e->getMessage());
		exit();
	}


} ?>

<?php require 'header.php'; ?>
<div class="contents">
<form method="post">
	<h1>ログインフォーム</h1>
	<div class="form-group">
		<input type="email"  class="form-control" name="email" placeholder="メールアドレス" required />
	</div>
	<div class="form-group">
		<input type="password" class="form-control" name="password" placeholder="パスワード" required />
	</div>
	<button type="submit" class="btn btn-default" name="login">ログインする</button>
	<a href="register.php">会員登録はこちら</a>
</form>

</div>
</body>
</html>
