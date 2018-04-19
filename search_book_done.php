<?php session_start(); ?>
<?php
try {

    $title=$_POST["title_".$_POST["isbn"]];
    $image=$_POST["image_".$_POST["isbn"]];
    $text=$_POST['text'];
    $url=$_POST["link_".$_POST["isbn"]];
    $date = new DateTime();
    $date = $date->format("Y/m/d H:i:s");

    require_once 'DbManager.php';

    $sql='INSERT INTO book (user_id,title,image,text,url,date) VALUES(?,?,?,?,?,?)';
    $stmt=$dbh->prepare($sql);

    $data[] = $_SESSION['user'];
    $data[] = $title;
    $data[] = $image;
    $data[] = $text;
    $data[] = $url;
    $data[] = $date;
	$stmt->execute($data);
    $dbh=null;
	header('Location: http://localhost:8888/book-sns/mypage.php');

} catch (\Exception $e) {
    die($e->getMessage());
}

?>

<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  if(array_key_exists("isbn",$_POST) && array_key_exists("title_".$_POST["isbn"],$_POST)){
     echo $_POST["title_".$_POST["isbn"]];
     echo $_POST["image_".$_POST["isbn"]];
  }
}
 ?>
