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

    $db =
    
    while($row = fetch_array($query)) {
        
        
        if($row['product_quantity'] != $_SESSION['product_' . $_GET['add']]) {
            
            $_SESSION['product_' . $_GET['add']]+=1;
            
        } else {
            
            //set_message("We only have" . );
        }
    }
    
//    $_SESSION['product_' . $_GET['add']] +=1;
//    redirect("index.php");
    
}

?>