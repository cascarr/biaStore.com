<?php  
require_once("../resources/config.php");

$results = cart();

$products = $results['products'];
?>

<?php include(TEMPLATE_FRONT . DS . "header.php") ?>


    <!-- Page Content -->
    <div class="container">


<!-- /.row --> 

<div class="row">

      <h1>Checkout</h1>

<form action="">
    <table class="table table-striped">
        <thead>
          <tr>
           <th>Product</th>
           <th>Price</th>
           <th>Thumbnail</th>
            <th>Remove</th>
     
          </tr>
        </thead>
        <tbody>
          <?php if(count($products) > 0) { ?>
            <?php foreach($products as $product) { ?>
            <tr>
             <td><?=$product['product_title']?></td>
             <td><?=$product['product_price']?></td>
             <td><?=$product['product_image']?></td>
             <td><a href="./remove.php?product_id=<?=$product['product_id']?>">Remove</a></td>
          </tr>

            <?php } ?>

            <?php } else {?>
            <tr>
              <td align='center' colspan=4>No items</td>
            </tr>

            <?php } ?>

        </tbody>
    </table>
</form>



<!--  ***********CART TOTALS*************-->
            
<div class="col-xs-4 pull-right ">
<h2>Cart Totals</h2>

<table class="table table-bordered" cellspacing="0">
<tbody>

<tr class="cart-subtotal">
<th>Items:</th>
<td><span class="amount"><?=$results['number_product']?></span></td>
</tr>
<tr class="shipping">
<th>Shipping and Handling</th>
<td>Free Shipping</td>
</tr>

<tr class="order-total">
<th>Order Total</th>
<td><strong><span class="amount">$<?=$results['total_cost']?></span></strong> </td>
</tr>


</tbody>

</table>

</div><!-- CART TOTALS-->


 </div><!--Main Content-->



    </div>
<!-- /.container -->


  <?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
