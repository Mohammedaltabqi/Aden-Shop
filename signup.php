<?php
include('header.php');
?>

<style>
  .card {
    background-color: rgb(240, 239, 239);
    border-radius: 20px;
  }
</style>

<div class="container">
  <div class="row">
    <div class="col-md-12 p-5 card" style="margin:80px 15px 15px 20px;">
      <h3 class="mb-4">Signup Form</h3>

      <!-- signup query starts-->
      <?php
      $show = ""; // Declare the $show variable here

      if (isset($_POST['signup'])) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $work_phone = $_POST['work_phone'];
        $cell_phone = $_POST['cell_phone'];
        $date_of_birth = $_POST['date_of_birth'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        $error = array();

        if (empty($name)) {
          $error['apply'] = "Enter name";
        } else if (empty($email)) {
          $error['apply'] = "Enter email";
        } else if (empty($address)) {
          $error['apply'] = "Enter address";
        } else if (empty($work_phone)) {
          $error['apply'] = "Enter work_phone";
        } else if (empty($cell_phone)) {
          $error['apply'] = "Enter cell_phone";
        } else if (empty($date_of_birth)) {
          $error['apply'] = "Enter date_of_birth";
        } else if (empty($password)) {
          $error['apply'] = "Enter Password";
        } else if ($confirm_password != $password) {
          $error['apply'] = "Both Password do not match";
        }

        // Check if the email already exists in the database
        $query_check_email = $pdo->prepare("SELECT email FROM customers WHERE email = :email");
        $query_check_email->bindParam(':email', $email);
        $query_check_email->execute();

        if ($query_check_email->rowCount() > 0) {
          $error['apply'] = "Email already exists. Use a different email.";
        }

        if (count($error) == 0) {
          $query = $pdo->prepare("INSERT INTO `customers`(`name`, `address`, `email`, `work_phone`, `cell_phone`, `date_of_birth`, `password`) VALUES (:name, :address, :email, :work_phone, :cell_phone, :date_of_birth, :password)");

          $query->bindParam('name', $name);
          $query->bindParam('address', $address);
          $query->bindParam('email', $email);
          $query->bindParam('work_phone', $work_phone);
          $query->bindParam('cell_phone', $cell_phone);
          $query->bindParam('date_of_birth', $date_of_birth);
          $query->bindParam('password', $password);

          $query->execute();
        ?>
        <div class="alert alert-success" role="alert">
          Successfully signed up.
        </div>
        <script>
          location.assign('login.php');
        </script>
        <?php
        } else {
          $show = "<div class='alert alert-danger' role='alert'>";
          foreach ($error as $err) {
            $show .= $err . "<br>";
          }
          $show .= "</div>";
        }
      }
      ?>
      <!-- signup query ends-->
      <div>
        <?php
        echo $show;
        ?>
        <div>
          <form method="post">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Name</label>
                <input type="name" name="name" class="form-control" id="inputEmail4">
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">Email</label>
                <input type="email" name="email" class="form-control" id="inputPassword4">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="inputAddress">Address</label>
                <input type="text" name="address" class="form-control" id="inputAddress">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-5">
                <label>Work_phone</label>
                <input type="number" name="work_phone" class="form-control" id="inputCity">
              </div>

              <div class="form-group col-md-5">
                <label>Cell_phone</label>
                <input type="number" name="cell_phone" class="form-control" id="inputCity">
              </div>

              <div class="form-group col-md-2">
                <label for="Date">Date_of_birth</label>
                <input type="date" name="date_of_birth" class="form-control" id="Date">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Password</label>
                <input type="password" name="password" class="form-control" id="inputCity">
              </div>

              <div class="form-group col-md-6">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" id="inputCity">
              </div>
            </div>

            <button name="signup" class="btn btn-primary">Sign up</button>

            <div class="my-3">
                <h5>Already have an account? <a href="login.php">Click here!</a></h5>
              </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<?php
include('footer.php');
?>
