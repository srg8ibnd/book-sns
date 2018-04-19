<?php session_start(); ?>
<?php
try {
    if (isset($_SESSION['user'])) {

        $title=$_POST['title'];
        $image=$_FILES['image'];
        $text=$_POST['text'];
        $date = new DateTime();
        $date = $date->format("Y/m/d H:i:s");

        move_uploaded_file($image['tmp_name'],'./images/'.$image['name']);
        $path = $image['name'];

        require_once 'DbManager.php';

        $sql='INSERT INTO book (user_id,title,image,text,date) VALUES(?,?,?,?,?)';
        $stmt=$dbh->prepare($sql);

        $data[] = $_SESSION['user']['id'];
        $data[] = $title;
        $data[] = $path;
        $data[] = $text;
        $data[] = $date;
    	$stmt->execute($data);
        $dbh=null;
    	header('Location: http://localhost:8888/book-sns/mypage.php');
    } else {
    	echo '本を投稿するには、ログインしてください。';
    }

} catch (\Exception $e) {
    die($e->getMessage());
}

?>
