<?php


include "connect.php";



$MainCatID = $_POST['MainCatID'];
//get all subcategories for the selected category
$stmt = $con->prepare('SELECT * FROM myshop.category WHERE parentID = :MainCatID');
$stmt->bindParam(':MainCatID', $MainCatID);
$stmt->execute();
$Categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
//return the subcategories as JSON
echo json_encode($Categories);
?>