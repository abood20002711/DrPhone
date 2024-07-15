<?php
session_start();
if (isset($_SESSION['Homepage'])) {
    $PageTilte = "Order Details";
    include "init.php";
    include "navbar.php";


    $order_id = $_GET['order_id'];

} else {
    header('location:index.php');
}
?>
    <div class="site-content">
        <div class="container">
            <div class="cartShoping">
                <div class="row">
                    <div class="col-lg-6">
                        <h4>Order Details</h4>
                        <div class="card">
                            <div class="card-body">
                                <div class="row orderSummary">
                                    <div class="col-lg-12 itemCol">

                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Itam Name</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $order_items = $con -> prepare("select * from myshop.order_items where order_ID = ? ");
                                                    $order_items -> execute([$order_id]);
                                                    $order_items_result = $order_items -> fetchAll();
                                                    foreach ($order_items_result as $order){
                                                        $prod_name = $con -> prepare("select * from myshop.items where ID = ? ");
                                                    $prod_ID = $order['item_ID'];
                                                    $prod_name -> execute([$prod_ID]);
                                                    $prod_ID_row = $prod_name -> fetch();
                                                    $Status = "";
                                                ?>
                                                <tr>
                                                <td>
                                                    <div class="itemInfo">
                                                        <div class="context">
                                                            <h5 class="itemName"><?= $prod_ID_row['ItemName'] ?></h5>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?= $order['qty'] ?></td>
                                                <td>
                                                    <div class="price">
                                                        <p class="priceitems"><?= $order['price']?>$</p>
                                                    </div>
                                                </td></tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row confirmOrder">
                                    <div class="col-lg-12" >
                                        <div class="totol">
                                                <span>Totol (USD)</span>
                                                <h6>
                                                    <?php
                                                    $order_total = $con->prepare("select Total as total from myshop.orderdetalis where OrderID = ? ");
                                                    $order_total->execute([$order_id]);
                                                    $order_total_res = $order_total->fetch();
                                                    echo $order_total_res['total'];
                                                    ?>
                                                </h6>
                                        </div>        
                                    </div>
                                </div>
                                <!--  -->
                                <?php
                                        $order_Info = $con -> prepare("select * from myshop.orderdetalis where OrderID = ? ");
                                        $order_Info -> execute([$order_id]);
                                        $order_Info_rows = $order_Info -> fetchAll();
                                        foreach ($order_Info_rows as $order){                                    
                                ?>
                                <form action="" class="mt-3">
                                    <div class="col-lg-12 p-0">
                                        <label for="">Payment Method</label>
                                        <input type="text" name="name" value="<?= $order['PaymentMethod']?>" id="" class="form-control" required readonly>
                                    </div>
                                    <div class="col-lg-12 mt-2 p-0">
                                        <?php
                                            if($order['Status'] == 0){
                                                $Status = "Under Process";
                                            }elseif($order['Status'] == 1){
                                                $Status = "Completed";
                                            } elseif ($order['Status'] == 2) {
                                                $Status = "Cancelled";
                                            }
                                        ?>
                                        <label for="">Status</label>
                                        <input type="text" name="name" value="<?= $Status ?>" id="" class="form-control" required readonly>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12 DeliveryInfo">
                                <h4>Delivery Information</h4>
                                <div class="card">
                                    <div class="card-body">
                                        <form action="" id="my-form">
                                            <div class="row">
                                                <div class="col col-lg-4">
                                                    <label for="">Name</label>
                                                    <input type="text" name="name" value="<?= $order['CustomerName'] ?>" id="" class="form-control" required readonly>
                                                </div>
                                                <div class="col col-lg-4">
                                                    <label for="">Phone</label>
                                                    <input type="tel" pattern="[0-9-()-+ ]*" id="phone" name="phone" value="<?= $order['Phone'] ?>"
                                                        class="form-control" required readonly>
                                                </div>
                                                <div class="col col-lg-4">
                                                    <label for="">Email</label>
                                                    <input type="email" name="name" id="" class="form-control" required readonly value="<?= $order['Email'] ?>">
                                                </div>
                                                <div class="col col-lg-4">
                                                    <label for="">Country</label>
                                                    <select  required name="country" class="form-control" readonly>
                                                        <option><?= $order['Country'] ?></option>
                                                    </select>
                                                </div>
                                                <div class="col col-lg-4">
                                                    <label for="">State</label>
                                                    <select name="state" required  class="form-control" readonly>
                                                        <option><?= $order['State'] ?></option>
                                                    </select>
                                                </div>
                                                <div class="col col-lg-4">
                                                    <label for="">Zip Code</label>
                                                    <input type="text" name="name" id="" class="form-control" required
                                                         readonly value="<?= $order['ZipCode'] ?>">
                                                </div>
                                                <div class="col col-lg-12">
                                                    <label for="">Address</label>
                                                    <input type="text" name="name" id="" class="form-control" required readonly value="<?= $order['Address'] ?>">
                                                </div>
                                            </div>
                                        </form>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <?php include $tpl . "footer.php"; ?>