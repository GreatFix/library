<?php 
include '../includes/connect.php'; 
$result = mysqli_query($connect,'SELECT books.id,books.name,books.description,books.year_of_writing,authors.full_name,genres.name  FROM books JOIN authors ON books.author = authors.id JOIN genres ON books.genre = genres.id' );
echo '<table class="table m-0">';
echo '<thead class="thead-dark">';
echo '<th>№</th>';
echo '<th class="text-nowrap">Title of the book</th>';
echo '<th>Description</th>';
echo '<th class="text-nowrap">Date write</th>';
echo '<th>Author</th>';
echo '<th>Genre</th>';
if($_COOKIE['login']=="admin"){
    echo '<th>Delete</th>';
    echo '<th>Edit</th>';
}
echo '<th>Comments</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
while($row = mysqli_fetch_array($result))
{
    echo '<tr>';
    echo '<th scope="row">'.$row[0].'</th>';
    echo '<td>'.$row[1].'</td>';
    echo '<td class="w-50">'.$row[2].'</td>';
    echo '<td>'.$row[3].'</td>';
    echo '<td>'.$row[4].'</td>';
    echo '<td>'.$row[5].'</td>';
    if($_COOKIE['login']=="admin"){
        echo '<td>
                <form action="./deleteBook.php" method="POST">
                    <input type="hidden" value="'.$row[0].'" name="id">
                    <button type="submit" class="btn btn-danger"><img src="../images/delete.png"/></button>
                </form>
            </td>';
        echo '<td>
                <form action="./editFormBook.php" method="POST">
                    <input type="hidden" value="'.$row[0].'" name="id">
                    <button type="submit" class="btn  btn-info"><img src="../images/edit.png"/></button>
                </form>
            </td>';
    }
    echo '<td>
                <form action="./commentsBook.php" method="GET">
                    <input type="hidden" value="'.$row[0].'" name="id">
                    <button type="submit" class="btn btn-danger"><img src="../images/comment.png"/></button>
                </form>
            </td>';
    echo '</tr>';
 }
echo '</tbody>';
echo '</table>';

?>

