<?php
    session_start();
    require 'inc/header.php';
 ?>

<div id="paymentPage">
<div ng-app="myApp" class="d-flex justify-content-center" ng-controller="playListController"  ng-init="getOrderDetails('<?php echo $_SESSION['orderId'] ?>')">
  <div id="orderSummaryContainer" >
  <td><h2>Order Summary</h2></td>
  <br>
   <div class="invoiceContainerProducts" ng-repeat="product in orderProductsArray">
     <td><span>{{product.product_name}}</span><span class="floatRight">{{product.product_price | currency}}</span></td>
    </div>
     <hr>
     <div>
     <td><span>Total:</span><span class="floatRight">{{setOrderTotalPrice() | currency}}</span></td>
     <div>
     <hr>
     <!--Button Paypal-->
     <div class="d-flex justify-content-center">
    <div id="paypal-button-container">
      <!--<button>PayPal</button>-->
    </div>
    </div>
 </div>
</div>
</div>
</div>
</div>
    

<?php require 'inc/footer.php'; ?>
