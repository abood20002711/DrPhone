<?php


include "connect.php";



$category_id = $_POST['category_id'];
//get all subcategories for the selected category
$stmt = $con->prepare('SELECT * FROM myshop.subcategory WHERE parentID = :category_id');
$stmt->bindParam(':category_id', $category_id);
$stmt->execute();
$subcategories = $stmt->fetchAll(PDO::FETCH_ASSOC);
//return the subcategories as JSON
echo json_encode($subcategories);
?>