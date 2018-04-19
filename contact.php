<?php
try
	{
	if ($_SERVER['REQUEST_METHOD'] === 'POST')
		{
		$name = $_POST['name'];
		$email = $_POST['email'];
		$inquiry = $_POST['inquiry'];
		if ($name == '')
			{
			$err1 = "お名前を入力してください";
			}

		if ($email == '')
			{
			$err2 = "アドレスを入力してください";
			}

		if ($inquiry == '')
			{
			$err3 = "お問い合わせ内容を入力してください";
			}

		if ($err !== '')
			{
			require_once 'DbManager.php';

			$sql = 'INSERT INTO contact (name,email,inquiry) VALUES(?,?,?)';
			$stmt = $dbh->prepare($sql);
			$data[] = $name;
			$data[] = $email;
			$data[] = $inquiry;
			$stmt->execute($data);
			$dbh = null;
			}
		}
	}

catch(Exception $e)
	{
	die($e->getMessage());
	}

?>
	<?php
require_once 'header.php';
 ?>
	<div class="contents">
<form action="" method="post">
  <div class="form-group">
    <label for="exampleFormControlInput1">名前</label>
    <input type="text" class="form-control" name="name">
    <?php

if (isset($err1))
	{
	echo '<p class="red-text">' . $err1 . '</p>';
	} ?>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">E-mail</label>
    <input type="email" class="form-control" name="email">
    <?php

if (isset($err2))
	{
	echo '<p class="red-text">' . $err2 . '</p>';
	} ?>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">問い合わせ内容</label>
    <textarea class="form-control" rows="3" name="inquiry"></textarea>
    <?php

if (isset($err3))
	{
	echo '<p class="red-text">' . $err3 . '</p>';
	} ?>
  </div>
  <input type="submit" name="" value="送信する">
</form>
	</div>


</body>
</html>
