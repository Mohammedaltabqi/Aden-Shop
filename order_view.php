<?php
include('./includes/header.php');
?>


<!-- Main Panel -->
<div class="main-panel">
  <div class="content-wrapper">


    <!-- Orders view form -->
    <div class="row ">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">Orders</h2>
            <div class="table-responsive">
              <table class="table table-bordered bg-dark">
                <thead class="bg-light">
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Work_phone</th>
                    <th>Cell_phone</th>
                    <th>Product_name</th>
                    <th>Product_price</th>
                    <th>Quantity</th>
                    <th>status</th>
                    <th>order_date</th>
                    <th colspan="2">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Order View Query -->
                  <?php
                          $query=$pdo->prepare("SELECT
                          orders.order_id,
                          customers.name,
                          customers.work_phone,
                          customers.cell_phone,
                          orders.product_name,
                          orders.product_price,
                          orders.quantity,
                          orders.status,
                          orders.order_date
                      FROM
                          orders
                      INNER JOIN
                          customers
                      ON
                          customers.customer_id = orders.customer_id
                      WHERE
                          orders.status = 'pending';"
                      );
                          $query->execute();
                          $data=$query->fetchAll(PDO::FETCH_ASSOC);
                          if($data){
                            foreach($data as $order){
                          ?>
                  <tr>
                    <td>
                      <?php echo $order['order_id']?>
                    </td>
                    <td>
                      <?php echo $order['name']?>
                    </td>
                    <td>
                        <?php echo $order['work_phone']?>
                    </td>
                    <td>
                        <?php echo $order['cell_phone']?>
                    </td>
                    <td>
                        <?php echo $order['product_name']?>
                    </td>
                    <td>
                        <?php echo $order['product_price']?>
                    </td>
                    <td>
                        <?php echo $order['quantity']?>
                    </td>
                    <td>
                      <button class="btn btn-outline-warning">
                        <?php echo $order['status']?>
                      </button>
                    </td>
                    <td>
                        <?php echo $order['order_date']?>
                    </td>
                    <td>
                      <form method="GET">
                        <button class="btn btn-success ml-4"><a href="order_view.php?oaid=<?php echo $order['order_id']?>"
                            class="text-light">Approve</a></button>
                      </form>
                    </td>
                    <td>
                      <form method="GET">
                        <button class="btn btn-danger ml-4"><a href="order_view.php?orid=<?php echo $order['order_id']?>"
                            class="text-light">Reject</a></button>
                      </form>
                    </td>

                    <!-- Order Approve Query -->
                    <?php
if (isset($_GET["oaid"])) {
    $id = $_GET['oaid'];
    $query = $pdo->prepare("UPDATE orders SET status = 'approved' WHERE order_id = :oid");
    $query->bindParam(":oid", $id);
    $query->execute();
    echo "<script>
            alert('Order Approved Successfully');
            location.assign('order_view.php');
          </script>";
}
?>
<!-- Order Reject Query -->
<?php
if (isset($_GET["orid"])) {
    $id = $_GET['orid'];
    $query = $pdo->prepare("UPDATE orders SET status = 'rejected' WHERE order_id = :oid");
    $query->bindParam(":oid", $id);
    $query->execute();
    echo "<script>
            alert('Order Rejected Successfully');
            location.assign('order_view.php');
          </script>";
}
?>
                  </tr>
                  <?php 
                            }
                          }

                          else{
                            ?>
                  <tr>
                    <td colspan="4" class="text-white text-center">No Orders to show</td>
                  </tr>
                  <?php
                          }
                          ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
  <!-- content-wrapper ends -->

  <?php
include('./includes/footer.php');
?>