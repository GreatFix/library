<?php

include '../includes/connect.php'; 

if(isset($_POST['id'])) {
    $authorId = (string)$_POST['id'];

    $result = mysqli_query($connect,"DELETE FROM authors WHERE id='{$authorId}'");
    if($result){
        header('Location: http://localhost/library/authors');
    }else{
        echo mysqli_error($connect);
        echo "<script>alert(\"Произошла ошибка!\");</script>";
    }
}
?>