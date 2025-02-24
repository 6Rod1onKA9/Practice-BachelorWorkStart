<?php
include '../connection.php';

if (isset($_POST['add_product'])) {
  $r_name = $_POST['r_name'];
  $r_price = $_POST['r_price'];
  $r_type = $_POST['r_type'];
  $r_attid = $_POST['r_attid'];
  $r_image = $_FILES['r_image']['name'];
  $r_image_temp_name = $_FILES['r_image']['r_tmp_name'];
  $r_image_folder = '../image/'.$r_image;
  
  $query = "INSERT INTO products_ride (name_ride, price_ride, ride_type, attraction_id, image_ride) 
  VALUES ('$r_name', '$r_price', '$r_type',$r_attid, '$r_image')";
  $insert_query = pg_query($con, $query);
  
  if ($insert_query) {
    move_uploaded_file($r_image_temp_name, $r_image_folder);
    $message[] = 'A new ride was added successfully';
    header('location:ride-items.php');
  } else {
    $message[] = 'A new ride was not added successfully';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <title>Rides Managing</title>
</head>
<body>
    <?php
        if (isset($message)) {
           foreach ($message as $message) {
           echo 
           '<div class="message">
            <span>'. $message .'<i class="bi bi-x" 
            onclick="this.parentElement.style.display = "none""></i></span>
            </div>';
            }
        }
?> 
    <div class="form">
       <form method="post" enctype="multipart/form-data">
            <h3>Add a new ride</h3>
            <input type="text" name="r_name" placeholder="Enter ride name" required>
            <input type="number" name="r_price" min="0" placeholder="Enter price for ride" required>
            <input type="text" name = "r_type" placeholder="Enter type of ride" required>
            <input type="number" name = "r_attid" placeholder="Enter id of ride" required>
            <input type="file" name="r_image" accept="image/png, image/jpg, image/jpeg" required>
            <input type="submit" name="add_product" value="Add ride" class="btn">
        </form>
    </div>
</body>
</html>
