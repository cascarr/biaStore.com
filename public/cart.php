<?php  
require_once("../resources/config.php");
?>


<?php

$connection = new MongoClient();
$db = $connection->storedb;

// the 1st thing we're going to do, is to dictate what is coming in for us. and the first thing that is coming in, is a GET request.
if(isset($_GET['add'])){
    
    //$query = query("SELECT * FROM products WHERE product_id=" . escape_string($_GET['add']). " ");
   // confirm($query); // we use this function to make sure that the query goes through.
    $product_id = intval($_GET['add']);

    if(!isset($_SESSION['cart_product_id'])){
        $_SESSION['cart_product_id'] = [];
    }

    if(!in_array($product_id, $_SESSION['cart_product_id'])) 
        $_SESSION['cart_product_id'][] = $product_id;
    redirect('/');
}

?>