<?php


// we want to be able to give the user some information  if logging or not.
function set_message($msg){
    
    if(!empty($msg)){
        $_SESSION['message'] = $msg;
    } else { // if it's empty, we go ahead and apply an empty string to it.
        $msg = "";
    }
}


// this displays the message to the user.
function display_message(){
    
    // so, 1st we need to check if the session is available.
    if(isset($_SESSION['message'])){
        
        echo $_SESSION['message']; // we echo it.
        unset($_SESSION['message']);
    }
}


// this function just redirects any time we needed to.
function redirect($location){
    
    return header("Location: $location ");
    
}

// get products

function get_products(){

    $connection = new MongoClient();
    
    $db = $connection->storedb;

    
    // we send the query in, right here..
    $mObj = $db->products->find();
    
    
    // we fetch, NB: this is coming back as an array
    foreach ($mObj as $row){
        
        // what we'r about to use is something called heredoc.. this is a cool way of inserting a lot of strings..
        // code to display our products..
        $product = <<<DELIMETER
    <div class="col-sm-4 col-lg-4 col-md-4">
        <div class="thumbnail">
            <a href="item.php?id={$row['_id']}"><img src="{$row['product_image']}" alt=""></a>
            <div class="caption">
                <h4 class="pull-right">&#36;{$row['product_price']}</h4>
                <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                            </h4>
                <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>

                <a class="btn btn-primary" target="_blank" href="cart.php?add={$row['product_id']}">Add to cart</a>
            </div>

        </div>
    </div>
DELIMETER;
        
        echo $product;
        
    }
}


// creating a new function for the category page.
function get_categories(){
$connection = new MongoClient();
    
$db = $connection->storedb;

 
// displaying dynamic categories..
$mObj = $db -> categories ->find();

// fetching the data from our db using the mfa..
foreach ($mObj as $row){

    // what we'r about to use is something called heredoc.. this is a cool way of inserting a lot of strings..
// code to display our category..
$category_links = <<<DELIMETER

<a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>
    
DELIMETER;
    echo $category_links;
            
    }
}


// creating the latest products
function get_products_in_cat_page(){

    $id = $_GET['id'];
    $connection = new MongoClient();
    
    // use database
    $db = $connection->storedb;
    
    // we send the query in, right here..
        $mObj = $db->products->find(array('cat_id' => $id));
    
    
    foreach ($mObj as $row){
        
    // what we'r about to use is something called heredoc.. this is a cool way of inserting a lot of strings..
    // code to display our products..
    $features_list = <<<DELIMETER
<div class="col-md-3 col-sm-6 hero-feature">
    <div class="thumbnail">
        <img src="{$row['product_image']}" alt="">
        <div class="caption">
            <h3>{$row['product_title']}</h3>
            <p>Lorem nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
            <p>
                <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
            </p>
        </div>
    </div>
</div>
DELIMETER;
        
        echo $features_list;
    }
    
}


function get_products_in_shop_page(){
    
    $connection = new MongoClient();
    
    $db = $connection->storedb;
    
    $mObj = $db->products->find();
    
    // we fetch, NB: this is coming back as an array
    foreach($mObj as $row){
        
    
    // code to display our products..
    $features_list = <<<DELIMETER
<div class="col-md-3 col-sm-6 hero-feature">
    <div class="thumbnail">
        <img src="{$row['product_image']}" alt="">
        <div class="caption">
            <h3>{$row['product_title']}</h3>
            <p>Lorem nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
            <p>
                <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
            </p>
        </div>
    </div>
</div>
DELIMETER;
        
        echo $features_list;
        
    }
}


// this function ll manipulate the login.php, to login the user.
function login_user(){
    
// 1st thing we have to do, is check..
if(isset($_POST['submit'])){
       
$connection = new MongoClient();
        
        // connection to database
        $db = $connection->storedb;
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $user = $db->users->find(
            array(
                'username' => $username
            )
        );
        
        // iterates through the found results.
        foreach($user as $userFind){
            $storedUsername = $userFind['username'];
            $storedPassword = $userFind['password'];
            
        }
        
        
        if($username == $storedUsername && $password == $storedPassword){
           set_message("Welcome to biaStore.com {$username}");
            return redirect("admin");
        } 
        set_message("Your password or username is wrong"); 
            
        redirect("login.php");
    
    
 }
 
    
}


// this function to post a message to admin.
function send_message(){
    
    if(isset($_POST['submit'])){
        
        $to         =   "someemail@gmail.com";
        $from_name  =   $_POST['name'];
        $ubject     =   $_POST['subject'];
        $email      =   $_POST['email'];
        $message    =   $_Post['message'];
        
        
        $headers    = "From: {$from_name} {$email}";
        
        $result     = mail($to, $ubject, $message, $headers);
        
        if(!$result) {
            
            set_message("Sorry, we could not send your message");
            redirect("contact.php");
        } else {
            
           set_message("Your message has been sent successfully");
            redirect("contact.php");
        }
        
    }
}


// this function displays the product in the checkout.
function cart() {
    $products = $_SESSION['cart_product_id'];

    $results = [
        'total_cost' => 0,
        'number_product' => 0,
        'products' => []
    ];

    if(!empty($products)){
        $results['number_product'] = count($products);
    }

    $connection = new MongoClient();
                
    $db = $connection->storedb;

    foreach($products as $product_id){
        $pr = $db->products->find(['product_id' => $product_id]);
        foreach($pr as $p){
            if($p) {
                $results['products'][] = $p;
                $results['total_cost'] += $p['product_price'];
            }
        }
    }
    return $results;

}
