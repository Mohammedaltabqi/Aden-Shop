<?php
include("./dashboard/includes/connection.php");
include("query.php");
 $query = $pdo->query("select * from products");
 $query->execute();
 $row = $query->fetchAll(PDO::FETCH_ASSOC);
 foreach($row as $proAll){
     echo " <div class='col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women'>
     <!-- Block2 -->
     <div class='block2'>
         <div class='block2-pic hov-img0'>
             <img src='./Dashboard/assets/images/siteimages/productimg/". $proAll['pro_image'] ."' style='height:250px;' alt='IMG-PRODUCT'>
         </div>

         <div class='block2-txt flex-w flex-t p-t-14'>
             <div class='block2-txt-child1 flex-col-l'>
                 <a href='product-detail.php?pid=".$proAll['id']."' class='stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6'>
                     '". $proAll['pro_name']."' 
                 </a>

                 <span class='stext-105 cl3'>
                     $ '". $proAll['pro_price']."'
                 </span>
             </div>

             <div class='block2-txt-child2 flex-r p-t-3'>
                 <a href='#' class='btn-addwish-b2 dis-block pos-relative js-addwish-b2'>
                 </a>
             </div>
         </div>
     </div>
 </div>";
 };
?>