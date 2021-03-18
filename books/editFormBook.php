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

    <title>Editing book</title>
</head>
<body>

<nav class="navbar navbar-expand navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="./index.php">Books</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="../authors">Authors</a>
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
          <form action="./editBook.php" method="POST" class="d-flex flex-column w-50">
          <?php 
            if( isset($_POST['id'])) {           
                include '../includes/connect.php'; 
                $bookId = (string)$_POST['id'];
                $result = mysqli_query($connect,"SELECT books.id,books.name,books.description,books.year_of_writing,authors.full_name,genres.name  FROM books JOIN authors ON books.author = authors.id JOIN genres ON books.genre = genres.id WHERE books.id='{$bookId}'" );
                
                while($row = mysqli_fetch_array($result))
                {
                    echo '<input type="hidden" value="'.$row[0].'" name="id">';
                    echo '<div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" value="'.$row[1].'" id="title" name="title" placeholder="title">
                        </div>';
                    echo '<div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" value="'.$row[2].'" id="description" name="description" placeholder="description">
                        </div>';
                    echo '<div class="form-group">
                            <label for="dateWrite">Date write</label>
                            <input type="text" class="form-control" value="'.$row[3].'" id="dateWrite" name="dateWrite" placeholder="dateWrite">
                        </div>';
                    $authors = mysqli_query($connect,'SELECT id,full_name  FROM authors' );
                    echo '<div class="form-group">';
                    echo '  <label for="authorSelect">Select an author:</label>';
                    echo '  <select class="form-control" id="authorSelect" name="authorSelect" >';  
                        while($author = mysqli_fetch_array($authors))
                        {
                            if($author[1]===$row[4]){
                              echo '<option selected value="'.$author[0].'">'.$author[1].'</option>';
                            }else {
                              echo '<option value="'.$author[0].'">'.$author[1].'</option>';
                            }
                          
                          }
                    echo '  </select>';
                    echo '</div>';

                    $genres = mysqli_query($connect,'SELECT id,name  FROM genres' );
                    echo '<div class="form-group">';
                    echo '  <label for="genreSelect">Select an genre:</label>';
                    echo '  <select class="form-control" id="genreSelect" name="genreSelect" >';  
                        while($genre = mysqli_fetch_array($genres))
                        {
                            if($genre[1]===$row[5]){
                              echo '<option selected value="'.$genre[0].'">'.$genre[1].'</option>';
                            }else {
                              echo '<option value="'.$genre[0].'">'.$genre[1].'</option>';
                            }
                          
                          }
                    echo '  </select>';
                    echo '</div>';
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