function checkEmailExist(){
    let email = document.getElementById('email').value;
    if(email.length == 0) {
        document.getElementById('email_err').innerHTML = "";
        return;
    }
    
    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controller/checker.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('checkEmail=true&email='+email);

    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            if(this.responseText == 'true'){
                document.getElementById('email_err').innerHTML = "Account found";
                document.getElementById('email_err').style.color = "green";

            }
            else{
                document.getElementById('email_err').innerHTML = "Account not found";
                document.getElementById('email_err').style.color = "red";
            }
        }
    }
}