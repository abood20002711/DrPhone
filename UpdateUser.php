<?php
// Start the session
session_start();

// Check if the 'dashbord' session variable is set
if (isset($_SESSION['dashbord'])) {

    // Set the page title as 'Add User'
    $PageTilte = "Update User";

    // Include necessary file(s)
    include "init.php";

    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $User_ID    = $_POST['User_ID'];
        $firstname  = $_POST['firstname'];
        $lastname   = $_POST['lastname'];
        $GroupID    = $_POST['GroupID'];
        $password   = $_POST['password'];
        $hasherPass = sha1($password);
        $country    = $_POST['country'];
        $state      = $_POST['state'];
        $phone      = $_POST['phone'];
        $image      = $_POST['image'];
        $fullname   = $firstname . " " . $lastname;

        // update  user data into the 'myshop.supplier' table
        $usre_update = $con->prepare("UPDATE myshop.users set fname = ?, lname = ?, Password = ? , phone = ?, Country = ? ,  State=? , Fullname = ?, GroupID = ?, Avater = ? where UserID = ?");
        $usre_update->execute([$firstname, $lastname, $hasherPass, $phone, $country, $state, $fullname, $GroupID, $image, $User_ID]);


        // Display success message using Swal library (assumed to be included in 'init.php')
        echo "<script>
        Swal.fire(
        'Good job!',
        'Update User completed successfully',
        'success'
        )
    </script>";
        echo '<script>setTimeout(function() { window.location.href = "UserList.php"; }, 1000);</script>';

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
        <!-- ============================ Start User Adding  ====================================== -->
        <div class="form-add new-users">
            <div class="sec-title">
                <h2 class="main-title">User Management</h2>
                <p class="desc-title">Add/Update User</p>
            </div>
            <!-- End User Adding header -->
            <!-- Start Usre Adding Body -->
            <?php
            if (isset($_GET['id'])) {
                $User_ID  = $_GET['id'];
                $get_user = $con->prepare("select * from myshop.users where UserID = ?");
                $get_user->execute([$User_ID]);
                $count = $get_user->rowCount();
                if ($count > 0) {
                    $User_row = $get_user->fetchAll();
                    foreach ($User_row as $user) {
                        ?>
                        <div class="card">
                            <div class="card-body">
                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                    <input type="hidden" name="User_ID" value="<?= $usre["UserID"] ?>">

                                    <div class="row">
                                        <div class="col-lg-3 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="">Frist Name *</label>
                                                <input type="text" name="firstname" id="" class="form-control required"
                                                    value="<?= $user["fname"] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="">Last Name *</label>
                                                <input type="text" name="lastname" id="" class="form-control required"
                                                    value="<?= $user["lname"] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="">Email *</label>
                                                <input type="email" name="email" id="" readonly class="form-control " required
                                                    value="<?= $user["Email"] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="">Role</label>
                                                <select name="GroupID" id="" class="form-control">
                                                    <option value="0" <?= $user["GroupID"] == 0 ? "selected" : "" ?>>User</option>
                                                    <option value="1" <?= $user["GroupID"] == 1 ? "selected" : "" ?>>Admin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="">Password *</label>
                                                <input type="password" name="password" id="" class="form-control " required>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="">Confirm Password *</label>
                                                <input type="password" name="" id="" class="form-control " required>
                                            </div>
                                        </div>


                                        <div class="col-lg-3 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="">Country *</label>
                                                <select id="country" required name="country" class="form-control" required>
                                                    <option value="">
                                                        <?= $user["Country"] ?>
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="">State *</label>
                                                <select name="state" required id="state" class="form-control" required>
                                                    <option value="">
                                                        <?= $user["State"] ?>
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-12">
                                            <div class="form-group" style="display: flex;flex-direction: column;">
                                                <label for="">Phone Number *</label>
                                                <input type="tel" pattern="[0-9-()-+ ]*" id="phone" name="phone"
                                                    class="phone form-control" required style="flex: 1;"
                                                    value="<?= $user["phone"] ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="">Avater *</label>
                                                <div class="image-upload">
                                                    <input type="file" name="image" id="uplodeimg" class="form-control" required
                                                        value="<?= $user["Avater"] ?>">
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
                        <?php }
                }
            } ?>
            </div>
        </div>
        <!-- End  User Adding Body -->
    </div>
</div>
<!-- ============================ End  User Adding  ====================================== -->
<script src="<?php echo $js; ?>dashbord.js"></script>
<?php include $tpl . "footer.php"; ?>