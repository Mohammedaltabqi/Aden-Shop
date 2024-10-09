<?php
include('header.php');
?>


<!-- Details Fetching Product Review Query Starts here-->
<?php
if(isset($_GET['rvid'])){
    $rvid=$_GET['rvid'];

    $query = $pdo->prepare("SELECT product_name FROM orders WHERE order_id = :rvid AND status = 'delivered'");
    $query->bindParam(':rvid', $rvid);
    $query->execute();

    $result=$query->fetch(PDO::FETCH_ASSOC);

    $prodname=$result['product_name'];

    //Fetching Product id

    $prodnamefetch = $pdo->prepare("SELECT id FROM products WHERE pro_name = :prodname");
    $prodnamefetch->bindParam(':prodname', $prodname);
    $prodnamefetch->execute();

    $prodidres = $prodnamefetch->fetch(PDO::FETCH_ASSOC);

    $proid = $prodidres['id'];

}
?>
<!--  Details Fetching for Product Review Query Ends here-->




<!-- Product review query starts here -->
<?php
if(isset($_POST['submit_review'])){
    $customerid=$_POST['customerid'];
    $orderid=$_POST['orderid'];
    $productid=$_POST['productid'];
    $productname=$_POST['productname'];
    $rating=$_POST['rating'];
    $review=$_POST['review'];

    $reviewinsert = $pdo->prepare("INSERT INTO product_reviews (customer_id, order_id,product_id, product_name, rating, review, review_date) VALUES (:customerid, :orderid, :productid, :productname, :rating, :review, NOW())");

    $reviewinsert->bindParam(':customerid', $customerid);
    $reviewinsert->bindParam(':orderid', $orderid);
    $reviewinsert->bindParam(':productid', $productid);
    $reviewinsert->bindParam(':productname', $productname);
    $reviewinsert->bindParam(':rating', $rating);
    $reviewinsert->bindParam(':review', $review);


    if($reviewinsert->execute()) {
       ?>
       <script>
        alert('Review submitted successfully');
        location.assign('trackorder.php');
       </script>
       <?php
    } else {
        ?>
       <script>
        alert('Review submission failed');
        location.assign('trackorder.php');
       </script>
       <?php
    }

}
?>
<!-- Product review query ends here -->




<div class="container">
    <div class="row">
        <div class="col-md-12 p-5 mt-5">
            <form method="post">
                    <input type="hidden" name="customerid" value="<?php echo $_SESSION['cusid']?>">
                    <input type="hidden" name="orderid" value="<?php echo $rvid;?>">
                    <input type="hidden" name="productid" value="<?php echo $proid;?>">

                    <div class="form-row">
                        <div class="form-group col-md-5">
                        <label>Your Name</label>
                        <input type="text" readonly  class="form-control" id="inputCity" value="<?php echo $_SESSION['username']?>">
                    </div>
                    <div class="form-group col-md-5">
                        <label>Product Name</label>
                        <input type="text" readonly name="productname" class="form-control" id="inputCity" value="<?php echo $prodname;?>">
                        </div>
                        <div class="form-group col-md-2">
                        <label>Product Rating</label>
                        <select name="rating"class="form-control">
                        <option value="">Give Your Rating</option>
                            <option value="⭐">⭐</option>
                            <option value="⭐★">⭐★</option>
                            <option value="⭐⭐">⭐⭐</option>
                            <option value="⭐⭐★">⭐⭐★</option>
                            <option value="⭐⭐⭐">⭐⭐⭐</option>
                            <option value="⭐⭐⭐★">⭐⭐⭐★</option>
                            <option value="⭐⭐⭐⭐">⭐⭐⭐⭐</option>
                            <option value="⭐⭐⭐⭐★">⭐⭐⭐⭐★</option>
                            <option value="⭐⭐⭐⭐⭐">⭐⭐⭐⭐⭐</option>
                        </select>
                    </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Review</label>
                            <textarea name="review" rows="5" class="form-control" placeholder="Give your precious review here"></textarea>
                        </div>
                    </div>

                    <button type="submit" name="submit_review" class="btn btn-primary">Submit Review</button>
            </form>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>