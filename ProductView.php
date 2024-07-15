<?php
session_start();
if (isset($_SESSION['Homepage'])) {
    $PageTilte = "View Product";
    include "init.php";
    include "navbar.php";

    if (isset($_GET['id'])) {
        $itemID    = $_GET['id'];
        $sql2      = "select * from myshop.items where ID = ? ";
        $ItemByCat = $con->prepare($sql2);
        $ItemByCat->execute([$itemID]);
        $items = $ItemByCat->fetchAll();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['AddToCart'])) {
            $UserID   = $_SESSION['UserId'];
            $Quantity = $_POST['Quantity'];
            $Item_ID  = $_POST['Item_ID'];
            $ItemName = $_POST['ItemName'];
            $Price    = $_POST['Price'] * $_POST['Quantity'];
            $image    = $_POST['image'];
            $Total    = $Price * $Quantity;

            $stmt2 = $con->prepare("insert into myshop.cart(UserID,ItemID,ItemName,Price,Quantity,img,Total) VALUES (:UserID,:ItemID,:ItemName,:Price,:Quantity,:img,:Total)");
            $stmt2->bindParam(":UserID", $UserID);
            $stmt2->bindParam(":ItemID", $Item_ID);
            $stmt2->bindParam(":ItemName", $ItemName);
            $stmt2->bindParam(":Price", $Price);
            $stmt2->bindParam(":Quantity", $Quantity);
            $stmt2->bindParam(":img", $image);
            $stmt2->bindParam(":Total", $Total);
            $stmt2->execute();

            echo "<script>
        Swal.fire(
        'Good job!',
        'The Itame is Added To Your Cart',
        'success'
                    )
    </script>";
        } elseif (isset($_POST['AddToWishlist'])) {

            $UserID   = $_SESSION['UserId'];
            $Item_ID  = $_POST['Item_ID'];
            $ItemName = $_POST['ItemName'];
            $Price    = $_POST['Price'];
            $image    = $_POST['image'];

            $stmt3 = $con->prepare("insert into myshop.wishlist(UserID,ItemID,itemname,price,img) VALUES (:UserID,:ItemID,:ItemName,:Price,:img)");
            $stmt3->bindParam(":UserID", $UserID);
            $stmt3->bindParam(":ItemID", $Item_ID);
            $stmt3->bindParam(":ItemName", $ItemName);
            $stmt3->bindParam(":Price", $Price);
            $stmt3->bindParam(":img", $image);
            $stmt3->execute();

            echo "<script>
        Swal.fire(
        'Good job!',
        'The Itame is Added To Your Wishlist',
        'success'
                    )
    </script>";

        }
    }
} else {
    header('location:index.php');
}



?>

    <div class="site-content">
        <div class="proudact-view">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <?php foreach($items as $item) {
                            ?>
                        <div class="col-lg-6 image">
                            <img class="img-fluid" src="layout/imges/proudact/<?php echo $item['image'] ?>" alt="noy found">
                            </div>
                            <div class="col-lg-6 context">

                                <div class="row">
                                    <div class="col-lg-12 colinfo">
                                        <h2><?php echo $item['ItemName'] ; ?></h2>
                                    <div class="rate">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star-half-stroke"></i>
                                        <span>( 55 sale )</span>
                                    </div>
                                    <span class="price">USD <?php echo $item['Price']?></span>
                                    
                                </div>
                                <div class="col-lg-12 colinfo">
                                    <p class="description"><?php echo $item['Description']?></p>
                                </div>
                                <div class="col-lg-12 colinfo">
                                    <!-- <label for="">QTY: </label> -->
                                    <?php if($item['Quantity'] > 0) {?>
                                        <form action="ProductView.php?id=<?php echo $item['ID']?>" method="POST" name="add">
                                        <input  type="number" id="tentacles" name="Quantity" value="1" min="1" max="<?= $item['Quantity']?>" required>
                                        <input type="hidden" name="Item_ID" value="<?php echo $item['ID']?>"/>
                                        <input type="hidden" name="ItemName" value="<?php echo $item['ItemName']?>"/>
                                        <input type="hidden" name="Price" value="<?php echo $item['Price']?>"/>
                                        <input type="hidden" name="image" value="<?php echo $item['image']?>"/>
                                        <button type="submit" class="AddCart" name="AddToCart">Add to Cart</button>
                                        <br>
                                    </form>
                                    
                                    <form action="ProductView.php?id=<?php echo $item['ID'] ?>" method="POST" name="wish">
                                        <input type="hidden" name="Item_ID" value="<?php echo $item['ID'] ?>" />
                                        <input type="hidden" name="ItemName" value="<?php echo $item['ItemName'] ?>" />
                                        <input type="hidden" name="Price" value="<?php echo $item['Price'] ?>" />
                                        <input type="hidden" name="image" value="<?php echo $item['image'] ?>" />
                                        <button    type="submit" name="AddToWishlist" class="AddWish"><i class="fa-regular fa-heart"></i> </button>                                        
                                        </form>
                                        <?php }else{?>
                                            <br>
                                            <span style="color:red ; font-size:18px; font-weight: 500;margin: 16px 0;">Out of Stock</span>
                                            <br>
                                            
                                        <?php }?>

                                        </div>
                                        <div class="col-lg-12 colinfo footer">
                                    <?php   
                                            $CatID=$item['Category'];
                                            $sql3 = "select * from myshop.Category where CategoryID = ?";
                                            $ItemByCat= $con->prepare($sql3);
                                            $ItemByCat->execute([$CatID]);
                                            $result12=$ItemByCat ->fetch();                                        
                                            // SubCategory
                                            $SunCatID=$item['sCategory'];
                                            $sql4 = "select * from myshop.subcategory where SubCateID = ?";
                                            $ItemBySubCat= $con->prepare($sql4);
                                            $ItemBySubCat->execute([$SunCatID]);
                                            $result13=$ItemBySubCat ->fetch(); 
                                        echo "<p>Category : <span> ".$result12['CategoryName']." </span></p>";
                                       echo  "<p>Sub Category : <span>".$result13['SubCatName']."</span></p>";
                                    ?>
 
                                    <div class="share">
                                        <p>Share This Product</p>
                                        <ul>
                                            <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-tiktok"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                </div>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>

     
            <?php
            include "HomePageFooter.php";
            include $tpl . "footer.php";
            ?>