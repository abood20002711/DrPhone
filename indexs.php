<?php 
session_start();

include "init.php";
include "connect.php";
// include $tpl ."header.php";
            $sql ="select * from myshop.maincategort  ";
            $stmt=$con->prepare($sql);
            $stmt->execute();
            $result=$stmt ->fetchAll();    
                                                      
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=\, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="layout/css/bootstrap.min.css">
  <link rel="stylesheet" href="layout/css/style.css">
  <link rel="stylesheet" href="layout/css/FrameWork.css">
  <link rel="stylesheet" href="layout/css/all.min.css" />
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Bad+Script&family=Cairo:wght@300;400;700&family=Epilogue:wght@400;600;700&family=Merienda+One&family=Montserrat:wght@300;700&family=Nunito:wght@300;400;600&family=Poppins:wght@500;600&family=Raleway:wght@400;500;600&family=Roboto:wght@100;300;400;500;700&family=Space+Mono&display=swap"
    rel="stylesheet">
  <!-- Hambargers css -->
  <link rel="stylesheet" href="layout/css/Hambargers.css">
  <link rel="stylesheet" href="layout/css/hamburgers/hamburgers.css">



</head>

<body>
  <div class="navbar">
    <div class="container">
      <a class="logo" href="HomePage.php">LOGO</a>

      <div class="search">
        <span class="i-ser"><i class="fa fa-search" aria-hidden="true"></i></span>
        <input id="search" type="search" class="form-control" placeholder="Search any thing">
        <span onclick="clear_fild()" class="i-remo" id="search"><i class="fa-solid fa-xmark"></i></span>
      </div>

      <ul class="icons">
        <li><a class="loginbtn ">Log in</a></li>
        <li><a href="" class="favourites"><i class="fa-regular fa-heart"></i></a></li>
        <li><a href="#" class="user" id="accountSettings" onclick="shoowDropDown()"><i class="fa-regular fa-user"></i></a></li>
        
          <ul class="dropdown">
            <li><a href=""><i class="fa-solid fa-user-pen"></i>Edit Profile</a></li>
            <li><a href=""><i class="fa-solid fa-gear"></i>Settings</a></li>
            <li><a href="Logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
          </ul>
        
        <li><a href="" class="cart"><i class="fa-solid fa-cart-shopping"></i></a></li>
      </ul>
    </div>
  </div>

  <!-- Start mega menu -->
  <div class="mega-menu">
    <div class="overlay"></div>
    <div class="container">
      <div class="hamburger hamburger--collapse " id="hamburger">
        <div class="hamburger-box">
          <div class="hamburger-inner"></div>
        </div>
      </div>
      <div class="memu"></div>
      <ul class="menu-main">
        <div class="mobile-menu-head">
          <div class="go-back"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
          <div class="currnet-menu-title">Shop</div>
          <div class="close-menu">&times;</div>
        </div>
            <?php foreach ($result as $MainCategory) { ?>
              <li class='has-children'><a><?php echo $MainCategory['NameMainCat'] ?></a>
                <i class='fa fa-angle-down'></i>
                  <div class='sub-menu' id='sub-menu'>
                          <ul>
                            <?php
                                        $sql2 ="select * from myshop.category where parentID=:MainCategoryID";
                                        $stmt2=$con->prepare($sql2);
                                        $stmt2->bindParam(":MainCategoryID",$MainCategory['MainCatID']);
                                        $stmt2->execute();
                                        $result2=$stmt2 ->fetchAll();    
                            ?>
                            <?php   foreach ($result2 as $Category) {?>
                                <li><a href='ProductPage.php?Category=<?=$Category['CategoryID']?>'><?php echo $Category['CategoryName'] ?></a>
                                    <ul>
                                      <?php
                                        $sql3 ="select * from myshop.subcategory where parentID=:CategoryID";
                                        $stmt3=$con->prepare($sql3);
                                        $stmt3->bindParam(":CategoryID",$Category['CategoryID']);
                                        $stmt3->execute();
                                        $result3=$stmt3 ->fetchAll();    
                                      ?>
                                      <?php foreach ($result3 as $SubCategory) { ?>
                                        <li><a href='ProductPage.php?SubCategory=<?=$SubCategory['SubCateID']?>'><?php echo $SubCategory['SubCatName'] ?></a>
                                      <?php }?>
                                    </ul>
                                </li>
                            <?php }?>
                              
                          </ul>
                  </div>
              </li>  
            <?php } ?>
      </ul>
    </div>
  </div>
  </div>

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
            <div class="col-lg-3 col-sm-12">
              <div class="card" >
                <div class="media">
                  <a class="card-img-top" href="#">
                    <img src="layout/imges/HomePage/camera2-300x300.png" alt="">
                  </a>
                    <a href="#" class="fav"><i class="fa-regular fa-heart"></i></a>
                </div>
                <div class="card-body">
                  <div class="prodict-title">
                    <h4>Notebook Purple</h4>
                    <span>300.00</span>
                  </div>
                  <div class="rate">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>
                  </div>
                  <a href="#" class="add-to-cart">Add to Cart</a>
                </div>
              </div>
            </div>
                        <div class="col-lg-3 col-sm-12">
                          <div class="card">
                            <div class="media">
                              <a class="card-img-top" href="#">
                                <img src="layout/imges/HomePage/camera2-300x300.png" alt="">
                              </a>
                              <a href="#" class="fav"><i class="fa-regular fa-heart"></i></a>
                            </div>
                            <div class="card-body">
                              <div class="prodict-title">
                                <h4>Notebook Purple</h4>
                                <span>300.00</span>
                              </div>
                              <div class="rate">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star-half-stroke"></i>
                              </div>
                              <a href="#" class="add-to-cart">Add to Cart</a>
                            </div>
                          </div>
                        </div>
                                    <div class="col-lg-3 col-sm-12">
                                      <div class="card">
                                        <div class="media">
                                          <a class="card-img-top" href="#">
                                            <img src="layout/imges/HomePage/camera2-300x300.png" alt="">
                                          </a>
                                          <a href="#" class="fav"><i class="fa-regular fa-heart"></i></a>
                                        </div>
                                        <div class="card-body">
                                          <div class="prodict-title">
                                            <h4>Notebook Purple</h4>
                                            <span>300.00</span>
                                          </div>
                                          <div class="rate">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star-half-stroke"></i>
                                          </div>
                                          <a href="#" class="add-to-cart">Add to Cart</a>
                                        </div>
                                      </div>
                                    </div>
                                                <div class="col-lg-3 col-sm-12">
                                                  <div class="card">
                                                    <div class="media">
                                                      <a class="card-img-top" href="#">
                                                        <img src="layout/imges/HomePage/camera2-300x300.png" alt="">
                                                      </a>
                                                      <a href="#" class="fav"><i class="fa-regular fa-heart"></i></a>
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="prodict-title">
                                                        <h4>Notebook Purple</h4>
                                                        <span>300.00</span>
                                                      </div>
                                                      <div class="rate">
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star-half-stroke"></i>
                                                      </div>
                                                      <a href="#" class="add-to-cart">Add to Cart</a>
                                                    </div>
                                                  </div>
                                                </div>
          </div>
        </div>
      </div>
    </div>
    <div class="banner">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <a href="#"><img src="layout/imges/HomePage/home-v5-banner.png" alt=""></a>
          </div>
        </div>
      </div>
    </div>
        <!-- phone Cat -->
        <div class="catg-Mobile">
          <div class="container">
            <div class="head-catg">
              <h3 class="catge-name">Smart Phone</h3>
              <a href="#">Go to Phone Section <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <div class="body-catg">
              <div class="row">
                <div class="col-lg-3 col-sm-12">
                  <div class="card">
                    <div class="media">
                      <a class="card-img-top" href="#">
                        <img src="layout/imges/HomePage/camera2-300x300.png" alt="">
                      </a>
                      <a href="#" class="fav"><i class="fa-regular fa-heart"></i></a>
                    </div>
                    <div class="card-body">
                      <div class="prodict-title">
                        <h4>Notebook Purple</h4>
                        <span>300.00</span>
                      </div>
                      <div class="rate">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                      </div>
                      <a href="#" class="add-to-cart">Add to Cart</a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-12">
                  <div class="card">
                    <div class="media">
                      <a class="card-img-top" href="#">
                        <img src="layout/imges/HomePage/camera2-300x300.png" alt="">
                      </a>
                      <a href="#" class="fav"><i class="fa-regular fa-heart"></i></a>
                    </div>
                    <div class="card-body">
                      <div class="prodict-title">
                        <h4>Notebook Purple</h4>
                        <span>300.00</span>
                      </div>
                      <div class="rate">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                      </div>
                      <a href="#" class="add-to-cart">Add to Cart</a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-12">
                  <div class="card">
                    <div class="media">
                      <a class="card-img-top" href="#">
                        <img src="layout/imges/HomePage/camera2-300x300.png" alt="">
                      </a>
                      <a href="#" class="fav"><i class="fa-regular fa-heart"></i></a>
                    </div>
                    <div class="card-body">
                      <div class="prodict-title">
                        <h4>Notebook Purple</h4>
                        <span>300.00</span>
                      </div>
                      <div class="rate">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                      </div>
                      <a href="#" class="add-to-cart">Add to Cart</a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-12">
                  <div class="card">
                    <div class="media">
                      <a class="card-img-top" href="#">
                        <img src="layout/imges/HomePage/camera2-300x300.png" alt="">
                      </a>
                      <a href="#" class="fav"><i class="fa-regular fa-heart"></i></a>
                    </div>
                    <div class="card-body">
                      <div class="prodict-title">
                        <h4>Notebook Purple</h4>
                        <span>300.00</span>
                      </div>
                      <div class="rate">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                      </div>
                      <a href="#" class="add-to-cart">Add to Cart</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
            <div class="banner">
              <div class="container">
                <div class="row">
                  <div class="col-lg-12">
                    <a href="#"><img src="layout/imges/HomePage/b4.png" alt=""></a>
                  </div>
                </div>
              </div>
            </div>
                    <!-- phone Cat -->
                    <div class="catg-Mobile">
                      <div class="container">
                        <div class="head-catg">
                          <h3 class="catge-name">Smart Phone</h3>
                          <a href="#">Go to Phone Section <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                        <div class="body-catg">
                          <div class="row">
                            <div class="col-lg-3 col-sm-12">
                              <div class="card">
                                <div class="media">
                                  <a class="card-img-top" href="#">
                                    <img src="layout/imges/HomePage/camera2-300x300.png" alt="">
                                  </a>
                                  <a href="#" class="fav"><i class="fa-regular fa-heart"></i></a>
                                </div>
                                <div class="card-body">
                                  <div class="prodict-title">
                                    <h4>Notebook Purple</h4>
                                    <span>300.00</span>
                                  </div>
                                  <div class="rate">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                  </div>
                                  <a href="#" class="add-to-cart">Add to Cart</a>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                              <div class="card">
                                <div class="media">
                                  <a class="card-img-top" href="#">
                                    <img src="layout/imges/HomePage/camera2-300x300.png" alt="">
                                  </a>
                                  <a href="#" class="fav"><i class="fa-regular fa-heart"></i></a>
                                </div>
                                <div class="card-body">
                                  <div class="prodict-title">
                                    <h4>Notebook Purple</h4>
                                    <span>300.00</span>
                                  </div>
                                  <div class="rate">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                  </div>
                                  <a href="#" class="add-to-cart">Add to Cart</a>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                              <div class="card">
                                <div class="media">
                                  <a class="card-img-top" href="#">
                                    <img src="layout/imges/HomePage/camera2-300x300.png" alt="">
                                  </a>
                                  <a href="#" class="fav"><i class="fa-regular fa-heart"></i></a>
                                </div>
                                <div class="card-body">
                                  <div class="prodict-title">
                                    <h4>Notebook Purple</h4>
                                    <span>300.00</span>
                                  </div>
                                  <div class="rate">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                  </div>
                                  <a href="#" class="add-to-cart">Add to Cart</a>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                              <div class="card">
                                <div class="media">
                                  <a class="card-img-top" href="#">
                                    <img src="layout/imges/HomePage/camera2-300x300.png" alt="">
                                  </a>
                                  <a href="#" class="fav"><i class="fa-regular fa-heart"></i></a>
                                </div>
                                <div class="card-body">
                                  <div class="prodict-title">
                                    <h4>Notebook Purple</h4>
                                    <span>300.00</span>
                                  </div>
                                  <div class="rate">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                  </div>
                                  <a href="#" class="add-to-cart">Add to Cart</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                            <!-- phone Cat -->
                            <div class="catg-Mobile">
                              <div class="container">
                                <div class="head-catg">
                                  <h3 class="catge-name">Smart Phone</h3>
                                  <a href="#">Go to Phone Section <i class="fa-solid fa-arrow-right"></i></a>
                                </div>
                                <div class="body-catg">
                                  <div class="row">
                                    <div class="col-lg-3 col-sm-12">
                                      <div class="card">
                                        <div class="media">
                                          <a class="card-img-top" href="#">
                                            <img src="layout/imges/HomePage/camera2-300x300.png" alt="">
                                          </a>
                                          <a href="#" class="fav"><i class="fa-regular fa-heart"></i></a>
                                        </div>
                                        <div class="card-body">
                                          <div class="prodict-title">
                                            <h4>Notebook Purple</h4>
                                            <span>300.00</span>
                                          </div>
                                          <div class="rate">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star-half-stroke"></i>
                                          </div>
                                          <a href="#" class="add-to-cart">Add to Cart</a>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-12">
                                      <div class="card">
                                        <div class="media">
                                          <a class="card-img-top" href="#">
                                            <img src="layout/imges/HomePage/camera2-300x300.png" alt="">
                                          </a>
                                          <a href="#" class="fav"><i class="fa-regular fa-heart"></i></a>
                                        </div>
                                        <div class="card-body">
                                          <div class="prodict-title">
                                            <h4>Notebook Purple</h4>
                                            <span>300.00</span>
                                          </div>
                                          <div class="rate">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star-half-stroke"></i>
                                          </div>
                                          <a href="#" class="add-to-cart">Add to Cart</a>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-12">
                                      <div class="card">
                                        <div class="media">
                                          <a class="card-img-top" href="#">
                                            <img src="layout/imges/HomePage/camera2-300x300.png" alt="">
                                          </a>
                                          <a href="#" class="fav"><i class="fa-regular fa-heart"></i></a>
                                        </div>
                                        <div class="card-body">
                                          <div class="prodict-title">
                                            <h4>Notebook Purple</h4>
                                            <span>300.00</span>
                                          </div>
                                          <div class="rate">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star-half-stroke"></i>
                                          </div>
                                          <a href="#" class="add-to-cart">Add to Cart</a>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-12">
                                      <div class="card">
                                        <div class="media">
                                          <a class="card-img-top" href="#">
                                            <img src="layout/imges/HomePage/camera2-300x300.png" alt="">
                                          </a>
                                          <a href="#" class="fav"><i class="fa-regular fa-heart"></i></a>
                                        </div>
                                        <div class="card-body">
                                          <div class="prodict-title">
                                            <h4>Notebook Purple</h4>
                                            <span>300.00</span>
                                          </div>
                                          <div class="rate">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star-half-stroke"></i>
                                          </div>
                                          <a href="#" class="add-to-cart">Add to Cart</a>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
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
                            <!-- phone Cat -->
                            <div class="catg-Mobile">
                              <div class="container">
                                <div class="head-catg">
                                  <h3 class="catge-name">Smart Phone</h3>
                                  <a href="#">Go to Phone Section <i class="fa-solid fa-arrow-right"></i></a>
                                </div>
                                <div class="body-catg">
                                  <div class="row">
                                    <div class="col-lg-3 col-sm-12">
                                      <div class="card">
                                        <div class="media">
                                          <a class="card-img-top" href="#">
                                            <img src="layout/imges/HomePage/camera2-300x300.png" alt="">
                                          </a>
                                          <a href="#" class="fav"><i class="fa-regular fa-heart"></i></a>
                                        </div>
                                        <div class="card-body">
                                          <div class="prodict-title">
                                            <h4>Notebook Purple</h4>
                                            <span>300.00</span>
                                          </div>
                                          <div class="rate">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star-half-stroke"></i>
                                          </div>
                                          <a href="#" class="add-to-cart">Add to Cart</a>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-12">
                                      <div class="card">
                                        <div class="media">
                                          <a class="card-img-top" href="#">
                                            <img src="layout/imges/HomePage/camera2-300x300.png" alt="">
                                          </a>
                                          <a href="#" class="fav"><i class="fa-regular fa-heart"></i></a>
                                        </div>
                                        <div class="card-body">
                                          <div class="prodict-title">
                                            <h4>Notebook Purple</h4>
                                            <span>300.00</span>
                                          </div>
                                          <div class="rate">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star-half-stroke"></i>
                                          </div>
                                          <a href="#" class="add-to-cart">Add to Cart</a>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-12">
                                      <div class="card">
                                        <div class="media">
                                          <a class="card-img-top" href="#">
                                            <img src="layout/imges/HomePage/camera2-300x300.png" alt="">
                                          </a>
                                          <a href="#" class="fav"><i class="fa-regular fa-heart"></i></a>
                                        </div>
                                        <div class="card-body">
                                          <div class="prodict-title">
                                            <h4>Notebook Purple</h4>
                                            <span>300.00</span>
                                          </div>
                                          <div class="rate">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star-half-stroke"></i>
                                          </div>
                                          <a href="#" class="add-to-cart">Add to Cart</a>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-12">
                                      <div class="card">
                                        <div class="media">
                                          <a class="card-img-top" href="#">
                                            <img src="layout/imges/HomePage/camera2-300x300.png" alt="">
                                          </a>
                                          <a href="#" class="fav"><i class="fa-regular fa-heart"></i></a>
                                        </div>
                                        <div class="card-body">
                                          <div class="prodict-title">
                                            <h4>Notebook Purple</h4>
                                            <span>300.00</span>
                                          </div>
                                          <div class="rate">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star-half-stroke"></i>
                                          </div>
                                          <a href="#" class="add-to-cart">Add to Cart</a>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tec-prands">
                              <div class="container">
                                <div class="row">
                                  <div class="col col-lg-2"><img src="layout/imges/HomePage/dell.svg" alt=""></div>
                                  <div class="col col-lg-2"><img src="layout/imges/HomePage/acer.svg" alt=""></div>
                                  <div class="col col-lg-2"><img src="layout/imges/HomePage/assus.svg" alt=""></div>
                                  <div class="col col-lg-2"><img src="layout/imges/HomePage/panasonic.svg" alt=""></div>
                                  <div class="col col-lg-2"><img src="layout/imges/HomePage/nokia.svg" alt=""></div>
                                  <div class="col col-lg-2"><img src="layout/imges/HomePage/vaio.svg" alt=""></div>
                                </div>
                              </div>
                            </div>
                            <div class="site-footer">
                              <div class="footer-newslettet">
                                <div class="container">
                              <div class="row">
                                
                                <div class="col col-lg-12">
                                    <div class="context">
                                      <h3>Sign Up For Newsletters</h3>
                                      <p>Get E-mail updates about our latest shop and<span>   special offers</span>.</p>
                                    </div>
                                    <form action="" class="email">
                                      
                                        <input type="email" name="" id="" placeholder="Your Email Address">
                                        <button>Sign Up</button>
                                     
                                    </form>
                                  </div>
                                  
                                </div>
                                </div>
                              </div>
                              <div class="footer-body">
                                <div class="container">
                                  <div class="row">
                                    <div class="col col-lg-5 col-md-4 col-sm-12">
                                      <div class="logo">
                                        LOGO
                                      </div>
                                      <div class="call">
                                        <i class="fa-solid fa-headset"></i>
                                        <div class="call-about">
                                          <span>Got Questions ? Call us 24/7!</span>
                                          <p>0781211215,0781211215</p>
                                        </div>
                                      </div>
                                      <div class="Address">
                                        <p>Contact Info</p>
                                        <span>Jordan,Amman,Marka</span>
                                        <div class="social">
                                          <ul>
                                            <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-whatsapp"></i></a></li>
                                            <li><a href="#"><i class="fa-regular fa-envelope"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                                          </ul>
                                        </div>
                                      </div>
                                      
                                    </div>
                                    <div class=" col col-lg-2 col-md-3 col-sm-12 ">
                                      <h4>Find It Fast</h4>
                                      <ul>
                                          <?php foreach ($result as $MainCategory) { ?>
                                            <li ><a href="#"><?php echo $MainCategory['NameMainCat'] ?></a> </li>
                                          <?php }?>
                            
                                      </ul>
                                    </div>
                                    <div class="col col-lg-2 col-md-2 col-sm-12">
                                      <h4>&nbsp;</h4>
                                      <ul>
                                        <li><a href="#">About</a></li>
                                        <li><a href="#">Contact</a></li>
                                        <li><a href="#">Wishlist</a></li>
                                        <li><a href="#">FAQ</a></li>
                                      </ul>
                                    </div>
                                    <div class="col col-lg-2 col-md-3 col-sm-12">
                                      <h4>Customer Care</h4>
                                      <ul>
                                        <li><a href="#">My Account</a></li>
                                        <li><a href="#">Customer Service</a></li>
                                        <li><a href="#">FAQs</a></li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>

                              </div>
                                                              <div class="copyright-bar">
                                                                <div class="container">
                                                                  <div class="row">
                                                                    <div class=" col col-lg-12">
                                                                      <p>© <span>Dr.Phone </span>- All Rights Reserved</p>
                                                                      <img src="layout/imges/HomePage/patment-icon1.png" alt="">
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                              </div>
                            </div>
  </div>
  </div>

  <script src="layout/js/backend.js"></script>



</body>

</html>
<?php include $tpl . "footer.php"; ?>