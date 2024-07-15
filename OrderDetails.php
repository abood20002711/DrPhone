<?php
// Start the session
session_start();

// Check if the 'dashbord' session variable is set
if (isset($_SESSION['dashbord'])) {
    // Set the page title as 'Order List'
    $PageTilte = "Order List";

    // Include necessary file(s)
    include "init.php";
    if (isset($_GET['orderID'])){
    $order_id = $_GET['orderID'];
    }
    // Update the order Status 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $order_id = $_POST['order_ID'];
        $order_Status = $_POST['order_Status'];
        $Update_Order_Status = $con -> prepare("Update myshop.orderdetalis set Status = ? where OrderID = ?");
        $Update_Order_Status -> execute([$order_Status,$order_id]);
        // Display success message using Swal library (assumed to be included in 'init.php')
        echo "<script>
        Swal.fire(
        'Good job!',
        'Update Status successfully',
        'success'
        )
        </script>";
    }
} else {
    // Redirect to indexs.php if the 'dashbord' session variable is not set
    header('location:index.php');
}

?>
<div class="dashboard">
    <!-- ============================ Start slidbar ================================================ -->
    <div class="slidbar">
        <div class="slidbar-content">
            <a href="dashbord.php" class="logo">DrPhone</a>
            <ul class="menu-main">
                <li class="sub-menus">
                    <a href="dashbord.php" class="">
                        <i class="fa-solid fa-house fa-fw"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sub-menus has-children">
                    <a href="#" class="">
                        <i class="fa-solid fa-cart-flatbed fa-fw"></i>
                        <span>products</span>
                        <i class="fa fa-sort-down"></i>
                    </a>
                    <ul class="drop-menu ">
                        <li><a href="ProductsList.php">Product List</a></li>
                        <li><a href="AddProduct.php">Add Product</a></li>
                        <li><a href="CategoryList.php">Category List</a></li>
                        <li><a href="AddCategory.php">Add Category</a></li>
                        <li><a href="SubCatList.php">Sub Category List</a></li>
                        <li><a href="AddSubCate.php">Add Sub Category</a></li>
                    </ul>
                </li>
                <li class="sub-menus has-children">
                    <a href="#" class="active">
                        <i class="fa-solid fa-truck-arrow-right fa-fw"></i>
                        <span>Orders</span>
                        <i class="fa fa-sort-down"></i>
                    </a>
                    <ul class="drop-menu ">

                        <li><a href="OrdersList.php">Orders List</a></li>

                    </ul>
                </li>
                <li class="sub-menus has-children">
                    <a href="#" class="">
                        <i class="fa-solid fa-users fa-fw"></i>
                        <span>customers</span>
                        <i class="fa fa-sort-down"></i>
                    </a>
                    <ul class="drop-menu ">
 
                        <li><a href="UserList.php">User List</a></li>
                        <li><a href="AddNewUser.php">Add User</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
    <!-- ============================ End slidbar ================================================ -->
    <!-- ============================ Start Dashboard Header  ==================================== -->
    <div class="content">
        <div class="head">
            <div class="container">
                <a href="#" class="navicon" onclick="showslidbar()"><i class="fa-solid fa-bars"></i></a>
                <div class="search-box">
                    <div class="search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="search" placeholder="Search products" class="form-control" />
                    </div>
                </div>
                <div class="icons">
                    <ul>
                        <li><a href="#"><i class="fa-solid fa-moon"></i></a></li>
                        <li class="Notifications"><a href="#"><i class="fa-solid fa-bell"></i></i></a></li>
                        <li>
                            <a href="#" class="profile">
                                <img width="40" height="40" src="layout/imges/user/<?php echo $user['Avater'] ?>" alt=""
                                    onclick="showProfileMenu()">
                            </a>
                        </li>
                    </ul>
                    <div class="profile-menu ">
                        <div class="profile-name">
                            <img src="layout/imges/avatar.png" alt="">
                            <span>
                                <?php echo $user['Fullname']; ?>
                            </span>
                        </div>
                        <hr>
                        <?php
                        echo "
                                <a href='UpdateUser.php?id=" . $user['UserID'] . "' >
                                    <i class='fa-regular fa-user'></i>
                                    <span>My profile</span>
                                </a>
                            ";
                        ?>
                        <a href="Logout.php">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================ End Dashboard Header  ==================================== -->
        <!-- ============================ Start User  List  ====================================== -->
        <!-- Start User List Body -->
           <div class="cartShoping">
                <div class="row">
                    <div class="col-lg-6">
                        <h4>Order Details</h4>
                        <div class="card">
                            <div class="card-body">
                                <div class="row orderSummary">
                                    <div class="col-lg-12 itemCol">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Itam Name</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $order_items = $con->prepare("select * from myshop.order_items where order_ID = ? ");
                                                $order_items->execute([$order_id]);
                                                $order_items_result = $order_items->fetchAll();
                                                    foreach ($order_items_result as $order) {
                                                        $prod_name = $con->prepare("select * from myshop.items where ID = ? ");
                                                        $prod_ID   = $order['item_ID'];
                                                        $prod_name->execute([$prod_ID]);
                                                        $prod_ID_row = $prod_name->fetch();
                                            ?>
                                                <tr>
                                                    <td>
                                                        <div class="itemInfo">
                                                            <div class="context">
                                                                <h5 class="itemName"><?= $prod_ID_row['ItemName'] ?></h5>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><?= $order['qty'] ?></td>
                                                    <td>
                                                        <div class="price">
                                                            <p class="priceitems"><?= $order['price'] ?>$</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                                <div class="row confirmOrder">
                                    <div class="col-lg-12" >
                                        <div class="totol">
                                                <span>Totol (USD)</span>
                                                <h6>
                                                        <?php
                                                        $order_total = $con->prepare("select Total as total from myshop.orderdetalis where OrderID = ? ");
                                                        $order_total->execute([$order_id]);
                                                        $order_total_res = $order_total->fetch();
                                                        echo $order_total_res['total'];
                                                        ?>
                                                </h6>
                                        </div>         
                                    </div>
                                </div>
                                <!--  -->
                                <?php
                                    $order_Info = $con->prepare("select * from myshop.orderdetalis where OrderID = ? ");
                                    $order_Info->execute([$order_id]);
                                    $order_Info_rows = $order_Info->fetchAll();
                                     foreach ($order_Info_rows as $order) {
                                ?>
                                        <div class="col-lg-12 p-0 mt-3">
                                            <label for="">Payment Method</label>
                                            <input type="text" name="name" value="<?= $order['PaymentMethod'] ?>" id="" class="form-control" required readonly>
                                        </div>
                                        <div class="col-lg-12 mt-2 p-0">
                                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                                    <input type="hidden" name="order_ID" value="<?= $order['OrderID']?>">
                                                    <label for="">Status</label>
                                                    <select name="order_Status"  id="" class="form-control">
                                                            <option value="0" <?= $order['Status'] == 0 ? "selected" : "" ?>>Under Process</option>
                                                            <option value="1" <?= $order['Status'] == 1 ? "selected" : "" ?>>Completed</option>
                                                            <option value="2" <?= $order['Status'] == 2 ? "selected" : "" ?>>Cancelled</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-primary mt-4">Update Status</button>
                                                </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-12 DeliveryInfo">
                                        <h4>Delivery Information</h4>
                                        <div class="card">
                                            <div class="card-body">
                                                <form action="" id="my-form">
                                                    <div class="row">
                                                        <div class="col col-lg-4">
                                                            <label for="">Name</label>
                                                            <input type="text" name="name" value="<?= $order['CustomerName'] ?>" id="" class="form-control" required readonly>
                                                    </div>
                                                    <div class="col col-lg-4">
                                                        <label for="">Phone</label>
                                                        <input type="tel" pattern="[0-9-()-+ ]*" id="phone" name="phone" value="<?= $order['Phone'] ?>"
                                                            class="form-control" required readonly>
                                                    </div>
                                                    <div class="col col-lg-4">
                                                        <label for="">Email</label>
                                                        <input type="email" name="name" id="" class="form-control" required readonly value="<?= $order['Email'] ?>">
                                                    </div>
                                                    <div class="col col-lg-4">
                                                        <label for="">Country</label>
                                                        <select  required name="country" class="form-control" readonly>
                                                            <option><?= $order['Country'] ?></option>
                                                        </select>
                                                    </div>
                                                    <div class="col col-lg-4">
                                                        <label for="">State</label>
                                                        <select name="state" required  class="form-control" readonly>
                                                            <option><?= $order['State'] ?></option>
                                                        </select>
                                                    </div>
                                                    <div class="col col-lg-4">
                                                        <label for="">Zip Code</label>
                                                        <input type="text" name="name" id="" class="form-control" required
                                                             readonly value="<?= $order['ZipCode'] ?>">
                                                    </div>
                                                    <div class="col col-lg-12">
                                                        <label for="">Address</label>
                                                        <input type="text" name="name" id="" class="form-control" required readonly value="<?= $order['Address'] ?>">
                                                    </div>
                                                </div>
                                            </form>
                                            <?php } ?>
                                    </div>
                                </div>

                            </div>
                            
                        </div>
                    </div>
                </div>

            </div>
        <!-- End  User List Body -->
    </div>
</div>
<!-- ============================ End  User List ====================================== -->
<script src="<?php echo $js; ?>dashbord.js"></script>
<?php include $tpl . "footer.php"; ?>