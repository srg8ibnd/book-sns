<?php
session_start();

$host = "localhost";
$username = "root";
$password = "root";
$dbname = "book_sns_db";

$mysqli = new mysqli($host, $username, $password, $dbname);
if ($mysqli->connect_error) {
	error_log($mysqli->connect_error);
	exit;
}

if (isset($_SESSION['user'])){
	$query = "SELECT * FROM users WHERE user_id=".$_SESSION['user']."";
	$result = $mysqli->query($query);

	if (!$result) {
		print('クエリーが失敗しました。' . $mysqli->error);
		$mysqli->close();
		exit();
	}

	while ($row = $result->fetch_assoc()) {
		$username = $row['user_name'];
		$email = $row['email'];
	}

	$result->close();
}

 ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>自分が投稿した本一覧</title>
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="css/styles.css">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="js/lc_switch.js"></script>
<link rel="stylesheet" href="css/lc_switch.css">
<script type="text/javascript">
$('input').lc_switch();

$('body').delegate('.lcs_check', 'lcs-statuschange', function() {
  var status = ($(this).is(':checked')) ? 'checked' : 'unchecked';
  console.log('field changed status: '+ status );
});

// triggered each time a field is checked
$('body').delegate('.lcs_check', 'lcs-on', function() {
  console.log('field is checked');
});

// triggered each time a is unchecked
$('body').delegate('.lcs_check', 'lcs-off', function() {
  console.log('field is unchecked');
});
</script>

</head>
<body>
    <div class="header">
		<div class="head_inner">
            <h1><a href="index.php">Your Bookshelf</a></h1>
			<ul>
				<li><a href="search_book.php">本を投稿する</a></li>
				<?php if (isset($_SESSION['user'])) { ?>
					<li><a href="cart.php">カート</a></li>
                	<li><a href="mypage.php"><?php echo $username; ?></a></li>
                	<li><a href="logout.php">ログアウト</a></li>
                <?php
 } else {
     ?>
                	<li><a href="register.php">会員登録</a></li>
                	<li><a href="login.php">ログイン</a></li>
                <?php
 }; ?>
				<li><a href="contact.php">お問い合わせ</a></li>
			</ul>
		</div>
	</div>
