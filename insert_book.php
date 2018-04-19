<?php
session_start();
if (!isset($_SESSION['user'])){
    header('Location: http://localhost:8888/book-sns/login.php');
}
 ?>
<?php require 'header.php'; ?>
<div class="contents insert_book">
    <form method="post" action="insert_book_check.php" enctype="multipart/form-data">
        <input type="text" name="title" value="">
        <input type="file" name="image" value="">
        <input type="text" name="text" value="">
        <input type="submit" value="投稿する">
    </form>
</div>
</body>
</html>
