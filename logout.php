<?php session_start(); ?>
<?php
if (isset($_SESSION['user'])) {
	unset($_SESSION['user']);
	header('Location: http://localhost:8888/book-sns/index.php');
} else {
	header('Location: http://localhost:8888/book-sns/index.php');
}
?>
