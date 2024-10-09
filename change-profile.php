<?php
include('header.php');
?>

<?php
$cusid = $_SESSION['cusid'];

if (isset($_POST['upd_prof'])) {
    // Getting the values from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $work_phone = $_POST['work_phone'];
    $cell_phone = $_POST['cell_phone'];
    $date_of_birth = $_POST['date_of_birth'];
    $password = $_POST['password'];

    // Create and execute the update query
    $updateQuery = $pdo->prepare("UPDATE customers SET name = :name, email = :email, address = :address, work_phone = :work_phone, cell_phone = :cell_phone, date_of_birth = :date_of_birth, password = :password WHERE customer_id = :cusid");
    $updateQuery->bindParam(':name', $name);
    $updateQuery->bindParam(':email', $email);
    $updateQuery->bindParam(':address', $address);
    $updateQuery->bindParam(':work_phone', $work_phone);
    $updateQuery->bindParam(':cell_phone', $cell_phone);
    $updateQuery->bindParam(':date_of_birth', $date_of_birth);
    $updateQuery->bindParam(':password', $password);
    $updateQuery->bindParam(':cusid', $cusid);

    if ($updateQuery->execute()) {
        ?>
        <script>
            alert('Profile updated Successfully');
            location.assign('index.php');
        </script>
        <?php
    } 
    else {
        ?>
        <script>
            alert('Profile didnt updated');
            location.assign('change-profile.php');
        </script>
        <?php
    }
}

// Fetch the customer's current data
$selectQuery = "SELECT * FROM customers WHERE customer_id = :cusid";
$updateQuery = $pdo->prepare($selectQuery);
$updateQuery->bindParam(':cusid', $cusid);
$updateQuery->execute();
$customerData = $updateQuery->fetch(PDO::FETCH_ASSOC);
?>

<div class="container">
    <div class="row">
        <div class="col-md-12 p-5 card" style="margin:80px 15px 15px 20px;">
            <h3 class="mb-4">Signup Form</h3>

            <div>
                <form method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Name</label>
                            <input type="name" name="name" class="form-control" id="inputEmail4" value="<?php echo $customerData['name']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Email</label>
                            <input type="email" name="email" class="form-control" id="inputPassword4" value="<?php echo $customerData['email']; ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputAddress">Address</label>
                            <input type="text" name="address" class="form-control" id="inputAddress" value="<?php echo $customerData['address']; ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label>Work_phone</label>
                            <input type="number" name="work_phone" class="form-control" id="inputCity" value="<?php echo $customerData['work_phone']; ?>">
                        </div>

                        <div class="form-group col-md-5">
                            <label>Cell_phone</label>
                            <input type="number" name="cell_phone" class="form-control" id="inputCity" value="<?php echo $customerData['cell_phone']; ?>">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="Date">Date_of_birth</label>
                            <input type="date" name="date_of_birth" class="form-control" id="Date" value="<?php echo $customerData['date_of_birth']; ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" id="inputCity" value="<?php echo $customerData['password']; ?>">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" id="inputCity" value="<?php echo $customerData['password']; ?>">
                        </div>
                    </div>

                    <button name="upd_prof" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
