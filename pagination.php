<?php
include('./dashboard/includes/connection.php');

if(isset($_GET['cid'])){
$limit = 8;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$cid = $_GET['cid'];
$start_page = ($page - 1) * $limit;


$query = $pdo->prepare("SELECT * FROM products where cat_type_id = :cid LIMIT $start_page, $limit;
");
$query->bindParam(':cid', $cid);
$query->execute();

$data = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($data as $proAll) {
?>
    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
        <!-- Block2 -->
        <div class="block2">
            <div class="block2-pic hov-img0">
                <img src="./Dashboard/assets/images/siteimages/productimg/<?php echo $proAll['pro_image'] ?>" alt="IMG-PRODUCT">
                <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                    Quick View
                </a>
            </div>

            <div class="block2-txt flex-w flex-t p-t-14">
                <div class="block2-txt-child1 flex-col-l">
                    <a href="product-detail.php?pid=<?php echo $proAll['id'] ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                        <?php echo $proAll['pro_name'] ?>
                    </a>

                    <span class="stext-105 cl3">
                        $ <?php echo $proAll['pro_price'] ?>
                    </span>
                </div>

                <div class="block2-txt-child2 flex-r p-t-3">
                    <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                        <img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
                        <img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script>    var cid = <?php echo json_encode($cid); ?>;
    console.log(cid);
    </script>

<?php
}
}




?>