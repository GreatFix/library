<?php

include '../includes/connect.php'; 

if( isset($_POST['id']) && isset($_POST['name'])&& isset($_POST['birthday'])&& isset($_POST['day_of_death'])) {
    
    $authorId = (string)$_POST['id'];
    $name = (string)$_POST['name'];
    $birthday = (string)$_POST['birthday'];
    $day_of_death = (string)$_POST['day_of_death'];
    
    $result = mysqli_query($connect,"UPDATE authors SET full_name = '{$name}', birthday = '{$birthday}',day_of_death = '{$day_of_death}' WHERE id = '{$authorId}'");
    if($result){
        header('Location: http://localhost/library/authors');
    }else{
        echo mysqli_error($connect);
        echo "<script>alert(\"Произошла ошибка!\");</script>";
    }
}
?>