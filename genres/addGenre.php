<?php

include '../includes/connect.php'; 

if( isset($_POST['name'])) {
    $name = (string)$_POST['name'];
    
    $result = mysqli_query($connect,"INSERT INTO genres (name) VALUES('{$name}')");
    if($result){
        header('Location: http://localhost/library/genres');
    }else{
        echo mysqli_error($connect);
        echo "<script>alert(\"Произошла ошибка!\");</script>";
    }
}
?>