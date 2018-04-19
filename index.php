<?php
session_start();
session_regenerate_id(true);
try
	{
	require_once 'DbManager.php';

	$sql = 'SELECT * FROM users join book on users.user_id = book.user_id order by date desc;';
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	$dbh = null;
	}

catch(Exception $e)
	{
	die($e->getMessage());
	exit();
	}

?>
<?php
require_once 'header.php';
 ?>
<div class="contents">
	<ul class="book_list">
		<?php

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{ ?>
	    <li>
			<div class="left col-2">
		        <img src="<?php echo $row['image'] ?>" alt="">
			</div>
			<div class="right col-9 text-left">
				<h2><?php echo $row['title'] ?></h2>
		        <p><?php echo $row['text'] ?></p>
				<button class="btn bg-warning"><a href="cartin.php?book_id=<?php echo $row['book_id'] ?>"
			 	class="text-white">カートに入れる</a></button>
			</div>
			<p class="by_name"><?php echo $row['user_name'] ?></p>
	    </li>
	<?php
	} ?>
	</ul>
</div>


</body>
</html>
