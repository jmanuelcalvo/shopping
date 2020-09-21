<?php
// Initialize shopping cart class
include_once 'Cart.class.php';
$cart = new Cart;

// Include the database config file
require_once 'dbConfig.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>PHP Shopping Cart</title>
<meta charset="utf-8">

<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Custom style -->
<link href="css/style.css" rel="stylesheet">

</head>
</head>
<body>
<div class="header">
  <a href="index.php" class="logo"><img src="img/logo1.png" width="200" height="100"/></a>
  <div class="header-right">
    <a href="orderSuccess.php?id=4">Ordenes</a>
    <a href="orderDetail.php">Detalle de la order</a>
    <a href="checkout.php">Carrito</a>
  </div>
</div>
<div class="container">
    <h1>PRODUCTS</h1>
	
	<!-- Cart basket -->
	<div class="cart-view">
		<a href="viewCart.php" title="View Cart"><i class="icart"></i> (<?php echo ($cart->total_items() > 0)?$cart->total_items().' Items':'Empty'; ?>)</a>
	</div>
    
	<!-- Product list -->
    <div class="row col-lg-12">
        <?php
        // Get products from database
        $result = $db->query("SELECT * FROM products ORDER BY id DESC LIMIT 10");
        if($result->num_rows > 0){ 
            while($row = $result->fetch_assoc()){
        ?>
		<div class="card col-lg-4">
			<div class="card-body">
			  <h5 class="card-title"><?php echo $row["name"]; ?></h5>
			  <h6 class="card-subtitle mb-2 text-muted">Price: <?php echo '$'.$row["price"].' USD'; ?></h6>
			  <p class="card-text"><?php echo $row["description"]; ?></p>
			  <a href="cartAction.php?action=addToCart&id=<?php echo $row["id"]; ?>" class="btn btn-primary">Add to Cart</a>
			</div>
		</div>
        <?php } }else{ ?>
        <p>Product(s) not found.....</p>
        <?php } ?>
    </div>
</div>
</body>
</html>
