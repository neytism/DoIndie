<div style="position: fixed; background-color: #00000050 ; width: 100%; height: 100%; display: flex; flex-direction: row; align-items: center; justify-content: center;" 
    id="login-container" onclick="closeLoginPopUp();">
    
    <div style="background-color: white;  max-width: fit-content;" onclick="event.stopPropagation();">
        <h3>Log In</h3>
        
        <p id="error-message" style="color: red;"></p>
        
        <!-- sending form data with javascript, no need for refreshing -->
        <form id="login-form" method="POST" onsubmit="sendForm(event, 'login-form', 'error-message', '<?php echo BASEURL; ?>logIn/checkLogIn')">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br><br>
            
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            
            <input type="submit" value="Log In" >
            <input type="button" value="Sign Up" onclick="window.location='<?php echo BASEURL; ?>signup'"><br><br>
            
            <input type="button" value="Close" onclick="closeLoginPopUp();">
        
        </form>
    </div>
    
</div>

<script src="http://localhost:8000/DoIndie/assets/js/sendForm.js" id="sendFormScript"></script>