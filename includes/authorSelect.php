<?php 
include '../includes/connect.php'; 
$result = mysqli_query($connect,'SELECT full_name  FROM authors' );
echo '<div class="form-group">';
echo '<label for="authorSelect">Select an author:</label>';
echo '<select class="form-control" id="authorSelect" name="authorSelect">';
            
while($row = mysqli_fetch_array($result))
{
    
    echo '<option value="'.$row[0].'">'.$row[0].'</option>';
  
 }

 echo '</select>';
 echo '</div>'
?>

