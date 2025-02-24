<?php
include 'connection.php';

if (isset($_POST['add_to_cart'])) {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $image = $_POST['image'];
  $quantity=1;

$select_cart = pg_query($con, "SELECT * FROM cart_ride WHERE name_cart_ride='$name'");
if (pg_num_rows($select_cart)>0) {
  $message[] = 'The ride has already been added in your cart';
} else {
  $query = "INSERT INTO cart_ride (name_cart_ride, price_cart_ride, image_cart_ride, quantity_ride) VALUES ('$name', '$price', '$image', '$quantity')";
  $insert_query = pg_query($con, $query);
  $message[] = 'The ride has been added in your cart';
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link rel="stylesheet" type="text/css" href="style.css">
<title>Products</title>
</head>
<body>
<?php include 'header_ride.php'; ?>
<?php   
if (isset($message)) {
foreach ($message as $message) {
echo '<div class="message">
<span>'.$message.' <i class="bi bi-x" onclick="this.parentElement.style.display="none"></i></span>
</div>';
}
}
?>
<div class = "product-container">
<h1>Latest products</h1>
<div class ="product-item-container">
<?php
$select_products = pg_query($con, "SELECT * FROM products_ride");
if (pg_num_rows($select_products) > 0) {
    while ($fetch_products = pg_fetch_assoc($select_products)) {
        ?>
        <form method="post">
            <div class="box">
                <img src="image/<?php echo $fetch_products['image_ride']; ?>">
                <h3><?php echo $fetch_products['name_ride']; ?></h3>
                <div class="price">$<?php echo $fetch_products['price_ride']; ?>/-</div>
                <input type="hidden" name="name" value="<?php echo $fetch_products['name_ride']; ?>">
                <input type="hidden" name="price" value="<?php echo $fetch_products['price_ride']; ?>">
                <input type="hidden" name="image" value="<?php echo $fetch_products['image_ride']; ?>">
                <input type="submit" name="add_to_cart" value="add to cart" class="btn">
            </div>
        </form>
        <?php
    }
}
?>
</div>
</div>
</body>
</html>
