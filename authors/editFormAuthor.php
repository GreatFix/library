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

    <title>Editing author</title>
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
      <div class="p-2 d-flex flex-column justify-content-center align-items-center">
        
        <h4 class="card-title text-center">Editing row</h4>
          <form action="./editAuthor.php" method="POST" class="d-flex flex-column w-50">
          <?php 
            if( isset($_POST['id'])) {
                include '../includes/connect.php'; 
                $authorId = (string)$_POST['id'];
                $result = mysqli_query($connect,"SELECT id,full_name,birthday,day_of_death  FROM  authors WHERE id='{$authorId}'" );
                
                while($row = mysqli_fetch_array($result))
                {
                    echo '<input type="hidden" value="'.$row[0].'" name="id">';
                    echo '<div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" value="'.$row[1].'" id="name" name="name" placeholder="name">
                          </div>';
                    echo '<div class="form-group">
                            <label for="birthday">birthday</label>
                            <input type="text" class="form-control" id="birthday" value="'.$row[2].'" name="birthday" placeholder="birthday">
                          </div>';
                    echo '<div class="form-group">
                            <label for="day_of_death">day of death</label>
                            <input type="text" class="form-control" id="day_of_death" value="'.$row[3].'" name="day_of_death" placeholder="day_of_death">
                          </div>';
                }
            }
                ?>
             <div class="d-flex justify-content-around">       
              <button type="button" class="btn btn-warning mb-2" onClick='location.href="<?php echo $_SERVER['HTTP_REFERER']; ?>"'>Вернуться</button>
              <button type="submit" class="btn btn-success mb-2">Сохранить</button>
            </div>
          </form>
      </div>

 
    </main>
    
   
</body>
</html>