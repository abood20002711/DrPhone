<?php
// Start the session
session_start();

// Check if the 'Homepage' session variable is set
if (isset($_SESSION['Homepage'])) {
  // Set the page title
  $PageTilte = "Product";

  // Include necessary files
  include "init.php";
  include "navbar.php";
} else {
  // Redirect to the index.php page if the 'Homepage' session variable is not set
  header('location:index.php');
}

// Check if the 'SubCategory' GET parameter is set
if (isset($_GET['SubCategory'])) {
  // Get the SubCategory ID from the GET parameter
  $SubCatID = $_GET['SubCategory'];

  // Query to select items based on the SubCategory
  $sql2      = "SELECT * FROM myshop.items WHERE sCategory = ?";
  $ItemByCat = $con->prepare($sql2);
  $ItemByCat->execute([$SubCatID]);

  // Fetch all the results
  $result12 = $ItemByCat->fetchAll();

  // title of the SubCategory
  $SubCategorieID = $SubCatID;

}
// Check if the 'CategoryID' GET parameter is set
if (isset($_GET['CategoryID'])) {
  // Get the CategoryID ID from the GET parameter
  $CategoryID = $_GET['CategoryID'];

  // Query to select items based on the Category
  $sql2      = "SELECT * FROM myshop.items WHERE Category = ?";
  $ItemByCat = $con->prepare($sql2);
  $ItemByCat->execute([$CategoryID]);

  // Fetch all the results
  $result12 = $ItemByCat->fetchAll();

  // title of the Category
  $CategorieID = $CategoryID;
}
if(isset($_GET['MainCatID'])){
  // Get the CategoryID ID from the GET parameter
  $MainCategoryID = $_GET['MainCatID'];

  // Query to select items based on the Main Category
  $sql2 = "SELECT * FROM myshop.items WHERE Category in (select CategoryID from myshop.category where parentID = ?)";
  $ItemByCat  = $con->prepare($sql2);
  $ItemByCat->execute([$MainCategoryID]);

  // Fetch all the results
  $result12 = $ItemByCat->fetchAll();

  // title of the Category
  $MainCatID = $MainCategoryID;
}
?>

<div class="bodys">
  <div class="catg-Mobile">
    <div class="container">
      <div class="head-catg">
        <h3 class="catge-name">
          <?php 
           if (isset($_GET['SubCategory'])){
            GetSubCategorieName();
           }elseif (isset($_GET['CategoryID'])){
              GetCategorieName();
           }else{
            GetMainCategorieName();
           }
          ?>
        </h3>
      </div>
      <div class="body-catg">
        <div class="row">
          <?php foreach ($result12 as $item) { ?>
            <div class="col-lg-3 col-md-4 col-sm-12">
              <div class="card">
                <div class="media">
                  <a class="card-img-top" href="ProductView.php?id=<?php echo $item['ID']; ?>">
                    <img src="layout/imges/proudact/<?php echo $item['image']; ?>" class="img-fluid" width="60"
                      height="60" style="width: auto;">
                  </a>
                  <a href="#?AddToWishList=<?php echo $item['ID'] ?>" onclick="submitForm()" class="fav">
                    <i class="fa-regular fa-heart"></i>
                  </a>
                </div>
                <div class="card-body">
                  <div class="prodict-title">
                    <h4>
                      <?php echo $item['ItemName']; ?>
                    </h4>
                    <span>
                      <?php echo $item['Price']; ?>
                    </span>
                  </div>
                  <div class="rate">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>
                  </div>
                  <a href="ProductView.php?id=<?php echo $item['ID']; ?>" class="add-to-cart">Add to Cart</a>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
// Include footer files
include "HomePageFooter.php";
include $tpl . "footer.php";
?>