<?php
include '../connection.php';
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
<section class="show-product">
<table>
<thead>
<th>Name of Client</th> 
<th>Product Sum</th> 
</thead>
<tbody>
    <?php
    $select_products = pg_query($con, "SELECT * FROM orders_ride ORDER BY total_price_ride DESC") or die ('query failed');
    if(pg_num_rows($select_products)>0){
        while($row = pg_fetch_assoc($select_products)){
        
            
    ?>

    <tr>  
        <td><?php echo $row['name_order_ride']; ?></td>   
        <td>$<?php echo $row['total_price_ride']; ?>/-</td>
    </tr>
    <?php  
        }
      }
    ?>
</tbody>
</table>
</section>

<script type="text/javascript">
const closeBtn = document.querySelector('#close-edit');
closeBtn.addEventListener('click', () => {
  document.querySelector('.edit-form').style.display = 'none';
});
</script>
</body>
</html>
