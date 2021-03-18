<?php

include '../includes/connect.php'; 

if( isset($_POST['name'])) {
    $name = (string)$_POST['name'];
    $birthday = (string)$_POST['birthday'];
    $day_of_death = (string)$_POST['day_of_death'];
    
    $result = mysqli_query($connect,"INSERT INTO authors (full_name,birthday,day_of_death) VALUES('{$name}','{$birthday}','{$day_of_death}')");
    if($result){
        header('Location: http://localhost/library/authors');
    }else{
        echo mysqli_error($connect);
        echo "<script>alert(\"Произошла ошибка!\");</script>";
    }
}
?>