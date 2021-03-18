<?php

include '../includes/connect.php'; 

if( isset($_POST['name']) && isset($_POST['id'])) {
    
    $genreId = (string)$_POST['id'];
    $name = (string)$_POST['name'];
    
    $result = mysqli_query($connect,"UPDATE genres SET name = '{$name}' WHERE id = '{$genreId}'");
    if($result){
        header('Location: http://localhost/library/genres');
    }else{
        echo mysqli_error($connect);
        echo "<script>alert(\"Произошла ошибка!\");</script>";
    }
}
?>