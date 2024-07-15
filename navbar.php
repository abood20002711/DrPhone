<div class="navbar">
  <div class="container">
    <a class="logo" href="HomePage.php">LOGO</a>

    <div class="search">
      <span class="i-ser"><i class="fa fa-search" aria-hidden="true"></i></span>
      <input id="search" type="search" class="form-control" placeholder="Search any thing">
      <span onclick="clear_fild()" class="i-remo" id="search"><i class="fa-solid fa-xmark"></i></span>
    </div>

    <ul class="icons">
      <li><a href="Wishlist.php" class="favourites"><i class="fa-regular fa-heart"></i></a></li>
      <li><a href="#" class="user" id="accountSettings" onclick="shoowDropDown()"><i class="fa-regular fa-user"></i></a>
      </li>

      <ul class="dropdown">
        <li class="userInfo">
          <img src="layout/imges/user/avatar.png" alt="">
          <span>
            <?php GetUserInfo(); ?>
          </span>
        </li>
        <li><a href=""><i class="fa-solid fa-user-pen"></i>Edit Profile</a></li>
        <li><a href="MyOrder.php"><i class="fa-solid fa-box"></i>My Oreders</a></li>

        <li><a href="Logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
      </ul>

      <li><a href="cart.php" class="cart"><i class="fa-solid fa-cart-shopping"></i></a></li>
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
      <?php
      $sql  = "select * from myshop.maincategort  ";
      $stmt = $con->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();
      foreach ($result as $MainCategory) { ?>
        <li class='has-children'>
          <a href="ProductPage.php?MainCatID=<?= $MainCategory['MainCatID']?>">
            <?php echo $MainCategory['NameMainCat'] ?>
          </a>
          <i class='fa fa-angle-down'></i>
          <div class='sub-menu' id='sub-menu'>
            <ul>
              <?php
              $sql2  = "select * from myshop.category where parentID=:MainCategoryID";
              $stmt2 = $con->prepare($sql2);
              $stmt2->bindParam(":MainCategoryID", $MainCategory['MainCatID']);
              $stmt2->execute();
              $result2 = $stmt2->fetchAll();
              ?>
              <?php foreach ($result2 as $Category) { ?>
                <li><a href='ProductPage.php?CategoryID=<?= $Category['CategoryID']?>'>
                    <?php echo $Category['CategoryName'] ?>
                  </a>
                  <ul>
                    <?php
                    $sql3  = "select * from myshop.subcategory where parentID=:CategoryID";
                    $stmt3 = $con->prepare($sql3);
                    $stmt3->bindParam(":CategoryID", $Category['CategoryID']);
                    $stmt3->execute();
                    $result3 = $stmt3->fetchAll();
                    ?>
                    <?php foreach ($result3 as $SubCategory) { ?>
                      <li><a href='ProductPage.php?SubCategory=<?= $SubCategory['SubCateID'] ?>'><?php echo $SubCategory['SubCatName'] ?></a>
                      <?php } ?>
                  </ul>
                </li>
              <?php } ?>

            </ul>
          </div>
        </li>
      <?php } ?>
    </ul>
  </div>
</div>
</div>