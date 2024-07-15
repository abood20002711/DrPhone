<?php
// Start the session
session_start();

// Check if the 'dashbord' session variable is set
if (isset($_SESSION['dashbord'])) {

    // Set the page title as 'Update Category'
    $PageTilte = "Update Category";

    // Include necessary file(s)
    include "init.php";

    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Retrieve data from the POST request
        $cat_ID       = $_POST['cat_id'];
        $CategoryName = $_POST['CategoryName'];
        $Description  = $_POST['Description'];
        $parentID     = $_POST['parentID'];

        // Prepare and execute the SQL statement to insert data into the database
        $cat_update = $con->prepare("UPDATE myshop.Category SET  CategoryName = ?, Description = ? , parentID = ? where CategoryID = ?");
        $cat_update->execute([$CategoryName, $Description, $parentID, $cat_ID]);

        // Display success message using Swal library (assumed to be included in 'init.php')
        echo "<script>
        Swal.fire(
        'Good job!',
        'Update Category completed successfully',
        'success'
        )
        </script>";
        echo '<script>setTimeout(function() { window.location.href = "CategoryList.php"; }, 1000);</script>';

    }
} else {
    // Redirect to index.php if the 'dashbord' session variable is not set
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
                    <a href="#" class="active">
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
        <!-- ============================ Start Category Adding  ====================================== -->
        <!-- Start Category Adding header -->
        <div class="form-add new-Category">
            <div class="sec-title">
                <h2 class="main-title">Update Category</h2>
            </div>
            <!-- Start Category Adding header -->
            <!-- Start prodact Adding Body -->
            <?php
            // Get Category selected from the database
            if (isset($_GET['id'])) {
                $cat_ID  = $_GET['id'];
                $get_cat = $con->prepare("select * from myshop.category where CategoryID = ?");
                $get_cat->execute([$cat_ID]);
                $count = $get_cat->rowCount();
                if ($count > 0) {
                    $cat_row = $get_cat->fetchAll();
                    foreach ($cat_row as $cat) {
                        $MainCatID = $cat['parentID'];
                        ?>
                        <div class="card">
                            <div class="card-body">
                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                    <input type="hidden" name="cat_id" value="<?= $cat['CategoryID'] ?>">
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="">Category Name *</label>
                                                <input type="text" name="CategoryName" id="" class="form-control " required
                                                    placeholder="Category Name" value="<?= $cat['CategoryName'] ?> ">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="">Parent Category *</label>
                                                <select name="parentID" id="" class="form-control" required>
                                                    <option value="">
                                                        <?php GetMainCategorieName() ?>
                                                    </option>
                                                    <?php
                                                    $sql  = "select * from myshop.maincategort";
                                                    $stmt = $con->prepare($sql);
                                                    $stmt->execute();
                                                    $result = $stmt->fetchAll();
                                                    foreach ($result as $catmain) {
                                                        echo "<option value='" . $catmain['MainCatID'] . "' >" . $catmain['NameMainCat'] . "</option>";

                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="">Description</label>
                                                <textarea name="Description" id="" class="form-control"
                                                    placeholder="Describe the product"><?= $cat['Description'] ?>
                                                            </textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <input type="submit" class="btn btn-primary" style="width: 100px !important;  "
                                                value="Submit">
                                            <input type="reset" class="btn btn-secondary" style="width: 100px !important;"
                                                value="Cancel">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php }
                }
            } ?>
            </div>
        </div>
        <!-- End Category Adding Body -->
    </div>
</div>
<!-- ============================ End Category Adding  ====================================== -->
<script src="<?php echo $js; ?>dashbord.js"></script>
<?php include $tpl . "footer.php"; ?>