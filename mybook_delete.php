<?php
session_start();
if (!isset($_SESSION['user'])){
    header('Location: http://localhost:8888/book-sns/login.php');
}

try
{

$title = $_POST['title'];

require_once 'DbManager.php';

$sql='DELETE FROM book WHERE user_id=? AND title=?';
$stmt=$dbh->prepare($sql);
$data[]=$_SESSION['user'];
$data[]=$title;
$stmt->execute($data);
$dbh=null;

header('Location: http://localhost:8888/book-sns/mypage.php');

}
catch (Exception $e)
{
	die($e->getMessage());
	exit();
}

?>
