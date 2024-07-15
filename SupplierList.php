<?php
// Start the session
session_start();

// Check if the 'dashbord' session variable is set
if (isset($_SESSION['dashbord'])) {
    // Set the page title as 'supplier List'
    $PageTilte = "supplier List";

    // Include necessary file(s)
    include "init.php";


    //  Delete supplier by ID
    if (isset($_GET['id'])) {
        $id     = $_GET['id'];
        $sql2   = "DELETE FROM myshop.supplier WHERE ID=?";
        $delete = $con->prepare($sql2);
        $delete->execute([$id]);
        header("Location:SupplierList.php");
        die();

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
                    <a href="#" class="active">
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
        <!-- ============================ Start Supplier  List  ====================================== -->
        <!-- Start Supplier List header -->
        <div class="form-add Supplier-List">
            <div class="sec-title" style="display: flex;align-items: center;justify-content: space-between;">
                <div class="desc">
                    <h2 class="main-title">Supplier list</h2>
                    <p class="desc-title">Manage your Supplier</p>
                </div>
                <a href="SupplierList.php" class="btn btn-primary" style="width: 200px !important;">Add new Supplier</a>
            </div>
        </div>
        <!-- End Supplier List header -->
        <!-- Start Supplier List Body -->
        <div class="prodactList">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Supplier Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>>
                                    <th>Country</th>
                                    <th>State</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // retrieve supplier information from database
                                $sql  = "select * from myshop.supplier";
                                $stmt = $con->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->fetchAll();
                                foreach ($result as $supplier) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $supplier['SupplierName'] ?>
                                        </td>
                                        <td>
                                            <?php echo $supplier['phone'] ?>
                                        </td>
                                        <td>
                                            <?php echo $supplier['email'] ?>
                                        </td>
                                        <td>
                                            <?php echo $supplier['Country'] ?>
                                        </td>
                                        <td>
                                            <?php echo $supplier['State'] ?>
                                        </td>
                                        <td>
                                            <?php echo $supplier['Description'] ?>
                                        </td>
                                        <td class='actions'>
                                            <a title='Edit Category'
                                                href="UpdateSupplier.php?id=<?php echo $supplier['ID'] ?>" class="action"><i
                                                    class="fa-regular fa-pen-to-square"></i></i></a>
                                            <a title='Remove Category'
                                                href="SupplierList.php?id=<?php echo $supplier['ID'] ?>" class="action"><i
                                                    class="fa-regular fa-trash-can"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End  supplier List Body -->
    </div>
</div>
<!-- ============================ End  supplier List  ====================================== -->
<script src="<?php echo $js; ?>dashbord.js"></script>
<?php include $tpl . "footer.php"; ?>