<?php
    session_start();
    require 'inc/navUser.php';

 ?>

<div class="ordersContainer" ng-init="loadOrders('<?php echo $_SESSION["id"] ?>')">
 <h3 align="center">Your Cart</h3>
 <div id="shoppingCartView" class="table-responsive" id="order_table">
   <table class="table table-bordered table-striped">
     <tr>
       <th width="10%">Order Id</th>
       <th width="20%">Username</th>
       <th width=20%>Date</th>
       <th width="20%">Total Price</th>
       <th width="10%">Status</th>
     </tr>
     <tr ng-repeat="order in orders" ng-init = "setOrderBtnText(order.status)">
       <td>{{order.orderId}}</td>
       <td>{{order.userName}}</td>
       <td>{{order.date | timestampToISO | date}}</td>
       <td>{{order.total_to_pay}}</td>
       <td id="orderCell" ng-style="{'background-color': getStyle(order.status)} ">{{order.status}}<span  ng-style="{'visibility': getBtnOrderVisibility(order.status)}"><br><br><button class="btn btn-primary" ng-click="orderAction()" id="orderBtn">{{setOrderBtnText(order.status)}}</button></span></td>
      </td>
     </tr>
   </table>
 </div>
</div>
<?php require 'inc/footer.php'; ?>
