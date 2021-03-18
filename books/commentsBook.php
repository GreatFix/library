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

    <title>Comments book</title>
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
        <?php 
            include '../includes/connect.php'; 
            $result = mysqli_query($connect,'SELECT books.name,books.description,books.year_of_writing,authors.full_name,genres.name  
            FROM books JOIN authors ON books.author = authors.id JOIN genres ON books.genre = genres.id 
            WHERE books.id="'.$_GET['id'].'";');
            while($book = mysqli_fetch_array($result))
            {
            echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-3">'.$book[0].'</h1>
                        <blockquote class="blockquote">
                            <p class="mb-0">'.$book[3].'</p>
                            <footer class="blockquote-footer">'.$book[2].',
                                <cite title="Source Title">'.$book[4].'</cite>
                            </footer>
                        </blockquote>
                        <p class="lead">'.$book[1].'</p>
                    </div>
                </div>';
            }
        ?>
         <?php 
        if($_COOKIE['login'])
            echo '
              <form action="./addComment.php" method="POST" class="d-flex flex-column align-items-center p-4">
                <h6 class="card-title text-center w-50">Write a comment</h6>
                <div class="input-group w-50">
                  <input type="hidden" value="'.$_GET['id'].'" name="id">
                  <input type="text" class="form-control" name="comment" placeholder="Comment text..." aria-label="" aria-describedby="basic-addon1">
                  <div class="input-group-append">
                    <button class="btn btn-success" type="submit">Submit</button>
                  </div>
                </div>
              </form>';
        ?>
        <div class="comments">
          <div class="card-columns ">
            <?php 
              include '../includes/connect.php'; 
              $result = mysqli_query($connect,'SELECT users.login,comments.date,comments.content 
              FROM comments JOIN users ON comments.userId = users.id
              WHERE comments.bookId="'.$_GET['id'].'"
              ORDER BY comments.date DESC;');
              while($comment = mysqli_fetch_array($result))
              {
                echo '<div class="card">
                        <div class="card-body">
                            <h6 class="card-title">'.$comment[0].' <span class="date-comment">'.$comment[1].'</span></h6>
                            <p class="card-text">
                              '.$comment[2].'
                            </p>
                        </div>
                      </div>';
              }
          ?>
          </div>
        </div>
        <!-- 
          
       
             <div class="d-flex justify-content-around">       
              <button type="button" class="btn btn-warning mb-2" onClick='location.href="http://localhost/library/books"'>Вернуться</button>
              <button type="submit" class="btn btn-success mb-2">Сохранить</button>
            </div>
          -->

    </main>
    
   
</body>
</html>