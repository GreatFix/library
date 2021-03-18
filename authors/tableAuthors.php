<?php 
include '../includes/connect.php'; 
$result = mysqli_query($connect,'SELECT id,full_name,birthday,day_of_death FROM authors' );
echo '<table class="table m-0">';
echo '<thead class="thead-dark">';
echo '<th>№</th>';
echo '<th>Name</th>';
echo '<th>Birthday</th>';
echo '<th>Day_of_death</th>';
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
    echo '  <th scope="row">'.$row[0].'</th>';
    echo '  <td>'.$row[1].'</td>';
    echo '  <td>'.$row[2].'</td>';
    echo '  <td>'.$row[3].'</td>';
    if($_COOKIE['login']=="admin"){
    echo '  <td>
                <form action="./deleteAuthor.php" method="POST">
                    <input type="hidden" value="'.$row[0].'" name="id">
                    <button type="submit" class="btn btn-danger"><img src="../images/delete.png"/></button>
                </form>
            </td>';
    echo '  <td>
                <form action="./editFormAuthor.php" method="POST">
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

