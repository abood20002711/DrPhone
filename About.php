<?php 
session_start();
if (isset($_SESSION['Homepage'])){
  $PageTilte = "About As";
  include "init.php";
  include "navbar.php";
  
}
else {
    header('location:index.php');
}
?>

<div class="site-content">
        <!-- entry-page --> 
        <div class="entry-page" style="background-image: url(layout/imges/about/Header.jpg);">
            <div class="container">
                <div class="overlay-c"></div>       
                <div class="caption">
                    <h1 class="title">About As</h1>
                    <p class="sub-title">Passion may be a friendly or eager interest in or admiration for a proposal,<br>cause, discovery, or activity or love to a feeling of unusual excitement.</p>
                </div>
            </div>
        </div>
    
    
    <!-- about-features -->
    <div class="about-features">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <div class="card" >
                        <img class="card-img-top" src="layout/imges/about/3column1.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">What we really do?</h5>
                            <p class="card-text">At DrPhone, we are passionate about revolutionizing the e-commerce experience. We go beyond just selling products online; we aim to provide a comprehensive and exceptional shopping journey for our customers.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="card" >
                        <img class="card-img-top" src="layout/imges/about/3column2.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Our Vision</h5>
                            <p class="card-text">At DrPhone, our vision for our e-commerce website is to enhance the way people shop online by providing a seamless and enjoyable experience. We understand the evolving needs and expectations of online shoppers.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="card" >
                        <img class="card-img-top" src="layout/imges/about/3column3.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">History of Beginning</h5>
                            <p class="card-text">DrPhone was founded with a vision to revolutionize the e-commerce industry and provide customers with a seamless online shopping experience. Our journey began in 2023 when a group of passionate</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About -->
    <div class="about-Company">
        <div class="container">
            <div class="row">
                <div class="col-first col-lg-6 col-sm-12">
                    <div class="row">
                        <div class="col col-lg-6 col-sm-12">
                            <div class="context">
                                <h3>What we really do?</h3>
                                <p>Curating a Vast Selection of Products: We handpick a diverse range of high-quality products from trusted brands and suppliers. From fashion and electronics to home decor and lifestyle essentials, we strive to offer a wide variety of options to cater to different tastes and preferences.</p>
                            </div>
                        </div>
                        <div class="col col-lg-6 col-sm-12">
                            <div class="context">
                                <h3>Our Vision</h3>
                                <p>At DrPhone, our vision for our e-commerce website is to enhance the way people shop online by providing a seamless and enjoyable experience. We understand the evolving needs and expectations of online shoppers.</p>
                            </div>
                        </div><div class="col col-lg-6 col-sm-12">
                            <div class="context">
                                <h3>History of the Company</h3>
                                <p>DrPhone was founded with a vision to revolutionize the e-commerce industry and provide customers with a seamless online shopping experience. Our journey began in 2023 when a group of passionate</p>
                            </div>
                        </div><div class="col col-lg-6 col-sm-12">
                            <div class="context">
                                <h3>Cooperate with Us!</h3>
                                <p>At DrPhone, we believe in the power of collaboration and partnerships. We are always looking to work with like-minded businesses and individuals who share our vision of revolutionizing the e-commerce industry.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="arro col-tow col-lg-6">
                    <h1>What can we do for you ?</h1>
                    <ul class="arrow">
                        <li>
                            <input type="checkbox" checked>
                            <i></i>
                            <h2>Support 24/7</h2>
                            <p>
                                At DrPhone, we take customer satisfaction seriously, and that's why we provide round-the-clock support to ensure your needs are always met. Our dedicated support team is available 24 hours a day
                            </p>
                        </li>
                        <li>
                            <input type="checkbox" checked>
                            <i></i>
                            <h2>Best Quality</h2>
                            <p>At DrPhone, we are committed to delivering the best quality products and services to our customers. We believe that quality is the foundation of a successful e-commerce business, and we strive to exceed customer expectations in every aspect of what we offer.</p>
                        </li>
                        <li>
                            <input type="checkbox" checked>
                            <i></i>
                            <h2>Customer Care</h2>
                            <p>
                            At DrPhone, we prioritize customer care and strive to provide exceptional support to our valued customers. We understand that your satisfaction is crucial to our success, and we are dedicated to ensuring that your experience with us is seamless and enjoyable. Here's how we deliver top-notch customer care:
                            </p>
                        </li>
                        <li>
                            <input type="checkbox" checked>
                            <i></i>
                            <h2>Fastest Delivery</h2>
                            <p>
                                At DrPhone, we understand the importance of fast and reliable delivery when it comes to eCommerce. We strive to provide the fastest delivery service to ensure that your orders reach you in a timely manner. Here's how we ensure swift and efficient delivery:
                            </p>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>

<?php
include "HomePageFooter.php";
include $tpl . "footer.php";
?>