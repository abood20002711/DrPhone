<?php
// Start the session
session_start();

// Check if the 'dashbord' session variable is set
if (isset($_SESSION['dashbord'])) {

    // Set the page title as 'Update Product'
    $PageTilte = "Update Product";

    // Include necessary file(s)
    include "init.php";


    // Udpate the product
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Retrieve data from the POST request
        $pro_ID      = $_POST['pro_id'];
        $ItemName    = $_POST['ItemName'];
        $Category    = $_POST['Category'];
        $sCategory   = $_POST['sCategory'];
        $Description = $_POST['Description'];
        $Quantity    = $_POST['Quantity'];
        $SalePrice   = $_POST['SalePrice'];
        $Price       = $_POST['Price'];
        $image       = $_POST['image'];
        $pro_update  = $con->prepare("UPDATE myshop.items SET ItemName = ? , Category =? , sCategory = ? , Description =? ,Quantity =? ,SalePrice=?,Price=?,image=? where ID=?");
        $pro_update->execute([$ItemName, $Category, $sCategory, $Description, $Quantity, $SalePrice, $Price, $image, $pro_ID]);

        // Display a success message after Update the product
        echo "<script>
            Swal.fire(
            'Good job!',
            'update  Product completed successfully',
            'success'
                        )
            // Redirect the user to the login page after a delay of 2 seconds
            </script>";
        echo '<script>setTimeout(function() { window.location.href = "ProductsList.php"; }, 1000);</script>';
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
        <!-- ============================ Start prodact Adding  ====================================== -->
        <!-- Start prodact Adding header -->
        <div class="form-add new-product">
            <div class="sec-title">
                <h2 class="main-title">Update Products</h2>
            </div>
            <!-- End prodact Adding header -->
            <!-- Start prodact Adding Body -->
            <?php
            if (isset($_GET['id'])) {
                $pro_ID  = $_GET['id'];
                $get_pro = $con->prepare("select * from myshop.items where ID = ?");
                $get_pro->execute([$pro_ID]);
                $count = $get_pro->rowCount();
                if ($count > 0) {
                    $pro_row = $get_pro->fetchAll();
                    foreach ($pro_row as $item) {


                        $CategorieID    = $item['Category'];
                        $SubCategorieID = $item['sCategory'];
                        ?>
                        <div class="card">
                            <div class="card-body">

                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                    <input type="hidden" name="pro_id" value="<?= $item['ID'] ?>">
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="">Product Name *</label>
                                                <input type="text" name="ItemName" id="" class="form-control " required
                                                    placeholder="Product Name" value="<?= $item['ItemName'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="">Category *</label>
                                                <select name="Category" id="category" class="form-control" required>
                                                    <option value="">
                                                        <?php GetCategorieName() ?>
                                                    </option>
                                                    <?php
                                                    $stmt = $con->prepare('SELECT * FROM myshop.category');
                                                    $stmt->execute();
                                                    $categories = $stmt->fetchAll();
                                                    //loop through the categories and add them as options in the select dropdown
                                                    foreach ($categories as $category) {
                                                        echo '<option value="' . $category['CategoryID'] . '">' . $category['CategoryName'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="">Sub Category *</label>
                                                <select name="sCategory" id="subcategory" class="form-control" required>
                                                    <option value="">
                                                        <?php GetSubCategorieName() ?>
                                                    </option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="">Description</label>
                                                <textarea name="Description" id="" class="form-control"
                                                    placeholder="Describe the product"><?= $item['Description'] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="">Quantity *</label>
                                                <input type="text" name="Quantity" id="" class="form-control" required
                                                    placeholder="Number of the item in stock" value="<?= $item['Quantity'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="">Sale Price</label>
                                                <input type="text" name="SalePrice" id="" class="form-control"
                                                    value="<?= $item['SalePrice'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="">Price *</label>
                                                <input type="text" name="Price" id="" class="form-control" required
                                                    value="<?= $item['Price'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="">Product Image *</label>
                                                <div class="image-upload">
                                                    <input type="file" name="image" id="uplodeimg" class="form-control" required
                                                        value="<?= $item['image'] ?> ">
                                                    <div class="image-uploads">
                                                        <img src="layout/imges/icons/upload.svg" alt="">
                                                        <h4>Drag and drop a file to upload</h4>
                                                        <span id="imageName" class="imageName"></span>
                                                    </div>
                                                </div>
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
                        </div>
                    <?php }
                }
            } ?>
        </div>
        <!-- End prodact Adding Body -->
    </div>
</div>
<!-- ============================ End prodact Adding  ====================================== -->

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="<?php echo $js; ?>dashbord.js"></script>
<?php include $tpl . "footer.php"; ?>