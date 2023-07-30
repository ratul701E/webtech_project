function validatePost(){
    let post_err = document.getElementById('post_err');
    let title = document.getElementById('title').value; 
    let body = document.getElementById('body').value; 

    if(title.length < 5){
        post_err.innerHTML ="Title is too short";
        post_err.style.color ="red";
        return false;
    }
    else if(body.length < 3){
        post_err.innerHTML ="Body is too short";
        post_err.style.color ="red";
        return false;
    }

    return true;
}