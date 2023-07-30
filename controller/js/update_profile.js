function checkEmail(){
    let email = document.getElementById('email').value;
    let err = document.getElementById("email_err");
    let at = email.indexOf('@');
    let dot = email.indexOf('.');
    let valid = true;

    if(at == -1 || dot == - 1) valid = false;
    if(at == 0 || dot == email.length - 1) valid = false;
    if(email.indexOf("..") != -1) valid = false;
    if(email.indexOf("@.") != -1) valid = false;
    if(email.indexOf(".@") != -1) valid = false;
    if(email.indexOf(" ") != -1) valid = false;

    let allowedCharacters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_@.';
    for(let i = 0; i < email.length; i++){
        if(allowedCharacters.indexOf(email[i]) == -1){
            valid = false;
            break;
        }
    }

    checkEmailExist(email);

    if(!valid){
        err.innerHTML = 'Invalid email';
        return false;
    }

    else err.innerHTML = 'valid';
    return true;
}

function checkEmailExist(email){
    
    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controller/checker.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('checkEmail=true&email='+email);
    let err = document.getElementById("email_err");

    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            if(this.responseText == 'true'){
                err.innerHTML = 'This email exist aleady';
            }
        }
    }
}
function validate(){
    let first_name = document.getElementById('firstname').value;
    let last_name = document.getElementById('lastname').value;
    let email = document.getElementById('email').value;
    let phone = document.getElementById('phone').value;
    let address = document.getElementById('phone').value;

   
    let err_shower = document.getElementById('err_shower');


    
    if(!isValidName(first_name)){
        err_shower.innerHTML = "Invalid first name";
        return false;
    }

    else if(!isValidName(last_name)){
        err_shower.innerHTML = "Invalid last name";
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