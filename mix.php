<?php
    session_start();


    if(isset($_SESSION['sesion'])) {
      if($_SESSION['role'] == "admin") {
        header('Location: Admin/');
      } else if($_SESSION['role'] == "user") {
        require 'inc/navUser.php';
      }
    } else {
        require header('Location: login.php');
    }
 ?>

 <!-- Select the service to purchase, either a buying a song, order a custom song, or mixing and mastering services-->
 <div class="servicesContainer">
 <ul id="servicesMenu" class="d-flex justify-content-between">
   <li>
     <div onclick="location.href='./index.php';"  class="serviceBackgroundBuy">
     <a class="serviceTextBuy">Buy a Beat</a>
     </div>
   </li>
   <li>
     <div onclick="location.href='./custom.php';"  class="serviceBackgroundCustom">
     <a class="serviceTextCustom">Order a Custom Beat</a>
   </div>
   </li>
   <li>
     <div onclick="location.href='./mix.php';"  class="serviceBackgroundMix">
     <a class="serviceTextMix letterBackground ">Mix/Master your Beat</a>
   </div>
   </li>
 </ul>
 </div>

<p class="beatDescription">Attacht your Beat and I will Mix it and Master it.
</p>
<form role="form" action="" id="formCustom">
  <div class="form-group">
     <input type="file" class="form-control-file" id="mixInput">
     <br>
     <button id="btnMix" type="submit" class="btn btn-primary">Order</button>
   </div>
</form>
</div>


 <?php require 'inc/footer.php'; ?>
