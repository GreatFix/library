<?php 
include '../includes/connect.php'; 
$result = mysqli_query($connect,'SELECT name FROM genres' );
echo '<div class="form-group">';
echo '<label for="genreSelect">Select an genre:</label>';
echo '<select class="form-control" id="genreSelect" name="genreSelect">';
            
while($row = mysqli_fetch_array($result))
{
    
    echo '<option value="'.$row[0].'">'.$row[0].'</option>';
  
 }

 echo '</select>';
 echo '</div>';
?>