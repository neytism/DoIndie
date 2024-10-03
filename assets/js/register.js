function onClickRegister() {
    var user = document.getElementById("regUser").value;
    var email = document.getElementById("regEmail").value;
    var password = document.getElementById("regPass").value;
    var confirmPassword = document.getElementById("regConPass").value;
    var userType = document.getElementById('userType').value;
    
    let output = "";

    if(user == '' || email == '' || password == '' || confirmPassword == '' || userType == '')
    {
        alert("Please fill in all the fields.");
    }
    else
    {
        document.getElementById("registerForm").submit();
    }
}