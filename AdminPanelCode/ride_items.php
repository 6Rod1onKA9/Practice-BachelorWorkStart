<?php
include '../connection.php';

if(isset($_GET['delete']))
{
    $delete_id_ride = $_GET['delete'];
    $delete_ride_query = pg_query($con, "DELETE FROM products_ride WHERE id_ride=$delete_id_ride") or die('query failed');
    if($delete_ride_query){
        $messge[] = 'The ride has been deleted successfully';
    }
    else{
        $messge[]='The ride has been not deleted successfully';
    }
}
if (isset($_POST['update_product'])) {
    $update_r_id = $_POST['update_r_id'];
    $update_r_name = $_POST['update_r_name'];
    $update_r_price = $_POST['update_r_price'];
    $update_r_img = $_FILES['update_r_image']['name'];
    $update_r_img_tmp_name = $_FILES['update_r_image']['r_tmp_name'];
    $update_r_folder = '../image/'.$update_r_img;

    $update_query = pg_query($con, "UPDATE products_ride SET id_ride='$update_r_id', name_ride='$update_r_name', 
    price_ride='$update_r_price', image_ride='$update_r_img' WHERE id_ride = '$update_r_id'") or die('query failed');
    if ($update_query) {
        move_uploaded_file($update_r_img_tmp_name, $update_r_folder);
        $messge[]='The ride has been updated sucessfully';
        header('location:ride-items.php');
    }else{
        $messge[]='The ride has been not updated sucessfully';
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
<title>Document</title>
</head>
<body>
<?php   
if (isset($message)) {
foreach ($message as $message) {
echo '<div class="message">
<span>'.$message.' <i class="bi bi-x" onclick="this.parentElement.style.display="none"></i></span>
</div>';
}
}
?>
<a href="add-ride-item.php" class="add">+</a>
<section class="show-product">
<table>
<thead>
<th>Ride Image</th>
<th>Ride Name</th> 
<th>Ride Price</th> 
<th>Action</th>  
</thead>
<tbody>
    <?php
    $select_rides = pg_query($con, "SELECT * FROM products_ride") or die ('query failed');
    if(pg_num_rows($select_rides)>0){
        while($row = pg_fetch_assoc($select_rides)){
        
            
    ?>

    <tr> 
        <td> <img src="../image/<?php echo $row['image_ride']; ?>"></td>
        <td><?php echo $row['name_ride']; ?></td>   
        <td>$<?php echo $row['price_ride']; ?>/-</td>
        
        <td>
            <div class="action-btn-wrap"><a href="ride-items.php?delete=<?php echo $row['id_ride']; ?>" class="delete-btn"><i class = "bi bi-trash" 
            onclick="return confirm('Are you sure you want to delete this item')"></i>Delete</a>
            <a href="ride-items.php?edit=<?php echo $row['id_ride'];?>" class="option-btn"> <i class="bi bi-pencil"></i>Update</a></div>
        </td>
    </tr>
    <?php  
        }
      }
    ?>
</tbody>
</table>
</section>
<section class="edit-form">
<?php
if (isset($_GET['edit'])) {
  $edit_id_ride = $_GET['edit'];
  $edit_ride_query = pg_query($con, "SELECT * FROM products_ride WHERE id_ride=$edit_id_ride") or die('query failed');

  if (pg_num_rows($edit_ride_query) > 0) {
    while($fetch_edit = pg_fetch_assoc($edit_ride_query)) {

?>
  <form method="post" enctype="multipart/form-data">
  <h3>Update ride</h3>
  <img src="../image/<?php echo $fetch_edit['image_ride'];?>">
  <input type="hidden" name="update_r_id" value="<?php echo $fetch_edit['id_ride'];?>" required>
  <input type="text" name="update_r_name" value="<?php echo $fetch_edit['name_ride'];?>" required>
  <input type="number" name="update_r_price" min="0" value="<?php echo $fetch_edit['price_ride'];?>" required>
  <input type="file" name="update_r_image" accept="image/png, image/jpg, image/jpeg" required>
  <input type="submit" name="update_product" value="update product" class="btn update">
  <input type="reset" value="cancle" class="btn cancle" id="close-edit">
</form>
<?php 
            }
    }
    echo "<script>document.querySelector('.edit-form').style.display = 'block'</script>";
}
?>
</section>

<script type="text/javascript">
const closeBtn = document.querySelector('#close-edit');
closeBtn.addEventListener('click', () => {
  document.querySelector('.edit-form').style.display = 'none';
});
</script>
</body>
</html>
