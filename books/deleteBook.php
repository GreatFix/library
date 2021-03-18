<?php

include '../includes/connect.php'; 

if(isset($_POST['id'])) {
    $bookId = (string)$_POST['id'];

    $result = mysqli_query($connect,"DELETE FROM books WHERE id='{$bookId}'");
    if($result){
        header('Location: http://localhost/library/books');
    }else{
        echo mysqli_error($connect);
        echo "<script>alert(\"Произошла ошибка!\");</script>";
    }
}
?>