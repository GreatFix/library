<?php

include '../includes/connect.php'; 

if( isset($_POST['id']) && isset($_POST['title'])&& isset($_POST['description'])&& isset($_POST['dateWrite'])) {
    
    $bookId = (string)$_POST['id'];
    $name = (string)$_POST['title'];
    $description = (string)$_POST['description'];
    $year_of_writing = (string)$_POST['dateWrite'];
    $authorId = (string)$_POST['authorSelect'];
    $genreId = (string)$_POST['genreSelect'];
    $result = mysqli_query($connect,"UPDATE books SET name = '{$name}', description = '{$description}',year_of_writing = '{$year_of_writing}', author = '{$authorId}', genre = '{$genreId}' WHERE id = '{$bookId}'");
    if($result){
        header('Location: http://localhost/library/books');
    }else{
        echo mysqli_error($connect);
        echo "<script>alert(\"Произошла ошибка!\");</script>";
    }
}
?>