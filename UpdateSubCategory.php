<?php
// Start the session
session_start();

// Check if the 'dashbord' session variable is set
if (isset($_SESSION['dashbord'])) {

    // Set the page title as 'Update Sub Category'
    $PageTilte = "Update Sub Category";

    // Include necessary file(s)
    include "init.php";

    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Retrieve data from the POST request
        $SubCat_id   = $_POST['SubCat_id'];
        $SubCatName  = $_POST['SubCatName'];
        $Description = $_POST['Description'];
        $parentID    = $_POST['parentID'];

        // Prepare and execute the SQL statement to insert Update into the database
        $update_subCat = $con->prepare("UPDATE myshop.subcategory SET  SubCatName = ?, Description = ? , parentID = ? where SubCateID = ?");
        $update_subCat->execute([$SubCatName, $Description, $parentID, $SubCat_id]);

        // Display success message using Swal library (assumed to be included in 'init.php')
        echo "<script>
        Swal.fire(
        'Good job!',
        'Update Sub Category completed successfully',
        'success'
        )
        </script>";
        echo '<script>setTimeout(function() { window.location.href = "SubCatList.php"; }, 1000);</script>';

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
        <!-- ============================ Start Sub Category Adding  ====================================== -->
        <!-- Start Sub Category Adding header -->
        <div class="form-add new-SubCategory">
            <div class="sec-title">
                <h2 class="main-title">Update Sub Category</h2>
            </div>
            <!-- End Sub Category Adding header -->
            <!-- Start prodact Adding Body -->
            <?php
            // Get Category selected from the database
            if (isset($_GET['id'])) {
                $SubCat_ID  = $_GET['id'];
                $get_SubCat = $con->prepare("select * from myshop.subcategory where SubCateID = ?");
                $get_SubCat->execute([$SubCat_ID]);
                $count = $get_SubCat->rowCount();
                if ($count > 0) {
                    $cat_row = $get_SubCat->fetchAll();
                    foreach ($cat_row as $cat) {
                        $CategorieID = $cat['parentID'];
                        ?>
                        <div class="card">
                            <div class="card-body">
                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                    <input type="hidden" name="SubCat_id" value="<?= $cat['SubCateID'] ?>">
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="">Main Category *</label>
                                                <select name="maincategort" id="MainCat" class="form-control" required>
                                                    <option value="">Select Main Category</option>
                                                    <?php
                                                    $stmt = $con->prepare('SELECT * FROM myshop.maincategort');
                                                    $stmt->execute();
                                                    $maincategort = $stmt->fetchAll();
                                                    //loop through the maincategort and add them as options in the select dropdown
                                                    foreach ($maincategort as $category) {
                                                        echo '<option value="' . $category['MainCatID'] . '">' . $category['NameMainCat'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="">Parent Category *</label>
                                                <select name="parentID" id="Category" class="form-control" required>
                                                    <option value="">
                                                        <?php GetCategorieName() ?>
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="">Category Name *</label>
                                                <input type="text" name="SubCatName" id="" class="form-control "
                                                    value="<?= $cat['SubCatName'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="">Description</label>
                                                <textarea name="Description" id=""
                                                    class="form-control"><?= $cat['Description'] ?></textarea>
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
        <!-- End Sub Category Adding Body -->
    </div>
</div>
<!-- ============================ End Sub Category Adding  ====================================== -->
<script>
    $(document).ready(function () {
        //when a category is selected, update the subcategory dropdown
        $('#MainCat').change(function () {
            var MainCatID = $(this).val();
            $.ajax({
                type: 'POST',
                url: 'getCat.php',
                data: {
                    MainCatID: MainCatID
                },
                dataType: 'json',
                success: function (data) {
                    $('#Category').empty();
                    $.each(data, function (index, Category) {
                        $('#Category').append('<option value="' + Category.CategoryID + '">' + Category.CategoryName + '</option>');
                    });
                },
                error: function () {
                    alert('Error: Could not retrieve subcategories.');
                }
            });
        });
    });
</script>
<script src="<?php echo $js; ?>dashbord.js"></script>
<?php include $tpl . "footer.php"; ?>