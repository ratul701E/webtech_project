function validEmail(){
    let email = document.getElementById('email').value;
    let at = email.indexOf('@');
    let dot = email.indexOf('.');
    let valid = true;
    let email_status = document.getElementById('email_status');

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

    if(email.length == 0){
        email_status.innerHTML = "";
        return false;
    }

    if(valid){
        email_status.innerHTML = "";
        return true;
    }
    else {
        email_status.innerHTML = "Invalid email";
        return false;
    }
    
}

function validQuery(){
    let query = document.getElementById('query').value;
    let query_status = document.getElementById('query_status');

    if(query.length == 0){
        query_status.innerHTML = "At least 5 letter.";
        return false;
    }

    if(query.length < 5) {
        query_status.innerHTML = "You need to write " + (5-Number(query.length)).toString() + " more letter(s) to valid";
        return false;
    }

    else {
        query_status.innerHTML = "";
        return true;
    }
}

function validate(){

    let email = document.getElementById('email').value;
    let query = document.getElementById('query').value;

    let email_status = document.getElementById('email_status');
    let query_status = document.getElementById('query_status');

    if(!validEmail(email)){
        email_status.innerHTML = "Invalid";
        return false;
    }
    if(!validQuery(query)){
        query_status.innerHTML = "invalid";
        return false;
    }

    return true;
}