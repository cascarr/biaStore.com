<?php  
require_once("../resources/config.php");
?>


<?php



// the 1st thing we're going to do, is to dictate what is coming in for us. and the first thing that is coming in, is a GET request.
if(isset($_GET['product_id'])){
    
    $product_id = intval($_GET['product_id']);

    if(isset($_SESSION['cart_product_id'])){
        if(in_array($product_id, $_SESSION['cart_product_id'])) {
        	$key = array_search( $product_id, $_SESSION['cart_product_id']);

        	unset($_SESSION['cart_product_id'][$key]);
        }
    }


    redirect('/checkout.php');
}

?>