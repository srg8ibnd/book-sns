<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: http://localhost:8888/book-sns/login.php');
}
try {
    $book_id = $_GET['book_id'];

    if (isset($_GET['book_id'])==true) {
        require_once 'DbManager.php';
        $sql='INSERT INTO cart (user_id, book_id) VALUES(?,?)';
        $stmt=$dbh->prepare($sql);

        $data[] = $_SESSION['user']['id'];
        $data[] = $book_id;
        $stmt->execute($data);
        $dbh=null;
        header('Location: http://localhost:8888/book-sns/cart.php');
    }
} catch (\Exception $e) {
    die($e->getMessage());
    exit();
}
