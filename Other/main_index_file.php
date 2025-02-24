<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <link rel="stylesheet" href="styles.css">
    <title>Jolly Land</title>
</head>

<body background="image/background_photo.png">
    <div class="top-bar">
        <span><ion-icon name="call-outline"></ion-icon> 111 222 333</span>
        <ul>
            <li><a href="#"><ion-icon name="logo-facebook"></ion-icon></a></li>
            <li><a href=""><ion-icon name="logo-twitter"></ion-icon></a></li>
            <li><a href=""><ion-icon name="logo-instagram"></ion-icon></a></li>
        </ul>
    </div>
    <nav>
        <div class="logo">
            <a href="#"><img src="image/logo.png" alt="logo"></a>
        </div>
        <div class="toggle">
            <a href="#"><ion-icon name="menu-outline"></ion-icon></a>
        </div>
        <ul class="menu">
            <?php
            if(isset($_SESSION['role_userr'] ) && $_SESSION['role_userr'] == 'admin')
            {
                echo '<li><a href="admin/ride-items.php">Edit rides</a></li> 
                      <li><a href="admin/food-items.php">Edit foods</a></li>
                      <li><a href="admin/ordered-price-ride-items.php">Table Ride Sums</a></li>
                      <li><a href="admin/ordered-price-food-items.php">Table Food Sums</a></li>';

            } else if (isset($_SESSION['role_userr'] ) && $_SESSION['role_userr'] == 'maintenance'){
                echo '<li><a href="maintenance/inspection-items.php">Make record</a></li>'; 

            } else{
                echo '<li><a href="products_ride.php">Buy ride ticket</a></li> 
                      <li><a href="products.php">Buy food</a></li>';
            }
            
            
            
            if (isset($_SESSION['id_user']))
            {
                echo '<li><a href="authorization/log_out.php">Log out</a></li>';
        

            } else
            {
                echo '<li><a href="authorization/index.php">Log in</a></li>';
            }
            ?>

        </ul>
    </nav>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(function () {
            $(".toggle").on("click", function () {
                if ($(".menu").hasClass("active")) {
                    $(".menu").removeClass("active");
                    $(this).find("a").html("<ion-icon name='menu-outline'></ion-icon>");
                } else {
                    $(".menu").addClass("active");
                    $(this).find("a").html("<ion-icon name='close-outline'></ion-icon>");
                }
            });
        });
    </script>
</body>

</html>
