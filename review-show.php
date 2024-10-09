<?php
include('header.php');
include('./Dashboard/includes/connection.php');
?>

<div class="container">
    <div class="row m-5">
        <div class="col-md-12 col-sm-12 mt-5">
            <h3 class="text-info mb-2">My Reviews <i class="fa-solid fa-pen-nib"></i></h3>
            <table class="table table-bordered col-md-12 col-sm-12">
                <thead>
                    <tr>
                        <th scope="col">Review</th>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Review Rating</th>
                        <th scope="col">Review Date</th>
                        <th colspan="2" scope="col">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if (isset($_SESSION['cusid'])) {
                        $cid = $_SESSION['cusid'];
                        $query = $pdo->prepare('select * from product_reviews as pr inner join orders as o on pr.order_id=o.order_id WHERE pr.customer_id=:cid');
                        $query->bindParam(':cid', $cid);
                        $query->execute();
                        $row = $query->fetchAll(PDO::FETCH_ASSOC);
                        if (count($row) > 0) {
                            foreach ($row as $prorev) {
                                ?>
                                <tr>
                                    <td><?php echo $prorev['review'] ?></td>
                                    <td><?php echo $prorev['product_name'] ?></td>
                                    <td><?php echo $prorev['quantity'] ?></td>
                                    <td><?php echo $prorev['product_price'] ?></td>
                                    <td><?php echo $prorev['rating'] ?></td>
                                    <td><?php echo $prorev['review_date'] ?></td>
                                    <td>
                                        <button class="btn btn-success">
                                            <a href="review-update.php?rvid=<?php echo $prorev['review_id'] ?>"
                                               class="text-light">Edit</a>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger">
                                            <a href="?rvid=<?php echo $prorev['review_id'] ?>" class="text-light">Delete</a>
                                        </button>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo 
                            '<tr>
                                <td colspan="7" class="text-center">
                                    <h6>No reviews found.</h6>
                                </td>
                            </tr>';
                        }
                    } else {
                        echo "<script>alert('session is unset ')</script>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Review delete query starts here -->
<?php
if (isset($_GET['rvid'])) {
    $rvid = $_GET['rvid'];

    $revdelete = $pdo->prepare('Delete from product_reviews where review_id=:rvid');
    $revdelete->bindParam(':rvid', $rvid);
    $revdelete->execute();
    ?>
    <script>
        alert('Review deleted successfully');
        location.assign('review-show.php');
    </script>
    <?php
}
?>
<!-- Review delete query ends here -->

<?php
include('footer.php');
?>
