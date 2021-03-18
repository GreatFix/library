<?php
    if(isset($_POST['login']) && isset($_POST['password'])) {
        include '../includes/connect.php'; 
        $result = mysqli_query($connect,'SELECT `id` FROM  `users` WHERE `login`="'.$_POST['login'].'" and `password`="'.$_POST['password'].'"');
        if(mysqli_num_rows($result)>0){  
            if(isset($_POST['remember']))
                setcookie("login", $_POST['login'],time()+(3600*200),"/");
            else 
                setcookie("login", $_POST['login'],0,"/");
            header('Location: http://localhost/library/books');
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
    name="viewport"
    content="minimum-scale=1, initial-scale=1, width=device-width"
  />
  <link rel="stylesheet" type="text/css" href="../styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Authorization</title>
</head>
<body>
    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="../books">Books</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../authors">Authors</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link " href="../genres">Genres</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="../queries">Queries</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link " href="./loginForm.php">Login</a>
            </li>
            </ul>
            <span class="navbar-brand" >Library</span>
        </div>
    </nav>
    <main class="container-fluid" >
      <div class="p-5 d-flex flex-column justify-content-center align-items-center ">
        <form method="POST" class="card p-2" autocomplete="off">
        <h4 class="card-title text-center">Authorization</h4>
        <div id="alertText">
        </div>
        <div class="form-group">
            <label for="login">Login</label>
            <input type="login" class="form-control" id="login" name="login" placeholder="login">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" class="form-control" id="password" name="password" placeholder="password">
        </div>
        <div class="form-check form-check-inline pt-2 pb-2 ">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" value="remember">
            <label class="form-check-label" for="remember">Remember</label>
        </div>
        <button type="submit" class="btn btn-primary mb-2">Submit</button>
        <a class="nav-link p-0" href="./registerForm.php">Registration</a>
        
        </form>
        </div>
    <main>
    <?php 
         if(isset($_POST['login']) && isset($_POST['password'])) {
        echo "<script>
                let div = document.querySelector(\"#alertText\");
                div.innerHTML= `<div class=\"alert alert-danger\" role=\"alert\"><strong>Error!</strong> Incorrect data entered!</div>`;
            </script>";
         }
    ?>
</body>
</html>
