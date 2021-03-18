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

    <title>Registration</title>
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
      <div id="box" class="p-5 d-flex flex-column justify-content-center align-items-center">
        <form method="POST" class="card p-2 w-50" validate autocomplete="off">
        <h4 class="card-title text-center">Registration</h4>
        <div id="alertText">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email..." required>
        </div>
        <div class="form-group">
            <label for="login">Login</label>
            <input type="login" class="form-control" id="login" name="login" placeholder="Login..." required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password..." required>
        </div>
        <div class="form-group">
            <label for="repeat">Repeat the password</label>
            <input type="password" class="form-control" id="repeat" name="repeat" placeholder="Password..." required>
        </div>
        
        <button type="submit" class="btn btn-primary mb-2">Submit</button>
            <a class="nav-link p-0" href="./loginForm.php">Authorization</a>
        </form>
      </div>
    </main>
    <?php
    if(isset($_POST['email']) && isset($_POST['login']) && isset($_POST['password'])&& isset($_POST['repeat'])) {
        include '../includes/connect.php'; 
        $loginCheck = mysqli_query($connect,'SELECT `id` FROM  `users` WHERE `login`="'.$_POST['login'].'"');
        $emailCheck = mysqli_query($connect,'SELECT `id` FROM  `users` WHERE `email`="'.$_POST['email'].'"');
        if(mysqli_num_rows($loginCheck)>0){
            echo "<script>
                let div = document.querySelector(\"#alertText\");
                div.innerHTML= `<div class=\"alert alert-danger\" role=\"alert\"><strong>Error!</strong> The username you entered is already taken!</div>`;
            </script>";
        }
        elseif(mysqli_num_rows($emailCheck)>0){
            echo "<script>
                let div = document.querySelector(\"#alertText\");
                div.innerHTML= `<div class=\"alert alert-danger\" role=\"alert\"><strong>Error!</strong> The entered email address is already taken!</div>`;
            </script>";
        }elseif($_POST['password']!==$_POST['repeat']){
            echo "<script>
                let div = document.querySelector(\"#alertText\");
                div.innerHTML= `<div class=\"alert alert-danger\" role=\"alert\"><strong>Error!</strong> Passwords don't match!</div>`;
            </script>";
        }
        else {  
            $email = $_POST['email'];
            $login = $_POST['login'];
            $password = $_POST['password'];
            if(preg_match('/\S*(?=\S{5,100})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/',$password)){
              $result = mysqli_query($connect,"INSERT INTO users (email,login,password) VALUES('{$email}','{$login}','{$password}')");
              if($result){
                echo "<script>
                        document.querySelector('#box').innerHTML= `<div class=\"alert alert-success\" role=\"alert\">Successful registration!</div>
                        <a class=\"nav-link p-0\" href=\"./loginForm.php\">Authorization</a>`;
                     </script>";
              } else {
                echo "<script>
                        let div = document.querySelector(\"#alertText\");
                        div.innerHTML= `<div class=\"alert alert-danger\" role=\"alert\"><strong>Error!</strong> Registration error!</div>`;
                     </script>";
              }
            } else {
                echo "<script>
                        let div = document.querySelector(\"#alertText\");
                        div.innerHTML= `<div class=\"alert alert-warning\" role=\"alert\"><strong>Warning!</strong> The password must consist of letters of the Latin alphabet of different cases, numbers, and a length of at least 5 characters!</div>`;
                    </script>";
            }
        }
    }
?>
</body>
</html>