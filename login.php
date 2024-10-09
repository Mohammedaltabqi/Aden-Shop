<?php
include('header.php');
error_reporting(0);
?>

<style>
    .divider:after,
    .divider:before {
    content: "";
    flex: 1;
    height: 1px;
    background: #eee;
    }
</style>

<div class="container p-5">
    <div class="col-md-12">
    <section class="vh-100">
      <div class="container py-5 h-100 my-4">
        <div class="row d-flex align-items-center justify-content-center h-100">
          <div class="col-md-8 col-lg-7 col-xl-6">
            <img src="images/loginimg.png" class="img-fluid" alt="Phone image">
          </div>
          <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
            <h2 class="mb-2">Login Form</h2>

            <!-- Bootstrap Alert for Login Validation -->
            <?php
            if (isset($_POST['login'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];

                // Check if any field is empty
                if (empty($email) || empty($password)) {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        Please fill all fields
                    </div>
                    <?php
                }
                else {
                    // Fetching data from the database to be matched in order to login
                    $query = $pdo->prepare("SELECT * FROM customers WHERE email=:email");
                    $query->bindParam(':email', $email);
                    $query->execute();

                    $result = $query->fetch(PDO::FETCH_ASSOC);

                    if ($result && $result['password'] == $password) {
                        // Successful login
                        $_SESSION['useremail'] = $result['email'];
                        $_SESSION['cusid'] = $result['customer_id'];
                        $_SESSION['username'] = $result['name'];
                        $_SESSION['address'] = $result['address'];
                        $_SESSION['work_phone'] = $result['work_phone'];
                        $_SESSION['cell_phone'] = $result['cell_phone'];
                        $_SESSION['date_of_birth'] = $result['date_of_birth'];
                        ?>
                        <script>
                            location.assign('index.php');
                        </script>
                        <?php
                    } else {
                        // Invalid login
                        ?>
                        <div class="alert alert-danger" role="alert">
                            Invalid email or password. Please try again.
                        </div>
                        <?php
                    }
                }
            }
            ?>
            <!-- Bootstrap Alert ends here -->

            <form method="POST">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input name="email" type="email" id="form1Example13" class="form-control form-control-lg" />
                <label class="form-label" for="form1Example13">Email address</label>
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input name="password" type="password" id="form1Example23" class="form-control form-control-lg" />
                <label class="form-label" for="form1Example23">Password</label>
              </div>

              <div class="d-flex justify-content-around align-items-center mb-4">
                <!-- Checkbox -->
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                  <label class="form-check-label" for="form1Example3"> Remember me </label>
                </div>
                <a href="#!">Forgot password?</a>
              </div>

              <!-- Login button -->
              <button name="login" class="btn btn-primary btn-lg btn-block" onclick="return validateForm();">Log In</button>

              <div class="my-3">
                <h5>Don't have an account? <a href="signup.php">Click here!</a></h5>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>



<?php
include('footer.php');
?>
