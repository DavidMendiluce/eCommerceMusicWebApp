<?php require 'header.php' ?>


<div id="playlistPage" ng-app="myApp" ng-controller="servicesController" ng-init="prueba('<?php echo $_SESSION["id"] ?>')">
<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
  <div class="container-fluid" >
    <a class="navbar-brand" href="#"><img id="logo" src="img/goldenLogoWiden.png"/></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="config" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="true">
            <i class="fa fa-user-circle-o fa-lg" aria-hidden="true"></i> Account
          </a>
          <ul class="dropdown-menu" id="configMenu">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="#">Orders</a></li>
            <li><a class="dropdown-item" href="logout.php">logout</a></li>
          </ul>
        </li>
        <li class="nav-item" id="cartLi">
          <a class="nav-link" aria-current="page" href="#">
            <i class="fa fa-shopping-cart fa-lg" aria-hidden="true"><p>{{idSesion}}</p></i>Cart</a>
        </li>
        <li class="nav-item" id="messageLi">
          <a class="nav-link" aria-current="page" href="#">
            <i class="fa fa-comment fa-lg" aria-hidden="true"><p>{{idSesion}}</p></i>
            Messages</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<h1 style="color: red;">Numero Sesion, usar para recoger orders y profiles = {{idSesion}}</h1>
