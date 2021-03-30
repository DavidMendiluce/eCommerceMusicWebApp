<?php
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';
    require 'inc/header.php';


    if(isset($_SESSION['sesion'])) {
      if($_SESSION['role'] == "admin") {
        header('Location: Admin/');
      } else if(isset($_SESSION['sesion'])) {
        header('Location: index.php');
      }
    }


    $msg = "";

    if(isset($_POST['submit'])) {

      require 'config/connection.php';
      if($mysqli) {
        echo "Connection estblished";
      } else {
        echo "error connectiong";
      }

      $name = $mysqli->real_escape_string($_POST['user_name']);
      $email = $mysqli->real_escape_string($_POST['user_email']);
      $pas = $mysqli->real_escape_string($_POST['user_password']);
      $cPas = $mysqli->real_escape_string($_POST['c_password']);

      $PDOMysqli = new PDO("mysql:host=localhost; dbname=ecommerce_music", "root", "");
      $queryCheckName = "SELECT name FROM users WHERE name = '$name'";
      $statementName = $PDOMysqli->prepare($queryCheckName);
      $statementName->execute();


      if($statementName->rowCount() > 0) {
        $msg = "user already exsist";
        echo   "<div id='errorContainer' class='d-flex justify-content-center'>
        <div class='registerError d-flex justify-content-center'>
                    <span>$msg</span>
                  </div>
                  </div>";
      }
      else {

        if($pas != $cPas) {
          $msg = "Please check your Passwords";
        }
        else {
          $hash = password_hash($pas, PASSWORD_BCRYPT);
          $vKey = md5(time() .$name);
          $insert = $mysqli->query("INSERT INTO users (name, email, password, role, vKey, verified) VALUES ('$name', '$email', '$hash', 'user','$vKey',0)");
          $msg = "You have been registered";

          if($insert) {

            $mail = new PHPMailer;

            //Enable SMTP debugging.
            $mail->SMTPDebug = 3;
            //Set PHPMailer to use SMTP.
            $mail->isSMTP();
            //Set SMTP host name
            $mail->Host = "smtp.gmail.com";
            //Set this to true if SMTP host requires authentication to send email
            $mail->SMTPAuth = true;
            //Provide username and password
            $mail->Username = "";
            $mail->Password = "";
            //If SMTP requires TLS encryption then set it
            //$mail->SMTPSecure = "tls";
            //Set TCP port to connect to
            $mail->Port = 587;

            $mail->From = "";
            $mail->FromName = "";

            $mail->smtpConnect(
                array(
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                        "allow_self_signed" => true
                    )
                )
            );

            $mail->addAddress($email, $name);

            $mail->isHTML(true);

            $mail->Subject = "Email Verification";
            $mail->Body = "<a href='http://localhost/eCommerceMusicWebApp/verify.php?vkey=$vKey'>Register Account</a>";
            $mail->AltBody = "This is the plain text version of the email content";

            if(!$mail->send())
            {
                echo "Mailer Error: " . $mail->ErrorInfo;
            }
            else
            {
                echo "Message has been sent successfully";
            }



            echo "<script>window.location.assign('confirmEmail.php')</script>";
          } else {
            echo $mysqli->error;
          }
        }


      }

    }
 ?>



  <div ng-app="myApp" ng-controller="playListController" ng-init="checkErrorMsg('<?php echo $msg ?>')" class="main">
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
          <form method="post" action="register.php" id="formrg">
            <fieldset>
              <h3 align="center">Register</h3>
              <br/>
              <div class="form-group">
                <input type="text" class="form-conytrol input-lg" placeholder="Username" name="user_name" required focus>
              </div>
              <div class="form-group">
                <input type="email" id="emailForm" class="form-conytrol input-lg" placeholder="Email" name="user_email" required focus>
              </div>
              <div class="form-group">
                <input type="password" pattern="[A-Za-z0-9_-]{1,15}" class="form-conytrol input-lg" placeholder="Password" name="user_password" required focus>
              </div>
              <div class="form-group">
                <input type="password" pattern="[A-Za-z0-9_-]{1,15}" class="form-conytrol input-lg" placeholder="ConfPassword" name="c_password" required focus>
              </div>
              <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                  <span>Already a user?</span><a href="login.php">Login</a>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                  <button name="submit" type="submit" id="btnrg" class="btn btn-lg btn-success btn-block">Sign Up</button>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>


  </div>

<?php require 'inc/footer.php'; ?>
