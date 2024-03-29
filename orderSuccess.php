<?php
if(!isset($_REQUEST['id'])){
    header("Location: index.php");
}

// Include the database config file
require_once 'dbConfig.php';

// Fetch order details from database
$result = $db->query("SELECT r.*, c.first_name, c.last_name, c.email, c.phone FROM orders as r LEFT JOIN customers as c ON c.id = r.customer_id WHERE r.id = ".$_REQUEST['id']);

if($result->num_rows > 0){
	$orderInfo = $result->fetch_assoc();
}else{
	header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Order Status - PHP Shopping Cart</title>
<meta charset="utf-8">

<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Custom style -->
<link href="css/style.css" rel="stylesheet">
</head>
<body>
<div class="header">
  <a href="index.php" class="logo"><img src="img/logo1.png" width="200" height="100"/></a>
  <div class="header-right">
    <a href="orderDetail.php">Detalle de la order</a>
    <a href="checkout.php">Carrito</a>
  </div>
</div>
<div class="container">
    <h1>ESTADO DEL PEDIDO</h1>
	<div class="col-12">
		<?php if(!empty($orderInfo)){ ?>
			<div class="col-md-12">
				<div class="alert alert-success">Su pedido se ha realizado correctamente.</div>
			</div>
			
			<!-- Order status & shipping info -->
			<div class="row col-lg-12 ord-addr-info">
				<div class="hdr">Información de pedido</div>
				<p><b>ID de referencia:</b> #<?php echo $orderInfo['id']; ?></p>
				<p><b>Total:</b> <?php echo '$'.$orderInfo['grand_total'].' USD'; ?></p>
				<p><b>Colocado en:</b> <?php echo $orderInfo['created']; ?></p>
				<p><b>Nombre del comprador:</b> <?php echo $orderInfo['first_name'].' '.$orderInfo['last_name']; ?></p>
				<p><b>Correo electrónico:</b> <?php echo $orderInfo['email']; ?></p>
				<p><b>Teléfono:</b> <?php echo $orderInfo['phone']; ?></p>
			</div>
			
			<!-- Order items -->
			<div class="row col-lg-12">
				<table class="table table-hover">
					<thead>
					  <tr>
						<th>Producto</th>
						<th>Precio</th>
						<th>QTY</th>
						<th>Sub Total</th>
					  </tr>
					</thead>
					<tbody>
                        <?php
                        // Get order items from the database
                        $result = $db->query("SELECT i.*, p.name, p.price FROM order_items as i LEFT JOIN products as p ON p.id = i.product_id WHERE i.order_id = ".$orderInfo['id']);
                        if($result->num_rows > 0){ 
                            while($item = $result->fetch_assoc()){
                                $price = $item["price"];
                                $quantity = $item["quantity"];
                                $sub_total = ($price*$quantity);
                        ?>
						<tr>
							<td><?php echo $item["name"]; ?></td>
							<td><?php echo '$'.$price.' USD'; ?></td>
							<td><?php echo $quantity; ?></td>
							<td><?php echo '$'.$sub_total.' USD'; ?></td>
						</tr>
                        <?php }
                        } ?>
					</tbody>
				</table>
			</div>
		<?php }else{ ?>
		<div class="col-md-12">
			<div class="alert alert-danger">Your order submission failed.</div>
		</div>
		<?php } ?>
	</div>
</div>
</body>
</html>
