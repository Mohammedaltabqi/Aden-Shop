<?php
include('./includes/header.php');
?>


<!-- Main Panel -->
<div class="main-panel">
  <div class="content-wrapper">


    <!-- Approved Orders view form -->
    <div class="row ">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">Approved orders</h2>
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
                    <th>Set Delivered</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Order View Query -->
                  <?php
                          $query=$pdo->prepare("SELECT
                          orders.order_id,customers.name,customers.work_phone,customers.cell_phone,orders.product_name,orders.product_price,orders.quantity,orders.status,orders.order_date FROM orders INNER JOIN customers ON customers.customer_id = orders.customer_id WHERE status='approved';");
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
                      <button class="btn btn-outline-success">
                      <?php echo $order['status']?>
                      </button>
                    </td>
                    <td>
                        <?php echo $order['order_date']?>
                    </td>

                    <!-- status from approved to Delivered button start-->
                    <form method="GET">
                    <td>
                      <button class="btn btn-primary">
                        <a href="approved_order.php?dlvdid=<?php echo $order['order_id'] ?>" class="text-light">Done</a>
                      </button>
                    </td>
                    </form>
                    <!-- status from approved to Delivered button end-->
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


              <!-- order status from approved to delivered changing query starts -->
              <?php
              if(isset($_GET['dlvdid'])){
                $id=$_GET['dlvdid'];

                $query=$pdo->prepare("Update orders set status='delivered' Where order_id=:dlvdid ");
                $query->bindParam(':dlvdid',$id);
                $query->execute();

                ?>
                <script>
                  alert('Order delivered successfully');
                  location.assign('approved_order.php');
                </script>
                <?php
              }
              ?>
              <!-- order status from approved to delivered changing query ends -->
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