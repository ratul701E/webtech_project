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