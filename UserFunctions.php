<?php 
    include "connect.php";


    function GetCatName($name){
        global $con ;
        $sql = "select * from myshop.category where CategoryName  = ? ";
        $stmt = $con->prepare($sql);
        $stmt -> execute([$name]);
        $result=$stmt ->fetchAll();
        return $result['CategoryName'];   
    }

    // function GetItemFromCat($id){
    //     $sql = "select * from myshop.items where id = ? ";
    //     $stmt = $con->prepare($sql);
    //     $stmt -> execute([$id]);
    // }
?>