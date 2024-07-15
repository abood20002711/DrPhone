<?php
session_start();

// Check if the 'dashboard' session variable is set
if (isset($_SESSION['dashbord'])) {
    // If the user is already logged in, redirect to the dashboard page
    header("Location:dashbord.php");
}

// Check if the 'Homepage' session variable is set
if (isset($_SESSION['Homepage'])) {
    // If the user is already logged in, redirect to the homepage
    header("Location:HomePage.php");
}

$PageTilte = "Log in";
include "init.php";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $hashedPass = sha1($password); // Hash the password for comparison

    // Check if the user is an admin by searching in the database
    $stmt = $con->prepare("SELECT UserID, Email, Password FROM myshop.users WHERE Email = ? AND Password = ? AND GroupID = 1 LIMIT 1");
    $stmt->execute(array($username, $hashedPass));
    $result = $stmt->fetch();
    $count  = $stmt->rowCount();

    // Check if the user is a regular user by searching in the database
    $stmt2 = $con->prepare("SELECT UserID, Email, Password FROM myshop.users WHERE Email = ? AND Password = ? AND GroupID = 0 LIMIT 1");
    $stmt2->execute(array($username, $hashedPass));
    $result2 = $stmt2->fetch();
    $count2  = $stmt2->rowCount();

    // If the admin user exists in the database
    if ($count > 0) {
        $_SESSION['dashbord'] = $username; // Register session name for dashboard
        $_SESSION['UserId']    = $result['UserID'];
        header("Location:dashbord.php");
        exit();
    }
    // If the regular user exists in the database
    elseif ($count2 > 0) {
        $_SESSION['Homepage'] = $username; // Register session name for homepage
        $_SESSION['UserId']   = $result2['UserID'];
        header("Location: HomePage.php");
        exit();
    }
    // If the username or password is incorrect
    else {
        echo "<script>     
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'The username or password is incorrect',
      })
    </script>";
    }
}
?>
  <!-- Start Login page -->
  <div class="page-login ">
        <div class="content">
            <div class="formbx">
                <h2>Welcom back</h2>
                <p class="c-8">Welcom back! Pleas enter your details</p>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="inputbx form-outline ">
                        <span class="form-label">Username</span>
                        <input type="text" name="username" placeholder="Enter your usernane"  class="form-control ">
                        <a href="#"><i class="fa fa-user "></i></a>
                    </div>
                    <div class="inputbx ">
                        <span>Password</span>
                        <input type="password" name="password" placeholder="Enter your password" id="password" class="pass form-control">
                        <i class="fa-solid fa-key"></i>
                        <i onclick="visibili()" class="fa-regular fa-eye hide" id="hide"></i>
                    </div>
                    <div class="remember ">
                        <label for="remember"><input type="checkbox" class="form-check-inpu" id="remember"> Remember me</label>
                        <a href="#">Forgot password</a>
                    </div>
                    <div class="inputbx">
                        <input type="submit" value="Login" name="submit" class="btn btn-primary">
                    </div>
                </form>
                <div class="or">or</div>
                <div class="log-with">
                    <a href="#" class="face"><i class="fa-brands fa-facebook-f fa-lg"></i></i></a>
                    <a href="#" class="twi"><i class="fa-brands fa-twitter fa-lg"></i></a>
                    <a href="#" class="goo"><i class="fa-brands fa-google-plus-g fa-lg"></i></a>
                </div>
                <div class="reg">
                   <?php echo "<p>Don't have an account? <a href='signup.php'>Sign up here</a></p>"; ?>
                </div>
            </div>
        </div>
        <div class="img">
            <img src="layout/imges/pexels-bogdan-glisik-1661471.png" alt="">
        </div>
    </div>
    <!-- End login page -->


<?php include $tpl . "footer.php"; ?>
