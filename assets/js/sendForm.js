console.log('script loaded');
//how to use example:
//onclick="sendForm(event,'login-form','error-message','<?php echo BASEURL; ?>login/checkLogIn')"
function sendForm(event, form_id, error_id, url) {
    
    const form = document.getElementById(form_id);
    
    if (!form.checkValidity()) {
        
        return;
    }
    
    event.preventDefault(); //prevents reloading when submitting
    
    const xhr = new XMLHttpRequest();
    const formData = new FormData(form);
    
    // console.log("Form data:");
    // for (let [key, value] of formData.entries()) {
    //     console.log(key + ": " + value);
    // }
    
    xhr.open('POST', url, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            
            const response = xhr.responseText
            var [result, redirect] = response.split("|");

            if(result == 'success'){
                window.location.href = redirect;
                
            }else{
                document.getElementById(error_id).innerHTML = xhr.responseText;
            }
            
        } 
    };
    
    xhr.send(formData);
}