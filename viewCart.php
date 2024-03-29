<?php
// Initialize shopping cart class
include_once 'Cart.class.php';
$cart = new Cart;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>View Cart - PHP Shopping Cart</title>
<meta charset="utf-8">

<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Custom style -->
<link href="css/style.css" rel="stylesheet">

<!-- jQuery library -->
<script src="js/jquery.min.js"></script>

<script>
function updateCartItem(obj,id){
    $.get("cartAction.php", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
        if(data == 'ok'){
            location.reload();
        }else{
            alert('Cart update failed, please try again.');
        }
    });
}
</script>
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



</div>
<div class="container">
    <h1>CARRITO DE COMPRAS</h1>
	<div class="row">
		<div class="cart">
			<div class="col-12">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th width="45%">Producto</th>
								<th width="10%">Precio</th>
								<th width="15%">Cantidad</th>
								<th class="text-right" width="20%">Total</th>
								<th width="10%"> </th>
							</tr>
						</thead>
						<tbody>
                            <?php
                            if($cart->total_items() > 0){
                                // Get cart items from session
                                $cartItems = $cart->contents();
                                foreach($cartItems as $item){
							?>
							<tr>
								<td><?php echo $item["name"]; ?></td>
								<td><?php echo '$'.$item["price"].' USD'; ?></td>
								<td><input class="form-control" type="number" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"/></td>
								<td class="text-right"><?php echo '$'.$item["subtotal"].' USD'; ?></td>
								<td class="text-right"><button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')?window.location.href='cartAction.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>':false;"><i class="itrash"></i> </button> </td>
							</tr>
							<?php } }else{ ?>
							<tr><td colspan="5"><p>Your cart is empty.....</p></td>
							<?php } ?>
							<?php if($cart->total_items() > 0){ ?>
							<tr>
								<td></td>
								<td></td>
								<td><strong>Total del carrito</strong></td>
								<td class="text-right"><strong><?php echo '$'.$cart->total().' USD'; ?></strong></td>
								<td></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col mb-2">
				<div class="row">
					<div class="col-sm-12  col-md-6">
						<a href="index.php" class="btn btn-block btn-light">Seguir Comprando</a>
					</div>
					<div class="col-sm-12 col-md-6 text-right">
						<?php if($cart->total_items() > 0){ ?>
						<a href="checkout.php" class="btn btn-lg btn-block btn-primary">Checkout</a>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
