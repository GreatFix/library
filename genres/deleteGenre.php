<?php

include '../includes/connect.php'; 

if(isset($_POST['id'])) {
    $genreId = (string)$_POST['id'];

    $result = mysqli_query($connect,"DELETE FROM genres WHERE id='{$genreId}'");
    if($result){
        header('Location: http://localhost/library/genres');
    }else{
        echo mysqli_error($connect);
        echo "<script>alert(\"Произошла ошибка!\");</script>";
    }
}
?>