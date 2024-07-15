<?php
session_start();
if (isset($_SESSION['Homepage'])) {
    $PageTilte = "Wish List";
    include "init.php";
    include "navbar.php";
    // get all items in Wishlist from database
    $stmt3   = $con->prepare("select * from myshop.wishlist where UserID = ? ");
    $stmt3->execute([$UserID]);
    $wishitem = $stmt3->fetchAll();

    // remove items from Wishlist
    if (isset($_GET['ItemID'])) {
        $ItemID = $_GET['ItemID'];
        $del    = $con->prepare("delete from myshop.wishlist where ItemID = ?");
        $del->execute([$ItemID]);
        echo '<script>setTimeout(function() { window.location.href = "Wishlist.php"; }, 0000);</script>';
        die();
    }
} else {
    header('location:index.php');
}




?>
<div class="site-content">
    <div class="container">
        <div class="wishlist">
            <h4>Favorite Products</h4>
            <div class="card">
                <div class="card-body">
                    <table width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>PRODUCT NAME</th>
                                <th>UNIT PRICE</th>
                                <th>STOCK STATUS</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($wishitem as $item) { ?>
                                <?php
                                $status;
                                $stmt4 = $con->prepare("select Quantity from myshop.items where id = ?");
                                $stmt4->execute([$item['ItemID']]);
                                $res = $stmt4->fetch();
                                if ($res['Quantity'] > 0) {
                                    $status = "In Stock";
                                } else {
                                    $status = "Out Of Stock";
                                }
                                ?>
                                <tr>
                                    <td>
                                        <a href="Wishlist.php?ItemID=<?php echo $item['ItemID']; ?>">
                                            <i class="fa-solid fa-xmark icon"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <img src="layout/imges/proudact/<?php echo $item['img'] ?>" alt="" width="50">
                                    </td>
                                    <td><?php echo $item['itemname'] ?></td>
                                    <td><?php echo $item['price'] ;?> $</td>
                                    <td><?php echo $status ?></td>
                                    <td>
                                        <a class="btn btn-primary" href="ProductView.php?id=<?php echo $item['ItemID']; ?>" role="button">Add to cart</a>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php
        include "HomePageFooter.php";
        include $tpl . "footer.php";
    ?>