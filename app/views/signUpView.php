<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="<?php echo BASEURL; ?>assets/css/website.css">
  <link rel="stylesheet" href="<?php echo BASEURL; ?>assets/css/register.css">
  <!-- Bootstrap Modal CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  
  <script src="../../assets/js/register.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
  <body class="registerBackground">
    <div class="registerMainDiv row">
        <div class="col-sm-5 center" style="padding: 2.5em;">
          <img src="<?php echo BASEURL; ?>assets/img/FISH MASCOT.png" class="img-responsive center" style="height:100%; width:100%;" alt="Image">
        </div>

        <div class="col-sm-7 center registerCenterDiv">
          <h1 class="center" style="color: #f4e9dc; font-size: 50px;">REGISTER</h1>
            <p id="error-message" style="color: red;"></p>
            <form class="registerFormDiv  " id="signup-form" method="POST">
            <div class="form-group"> <input type="email" class="registerInput" id="email" name="email" placeholder="Email" required></div>
            <div class="form-group"> <input type="text" class="registerInput" id="username" name="username" placeholder="Username" required></div>
            <div class="form-group"> <input type="password" class="registerInput" id="password" name="password" placeholder="Password" required></div>
            <div class="form-group"> <input type="password" class="registerInput" id="repeat_password" name="repeat_password" placeholder="Confirm Password" required></div>
            <input class="inputButtonV1" type="button" value="Already have an account." onclick="window.location='<?php echo BASEURL; ?>login'"><br>
            <input class="inputButtonV1" type="submit" value="Sign Up" onclick="sendForm(event,'signup-form','error-message','<?php echo BASEURL; ?>signUp/checkSignUp')">
            
            </form>
        </div>
    </div>
    
<script type="text/javascript" src="assets/js/sendForm.js"></script>
  
  </body>
</html>
  