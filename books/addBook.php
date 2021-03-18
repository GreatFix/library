<?php

include '../includes/connect.php'; 

if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['dateWrite']) && isset($_POST['authorSelect']) && isset($_POST['genreSelect'])) {
    $name = (string)$_POST['title'];
    $authorSelect = (string)$_POST['authorSelect'];
    $genreSelect = (string)$_POST['genreSelect'];
    $description = (string)$_POST['description'];
    $year_of_writing = (string)$_POST['dateWrite'];
    $author = mysqli_query($connect,"SELECT `id` FROM `authors` WHERE `full_name`='{$authorSelect}'");
    $genre = mysqli_query($connect,"SELECT `id` FROM `genres` WHERE `name`='{$genreSelect}'");
    $authorId = (int)mysqli_fetch_array($author)[0];
    $genreId = (int)mysqli_fetch_array($genre)[0]; 

    $result = mysqli_query($connect,"INSERT INTO books (name,description,year_of_writing,author,genre) VALUES('{$name}','{$description}','{$year_of_writing}','{$authorId}','{$genreId}')");
    if($result){
        header('Location: http://localhost/library/books');
    }else{
        echo mysqli_error($connect);
        echo "<script>alert(\"Произошла ошибка!\");</script>";
    }
}
?>