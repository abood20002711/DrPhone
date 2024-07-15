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
  <div class="footer-newslettet" style="background-image: url(layout/imges/HomePage/pattern-2.png);">
    <div class="container">
      <div class="row">
        <div class="col col-lg-12">
          <div class="context">
            <h3>Sign Up For Newsletters</h3>
            <p>Get E-mail updates about our latest shop and<span> special offers</span>.</p>
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
              <span>Got Questions? Call us 24/7!</span>
              <p>0781211215, 0781211215</p>
            </div>
          </div>
          <div class="Address">
            <p>Contact Info</p>
            <span>Jordan, Amman, Marka</span>
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
        <div class="col col-lg-2 col-md-3 col-sm-12">
          <h4>Find It Fast</h4>
          <ul>
            <?php foreach ($result as $MainCategory) { ?>
              <li>
                <a href="ProductPage.php?MainCatID=<?= $MainCategory['MainCatID'] ?>">
                  <?php echo $MainCategory['NameMainCat'] ?>
                </a>
              </li>
            <?php } ?>
          </ul>
        </div>
        <div class="col col-lg-2 col-md-2 col-sm-12">
          <h4>&nbsp;</h4>
          <ul>
            <li><a href="About.php">About</a></li>
            <li><a href="Contact.php">Contact</a></li>
            <li><a href="Wishlist.php">Wishlist</a></li>
            <li><a href="FQA.php">FAQ</a></li>
          </ul>
        </div>
        <div class="col col-lg-2 col-md-3 col-sm-12">
          <h4>Customer Care</h4>
          <ul>
            <li><a href="#">My Account</a></li>
            <li><a href="FQA.php">FAQs</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="copyright-bar">
    <div class="container">
      <div class="row">
        <div class="col col-lg-12">
          <p>© <span>Dr.Phone</span> - All Rights Reserved</p>
          <img src="layout/imges/HomePage/patment-icon1.png" alt="">
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
