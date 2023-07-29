function checkUsername(){
    let username = document.getElementById('username').value;
    if(username.length == 0) {
        document.getElementById('err_msg').innerHTML = "";
        return;
    }
    
    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controller/checker.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('checkUser=true&username='+username);

    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            if(this.responseText == 'false'){
                document.getElementById('err_msg').innerHTML = "User not found";
            }
            else{
                document.getElementById('err_msg').innerHTML = "";
            }
        }
    }
}


function validate(){
    let password = document.getElementById('password').value;
    let username = document.getElementById('username').value;

    // no validation needed

    return true;
}