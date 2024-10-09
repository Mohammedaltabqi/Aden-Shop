<?php
include('header.php');
?>

<!-- Review update query starts here -->
<?php
if (isset($_GET['rvid'])) {
    $rvid = $_GET['rvid'];
    
    if (isset($_POST['update_review'])) {
        $newRating = $_POST['rating'];
        $newReview = $_POST['review'];

        // Updating the review in the database
        $updateReview = $pdo->prepare('UPDATE product_reviews SET rating = :rating, review = :review, review_date = NOW() WHERE review_id = :rvid');
        $updateReview->bindParam(':rating', $newRating);
        $updateReview->bindParam(':review', $newReview);
        $updateReview->bindParam(':rvid', $rvid);
        $updateReview->execute();
        
        ?>
        <script>
            alert('Review updated successfully');
            location.assign('review-show.php');
        </script>
        <?php
        
    }

    // Fetching the current review data
    $currentrev = $pdo->prepare('SELECT * FROM product_reviews WHERE review_id = :rvid');
    $currentrev->bindParam(':rvid', $rvid);
    $currentrev->execute();

    $currentrevdet = $currentrev->fetch(PDO::FETCH_ASSOC);
}
?>
<!-- Review update query ends here -->


<div class="container">
    <div class="row">
        <div class="col-md-12 p-5 mt-5">
            <h3>Review update</h3>
            <form method="post">

                    <div class="form-row">
                        <div class="form-group col-md-5">
                        <label>Your Name</label>
                        <input type="text" readonly  class="form-control" id="inputCity" value="<?php echo $_SESSION['username']?>">
                    </div>
                    <div class="form-group col-md-5">
                        <label>Product Name</label>
                        <input type="text" readonly  class="form-control" id="inputCity" value="<?php echo $currentrevdet['product_name']?>">
                        </div>
                        <div class="form-group col-md-2">
                        <label>Product Rating</label>
                        <select name="rating" class="form-control">
    <option value="">Give Your Rating</option>
    <option value="⭐" <?php if ($currentrevdet['rating'] == "⭐") echo "selected"; ?>>⭐</option>
    <option value="⭐★" <?php if ($currentrevdet['rating'] == "⭐★") echo "selected"; ?>>⭐★</option>
    <option value="⭐⭐" <?php if ($currentrevdet['rating'] == "⭐⭐") echo "selected"; ?>>⭐⭐</option>
    <option value="⭐⭐★" <?php if ($currentrevdet['rating'] == "⭐⭐★") echo "selected"; ?>>⭐⭐★</option>
    <option value="⭐⭐⭐" <?php if ($currentrevdet['rating'] == "⭐⭐⭐") echo "selected"; ?>>⭐⭐⭐</option>
    <option value="⭐⭐⭐★" <?php if ($currentrevdet['rating'] == "⭐⭐⭐★") echo "selected"; ?>>⭐⭐⭐★</option>
    <option value="⭐⭐⭐⭐" <?php if ($currentrevdet['rating'] == "⭐⭐⭐⭐") echo "selected"; ?>>⭐⭐⭐⭐</option>
    <option value="⭐⭐⭐⭐★" <?php if ($currentrevdet['rating'] == "⭐⭐⭐⭐★") echo "selected"; ?>>⭐⭐⭐⭐★</option>
    <option value="⭐⭐⭐⭐⭐" <?php if ($currentrevdet['rating'] == "⭐⭐⭐⭐⭐") echo "selected"; ?>>⭐⭐⭐⭐⭐</option>
</select>

                    </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Review</label>
                            <textarea name="review" rows="5" class="form-control"><?php echo $currentrevdet['review']?></textarea>
                        </div>
                    </div>

                    <button type="submit" name="update_review" class="btn btn-primary">Update Review</button>
            </form>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>