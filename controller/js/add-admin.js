function validate(){
    let username = document.getElementById('username').value;
    let first_name = document.getElementById('first-name').value;
    let last_name = document.getElementById('last-name').value;
    let email = document.getElementById('email').value;
    let phone = document.getElementById('phone').value;
    let address = document.getElementById('address').value;
    let password = document.getElementById('password').value;
    let err_shower = document.getElementById('empty_err');

     if(!isValidUsername(username)){
        err_shower.innerHTML = "Invalid Username";
        return false;
    }
    
    else if(!isValidName(first_name)){
        err_shower.innerHTML = "Invalid first name";
        return false;
    }

    else if(!isValidName(last_name)){
        err_shower.innerHTML = "Invalid last name";
        return false;
    }

    else if(!isValidEmail(email)){
        err_shower.innerHTML = "Invalid email address";
        return false;
    }

    else if(phone.length != 11){
        err_shower.innerHTML = "Invalid phone number";
        return false;
    }

    else if(address.length < 5){
        err_shower.innerHTML = "Too small address. Please provide with detials";
        return false;
    }

    if(password < 8){
        err_shower.innerHTML = "Password must be 8 character or more";
        return false;
    }

    return true;
}

function isValidUsername(username){
    if(username.length < 4) {
        return false;
    }
    let allowedCharacters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_';
    for(let i = 0; i < username.length; i++){
        if(allowedCharacters.indexOf(username[i]) == -1){
            return false;
        }
    }
    return true;
}


function isValidName(name){
    if(name.length < 3) return false;
    for(let i = 0; i < name.length; i++){
        let char = name[i];
        if(!isAlphabet(char) && char != ' ' && char != '.'){
            return false;
        }
    }
    return true;
}

function isAlphabet(character) {
    const codePoint = character.codePointAt(0);
    return (codePoint >= 65 && codePoint <= 90) || (codePoint >= 97 && codePoint <= 122);
}

function isValidEmail(email){
    let at = email.indexOf('@');
    let dot = email.indexOf('.');

    if(at == -1 || dot == - 1) return false;
    if(at == 0 || dot == email.length - 1) return false;
    if(email.indexOf("..") != -1) return false;
    if(email.indexOf("@.") != -1) return false;
    if(email.indexOf(".@") != -1) return false;
    if(email.indexOf(" ") != -1) return false;

    let allowedCharacters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_@.';
    for(let i = 0; i < email.length; i++){
        if(allowedCharacters.indexOf(email[i]) == -1){
            return false;
        }
    }

    return true;
    
}

function checkUsernameExist(){
    let username = document.getElementById('username').value;
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