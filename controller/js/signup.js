function checkUsernameExist(){
    let username = document.getElementById('EnterUsername').value;
    if(username.length == 0) {
        document.getElementById('username_msg').innerHTML = "";
        return;
    }
    
    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controller/checker.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('checkUser=true&username='+username);

    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            if(this.responseText == 'true'){
                document.getElementById('username_msg').innerHTML = "Username Already Exist";
            }
            else{
                document.getElementById('username_msg').innerHTML = "";
            }
        }
    }
}

function checkEmailExist(){
    let email = document.getElementById('email').value;
    if(email.length == 0) {
        document.getElementById('email_msg').innerHTML = "";
        return;
    }
    
    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controller/checker.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('checkEmail=true&email='+email);

    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            if(this.responseText == 'true'){
                document.getElementById('email_msg').innerHTML = "Email Already Exist";
            }
            else{
                document.getElementById('email_msg').innerHTML = "";
            }
        }
    }
}

function validate(){
    let asp = document.getElementById('Aspirant').checked;
    let prof = document.getElementById('Professional').checked;

    let username = document.getElementById('EnterUsername').value;
    let first_name = document.getElementById('first-name').value;
    let last_name = document.getElementById('last-name').value;
    let email = document.getElementById('email').value;
    let phone = document.getElementById('phone').value;
    let address = document.getElementById('address').value;
    let password = document.getElementById('password').value;
    let cpassword = document.getElementById('cpassword').value;
    let agree = document.getElementById('agreement').checked;
    let err_shower = document.getElementById('empty_err');

    if(!asp && !prof){
        err_shower.innerHTML = "Role not selected";
        return false;
    }
    else if(username.length < 3){
        err_shower.innerHTML = "Invalid Username";
        return false;
    }
    else if(first_name.length == 0){
        err_shower.innerHTML = "Invalid first name";
        return false;
    }

    
    return false;
}