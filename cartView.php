<?php
    session_start();
    require 'inc/navUser.php';

 ?>

 <div id="emptyCart" class="alert alert-danger
 alert-dismissable" ng-show="isEmpty">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   Your cart is empty
 </div>

 <h3 id="textCart" align="center">Your Cart</h3>
 <div id="shoppingCartView" class="table-responsive" id="order_table">
   <table class="table table-bordered table-striped">
     <tr>
       <th width="40%">Product Name</th>
       <th width="20%">Price</th>
       <th width=15%>Total</th>
       <th width="5%">Action</th>
     </tr>
     <tr ng-repeat="cart in carts">
       <p>{{cart.product_id}}</p>
       <td>{{cart.product_name}}</td>
       <td>{{ cart.product_price }}</td>
       <td>{{ cart.product_quantity * cart.product_price | currency : "€"}}</td>
       <td><button type="button" name="remove_product" class="btn btn-danger btn-xs" ng-click="removeItem($index, cart.product_id)">Delete</button>
      </td>
     </tr>
     <tr>
       <td colspan="3" align="right">Total</td>
       <td colspan="2">{{ setTotals () | currency : "€" }}</td>
     </tr>
   </table>
 </div>
<div class="checkoutContainer">
<button id="btnCheckout" type="button" ng-click="submitCheckout('<?php echo $_SESSION["id"] ?>', '<?php echo $_SESSION["sesion"] ?>', setTotals())" name="checkout_products" class="btn btn-ligh btn-lg align-center">Checkout</button>
</div>
<?php require 'inc/footer.php'; ?>
