<?php

// get the page title
    function GetTitle(){
        global $PageTilte;
        if(isset($PageTilte)){
            echo $PageTilte;
        }
        else{
            echo "default";
        }
    }
// get the Main Categorie Name
function GetMainCategorieName()
{
    include "connect.php";
    global $MainCatID;
    $stmt = $con->prepare("SELECT NameMainCat FROM myshop.maincategort where MainCatID = ?");
    $stmt->execute([$MainCatID]);
    $result = $stmt->fetch();
    echo $result['NameMainCat'];

}
    // get the Categorie Name
    function GetCategorieName(){
        include "connect.php";
        global $CategorieID;
        $stmt = $con ->prepare("SELECT CategoryName FROM myshop.category where CategoryID = ?");
        $stmt ->execute([$CategorieID]);
        $result = $stmt->fetch();                                     
        echo  $result['CategoryName'];                              
                                        
    }
    // get the Sub Categorie Name
    function GetSubCategorieName()
    {
        include "connect.php";
        global $SubCategorieID;
        $stmt = $con->prepare("SELECT SubCatName FROM myshop.subcategory where SubCateID = ?");
        $stmt->execute([$SubCategorieID]);
        $result = $stmt->fetch();
        echo $result['SubCatName'];

    }
    // User information
    function GetUserInfo(){
    include "connect.php";
    $UserID = $_SESSION['UserId'];
    $sql2   = "SELECT * FROM myshop.users where UserId = ? limit 1";
    $stmt2  = $con->prepare($sql2);
    $stmt2->execute([$UserID]);
    $result2 = $stmt2->fetch();
    echo $result2['Fullname'];
    }
    

     
?>