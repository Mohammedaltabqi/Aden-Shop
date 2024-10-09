<?php
include('header.php');


if (isset($_POST['submit_order'])) {
  // Extracting user information from the session
  $customer_id = $_SESSION['cusid'];



  // Looping through the cart items and insert them into the database
  if (isset($_SESSION['cart'])) {
      
    // Inserting Orders details query 
      $Orderinsertquery = "INSERT INTO orders (customer_id, product_name, product_price, product_image, quantity, order_date)
          VALUES (:customer_id, :product_name, :product_price, :product_image, :quantity, NOW())";

      $orderquery = $pdo->prepare($Orderinsertquery);

    foreach ($_SESSION['cart'] as $item) {
      $product_name = $item['p_name'];
      $product_price = $item['p_price'];
      $product_image = $item['p_image']; // Include the product image
      $quantity = $item['p_qty'];

      $orderquery->bindParam(':customer_id', $customer_id);
      $orderquery->bindParam(':product_name', $product_name);
      $orderquery->bindParam(':product_price', $product_price);
      $orderquery->bindParam(':product_image', $product_image); // Bind the product image
      $orderquery->bindParam(':quantity', $quantity);

      $orderquery->execute();
    }

      // Clear the cart after successful order submission
      unset($_SESSION['cart']);

      // Optionally, you can redirect the user to a thank you page
      ?>
      <script>
        alert('order placed successfully');
        location.assign('shoping-cart.php');
      </script>
      <?php
      exit();
  }
}

// Your existing HTML form for displaying user information
?>

<div class="container">
    <div class="row">
        <div class="col-md-12 p-5 mt-5">
            <form method="post" action="checkout.php">
            <input type="hidden" value="<?php echo $_SESSION['cusid']?>">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Name</label>
      <input type="name" class="form-control" id="inputEmail4" value="<?php echo $_SESSION['username']?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Email</label>
      <input type="email" class="form-control" id="inputPassword4" value="<?php echo $_SESSION['useremail']?>">
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" class="form-control" id="inputAddress" value="<?php echo $_SESSION['address']?>">
  </div>

  <div class="form-row">
    <div class="form-group col-md-5">
      <label>Work_phone</label>
      <input type="text" class="form-control" id="inputCity" value="<?php echo $_SESSION['work_phone']?>">
    </div>
    <div class="form-group col-md-5">
    <label>Cell_phone</label>
      <input type="text" class="form-control" id="inputCity" value="<?php echo $_SESSION['cell_phone']?>">
    </div>
    <div class="form-group col-md-2">
    <label for="Date">Date_of_birth</label>
      <input type="date" class="form-control" id="Date" value="<?php echo $_SESSION['date_of_birth']?>">
    </div>
  </div>
                <!-- Add the form fields for order summary and additional information here -->
                <button type="submit" name="submit_order" class="btn btn-primary">Place Order</button>
            </form>
        </div>
    </div>
</div>



<?php
include('footer.php');
?>
