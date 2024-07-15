<?php 
session_start();
if (isset($_SESSION['Homepage'])){
  $PageTilte = "Home Page";
  include "init.php";
  include "navbar.php";
  
}
else {
    header('location:index.php');
}

 

            
            
?>
  <div class="bodys">
    <!-- Start Slider -->
    <div class="slider slide-fade">
      <div class="slider-inner">
        <div class="slider-item item-active">
          <img src="layout/imges/HomePage/1.png" alt="" class="slide-img">
        </div>
        <div class="slider-item ">
          <img src="layout/imges/HomePage/2.png" alt="" class="slide-img">
        </div>
        <div class="slider-item">
          <img src="layout/imges/HomePage/3.png" alt="" class="slide-img">
        </div>
      </div>
      <div class="slide-dots">
        <button class="dot "></button>
        <button class="dot"></button>
        <button class="dot "></button>
      </div>
    </div>
    <!-- End Slider -->
    <!-- Start Featured -->
    <div class="featured">
      <div class="row">
        <div class="col">
          <i class="fa-solid fa-truck"></i>
          <div class="content">
            <p>Free Shipping</p>
            <span>Free fot all prodact</span>
          </div>
        </div>
        <div class="col">
          <i class="fa-solid fa-sack-dollar"></i>
          <div class="content">
            <p>MonyGuarnte</p>
            <span>Mony Back Guarnte</span>
          </div>
        </div>
        <div class="col">
          <i class="fa-solid fa-shield-heart"></i>
          <div class="content">
            <p>Safe Shopping</p>
            <span>Enjoy Safe Shopping</span>
          </div>
        </div>
        <div class="col">
          <i class="fa-solid fa-headset"></i>
          <div class="content">
            <p>Online Support</p>
            <span>24/7 we provide online support</span>
          </div>
        </div>
      </div>
    </div>
    <!-- End Featured -->
    <!-- Start Advertising  -->
    <div class="advertising w-100">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <a href="#"><img src="layout/imges/HomePage/two-banner-1.jpg" alt=""></a>
          </div>
          <div class="col-lg-6">
            <a href="#"><img src="layout/imges/HomePage/two-banner-2.jpg" alt=""></a>
          </div>
        </div>
      </div>
    </div>

    <!-- End Advertising  -->
    <!-- phone Cat -->
    <div class="catg-Mobile">
      <div class="container">
        <div class="head-catg">
          <h3 class="catge-name">Smart Phone</h3>
          <a href="#">Go to Phone Section <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="body-catg">
          <div class="row">
            <?php
                $getPhone = $con -> prepare("select * from myshop.items where Category = ? ORDER BY RAND() limit 4");
                $getPhone -> execute([13]);
                $PhoneRow = $getPhone -> fetchAll();
                foreach ($PhoneRow as $phone){
            ?>
            <div class="col-lg-3 col-sm-12">
              <div class="card" >
                <div class="media">
                  <a class="card-img-top" href="ProductView.php?id=<?= $phone['ID'] ?>">
                    <img src="layout/imges/proudact/<?php echo $phone['image']; ?>" alt="" class="img-fluid">
                  </a>
                    <a href="#" class="fav"><i class="fa-regular fa-heart"></i></a>
                </div>
                <div class="card-body">
                  <div class="prodict-title">
                    <h4><?= $phone['ItemName'] ?></h4>
                    <span><?= $phone['Price']?></span>
                  </div>
                  <div class="rate">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>
                  </div>
                  <a href="ProductView.php?id=<?= $phone['ID']?>" class="add-to-cart">Add to Cart</a>
                </div>
              </div>
            </div>
            <?php } ?>                          
          </div>
        </div>
      </div>
    </div>
    <!-- Start banner -->
    <div class="banner">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <a href="#"><img src="layout/imges/HomePage/home-v5-banner.png" alt=""></a>
          </div>
        </div>
      </div>
    </div>
    <!-- End banner -->
    <!-- phone Laptops -->
    <div class="catg-Mobile">
      <div class="container">
        <div class="head-catg">
          <h3 class="catge-name">Laptops </h3>
          <a href="#">Go to Laptops Section <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="body-catg">
          <div class="row">
            <?php
            $getPhone = $con->prepare("select * from myshop.items where Category = ? ORDER BY RAND() limit 4");
            $getPhone->execute([16]);
            $PhoneRow = $getPhone->fetchAll();
            foreach ($PhoneRow as $phone) {
              ?>
              <div class="col-lg-3 col-sm-12">
                <div class="card">
                  <div class="media">
                    <a class="card-img-top" href="ProductView.php?id=<?= $phone['ID'] ?>">
                      <img src="layout/imges/proudact/<?php echo $phone['image']; ?>" alt="" class="img-fluid">
                    </a>
                    <a href="#" class="fav"><i class="fa-regular fa-heart"></i></a>
                  </div>
                  <div class="card-body">
                    <div class="prodict-title">
                      <h4>
                        <?= $phone['ItemName'] ?>
                      </h4>
                      <span>
                        <?= $phone['Price'] ?>
                      </span>
                    </div>
                    <div class="rate">
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                    <a href="ProductView.php?id=<?= $phone['ID'] ?>" class="add-to-cart">Add to Cart</a>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <!-- Start banner -->
            <div class="banner">
              <div class="container">
                <div class="row">
                  <div class="col-lg-12">
                    <a href="#"><img src="layout/imges/HomePage/b4.png" alt=""></a>
                  </div>
                </div>
              </div>
            </div>
   <!-- End banner -->
    <div class="catg-Mobile">
      <div class="container">
        <div class="head-catg">
          <h3 class="catge-name">Desktop </h3>
          <a href="#">Go to Desktop Section <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="body-catg">
          <div class="row">
            <?php
            $getPhone = $con->prepare("select * from myshop.items where Category = ? ORDER BY RAND() limit 4");
            $getPhone->execute([25]);
            $PhoneRow = $getPhone->fetchAll();
            foreach ($PhoneRow as $phone) {
              ?>
              <div class="col-lg-3 col-sm-12">
                <div class="card">
                  <div class="media">
                    <a class="card-img-top" href="ProductView.php?id=<?= $phone['ID'] ?>">
                      <img src="layout/imges/proudact/<?php echo $phone['image']; ?>" alt="" class="img-fluid">
                    </a>
                    <a href="#" class="fav"><i class="fa-regular fa-heart"></i></a>
                  </div>
                  <div class="card-body">
                    <div class="prodict-title">
                      <h4>
                        <?= $phone['ItemName'] ?>
                      </h4>
                      <span>
                        <?= $phone['Price'] ?>
                      </span>
                    </div>
                    <div class="rate">
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                    <a href="ProductView.php?id=<?= $phone['ID'] ?>" class="add-to-cart">Add to Cart</a>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
                            <!-- phone Cat -->
                           <div class="catg-Mobile">
      <div class="container">
        <div class="head-catg">
          <h3 class="catge-name">Smart TV </h3>
          <a href="#">Go to Smart TV Section <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="body-catg">
          <div class="row">
            <?php
            $getPhone = $con->prepare("select * from myshop.items where Category = ? ORDER BY RAND() limit 4");
            $getPhone->execute([33]);
            $PhoneRow = $getPhone->fetchAll();
            foreach ($PhoneRow as $phone) {
              ?>
              <div class="col-lg-3 col-sm-12">
                <div class="card">
                  <div class="media">
                    <a class="card-img-top" href="ProductView.php?id=<?= $phone['ID'] ?>">
                      <img src="layout/imges/proudact/<?php echo $phone['image']; ?>" alt="" class="img-fluid">
                    </a>
                    <a href="#" class="fav"><i class="fa-regular fa-heart"></i></a>
                  </div>
                  <div class="card-body">
                    <div class="prodict-title">
                      <h4>
                        <?= $phone['ItemName'] ?>
                      </h4>
                      <span>
                        <?= $phone['Price'] ?>
                      </span>
                    </div>
                    <div class="rate">
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                    <a href="ProductView.php?id=<?= $phone['ID'] ?>" class="add-to-cart">Add to Cart</a>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <!-- Start banner -->
                            <div class="banner4">
                                <div class="row">
                                  <div class="col-lg-6 col">
                                    <a href="#"><img src="layout/imges/HomePage/banner_1_e0fb9225-0de5-4af6-a048-cca155149542_960x270.png" alt=""></a>
                                  </div>
                                  <div class="col col-lg-6">
                                    <a href="#"><img src="layout/imges/HomePage/banner_2_960f1baf-058f-4f26-87d3-60d5963dea49_960x270.png" alt=""></a>
                                  </div>
                                </div>
                            </div>
  <!-- End banner -->
      <!-- phone Cat -->
     <div class="catg-Mobile">
      <div class="container">
        <div class="head-catg">
          <h3 class="catge-name">Smart Watch </h3>
          <a href="#">Go to SmartWatch Section <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="body-catg">
          <div class="row">
            <?php
            $getPhone = $con->prepare("select * from myshop.items where Category = ? ORDER BY RAND() limit 4");
            $getPhone->execute([39]);
            $PhoneRow = $getPhone->fetchAll();
            foreach ($PhoneRow as $phone) {
              ?>
              <div class="col-lg-3 col-sm-12">
                <div class="card">
                  <div class="media">
                    <a class="card-img-top" href="ProductView.php?id=<?= $phone['ID'] ?>">
                      <img src="layout/imges/proudact/<?php echo $phone['image']; ?>" alt="" class="img-fluid">
                    </a>
                    <a href="#" class="fav"><i class="fa-regular fa-heart"></i></a>
                  </div>
                  <div class="card-body">
                    <div class="prodict-title">
                      <h4>
                        <?= $phone['ItemName'] ?>
                      </h4>
                      <span>
                        <?= $phone['Price'] ?>
                      </span>
                    </div>
                    <div class="rate">
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                    <a href="ProductView.php?id=<?= $phone['ID'] ?>" class="add-to-cart">Add to Cart</a>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
                            




<?php
include "HomePageFooter.php";
include $tpl . "footer.php"; 
?>