<?php
session_start();
if (isset($_SESSION['Homepage'])) {
    $PageTilte = "Contact";
    include "init.php";
    include "navbar.php";

} else {
    header('location:index.php');
}
?>
    <div class="site-content">
        <div class="message">
            <div class="container">
                <div class="form-head">
                    <h3>Leave us a Message</h3>
                </div>
                <div class="desc">
                    <p>Maecenas dolor elit, semper a sem sed, pulvinar molestie lacus. Aliquam dignissim, elit non mattis ultrices,<br>
                    neque odio ultricies tellus, eu porttitor nisl ipsum eu massa.</p>
                </div>
                <div class="form">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="">First Name</label>
                                    <input type="text" name="" id="" class="form-control ">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="">Last Name</label>
                                    <input type="text" name="" id="" class="form-control ">
                                </div>
                        </div>
                        <div class="col-lg-12 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="">Your Email</label>
                                <input type="text" name="" id="" class="form-control ">
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Comment or Message *
                                </label>
                                <textarea name="Description" id="" class="form-control"></textarea>
                            </div>
                        </div>
                        
                    </div><a href="#" class="add-to-cart">Send Message</a>
                </div>
            </div>
        </div>
        
      <?php
      include "HomePageFooter.php";
      include $tpl . "footer.php";
      ?>