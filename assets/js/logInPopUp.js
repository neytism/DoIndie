
function openLoginPopUp(event, url, baseUrl) {
    
    event.preventDefault();
   
    const xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            //modify on where to put the login form
            document.body.insertAdjacentHTML('beforeend', xhr.responseText);

            if (!document.getElementById('sendFormScript')) {
                const script = document.createElement('script');
                script.src = baseUrl+'assets/js/sendForm.js';
                script.id = 'sendFormScript';
                document.body.appendChild(script);
            }
            
            // Optional: scroll to the newly added login form
            //document.getElementById('login-form').scrollIntoView();
        }
    };
    xhr.send();
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
