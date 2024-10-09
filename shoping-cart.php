<?php
include("header.php");

?>
 
 


<?php
if(isset($_POST['AddToCart'])){
	if(isset($_SESSION['cart'])){
		$productId=array_column($_SESSION['cart'],"p_id");
			if(in_array($_POST['p_id'],$productId)){
				echo "<script>
				alert('product already added into cart');
				location.assign('shoping-cart.php')
				</script>";
			}
			else{
				$count = count($_SESSION['cart']);
				$_SESSION['cart'][$count]=array("p_id"=>$_POST['p_id'],"p_name"=>$_POST['p_name'],"p_image"=>$_POST['p_image'],"p_price"=>$_POST['p_price'],"p_qty"=>$_POST['p_qty']);
				echo "<script>
					alert('product added into cart');
					location.assign('shoping-cart.php')
				</script>";
			}

	}
	
	else{
		$_SESSION['cart'][0]=array("p_id"=>$_POST['p_id'],"p_name"=>$_POST['p_name'],"p_image"=>$_POST['p_image'],"p_price"=>$_POST['p_price'],"p_qty"=>$_POST['p_qty']);
		echo "<script>
			alert('product added into cart');
			location.assign('shoping-cart.php')
		</script>";
	}
}
// REMOVE PRODUCT 
if(isset($_GET['removeId'])){
	foreach($_SESSION['cart'] as $key => $value){
		if($_GET['removeId']==$value['p_id']){
			// row delete
			unset($_SESSION['cart'][$key]);
			// reset
			$_SESSION["cart"]=array_values($_SESSION['cart']);
			echo "<script>alert('item removed successfully from cart');
			location.assign('shoping-cart.php')
			</script>";
		}

	}
}
?>

	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			
		</div>
	</div>
		

	<!-- Shoping Cart -->
	<form class="bg0 p-t-75 p-b-85">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">Product</th>
									<th class="column-2">Name</th>
									<th class="column-3">Price</th>
									<th class="column-4">Quantity</th>
									<th class="column-5">Total</th>
									<th class="column-5">Action</th>
								</tr>
<?php
if(isset($_SESSION['cart'])){
	foreach($_SESSION['cart'] as $key=>$value){
		?>
								<tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1">
											<img src="Dashboard/assets/images/siteimages/productimg/<?php echo $value['p_image']?>" alt="IMG">
										</div>
									</td>
									<td class="column-2"><?php echo $value['p_name']?></td>
									<td class="column-3"><?php echo $value['p_price']?></td>
									<td class="column-4">
										<?php echo $value['p_qty']?>
									</td>
									<td class="column-5"><?php echo $value['p_qty']*$value['p_price']?></td>
									<td class="column-5">
										<a href ="?removeId=<?php echo $value['p_id']?>" class="btn btn-danger">
											<i class="fa fa-trash" aria-hidden="true"></i>
										</a>
									</td>
								</tr>
								<?php
	}
}

?>
								
							</table>
						</div>

						<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
							<div class="flex-w flex-m m-r-20 m-tb-5">
								
							</div>

							<div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
								<a href="product.php" style="color:black">Update Cart</a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Cart Totals
						</h4>

						

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span class="mtext-110 cl2">
									$
								<?php
								$count=0;
								if(isset($_SESSION['cart'])){
									foreach($_SESSION['cart'] as $key => $val){
										$subtotal = $val['p_qty'] * $val['p_price'];
										$count+=$subtotal;

									}
									echo $count;
								}else{
									echo $count;
								}
								?>


								</span>
							</div>
						</div>

						<?php
if(isset($_SESSION['useremail'])){
	?>
	
	<a href="checkout.php" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">Proceed to Checkout</a>
						
	<?php
}else{
	?>
		<a href="login.php" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">Proceed to Checkout</a>
	<?php
}
?>
					</div>
				</div>
			</div>
		</div>
	</form>
		
	
		

	<?php
	include("footer.php");
	?>