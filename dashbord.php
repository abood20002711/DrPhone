<?php
// Start the session
session_start();

// Check if the 'dashbord' session variable is set
if (isset($_SESSION['dashbord'])) {
    // Set the page title as 'Dashbord'
    $PageTilte = "Dashbord";

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
                    <a href="dashbord.php" class="active">
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
                    <a href="#" class="">
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
        <!-- ============================ Start Dashboard Body  ==================================== -->
        <!-- ============ Start counters  ========================= -->
        <h2 class="main-title">Dashborad</h2>
        <div class="dash-count">
            <div class="row-das">
                <div class="col-das "  style="background: #00cfe8;">
                    <div class="content">
                        <span>
                            <?php
                            // Retrieve Number of users without admin  
                            $sql  = "SELECT * FROM myshop.users where GroupID = 0";
                            $stmt = $con->prepare($sql);
                            $stmt->execute();
                            echo $stmt->rowCount();
                            ?>
                        </span>
                        <p>Users</p>
                    </div>
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="col-das" style="background: #ff9f43;">
                    <div class="content">
                        <span>$ 
                         <?php
                            //  
                            $sql  = "SELECT  SUM(Total) as total FROM myshop.orderdetalis where Status = 0 or Status = 1";
                            $stmt = $con->prepare($sql);
                            $stmt->execute();
                            $Total = $stmt->fetch();
                            echo $Total['total'];
                            ?>
                        </span>
                        <p>Account balance</p>
                    </div>
                    <i class="fa-solid fa-money-bill"></i>
                </div>
                <div class="col-das" style="background: #1b2850;">
                    <div class="content">
                        <span>
                            <?php
                            // Retrieve Number of Order 
                            $sql  = "SELECT * FROM myshop.orderdetalis ";
                            $stmt = $con->prepare($sql);
                            $stmt->execute();
                            echo $stmt->rowCount();
                            ?>
                        </span>
                        <p>Orders</p>
                    </div>
                    <i class="fa-solid fa-truck"></i>
                </div>
                <div class="col-das" style="background: #28c76f;">
                    <div class="content">
                        <span>
                            <?php
                            // Retrieve Number of Admin  
                            $sql  = "SELECT * FROM myshop.users where GroupID = 1";
                            $stmt = $con->prepare($sql);
                            $stmt->execute();
                            echo $stmt->rowCount();
                            ?>
                        </span>
                        <p>Admin</p>
                    </div>
                    <i class="fa-regular fa-user"></i>
                </div>
            </div>
        </div>
        <!-- ============ End counters  ========================= -->
        <!-- ============ Start Order table  ==================== -->
        <div class="col-12 table-status">
            <div class="card">
                <div class="card-body">
                    <div class="head">
                        <h4 class="card-title">Order Status</h4>
                        <a class="to-order" href="orderlist.php" style="font-size: 14px; font-weight: 500;">See more <i
                                class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Client Name</th>
                                    <th>Order No</th>
                                    <th>Number of item</th>
                                    <th>Product Costs</th>
                                    <th>Date Start</th>
                                    <th>Payment Mode</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Retrieve last of 5 Order details 
                                $sql  = "SELECT * FROM myshop.orderdetalis limit 5";
                                $stmt = $con->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->fetchAll();
                                foreach ($result as $order) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $order['CustomerName'] ?>
                                        </td>
                                        <td>
                                            <?php echo $order['OrderID'] ?>
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
                                        <td>
                                            <?php echo $order['PaymentMethod'] ?>
                                        </td>
                                        <td>
                                            <?php echo $order['Country'] ?>
                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============ Start Order table  ==================== -->
        <!-- ============ Start Out Of Stock table  ============= -->
        <div class="charts">
            <div class="OutofStock prodactList">
                <div class="card" style="border-radius: 10px; margin:0">
                    <div class="card-body">
                        <h4 class="card-title"> Out Of Stock</h4>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Item ID</th>
                                        <th>Item Name</th>
                                        <th>Price</th>
                                        <th>Sale Price</th>>
                                        <th>Category</th>
                                        <th>Sub Category </th>
                                        <th>Add Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Retrieve the item out of Stouk 
                                    $sql  = "SELECT * FROM myshop.items where Quantity = 0";
                                    $stmt = $con->prepare($sql);
                                    $stmt->execute();
                                    $result = $stmt->fetchAll();
                                    foreach ($result as $item) {
                                        $CategorieID    = $item['Category'];
                                        $SubCategorieID = $item['sCategory']
                                            ?>
                                        <tr>
                                            <td>
                                                <?php echo $item['ID'] ?>
                                            </td>
                                            <td>
                                                <?php echo $item['ItemName'] ?>
                                            </td>
                                            <td>
                                                <?php echo $item['Price'] ?>
                                            </td>
                                            <td>
                                                <?php echo $item['SalePrice'] ?>
                                            </td>
                                            <!-- Get Category Name using Category_ID -->
                                            <td>
                                                <?php GetCategorieName() ?>
                                            </td>
                                            <!-- Get Sub Category Name using Category_ID -->
                                            <td>
                                                <?php GetSubCategorieName() ?>
                                            </td>
                                            <td>
                                                <?php echo $item['AddDate'] ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============ Start Out Of Stock table  ============= -->
    </div>
</div>
<!-- ============================ End Dashboard Body  ==================================== -->


<script src="<?php echo $js; ?>dashbord.js"></script>
<?php include $tpl . "footer.php"; ?>