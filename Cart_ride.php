<?php
include 'connection.php';

if (isset($_POST['update_btn'])) {
  $update_value_ride = $_POST['update_quantity'];
  $update_id_ride = $_POST['update_quantity_id'];

  $update_query = pg_query($con, "UPDATE cart_ride SET quantity_ride='$update_value_ride' WHERE id_cart_ride='$update_id_ride'") or die('query failed');

  if ($update_query) {
    header('location:cart_ride.php');
  }
}

if (isset($_GET['remove'])) {
  $remove_id_ride = $_GET['remove'];
  pg_query($con, "DELETE FROM cart_ride WHERE id_cart_ride='$remove_id_ride'");
  header('location:cart_ride.php');
}

if (isset($_GET['delete_all'])) {
  pg_query($con, "DELETE FROM cart_ride ");
  header('location:cart_ride.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link rel="stylesheet" type="text/css" href="style.css">
<title>Add rides</title>
</head>
<body>
<?php include 'header_ride.php'; ?>
<div class="cart-container">
<h1>Ride cart</h1>
<table>
<thead>
<th>Image of ride</th>
<th>Name of ride</th>
<th>Price of ride</th>
<th>Quantity of ride</th>
<th>Total price of ride</th>
<th>Action</th>
</thead>
<tbody>
<?php
$select_cart_ride = pg_query($con, "SELECT * FROM cart_ride");
$grand_total_ride = 0;
if(pg_num_rows($select_cart_ride)>0){

while($fetch_cart=pg_fetch_assoc($select_cart_ride)){

?>
<tr>
<td><img src="image/<?php echo $fetch_cart['image_cart_ride']; ?>"></td>
<td><?php echo $fetch_cart['name_cart_ride']; ?></td>
<td>$<?php echo $fetch_cart['price_cart_ride']; ?>/-</td>
<td class="quantity_ride">
<form method="post">
<input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id_cart_ride']; ?>">
<input type="number" min="1" name="update_quantity" value="<?php echo $fetch_cart['quantity_ride']; ?>">
<input type="submit" name="update_btn" value="update">
</form>
</td>
<td>$<?php echo $sub_total_ride = $fetch_cart['price_cart_ride']*$fetch_cart['quantity_ride']; ?></td>
<td><a href="cart_ride.php?remove=<?php echo $fetch_cart['id_cart_ride']; ?>" 
onclick="return confirm('Remove item from cart');" class="delete-btn">Remove</a></td>
</tr>
<?php
$grand_total_ride+=$sub_total_ride;
}
}
?>
<tr class="table-bottom">
<td><a href="products_ride.php" class="option-btn">Continue shopping</a></td>
<td colspan="3"><h1>Total amount payable</h1></td>
<td style="font-weight: bold;">$<?php echo $grand_total_ride; ?></td>
<td><a href="cart_ride.php?delete_all" onclick="return confirm('Are you sure, that you want to delete all items from cart');" 
class="delete-btn">Delete all</a></td>
</tr>
</tbody>
</table>
<div class="checkout-btn">
    <a href="checkout_ride.php" class="btn <?=($grand_total_ride>1)?'' : 'disabled'?>" >Proceed to checkout</a>
</div>
</div>
</body>
</html>
