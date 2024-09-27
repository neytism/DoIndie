function onClickLogin() {
    var email = document.getElementById("lgnUser").value;
    var password = document.getElementById("lgnPass").value;
    
    let output = "";

    if(email == '' || password == '')
    {
        alert("Please fill in all the fields.");
    }
    else
    {
        document.getElementById("loginForm").submit();
    }
}