function oldPasswordCheck(){
    let oldPassword = document.getElementById('oldPassword').value;
    let username = document.getElementById('username').value;

    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controller/checker.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('checkPassword=true&username='+username+"&password="+oldPassword);

    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            if(this.responseText == 'true'){
                document.getElementById('err').innerHTML = "Old password matched";
                document.getElementById('err').style.background = green;
                
            }
            else{
                document.getElementById('err').innerHTML = "Old password mismatched";
                document.getElementById('err').style.color = red;
            }
        }
    }
}


function validate(){
    let oldPassword = document.getElementById('oldPassword').value;
    let newPassword = document.getElementById('newPassword').value;
    let confirmNewPassword = document.getElementById('confirmNewPassword').value;
    let err = document.getElementById('err');
    let new_pass_match = document.getElementById('new_pass_match');

    if(newPassword.length < 8 || confirmNewPassword.length < 8 || oldPassword.length == 0){
        err.innerHTML = "passwords must be 8 or more char long/mismatch password";
        return false;
    }
    else if(newPassword != confirmNewPassword){
       err.innerHTML = "New passwords mismatch";
        return false;
    }

    else {
        err.innerHTML = "";
        return true;
    }
}

function newPassValidate(){

    let newPassword = document.getElementById('newPassword').value;
    let confirmNewPassword = document.getElementById('confirmNewPassword').value;
    let new_pass_match = document.getElementById('new_pass_match');

    if(newPassword != confirmNewPassword){
        new_pass_match.innerHTML = "Not matched";
    }
    else{
        new_pass_match.innerHTML = "Matched";
        new_pass_match.style.color = cyan;
    }

}