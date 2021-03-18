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
     <a class="serviceTextCustom letterBackground ">Order a Custom Beat</a>
   </div>
   </li>
   <li>
     <div onclick="location.href='./mix.php';"  class="serviceBackgroundMix">
     <a class="serviceTextMix">Mix/Master your Beat</a>
   </div>
   </li>
 </ul>
 </div>

<p class="beatDescription">Describe in detail what you want in your custom Beat:
  rhythm, genres, key, if you want lyrics and vocals, length, etc.
  The more details you give me the closer will be the beat to what you want.
</p>
<form role="form" action="" id="formCustom">
 <div class="form-group">
    <textarea placeholder="I want a Beat with the style of tyga with lyrics that talk about..." class="form-control" id="customTextArea" rows="3"></textarea>
  </div>
  <button id="btnCustom" type="submit" class="btn btn-primary">Order</button>
</form>
</div>


 <?php require 'inc/footer.php'; ?>
