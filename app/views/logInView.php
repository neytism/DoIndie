
<?php if ($view == 'logInView'): ?>
    <link rel="stylesheet" href="<?php echo BASEURL; ?>assets/css/website.css">          
    <link rel="stylesheet" href="<?php echo BASEURL; ?>assets/css/login.css">                 
<?php endif; ?>

<div id="login-container" class="modal" onclick="closeLoginPopUp();">
      
    <!-- Modal content -->
    <div class="modal-content" onclick="event.stopPropagation();">
        <span class="close"></span>
            <div class="row">
                
                <div class="col-sm-5 center modal-input">
                    <img src="<?php echo BASEURL; ?>/uploads/images/LoginPic.png" class="responsive" alt="Image">
                </div>
                
                <div class="col-sm-7 center modal-input" style="margin-right: 50px !important">
                    <h1 class="headerTitle center" style="color: #f4e9dc">LOGIN</h1>
                    
                    <form id="login-form" method="POST" onsubmit="sendForm(event, 'login-form', 'error-message', '<?php echo BASEURL; ?>logIn/checkLogIn')">
                        <div class="form-group"> <input class="loginInput" type="text" id="username" name="username"
                                placeholder="Username" required></div>
                        <br>
                        <div class="form-group"> <input class="loginInput" type="password" id="password" name="password"
                                placeholder="Password" required></div>
                        <div>
                            <!-- no funcitonalities yet clickin will lead to homepage -->
                            <span onclick="window.location='<?php echo BASEURL; ?>signup'" class="loginSubHeader">Don't have an
                                account?</span>
                        </div><br>
                        <p id="error-message" style="color: red; "></p>
                        <input class="inputButtonV1" type="submit" value="Login" >
                    </form>                
                </div>
            
            </div>
            
            
    </div>

</div>

<script src="<?php echo BASEURL; ?>assets/js/sendForm.js" id="sendFormScript"></script>