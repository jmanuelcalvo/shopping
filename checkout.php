<?php
// Include the database config file
require_once 'dbConfig.php';

// Initialize shopping cart class
include_once 'Cart.class.php';
$cart = new Cart;

// If the cart is empty, redirect to the products page
if($cart->total_items() <= 0){
    header("Location: index.php");
}

// Get posted data from session
$postData = !empty($_SESSION['postData'])?$_SESSION['postData']:array();
unset($_SESSION['postData']);

// Get status message from session
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
?>

<!DOCTYPE html>
<html lang="en">
<div class="header">
  <a href="index.php" class="logo"><img src="img/logo1.png" width="200" height="100"/></a>
  <div class="header-right">
    <a href="orderDetail.php">Detalle de la order</a>
    <a href="checkout.php">Carrito</a>
  </div>
</div>
<head>
<title>Checkout - PHP Shopping Cart Tutorial</title>
<meta charset="utf-8">

<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Custom style -->
<link href="css/style.css" rel="stylesheet">
</head>
<body>
<div class="container">
	<h1>CHECKOUT</h1>
	<div class="col-12">
		<div class="checkout">
			<div class="row">
				<?php if(!empty($statusMsg) && ($statusMsgType == 'success')){ ?>
				<div class="col-md-12">
					<div class="alert alert-success"><?php echo $statusMsg; ?></div>
				</div>
				<?php }elseif(!empty($statusMsg) && ($statusMsgType == 'error')){ ?>
				<div class="col-md-12">
					<div class="alert alert-danger"><?php echo $statusMsg; ?></div>
				</div>
				<?php } ?>
				
				<div class="col-md-4 order-md-2 mb-4">
					<h4 class="d-flex justify-content-between align-items-center mb-3">
						<span class="text-muted">Su carrito</span>
						<span class="badge badge-secondary badge-pill"><?php echo $cart->total_items(); ?></span>
					</h4>
					<ul class="list-group mb-3">
                        <?php
                        if($cart->total_items() > 0){
                            //get cart items from session
                            $cartItems = $cart->contents();
                            foreach($cartItems as $item){
                        ?>
						<li class="list-group-item d-flex justify-content-between lh-condensed">
						  <div>
							<h6 class="my-0"><?php echo $item["name"]; ?></h6>
							<small class="text-muted"><?php echo '$'.$item["price"]; ?>(<?php echo $item["qty"]; ?>)</small>
						  </div>
						  <span class="text-muted"><?php echo '$'.$item["subtotal"]; ?></span>
						</li>
						<?php } } ?>
						<li class="list-group-item d-flex justify-content-between">
						  <span>Total (USD)</span>
						  <strong><?php echo '$'.$cart->total(); ?></strong>
						</li>
					</ul>
					<a href="index.php" class="btn btn-block btn-info">Agregar elementos</a>
				</div>
				<div class="col-md-8 order-md-1">
					<h4 class="mb-3">Detalles de contacto</h4>
					<form method="post" action="cartAction.php">
						<div class="row">
							<div class="col-md-6 mb-3">
							  <label for="first_name">Nombre</label>
							  <input type="text" class="form-control" name="first_name" value="<?php echo !empty($postData['first_name'])?$postData['first_name']:''; ?>" required>
							</div>
							<div class="col-md-6 mb-3">
							  <label for="last_name">Apellido</label>
							  <input type="text" class="form-control" name="last_name" value="<?php echo !empty($postData['last_name'])?$postData['last_name']:''; ?>" required>
							</div>
						</div>
						<div class="mb-3">
							<label for="email">Correo electronico</label>
							<input type="email" class="form-control" name="email" value="<?php echo !empty($postData['email'])?$postData['email']:''; ?>" required>
						</div>
						<div class="mb-3">
							<label for="phone">Teléfono</label>
							<input type="text" class="form-control" name="phone" value="<?php echo !empty($postData['phone'])?$postData['phone']:''; ?>" required>
						</div>
						<div class="mb-3">
							<label for="last_name">Dirección</label>
							<input type="text" class="form-control" name="address" value="<?php echo !empty($postData['address'])?$postData['address']:''; ?>" required>
						</div>
						<input type="hidden" name="action" value="placeOrder"/>
						<input class="btn btn-success btn-lg btn-block" type="submit" name="checkoutSubmit" value="Place Order">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
