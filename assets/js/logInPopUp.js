
// function openLoginPopUp(event, url, baseUrl) {
    
//     event.preventDefault();
   
//     const xhr = new XMLHttpRequest();
//     xhr.open('GET', url, true);
//     xhr.onreadystatechange = function() {
//         if (xhr.readyState == 4 && xhr.status == 200) {
//             //modify on where to put the login form
//             document.body.insertAdjacentHTML('beforeend', xhr.responseText);
            
//             if (!document.getElementById('sendFormScript')) {
//                 const script = document.createElement('script');
//                 script.src = baseUrl+'assets/js/sendForm.js';
//                 script.id = 'sendFormScript';
//                 document.body.appendChild(script);
//             }
            
//             // Optional: scroll to the newly added login form
//             //document.getElementById('login-form').scrollIntoView();
//         }
//     };
//     xhr.send();
// }

function openLoginPopUp(event, url, baseUrl) {
    event.preventDefault();
    if (document.getElementById('login-container')) {
        closeLoginPopUp();
    } else{

        const login_popup_template = `
        <div id="login-container" class="modal" onclick="closeLoginPopUp();">
      
            <!-- Modal content -->
            <div class="modal-content" onclick="event.stopPropagation();">
                <span class="close"></span>
                    <div class="row">
                        
                        <div class="col-sm-5 center modal-input">
                            <img src=" ` + baseUrl + `/uploads/images/LoginPic.png" class="responsive" alt="Image">
                        </div>
                        
                        <div class="col-sm-7 center modal-input" style="margin-right: 50px !important">
                            <h1 class="headerTitle center" style="color: #f4e9dc">LOGIN</h1>
                            
                            <form id="login-form" method="POST" onsubmit="sendForm(event, 'login-form', 'error-message', ' ` + baseUrl + `logIn/checkLogIn')">
                                <div class="form-group"> <input class="loginInput" type="text" id="username" name="username"
                                        placeholder="Username" required></div>
                                <br>
                                <div class="form-group"> <input class="loginInput" type="password" id="password" name="password"
                                        placeholder="Password" required></div>
                                <div>
                                    <!-- no funcitonalities yet clickin will lead to homepage -->
                                    <span onclick="window.location=' ` + baseUrl + `signup'" class="loginSubHeader">Don't have an
                                        account?</span>
                                </div><br>
                                <p id="error-message" style="color: red; "></p>
                                <input class="inputButtonV1" type="submit" value="Login" >
                            </form>        
                        </div>
                    
                    </div>
                    
                    
            </div>

        </div>`;

        document.body.insertAdjacentHTML('beforebegin', login_popup_template);
        
        if (!document.getElementById('sendFormScript')) {
            const script = document.createElement('script');
            script.src = baseUrl + 'assets/js/sendForm.js';
            script.id = 'sendFormScript';
            document.body.appendChild(script);
        }
    
    }
   
}

function closeLoginPopUp() {
    const loginContainer = document.getElementById('login-container');
    if (loginContainer) {
        loginContainer.remove();
        
        // Optionally remove the script if no longer needed
        const script = document.getElementById('sendFormScript');
        if (script) {
            script.remove();
        }
    }
}
