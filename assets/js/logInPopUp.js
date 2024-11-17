
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
        <div style="position: fixed; background-color: #00000080 ; width: 100%; height: 100%; display: flex; flex-direction: row; align-items: center; justify-content: center;" id="login-container" onclick="closeLoginPopUp();">
            <div style="background-color: white;  max-width: fit-content;" onclick="event.stopPropagation();">
                <h3>Log In</h3>
                
                <p id="error-message" style="color: red;"></p>
                
                <!-- sending form data with javascript, no need for refreshing -->
                <form id="login-form" method="POST" onsubmit="sendForm(event, 'login-form', 'error-message', '`+baseUrl+`logIn/checkLogIn')">
                    <label for="username">Username:</label><br>
                    <input type="text" id="username" name="username" required><br><br>
                    
                    <label for="password">Password:</label><br>
                    <input type="password" id="password" name="password" required><br><br>
                    
                    <input type="submit" value="Log In" >
                    <input type="button" value="Sign Up" onclick="window.location='`+baseUrl+`signup'"><br><br>
                    
                    <input type="button" value="Close" onclick="closeLoginPopUp();">
                
                </form>
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
