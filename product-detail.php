<?php
include("header.php");
?>



	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			
		</div>
	</div>
		

	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-65 p-b-60">
		<div class="container">
		<form action="shoping-cart.php" method="post">
			<?php
			if (isset($_GET['pid'])){
				$pid = $_GET['pid'];
				 $query = $pdo->prepare("select * from products where id = :pid");
				 $query->bindParam("pid",$pid);
				 $query->execute();
				 $productdet = $query->fetch(PDO::FETCH_ASSOC);
			
			?>
			<input type="hidden" name="p_id" value="<?php echo $productdet['id']?>">
				<input type="hidden" name="p_name" value="<?php echo $productdet['pro_name']?>">
				<input type="hidden" name="p_image" value="<?php echo $productdet['pro_image']?>">
				<input type="hidden" name="p_price" value="<?php echo $productdet['pro_price']?>">
			<div class="row">
				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

							<div class="slick3 gallery-lb">
								<div class="item-slick3" data-thumb="./Dashboard/assets/images/siteimages/productimg/<?php echo $productdet['pro_image']?>">
									<div class="wrap-pic-w pos-relative">
										<img src="./Dashboard/assets/images/siteimages/productimg/<?php echo $productdet['pro_image']?>" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="./Dashboard/assets/images/siteimages/productimg/<?php echo $productdet['pro_image']?>">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>

								<div class="item-slick3" data-thumb="./Dashboard/assets/images/siteimages/productimg/<?php echo $productdet['pro_image']?>">
									<div class="wrap-pic-w pos-relative">
										<img src="./Dashboard/assets/images/siteimages/productimg/<?php echo $productdet['pro_image']?>" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="./Dashboard/assets/images/siteimages/productimg/<?php echo $productdet['pro_image']?>">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>

								<div class="item-slick3" data-thumb="./Dashboard/assets/images/siteimages/productimg/<?php echo $productdet['pro_image']?>">
									<div class="wrap-pic-w pos-relative">
										<img src="./Dashboard/assets/images/siteimages/productimg/<?php echo $productdet['pro_image']?>" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="./Dashboard/assets/images/siteimages/productimg/<?php echo $productdet['pro_image']?>">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-5 p-b-30">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<h4 class="mtext-105 cl2 js-name-detail p-b-14">
							<?php echo $productdet['pro_name']?>
						</h4>

						<span class="mtext-106 cl2">
						<?php echo $productdet['pro_price']. "PKR"?>
						</span>

						<p class="stext-102 cl3 p-t-23">
						<?php echo $productdet['pro_short_info']?>
						</p>
						
						<!--  -->
						<div class="p-t-33">

							<div class="flex-w flex-r-m p-b-10">
								<div class="size-204 flex-w flex-m respon6-next">
									<div class="wrap-num-product flex-w m-r-20 m-tb-10">
										<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-minus"></i>
										</div>

										<input class="mtext-104 cl3 txt-center num-product" type="number" name="p_qty" value="1">

										<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-plus"></i>
										</div>
									</div>

									<button type="submit" name="AddToCart" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
										Add to cart
									</button>
								</div>
							</div>	
						</div>

						<!--  -->
						
					</div>
			</div>
				</div>
				
			</form>
			<div class="bor10 m-t-50 p-t-43 p-b-40">
				<!-- Tab01 -->
				<div class="tab01">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item p-b-10">
							<a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
						</li>


						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews (1)</a>
						</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content p-t-43">
						<!-- Product Description Pane  -->
						<div class="tab-pane fade show active" id="description" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6 text-center">
									<?php echo $productdet['pro_description']?>
								</p>
							</div>
						</div>

						<?php 
				}
				?>


						<!-- Product Review Pane -->
						<div class="tab-pane fade" id="reviews" role="tabpanel">
							<div class="row">
								<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
									<div class="p-b-30 m-lr-15-sm">

										<!-- Reviews displaying of the product query starts here -->
										<?php
										$reviewfetch=$pdo->prepare("SELECT
										customers.name AS customer_name,
										products.pro_name AS product_name,
										product_reviews.rating,
										product_reviews.review,
										product_reviews.review_date
									FROM
										product_reviews
									INNER JOIN customers ON product_reviews.customer_id = customers.customer_id
									INNER JOIN products ON product_reviews.product_id = products.id;
									");

									$reviewfetch->execute();

									$reviewdetfetch=$reviewfetch->fetchAll(PDO::FETCH_ASSOC);

									foreach($reviewdetfetch as $reviewdet){
										?>
										<!-- Review -->
										<div class="flex-w flex-t p-b-68">
											<div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
												<img src="images/reviewusericon.png" alt="AVATAR">
											</div>

											<div class="size-207">
												<div class="flex-w flex-sb-m p-b-17">
													<span class="mtext-107 cl2 p-r-20">
														<?php echo $reviewdet['customer_name']?> ( <?php echo $reviewdet['review_date']?>)s
													</span>

													<span class="fs-18 cl11">
														<?php echo $reviewdet['rating']?>
													</span>
												</div>

												<p class="stext-102 cl6">
												<?php echo $reviewdet['review']?>
												</p>
											</div>
										</div>
										<?php
										}
										?>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		
	</section>

		





<?php
include('footer.php');
?>