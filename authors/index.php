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

    <title>Table "Authors"</title>
</head>
<body>

<nav class="navbar navbar-expand navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="../books">Books</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="./index.php">Authors</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link " href="../genres">Genres</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="../queries">Queries</a>
      </li>
      <?php 
        if($_COOKIE['login'])
          echo '<li class="nav-item">
                  <a class="nav-link " href="../auth/logout.php">Logout</a>
                </li>';
        else 
          echo '<li class="nav-item">
                  <a class="nav-link " href="../auth/loginForm.php">Login</a>
                </li>';
      ?>
    </ul>
    <span class="navbar-brand" >Library</span>
  </div>
</nav>

    <main class="container-fluid" > 
      <?php
      if($_COOKIE['login']=="admin"){
        echo ' <div class="p-2">
                <h4 class="card-title text-center">Adding new row</h4>
                <form action="./addAuthor.php" method="POST" class=" d-flex justify-content-around">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name...">
                </div>
                <div class="form-group">
                    <label for="birthday">Birthday</label>
                    <input type="text" class="form-control" id="birthday" name="birthday" placeholder="Birthday...">
                </div>
                <div class="form-group">
                    <label for="day_of_death">Day of death</label>
                    <input type="text" class="form-control" id="day_of_death" name="day_of_death" placeholder="Day of death...">
                </div>
              
                <div class="form-group mt-auto ">
                  <button type="submit" class="btn btn-primary p-2">
                    <img src="../images/add.png"/>
                  </button> 
                </div>

                </form>
              </div>';
       } 
       ?>      
    <?php
 include './tableAuthors.php';
 ?>
 
    </main>
    
   
</body>
</html>