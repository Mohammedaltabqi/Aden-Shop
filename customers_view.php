<?php
include('./includes/header.php');
?>


<!-- Main Panel -->
<div class="main-panel">
  <div class="content-wrapper">


    <!-- Customers add form -->
    <div class="row ">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">Customers</h2>
            <div class="table-responsive">
              <table class="table table-bordered bg-dark">
                <thead class="bg-light">
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Work_phone</th>
                    <th>Cell_phone</th>
                    <th>Date Of Birth</th>
                    <th colspan="2">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Customers View Query -->
                  <?php
                          $query=$pdo->prepare('select * from customers');
                          $query->execute();
                          $data=$query->fetchAll(PDO::FETCH_ASSOC);
                          if($data){
                            foreach($data as $customer){
                          ?>
                  <tr>
                    <td>
                      <?php echo $customer['customer_id']?>
                    </td>
                    <td>
                      <?php echo $customer['name']?>
                    </td>
                    <td>
                      <?php echo $customer['address']?>
                    </td>
                    <td>
                      <?php echo $customer['email']?>
                    </td>
                    <td>
                      <?php echo $customer['work_phone']?>
                    </td>
                    <td>
                      <?php echo $customer['cell_phone']?>
                    </td>
                    <td>
                      <?php echo $customer['date_of_birth']?>
                    </td>
                    <td>
                      <form method="GET">
                        <button class="btn btn-success ml-4"><a href="customers_update.php?cusid=<?php echo $customer['customer_id']?>"
                            class="text-light"> Edit</a></button>
                      </form>
                    </td>
                    <td>
                      <form method="GET">
                        <button class="btn btn-danger ml-4"><a href="customers_view.php?cusid=<?php echo $customer['customer_id']?>"
                            class="text-light"> Delete</a></button>
                      </form>
                    </td>

                    <!-- Delete Customers Query -->
                    <?php
                    if(isset($_GET["cusid"])){
                      $id = $_GET['cusid'];
                      $query= $pdo->prepare("delete from customers where customer_id =:cusid");
                      $query->bindParam("cusid",$id);
                      $query->execute();
                      echo "<script>
                      alert('Customers Deleted Successfully');
              location.assign('customers_view.php');
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
                    <td colspan="4" class="text-white text-center">No Customers to show</td>
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