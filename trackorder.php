<?php
error_reporting(0);
include('header.php');
?>

<div class="container">
    <div class="row m-5">
        <div class="col-md-12 col-sm-12 mt-5">
            <h3 class="text-info mb-2">Track Order <i class="fa-duotone fa-truck"></i></h3>
            <table class="table table-bordered col-md-12 col-sm-12">
                <thead>
                    <tr>
                        <th scope="col">Order</th>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Date Placed</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>

                <tbody>
                    
                    <!-- Orders Fetch for Tracking order of specific customer starts here -->

                    <?php
                    $customer_id = $_SESSION['cusid'];
                    $query = $pdo->prepare("SELECT * FROM orders WHERE customer_id = :cus_id");
                    $query->bindParam(':cus_id', $customer_id);
                    $query->execute();

                    $result = $query->fetchAll(PDO::FETCH_ASSOC);

                    $orderCount = 1; // Initializing the order count

                    if(empty($result)){
                        ?>
                        <tr>
                            <td colspan="6" class="text-center">No orders to show</td>
                        </tr>
                        <?php
                    }
                    else{

                    foreach ($result as $orderdet) {
                        // Customizing bg-color according to status starts

                        $statusClass = ''; // Initializing the class for row background color

                        // Determine the class based on the order status
                        if ($orderdet['status'] == 'delivered') {
                            $statusClass = 'bg-info  text-white'; // Setting Green background for delivered

                            // Check if a review exists for this order
                            $reviewQuery = $pdo->prepare("SELECT COUNT(*) AS review_count FROM product_reviews WHERE customer_id = :customer_id AND order_id = :order_id");
                            $reviewQuery->bindParam(':customer_id', $customer_id);
                            $reviewQuery->bindParam(':order_id', $orderdet['order_id']);
                            $reviewQuery->execute();
                            $reviewResult = $reviewQuery->fetch(PDO::FETCH_ASSOC);

                            // If a review exists, remove the Review link
                            if ($reviewResult['review_count'] > 0) {
                                $statusText = 'Review Submitted';
                            } else {
                                // Create a link to the review page for delivered orders
                                $statusText = "<a href='review.php?rvid={$orderdet['order_id']}' class='text-light'>Delivered</a>";
                            }
                        } elseif ($orderdet['status'] == 'approved') {
                            $statusClass = 'bg-success text-white'; // Setting Green background for approved
                            $statusText = 'Approved';
                        } elseif ($orderdet['status'] == 'pending') {
                            $statusClass = 'bg-warning'; // Setting Yellow background for pending
                            $statusText = 'Pending';
                        } elseif ($orderdet['status'] == 'rejected') {
                            $statusClass = 'bg-danger text-white'; // Setting Red background for rejected
                            $statusText = 'Rejected';
                        }
                        ?>
                        <tr class="<?php echo $statusClass; ?>">
                            <td><?php echo $orderCount; ?></td>
                            <td><?php echo $orderdet['product_name']; ?></td>
                            <td><?php echo $orderdet['quantity']; ?></td>
                            <td><?php echo $orderdet['product_price']; ?></td>
                            <td><?php echo $orderdet['order_date']; ?></td>
                            <td><?php echo $statusText; ?></td>
                        </tr>
                    <?php
                        $orderCount++; // Incrementing the order count for the next row
                    }
                }
                    ?>

                    <!-- Orders Fetch for Tracking order of a specific customer ends here -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>
