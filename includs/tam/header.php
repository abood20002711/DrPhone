<?php

    // Retrieve user information based on the 'UserId' stored in the session variable


// Check if the 'dashboard' session variable is empty or not set

if (isset($_SESSION['dashbord']) ) {
    $UserID = $_SESSION['UserId'];
    $sql    = "SELECT * FROM myshop.users WHERE UserId = ? LIMIT 1";
    $stmt   = $con->prepare($sql);
    $stmt->execute([$UserID]);
    $user = $stmt->fetch();
}
if (isset( $_SESSION['Homepage'])) {
    $UserID = $_SESSION['UserId'];
    $sql    = "SELECT * FROM myshop.users WHERE UserId = ? LIMIT 1";
    $stmt   = $con->prepare($sql);
    $stmt->execute([$UserID]);
    $user = $stmt->fetch();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="layout/imges/icons/logo.jpg"/>
    <title><?php  GetTitle() ?></title>
    <!-- ================ CSS Links ========================= -->
    <!-- Main CSS File -->
    <link rel="stylesheet" href="<?php echo $css; ?>style.css">
    <!-- Bootstrap Link -->
    <link rel="stylesheet" href="<?php echo $css;?>bootstrap.min.css"/>
    <!-- Font-awesome Link -->
    <link rel="stylesheet" href="<?php echo $css;?>all.min.css"/>

    <!-- normalize Links -->
    <link rel="stylesheet" href="<?php echo $css; ?>normalize.css" />
    <!-- Style link -->
    <link rel="stylesheet" href="<?php echo $css;?>style.css"/>
    <link rel="stylesheet" href="<?php echo $css;?>restpassword.css"/>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bad+Script&family=Cairo:wght@300;400;700&family=Epilogue:wght@400;600;700&family=Merienda+One&family=Montserrat:wght@300;700&family=Nunito:wght@300;400;600&family=Poppins:wght@500;600&family=Raleway:wght@400;500;600&family=Roboto:wght@100;300;400;500;700&family=Space+Mono&display=swap" rel="stylesheet">
    <!-- phone  number -->
    <link rel="stylesheet" href="layout/phone-number-with-country-code/build/css/intlTelInput.css">
    <!-- My Framework -->
    <link rel="stylesheet" href="<?php echo $css; ?>FrameWork.css">
    <!-- Data Table -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/cRebootss/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
    <!-- Hambargers css -->
    <link rel="stylesheet" href="<?php echo $css; ?>Hambargers.css">
    <link rel="stylesheet" href="<?php echo $css; ?>hamburgers/hamburgers.css">
   

    <!-- ================ Script Links ========================= -->
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    
</head>
<body>