function validate(){
    let err = document.getElementById('err');
    let title = document.getElementById('title').value; 
    let body = document.getElementById('body').value; 

    if(title.length < 5){
        err.innerHTML ="Title is too short";
        err.style.color ="red";
        return false;
    }
    else if(body.length < 3){
        err.innerHTML ="Body is too short";
        err.style.color ="red";
        return false;
    }

    return true;

}