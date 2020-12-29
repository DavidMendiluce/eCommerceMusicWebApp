<?php
    session_start();
    require 'inc/header.php';


    if(isset($_SESSION['sesion'])) {
      if($_SESSION['role'] == "admin") {
        header('Location: Admin/');
      } else {
        header('Location: index.php');
      }
    }
 ?>

  <div class="main">
    <!-- nav menu -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#"></a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#/signup">Sign Up</a></li>
          </ul>
        </div>
    <!--/ .nav collapse -->
      </div>
    </div>


    <?php echo 'Current PHP version: ' . phpversion();
    // prints e.g. '2.0' or nothing if the extension isn't enabled
    echo phpversion('tidy');?>
    <!-- form -->
    <h2 align="center">Login Php</h2>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
          <div class="error">
            <span class="text">Wrong username or password, please try again</span>
          </div>
          <form role="form" action="" id="formlg">
            <fieldset>
              <h3 align="center">Log In</h3>
              <br/>
              <div class="form-group">
                <input type="text" class="form-conytrol input-lg" placeholder="Email or username" name="user_email" required focus>
              </div>
              <div class="form-group">
                <input type="password" pattern="[A-Za-z0-9_-]{1,15}" class="form-conytrol input-lg" placeholder="Password" name="user_password" required focus>
              </div>
              <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                  <a href="register.php" class="btn btn-lg btn-primary btn-block">Sign Up</a>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                  <button type="submit" id="btnlg" class="btn btn-lg btn-success btn-block">Log In</button>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php require 'inc/footer.php'; ?>
