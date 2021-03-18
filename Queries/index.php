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

  <title>Query</title>
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
      <li class="nav-item active">
        <a class="nav-link " href="./index.php">Queries</a>
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
        
        <h4 class="card-title text-center">Query books</h4>
          <form action="./index.php" method="POST" >
            <div class="d-flex justify-content-around align-content-center">
              <div class="form-group mr-5 ">
                <input type="text" class="form-control" id="title" name="title" placeholder="Search by title...">
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" <?php if (isset($_POST['description'])) echo "checked"; ?> name="description" id="description" value="description">
                <label class="form-check-label" for="description">Description</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" <?php if (isset($_POST['year_of_writing'])) echo "checked"; ?>  name="year_of_writing" id="year_of_writing" value="year_of_writing">
                <label class="form-check-label" for="year_of_writing">Year of writing</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" <?php if (isset($_POST['author'])) echo "checked"; ?>  name="author" id="author" value="author">
                <label class="form-check-label" for="author">Author</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" <?php if (isset($_POST['genre'])) echo "checked"; ?>  name="genre" id="genre" value="genre">
                <label class="form-check-label" for="genre">Genre</label>
              </div>
              <div class="form-group mt-auto ">
              <button type="submit" class="btn btn-primary p-2">
                <img src="../images/search.png"/>
              </button> 
            </div>
            </div>
          </form>
      </div>
      <div>
        <?php 
          include '../includes/connect.php'; 
          if (isset($_POST['title']))
            $result = mysqli_query($connect,'SELECT books.id,books.name,books.description,books.year_of_writing,authors.full_name,genres.name  FROM books JOIN authors ON books.author = authors.id JOIN genres ON books.genre = genres.id WHERE books.name LIKE "%'.$_POST['title'].'%"' );
          else
            $result = mysqli_query($connect,'SELECT books.id,books.name,books.description,books.year_of_writing,authors.full_name,genres.name  FROM books JOIN authors ON books.author = authors.id JOIN genres ON books.genre = genres.id' );

          echo '<table class="table m-0">';
          echo '<thead class="thead-dark">';
          echo '<th>№</th>';
          echo '<th>Title of the book</th>';
          if (isset($_POST['description']))
            echo '<th>Description</th>';
          if (isset($_POST['year_of_writing']))
            echo '<th>Date write</th>';
          if (isset($_POST['author']))
            echo '<th>Author</th>';
          if (isset($_POST['genre']))
            echo '<th>Genre</th>';
          if($_COOKIE['login']=="admin"){
            echo '<th>Delete</th>';
            echo '<th>Edit</th>';
          }
          echo '</tr>';
          echo '</thead>';
          echo '<tbody>';
          while($row = mysqli_fetch_array($result))
          {
              echo '<tr>';
              echo '<th scope="row">'.$row[0].'</th>';
              echo '<td>'.$row[1].'</td>';
              if (isset($_POST['description']))
                echo '<td class="w-50">'.$row[2].'</td>'; 
              if (isset($_POST['year_of_writing']))
                echo '<td>'.$row[3].'</td>';
              if (isset($_POST['author']))
                echo '<td>'.$row[4].'</td>';
              if (isset($_POST['genre']))
                echo '<td>'.$row[5].'</td>';
              if($_COOKIE['login']=="admin"){
                echo '<td>
                      <form action="../books/deleteBook.php" method="POST">
                        <input type="hidden" value="'.$row[0].'" name="id">
                        <button type="submit" class="btn btn-danger"><img src="../images/delete.png"/></button>
                      </form>
                    </td>';
                echo '<td>
                      <form action="../books/editFormBook.php" method="POST">
                        <input type="hidden" value="'.$row[0].'" name="id">
                        <button type="submit" class="btn  btn-info"><img src="../images/edit.png"/></button>
                      </form>
                    </td>';
              }
              echo '</tr>';
          }
          echo '</tbody>';
          echo '</table>';

          ?>
      </div>
 
    </main>
    
</body>
</html>