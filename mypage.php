<?php
session_start();

if (!isset($_SESSION['user']))
	{
	header('Location: http://localhost:8888/book-sns/login.php');
	}

try
	{
	require_once 'DbManager.php';

	$sql = 'SELECT title, image, text FROM book where user_id=? order by date desc';
	$stmt = $dbh->prepare($sql);
	$stmt->execute([$_SESSION['user']]);
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
	{
?>
		    <li>
				<div class="left col-2">
			        <img src="<?php echo $row['image'] ?>" alt="">
				</div>
				<div class="right col-9 text-left">
					<h2><?php echo $row['title'] ?></h2>
			        <p><?php echo $row['text'] ?></p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">削除する</button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel"></h4>
                          </div>
                          <div class="modal-body">
                              <p>本当に削除しますか？</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <form class="" action="mybook_delete.php" method="post">
                                <input type="submit" name="" value="削除する" class="btn btn-primary">
                                <input type="hidden" name="title" value="<?php echo $row['title'] ?>">
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
				</div>
		    </li>
		<?php
	} ?>
		</ul>
	</div>
