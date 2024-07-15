<?php
session_start();
if (isset($_SESSION['Homepage'])) {
  $PageTilte = "My Orders";
  include "init.php";
  include "navbar.php";

} else {
  header('location:index.php');
}
?>
      <div class="site-content">
        <div class="container">
             <div class="myOrders">
                <table class="table table-hover  mt-5">
                    <thead>        
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Order ID</th>
                            <th scope="col">Number Of Items</th>
                            <th scope="col">Price</th>
                            <th scope="col">Date</th>
                            <th scope="col">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $my_order = $con -> prepare("select * from myshop.orderdetalis where UserID = ?");
                            $my_order -> execute([$UserID]);
                            $my_order_value = $my_order -> fetchAll();
                            $count = $my_order -> rowCount();
                            if ($count > 0) {
                                $num =0;
                            foreach ($my_order_value as $order){
                                $num +=1;
                        ?>
                        <tr>
                            <th scope="row"><?= $num  ?></th>
                            <td><?php echo $order['OrderID']?></td>
                            <td><?php echo $order['NumOfItem'] ?></td>
                            <td><?php echo $order['Total'] ?></td>
                            <td><?php echo $order['OrderCreate'] ?></td>
                            <td><a class="btn btn-primary" href="orderview.php?order_id=<?php echo $order['OrderID']?>" role="button">View Details</a></td>
                        </tr>
                        <?php }
                          }else{?>
                           <td colspan="6"> No Orders yet</td>
                        <?php }?>    
                    </tbody>
                </table>
            </div>                            
        </div>
    </div>
    </div>

<?php include $tpl . "footer.php"; ?>