function onClickLogin() {
    var user = document.getElementById("lgnUser").value;
    var password = document.getElementById("lgnPass").value;
    
    let output = "";

    if(user == '' || password == '')
    {
        alert("Please fill in all the fields.");
    }
    else
    {
        document.getElementById("loginForm").submit();
    }
}