<?php
include '../includes/connect.php'; 

if(isset($_POST['id']) && isset($_POST['comment'])) {
    $comment = (string)$_POST['comment'];
    $user = mysqli_query($connect,"SELECT `id` FROM `users` WHERE `login`='{$_COOKIE['login']}'");
    $bookId = (int)$_POST['id'];
    $userId = (int)mysqli_fetch_array($user)[0];
    $result = mysqli_query($connect,"INSERT INTO comments (content,userId,bookId) VALUES('{$comment}','{$userId}','{$bookId}')");
    if($result){
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }else{
        echo mysqli_error($connect);
        echo "<script>alert(\"Произошла ошибка!\");</script>";
    }
}
?>