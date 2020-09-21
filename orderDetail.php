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
    <a href="orderDetail.php">Detalle de la Orden</a>
    <a href="checkout.php">Carrito</a>
  </div>
</div>
<div class="container">
    <h1>ORDER</h1>
	
  <form action="orderSuccess.php" method="GET">
  <div class="form-group">
    <label for="orderNumber">Order Number</label>
    <input type="email" class="form-control" id="orderNumber" placeholder="999">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>  
</div>
</body>
</html>
