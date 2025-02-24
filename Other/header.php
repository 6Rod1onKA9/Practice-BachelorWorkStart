<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body background="background.png">
  <header>
    <div class="flex">
      <div class="logo">
                <img src="image/logo.png" alt="Jolly Land Logo">
            </div>
      <div class="navbar">
        <a href="products.php">Shop</a>
      </div>
      <?php
          $select_rows = pg_query($con, "SELECT * FROM cart") or die('query failed');
          $row_count = pg_num_rows($select_rows);
        ?>
      <a href="cart.php" class = "cart"><i class="bi bi-cart-check-fill"></i><span><?php echo $row_count;?></span></a>
    </div>
  </header>
</body>
</html>
