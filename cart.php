<?php
session_start();

if (!isset($_SESSION['user']))
	{
	header('Location: http://localhost:8888/book-sns/login.php');
	}

try
	{
	require_once 'DbManager.php';

	$sql = 'SELECT title, image, text, url FROM book INNER JOIN cart ON book.book_id = cart.book_id WHERE cart.user_id =?;';
	$stmt = $dbh->prepare($sql);
	$data[] = $_SESSION['user']['id'];
	$stmt->execute($data);
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
                <button class="btn bg-warning"><a href="<?php echo $row['url'] ?>" class="text-white">購入する</a></button>
            </div>
        </li>
    <?php
	} ?>
    </ul>
</div>


</body>
</html>
