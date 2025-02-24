<?php
include 'connection.php';
if (isset($_POST['order_btn'])) {
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $payment_method = $_POST['payment-method'];
    $city = $_POST['city'];
    $country = $_POST['country'];

    $cart_query = pg_query($con, "SELECT * FROM cart_ride");
    $price_total = 0;
    if (pg_num_rows($cart_query)>0) {
        while($product_item_ride=pg_fetch_assoc($cart_query)){
            $product_name_ride[]=$product_item_ride['name_order_ride'].' ('.$product_item_ride['quantity_ride'].')';
            $product_price_ride=$product_item_ride['price_cart_ride']*$product_item_ride['quantity_ride'];
            $price_total+=$product_price_ride;
        }
    }
    $total_product=implode(',', $product_name_ride);
    $detail_query = pg_query($con, "INSERT INTO orders_ride 
    (name_order_ride, number_order_ride, email_order_ride, method_order_ride, city_order_ride,
    country_order_ride, total_products_ride, total_price_ride) 
    VALUES ('$name', '$number', '$email', '$payment_method', '$city',
    '$country', '$total_product', '$price_total')");
    if($cart_query && $detail_query)
    {
         echo "<div class='order-confirm-container'>
                    <div class='message-container'>
                        <h3>Thank you for choosing rides</h3>
                        <div class='order-detail'>
                            <span>".$total_product."</span>
                            <span class='total'>total: $".$price_total."/-</span>
                        </div>
                        <div class='customer-details'>
                           <p>Your name : <span>".$name."</span></p>
                           <p>Your number: <span>".$number."</span></p>
                           <p>Your email: <span>".$email."</span></p>
                           <p>Your address: <span>".$city.", ".$country."</span></p>
                           <p>Payment method: <span>".$payment_method."</span></p>
                           <p class='pay'>(*pay when product arrives*)</p>
                        </div>
                           <a href='products_ride.php' class='btn'>Continue choosing rides</a>
                    </div>
                </div>";
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
<title>Add products</title>
</head>
<body>
    
<?php include 'header_ride.php'; ?>
<div class="checkout-form">
    <h1>Payment process</h1>
    <div class="display-order">
        <?php
            $select_cart=pg_query($con, "SELECT * FROM cart_ride");
            $total=0;
            $grand_total=0;
            if (pg_num_rows($select_cart)>0) {
                while($fetch_cart=pg_fetch_assoc($select_cart)){
                    $total_price = $fetch_cart ['price_cart_ride']* $fetch_cart['quantity_ride'];
                    $grand_total = $total += $total_price;
        ?>
        <span><?= $fetch_cart['name_cart_ride']; ?>(<?= $fetch_cart['quantity_ride']; ?>)</span>
        <?php
              }
           }
        ?>
        <span class="grand-total">Total amount payable : $<?= $grand_total; ?>/-</span>
    </div>
    <form method="post">
    <div class="input-field">
        <span>Your name</span>
        <input type="text" name="name" placeholder="Enter your name" required>
    </div>
    <div class="input-field">
        <span>Your number</span>
        <input type="number" name="number" placeholder="Enter your number" required>
    </div>
    <div class="input-field">
        <span>Your email</span>
        <input type="email" name="email" placeholder="Enter your email" required>
    </div>
    <div class="input-field">
        <span>Payment method</span>
        <select name="payment-method" >
            <option class="Cash on delivery">Cash on delivery</option>
            <option value="credit card">Predit card</option>
            <option value="paytm">paytm</option>
            <option value="phone pay">Phone pay</option>
            <option value="pay pal">Pay pal</option>
        </select>
    </div>
<div class="input-field">
    <span>City</span>
    <input type="text" name="city" placeholder="e.g Odessa" required>
</div>
<div class="input-field">
    <span>Country</span>
    <input type="text" name="country" placeholder="e.g Ukraine" required>
</div>
<input type="submit" name="order_btn" value="order now" class="btn">

</form>

</div>
</body>
</html>
