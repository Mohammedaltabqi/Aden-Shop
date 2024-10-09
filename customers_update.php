<?php
include('./includes/header.php');
?>


<!-- Main Panel -->
<div class="main-panel">
  <div class="content-wrapper">


    <!-- Customer add form -->
    <div class="row ">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <div class="card-body">
              <h4 class="card-title">Customer Update</h4>

              <!-- Fetching Previous Customer details for knowing the previus value -->
              <?php
              if(isset($_GET['cusid'])){
                $id=$_GET['cusid'];
                $query=$pdo->prepare('select * from customers where customer_id=:cusid');
                $query->bindParam('cusid',$id);
                $query->execute();

                $data=$query->fetch(PDO::FETCH_ASSOC);
                ?>
                 <!-- Customer Update Form -->
              <form class="forms-sample" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="exampleInputName1">Name</label>
                  <input type="text" name="cust_name" class="form-control" id="exampleInputName1" placeholder="<?php echo $data['name']?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Address</label>
                  <input type="text" name="cust_address" class="form-control" id="exampleInputName1" placeholder="<?php echo $data['address']?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Email</label>
                  <input type="text" name="cust_email" class="form-control" id="exampleInputName1" placeholder="<?php echo $data['email']?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Work_phone</label>
                  <input type="text" name="cust_wphone" class="form-control" id="exampleInputName1" placeholder="<?php echo $data['work_phone']?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Cell_phone</label>
                  <input type="text" name="cust_cphone" class="form-control" id="exampleInputName1" placeholder="<?php echo $data['cell_phone']?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Date_of_birth</label>
                  <input type="text" name="cust_dob" class="form-control" id="exampleInputName1" placeholder="<?php echo $data['date_of_birth']?>">
                </div>

    


                <button name="cust_update" class="btn btn-primary mr-2">Update</button>
              </form>




                <?php
              }

            //   Customer Update Query

              if(isset($_POST["cust_update"])){
                
                $cusid = $_GET['cusid'];
               $customer_name = $_POST['cust_name'];
               $customer_address = $_POST['cust_address'];
               $customer_email = $_POST['cust_email'];
               $customer_wphone = $_POST['cust_wphone'];
               $customer_cphone = $_POST['cust_cphone'];
               $customer_dob = $_POST['cust_dob'];
$query=$pdo->prepare("update customers  set name =:cname, address=:cadd, email=:cemail, work_phone=:wphone, cell_phone=:cphone, date_of_birth=:cdob where customer_id =:pid");
$query->bindParam("pid",$cusid);
$query->bindParam("cname",$customer_name);
$query->bindParam("cadd",$customer_address);
$query->bindParam("cemail",$customer_email);
$query->bindParam("wphone",$customer_wphone);
$query->bindParam("cphone",$customer_cphone);
$query->bindParam("cdob",$customer_dob);
$query->execute();
echo "
<script>
alert('update customer successfully')
location.assign('customers_view.php');

</script>";

}
                  
              ?>

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