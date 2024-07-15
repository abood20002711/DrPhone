<?php
session_start();
$PageTilte = "Sign Up";
include "init.php";
// Check if the 'dashboard' session variable is set
if (isset($_SESSION['dashbord'])) {
    // If the user is already logged in, redirect to the dashbord page
    header("Location:dashbord.php");
}

// Check if the 'Homepage' session variable is set
if (isset($_SESSION['Homepage'])) {
    // If the user is already logged in, redirect to the homepage
    header("Location:HomePage.php");
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname  = $_POST['firstname'];
    $lastname   = $_POST['lastname'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $password   = $_POST['password'];
    $hasherPass = sha1($password);
    $country    = $_POST['country'];
    $state      = $_POST['state'];
    $fullname   = $firstname . " " . $lastname;

    // Check if the email exists in the database
    $sql   = "SELECT * FROM myshop.users WHERE email = :email";
    $stmts = $con->prepare($sql);
    $stmts->bindParam(':email', $email);
    $stmts->execute();

    if ($stmts->rowCount() > 0) {
        // Display an error message if the email already exists
        echo "<script>     Swal.fire({
        title: 'Error!',
        text: 'The email already exists, try another email',
        icon: 'error',
        confirmButtonText: 'OK'
      })</script>";
    } else {
        // Insert the user data into the database
        $stmt = $con->prepare("INSERT INTO myshop.users (fname, lname, Password, Email, phone, Country, State, Fullname) VALUES 
    (:fname, :lname, :Password, :Email, :phone, :Country, :State, :Fullname)");
        $stmt->bindParam(":fname", $firstname);
        $stmt->bindParam(":lname", $lastname);
        $stmt->bindParam(":Password", $hasherPass);
        $stmt->bindParam(":Email", $email);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":Country", $country);
        $stmt->bindParam(":State", $state);
        $stmt->bindParam(":Fullname", $fullname);

        $stmt->execute();

        // Display a success message using Swal library
        echo "<script>
        Swal.fire(
        'Good job!',
        'Registration completed successfully',
        'success'
                    )
    </script>";

        // Redirect the user to the login page after a delay of 2 seconds
        echo '<script>setTimeout(function() { window.location.href = "index.php"; }, 2000);</script>';
    }
}
?>

    <div class="page-sign">
            <div class="img">
                <img src="layout/imges/signup.jpg" alt="">
            </div>
            <div class="contain">
            <div class="formbx">
                <h2>Create your account</h2>
                <form onsubmit ="return validateForm()" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" >
                <div clas></div>
                    <div class="namebx form-outline ">
                        <div class="firstname inputbx">
                            <span class="form-label">First name</span>
                            <input type="text" name="firstname" placeholder="First Name" required class="form-control ">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="lastname inputbx">
                            <span class="form-label">Last name</span>
                            <input type="text" name="lastname" placeholder="Last Name" required class="form-control ">
                            <i class="fa-solid fa-user"></i>
                        </div>
                    </div>
                    <div class="ContactInfobx ">
                        <div class="email inputbx ">
                            <span>Email</span>
                            <input type="email" name="email" placeholder="Enter your Email" id="enail" required class="form-control">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="phonebx inputbx">
                            <span>Phone number</span>
                            <input type="tel" pattern="[0-9-()-+ ]*" id="phone"  name="phone"  class="phone form-control" required >
                        </div>
                    </div>
                    <div class="passwordbx">
                        <div class="inputbx ">
                            <span>Password</span>
                            <input type="password" name="password" placeholder="A23s@#s1d" id="password" required class="pass form-control">
                            <i class="fa-solid fa-key"></i>
                            <i onclick="visibili()" class="fa-regular fa-eye hide" id="hide"></i>
                            <span class="msg1 msg" id=msg1></span>
                        </div>
                        <div class="inputbx ">
                            <span>Confirm</span>
                            <input type="password" name="password" placeholder="Confirm Password" id="Confirm" required class="pass form-control">
                            <i class="fa-solid fa-key"></i>
                            <span class="msg2 msg" id=msg2></span>
                        </div>
                    </div>
                    <div class="address ">
                        <div class="country inputbx">
                            <span>Country</span>
                            <select id="country" required name="country" class="form-control">
                                
                            </select>
                        </div>
                        <div class="state inputbx">
                            <span>State</span>
                            <select name="state" required id="state" class="form-control">
                                <option value="-1">Select State</option>
                            </select>
                        </div>
                    </div>
                    <div class="inputbx">
                        <input type="submit"  value="Login" name="submit" class="btn btn-primary">
                    </div>
                </form>
                <!-- End Form -->
                <div class="or">or</div>
                <div class="log-with">
                    <a href="#" class="face"><i class="fa-brands fa-facebook-f fa-lg"></i></i></a>
                    <a href="#" class="twi"><i class="fa-brands fa-twitter fa-lg"></i></a>
                    <a href="#" class="goo"><i class="fa-brands fa-google-plus-g fa-lg"></i></a>
                </div>
                <div class="reg"> 
                    <p>If you already have an account? <a href="index.php">Login here</a></p>
                </div>
            </div>
        </div>
    </div>

<?php include $tpl . "footer.php"; ?>
