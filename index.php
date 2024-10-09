<?php
include("header.php");
?>




<!-- Slider -->



<!-- Banner -->
<div class="sec-banner bg0 p-t-80 p-b-50">
	<div class="container">
		<div class="row">
			<!-- Categories print query starts here -->
			<?php
			$query = $pdo->query("select * from categories");
			$row = $query->fetchAll(PDO::FETCH_ASSOC);
			$query->execute();
			foreach ($row as $catAll) { ?>
			<div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
				<!-- Block1 -->
				<div class="block1 wrap-pic-w">
					<img src="./Dashboard/assets/images/siteimages/categoryimg/<?php echo $catAll['image']?>"
					style="height:200px;" alt="IMG-BANNER">


					<!-- making link to approach product of the specific selected category in product.php -->
					<a href="product.php?cid=<?php echo $catAll['id']?>"
						class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">

						<div class="block1-txt-child1 flex-col-l">
							<span class="block1-name ltext-102 trans-04 p-b-8">
								<?php echo $catAll['name']; ?>
							</span>

							<span class="block1-info stext-102 trans-04">
								New 2023
							</span>
						</div>

						<div class="block1-txt-child2 p-b-4 trans-05">
							<div class="block1-link stext-101 cl0 trans-09">
								Shop Now
							</div>
						</div>
					</a>
				</div>
			</div>
			<?php
			}
			?>


			<!-- Categories print query ends here -->
		</div>
	</div>
</div>


<!-- Product -->



<?php
include("footer.php")
?>