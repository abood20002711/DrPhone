<?php
session_start();
if (isset($_SESSION['Homepage'])) {
    // Set the page title
    $PageTilte = "Cart";

    // Include necessary files
    include "init.php";
    include "navbar.php";

    // Display the items in the cart
    $stmt = $con->prepare("select * from myshop.cart where UserID = ? ");
    $stmt->execute([$UserID]);
    $items = $stmt->fetchAll();
    $count = $stmt->rowCount();

    // Calculate the total price for the items in the cart
    $stmt2 = $con->prepare("select SUM(Total) as totle from myshop.cart where UserID = ? ");
    $stmt2->execute([$UserID]);
    $totle = $stmt2->fetch();

    

    // Process the order
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($count > 0) {
            // Get customer information from the form
            $CustomerName  = $_POST['CustomerName'];
            $Phone         = $_POST['Phone'];
            $Email         = $_POST['Email'];
            $Country       = $_POST['Country'];
            $State         = $_POST['State'];
            $Address       = $_POST['Address'];
            $ZipCode       = $_POST['Zip'];
            $PaymentMethod = "";
            $Paypal        = $_POST['Paypal'];
            $Credit        = $_POST['Credit'];

            // Determine the payment method
            if ($Paypal == "") {
                $PaymentMethod = "Credit";
            } else {
                $PaymentMethod = "Paypal";
            }

            // Insert order details into the database
            $order = $con->prepare("insert into myshop.orderdetalis (UserID,NumOfItem,Total,PaymentMethod,CustomerName,Phone,Email,Country,State,Address,ZipCode) VALUES 
    (:UserID,:NumOfItem,:Total,:PaymentMethod,:CustomerName,:Phone,:Email,:Country,:State,:Address,:ZipCode)");
            $order->bindParam(":UserID", $UserID);
            $order->bindParam(":NumOfItem", $count);
            $order->bindParam(":Total", $totle['totle']);
            $order->bindParam(":PaymentMethod", $PaymentMethod);
            $order->bindParam(":CustomerName", $CustomerName);
            $order->bindParam(":Phone", $Phone);
            $order->bindParam(":Email", $Email);
            $order->bindParam(":Country", $Country);
            $order->bindParam(":State", $State);
            $order->bindParam(":Address", $Address);
            $order->bindParam(":ZipCode", $ZipCode);
            $order->execute();

            if ($order) {
                $order_id = $con->lastInsertId();

                // Insert order items into the database
                foreach ($items as $item) {
                    $item_id     = $item['ItemID'];
                    $Quantity    = $item['Quantity'];
                    $price       = $item['Price'];
                    $insert_item = $con->prepare("insert into myshop.order_items (order_ID,item_ID,qty,price) values (:order_ID,:item_ID,:qty,:price)");
                    $insert_item->bindParam(":order_ID", $order_id);
                    $insert_item->bindParam(":item_ID", $item_id);
                    $insert_item->bindParam(":qty", $Quantity);
                    $insert_item->bindParam(":price", $price);
                    $insert_item->execute();

                    // Update item quantity in the database
                    $pro_qty = $con->prepare("select * from myshop.items where  ID = ? limit 1");
                    $pro_qty->execute([$item_id]);
                    $pro_qty_data = $pro_qty->fetch();
                    $current_qty  = $pro_qty_data['Quantity'];
                    $new_qty = $current_qty - $Quantity;

                    $update_qty = $con->prepare("UPDATE myshop.items Set Quantity = ? WHERE ID = ?");
                    $update_qty->execute([$new_qty, $item_id]);
                }
            }

            // Delete all items in the cart
            $del = $con->prepare("DELETE from myshop.cart where UserID = ?");
            $del->execute([$UserID]);

            echo "<script>
        Swal.fire(
        'Good job!',
        'Order is completed ',
        'success'
        )
    </script>";
            echo '<script>setTimeout(function() { window.location.href = "MyOrder.php"; }, 1000);</script>';
            exit();
        } else {
            echo "<script>     Swal.fire({
            title: 'Error!',
            text: 'There must be items in the cart to complete the order',
            icon: 'error',
            confirmButtonText: 'OK'
        })</script>";
        }
    }
    // Delete item from the cart
    if (isset($_GET['CartRowID'])) {
        $id     = $_GET['CartRowID'];
        $sql2   = "DELETE FROM myshop.cart WHERE ID=?";
        $delete = $con->prepare($sql2);
        $delete->execute([$id]);
        echo '<script>setTimeout(function() { window.location.href = "Cart.php"; }, 0000);</script>';

        die();
    }
} else {
    header('location:index.php');
}
?>
      <div class="site-content">
        <div class="container">
            <div class="cartShoping">
                <div class="row">
                    <div class="col-lg-6">
                        <h4>Order Summary</h4>
                        <div class="card">
                            <div class="card-body">
                                <div class="row orderSummary">
                                    <div class="col-lg-12 itemCol">
                                      <table>
                                        <thead>
                                            <tr>
                                                <th>Itam Name</th>
                                                <th style="text-align: center;">Quantity</th>
                                                <th style="text-align: center;">Price</th>
                                                <th>Total</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($items as $item) {?> 
                                            <tr>
                                                <td>
                                                    <div class="itemInfo">
                                                        <img src="layout/imges/proudact/<?php echo $item['img'] ?>" alt=""width="50" height="50">
                                                        <div class="context">
                                                            <h5 class="itemName"><?php echo $item['ItemName'] ?></h5>
                                                            <?php
                                                                $qury = $con -> prepare("select subcategory.SubCatName from myshop.subcategory where SubCateID = (select items.sCategory from myshop.items where ID = ?)");
                                                                $qury ->execute([$item['ItemID']]);
                                                                $subcat= $qury ->fetch();
                                                                ?>
                                                                <span class="SubCat">
                                                                    <?php echo $subcat['SubCatName'] ?>
                                                                </span>
                                                        </div>
                                                </td>
                                                <td><?php echo $item['Quantity']?></td>
                                                <td><?php echo $item['Price'] ?>$</td>
                                                <td>
                                                    <div class="price">
                                                        <p class="priceitems"><?php echo $item['Price'] * $item['Quantity'] ?>$</p>
                                                    </div>
                                                </td>
                                                <td><a href="Cart.php?CartRowID=<?php echo $item['ID'] ?>"><i class="fa-solid fa-xmark"></i></a></td>
                                            </tr>
                                        <?php }?>
                                        </tbody>
                                     </table>     
                                   </div>
                                </div>
                                <div class="row confirmOrder">
                                    <div class="col-lg-12">
                                        <div class="totol">
                                            <span>Totol (USD)</span>
                                            <h6>$<?php print_r ($totle['totle'])?></h6>
                                        </div>
                                        <div class="confirmbtn">
                                            <button class="confirm" type="submit" form="my-form">Confirm Order</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12 DeliveryInfo">
                                <h4>Delivery Information</h4>
                                <div class="card">
                                    <div class="card-body">
                                        <form  id="my-form"  onsubmit ="return PaymentMethod()" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                            <div class="row">
                                                <div class="col col-lg-6">
                                                    <label for="">Name</label>
                                                    <input type="text" name="CustomerName" id="" class="form-control" required>
                                                </div>
                                                <div class="col col-lg-6">
                                                    <label for="">Phone</label>
                                                    <input type="tel" pattern="[0-9-()-+ ]*" id="phone" name="Phone"
                                                        class="form-control" required>
                                                </div>
                                                <div class="col col-lg-6">
                                                    <label for="">Email</label>
                                                    <input type="email" name="Email" id="" class="form-control" required>
                                                </div>
                                                <div class="col col-lg-6">
                                                    <label for="">Country</label>
                                                    <select id="country" required name="Country" class="form-control">
                                                    </select>
                                                </div>
                                                <div class="col col-lg-6">
                                                    <label for="">State</label>
                                                    <select name="State" required id="state" class="form-control">
                                                        <option value="-1">Select State</option>
                                                    </select>
                                                </div>
                                                <div class="col col-lg-6">
                                                    <label for="">Zip Code</label>
                                                    <input type="text" name="Zip" id="" class="form-control" required
                                                        placeholder="93944">
                                                </div>
                                                <div class="col col-lg-12">
                                                    <label for="">Address</label>
                                                    <input type="text" name="Address" id="" class="form-control" required>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!--  Payment Method-->
                            <div class="col-lg-12 Payment">
                                <h4>Payment Method</h4>
                                <div class="row g-3">
                                    <div class="col-md-12">            
                                        <div class="card">
                                            <div class="accordion" id="accordionExample">
                                                <div class="card mb-0">
                                                    <div class="card-header p-0" id="headingTwo">
                                                        <h2 class="mb-0">
                                                            <button
                                                                class="btn btn-light btn-block text-left collapsed p-3 rounded-0 border-bottom-custom"
                                                                type="button" data-toggle="collapse"
                                                                data-target="#collapseTwo" aria-expanded="false"
                                                                aria-controls="collapseTwo">
                                                                <div class="d-flex align-items-center justify-content-between">
                                                                    <span>Paypal</span>
                                                                    <img src="layout/imges/icons/7kQEsHU.png"width="30">
                                                                </div>
                                                            </button>
                                                        </h2>
                                                    </div>
                                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                                        data-parent="#accordionExample">
                                                        <div class="card-body">    
                                                            <input type="text" class="form-control Paypal"
                                                                placeholder="Paypal email" id="Paypal" name="Paypal"  form="my-form">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card mb-0">
                                                    <div class="card-header p-0">
                                                        <h2 class="mb-0">
                                                            <button
                                                                class="btn btn-light btn-block text-left p-3 rounded-0"
                                                                data-toggle="collapse" data-target="#collapseOne"
                                                                aria-expanded="true" aria-controls="collapseOne">
                                                                <div class="d-flex align-items-center justify-content-between">
                                                                    <span>Credit card</span>
                                                                    <div class="icons">
                                                                        <img src="layout/imges/icons/W1vtnOV.png"
                                                                            width="30">
                                                                        <img src="layout/imges/icons/2ISgYja.png"
                                                                            width="30">
                                                                        <img src="layout/imges/icons/35tC99g.png"
                                                                            width="30">
                                                                        <img src="layout/imges/icons/W1vtnOV.png"
                                                                            width="30">
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                    </div>
                                                    <div id="collapseOne" class="collapse show"
                                                        aria-labelledby="headingOne" data-parent="#accordionExample">
                                                        <div class="card-body payment-card-body">
                                                            <span class="font-weight-normal card-text">Card
                                                                Number</span>
                                                            <div class="input">
                                                                <i class="fa fa-credit-card"></i>
                                                                <input type="text" class="form-control credit"
                                                                    placeholder="0000 0000 0000 0000" name="Credit"  form="my-form">
                                                            </div>
                                                            <div class="row mt-3 mb-3">
                                                                <div class="col-md-6">
                                                                    <span class="font-weight-normal card-text">Expiry
                                                                        Date</span>
                                                                    <div class="input">
                                                                        <i class="fa fa-calendar"></i>
                                                                        <input type="text" class="form-control creditdata"
                                                                            placeholder="MM/YY" form="my-form" name="data">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <span
                                                                        class="font-weight-normal card-text">CVC/CVV</span>
                                                                    <div class="input">
                                                                        <i class="fa fa-lock"></i>
                                                                        <input type="text" class="form-control cvv"
                                                                          placeholder="000" maxlength="3" form="my-form" name="cvv">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <span class="text-muted certificate-text"><i
                                                                    class="fa fa-lock"></i> Your transaction is
                                                                secured with ssl certificate</span>
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
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        
        function PaymentMethod(){
            var Paypal = document.querySelector('.Paypal');
            var credit = document.querySelector('.credit');
            var creditdata = document.querySelector('.creditdata');
            var cvv = document.querySelector('.cvv');
            if (Paypal.value == "" && (credit.value == "" || creditdata.value == "" || cvv.value == "")){
                Swal.fire({
                    title: 'Error!',
                    text: 'Select a payment method',
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
                return false;
            }
            else {
                return  true;
            }
        }
    </script>

    <?php
    include $tpl . "footer.php";
    ?>