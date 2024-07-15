<?php
// Start the session
session_start();

// Check if the 'dashbord' session variable is set
if (isset($_SESSION['dashbord'])) {
    // Set the page title as 'Order List'
    $PageTilte = "Order List";

    // Include necessary file(s)
    include "init.php";
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
        <!-- Start Supplier User header -->
        <div class="form-add Proudact-List">
            <div class="sec-title" style="display: flex;align-items: center;justify-content: space-between;">
                <div class="desc">
                    <h2 class="main-title">Order list</h2>
                    <p class="desc-title">Manage Order</p>
                </div>
            </div>
        </div>
        <!-- End User List header -->
        <!-- Start User List Body -->
        <div class="prodactList">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Number Of Item</th>
                                    <th>Total</th>
                                    <th>Order Create</th>
                                    <th>Order Status</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // retrieve user information without admin from database
                                $sql  = "select * from myshop.orderdetalis ";
                                $stmt = $con->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->fetchAll();
                                foreach ($result as $order) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $order['OrderID'] ?>
                                        </td>
                                        <td>
                                            <?php echo $order['CustomerName'] ?>
                                        </td>
                                        <td>
                                            <?php echo $order['Email'] ?>
                                        </td>
                                        <td>
                                            <?php echo $order['Phone'] ?>
                                        </td>
                                        <td>
                                            <?php echo $order['NumOfItem'] ?>
                                        </td>
                                        <td>
                                            <?php echo $order['Total'] ?>
                                        </td>
                                        <td>
                                            <?php echo $order['OrderCreate'] ?>
                                        </td>
                                        <?php
                                        if ($order['Status'] == 0) {
                                            echo "<td> <button type='button' class='btn btn-outline-warning' disabled>Under Process</button></td>";
                                        } elseif ($order['Status'] == 1) {
                                            echo "<td> <button type='button' class='btn btn-outline-success' disabled>Completed</button></td>";
                                        } else {
                                            echo "<td> <button type='button' class='btn btn-outline-danger' disabled>Cancelled</button></td>";
                                        }
                                        ?>
                                        <td><a class="btn btn-primary"
                                                href="OrderDetails.php?orderID=<?= $order['OrderID'] ?>" role="button">View
                                                Detalis</a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
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