<?php
include('header.php');
include("./dashboard/includes/connection.php");
include("query.php")
?>
<div class="bg0 m-t-23 p-b-140">
    <div class="container">
        <div class="flex-w flex-sb-m p-b-52">

        </div>
        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">

            </div>

            <div class="flex-w flex-c-m m-tb-10">


                <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                    <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                    <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    Search
                </div>
            </div>

            <!-- Search product -->
            <div class="dis-none panel-search w-full p-t-10 p-b-15">
                <div class="bor8 dis-flex p-l-15">
                    <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>

                    <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search" id="psearch" placeholder="Search">
                </div>
            </div>


        </div>

        <!-- All product cards start here -->
        <div id="products-container">
            <!-- Your product cards and pagination here -->

            <div class="row ml-5" id="loadData">

                <!-- Products print query starts here with product per page queries -->
                <?php

                if (isset($_GET['cid'])) {
                    $cid = $_GET['cid'];



                    $query = $pdo->prepare("SELECT * FROM products where cat_type_id=:cid ;
");
                    $query->bindParam(':cid', $cid);
                    $query->execute();
                    $data = $query->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($data as $proAll) {
                ?>
                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women" >
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-pic hov-img0">
                                    <img src="./Dashboard/assets/images/siteimages/productimg/<?php echo $proAll['pro_image'] ?>" style="height:250px;" alt="IMG-PRODUCT">
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
                                       </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <script>
                        $(document).ready(function() {
                            $.ajax({
                                url: "loadAjax.php",
                                type: "get",
                                success: function(res) {

                                    $('#loadData').load("loadAjax.php")
                                }

                            })
                        })
                    </script>

                <?php

                }
                ?>
                <!-- Products print query ends here with products per page queries -->
            </div>
            <div id='load'></div>
            <!-- All product cards ends here -->

            <!-- Pagination -->
            <?php
            $limit = 8;

            // Calculate the total number of products (or content) available
            $query = $pdo->prepare('SELECT COUNT(*) FROM products WHERE cat_type_id = :cid');
            $query->bindParam(':cid', $cid);
            $query->execute();
            $row = $query->fetchColumn();

            // Calculate the total number of pages
            $total_pages = ceil($row / $limit);

            if ($total_pages > 1) {
                // Display pagination only if there are more than one page
                echo '<nav aria-label="Page navigation" class="flex-c-m flex-w w-full p-t-45">';
                echo '<ul class="pagination text-center" id="pagination">';
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == 1) {
                        echo '<li class="page-item active" id="' . $i . '"><a class="page-link" href="product.php?cid=' . $cid . '&page=' . $i . '">' . $i . '</a></li>';
                    } else {
                        echo '<li class="page-item" id="' . $i . '"><a class="page-link" href="product.php?cid=' . $cid . '&page=' . $i . '">' . $i . '</a></li>';
                    }
                }
                echo '</ul>';
                echo '</nav>';
            } 
            ?>

        </div>
        </body>
        <script>
            $(document).ready(function() {
                $("#load").load("pagination.php?page=1");
                $("#pagination li").on('click', function(e) {
                    e.preventDefault();
                    $("#load").html('loading...');
                    $("#pagination li").removeClass('active');
                    $(this).addClass('active');
                    var pageNum = this.id;
                    $("#load").load("pagination.php?page=" + pageNum);
                });
            });
        </script>
    </div>
</div>
</div>


<?php
include('footer.php');
?>


