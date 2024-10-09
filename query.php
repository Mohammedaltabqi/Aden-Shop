<?php
include("./dashboard/includes/connection.php");?>
<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css"><?php
if(isset($_POST['search'])){
    $search = $_POST['search'];
    $query = $pdo->query("select * from products where pro_name like '%$search%'");
    $query->execute();
    $row = $query->fetchAll(PDO::FETCH_ASSOC);
    if (empty($row)) {
        echo "
        <h3 style='width:100%'>No matching products found.</h3>";
    } else {
        foreach ($row as $proAll) {
            echo "<div class='col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women'>
                <!-- Block2 -->
                <div class='block2'>
                    <div class='block2-pic hov-img0'>
                        <img src='./Dashboard/assets/images/siteimages/productimg/" . $proAll['pro_image'] . "' style='height:250px;' alt='IMG-PRODUCT'>
                    </div>

                    <div class='block2-txt flex-w flex-t p-t-14'>
                        <div class='block2-txt-child1 flex-col-l'>
                            <a href='product-detail.php?pid=" . $proAll['id'] . "' class='stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6'>
                                " . $proAll['pro_name'] . "
                            </a>

                            <span class='stext-105 cl3'>
                                $ '" . $proAll['pro_price'] . "'
                            </span>
                        </div>

                        <div class='block2-txt-child2 flex-r p-t-3'>
                            <a href='#' class='btn-addwish-b2 dis-block pos-relative js-addwish-b2'>
                            </a>
                        </div>
                    </div>
                </div>
            </div>";
        }
    }
}
if(isset($_POST['signup'])){
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $wphone = $_POST['wphone'];
    $cphone = $_POST['cphone'];
    $dob = $_POST['dob'];
    $pass = $_POST['pass'];
    try {
        $query = $pdo->prepare("INSERT INTO customers (name, address, email, work_phone, cell_phone, date_of_birth, password) VALUES (:cname, :cadd, :cemail, :wphone, :cphone, :cdob, :cpass)");
        $query->bindParam(":cname", $name);
        $query->bindParam(":cadd", $address);
        $query->bindParam(":cemail", $email);
        $query->bindParam(":wphone", $wphone);
        $query->bindParam(":cphone", $cphone);
        $query->bindParam(":cdob", $dob);
        $query->bindParam(":cpass", $pass);

        $query->execute();
        echo "<script>alert('Successfully signed up')</script>";
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            echo "<script>alert('Email already exists. Please use a different email.')</script>";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
}








  
?>