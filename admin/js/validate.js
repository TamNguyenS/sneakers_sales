
function checkEmail(email) {
    regularEmail ='^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$';
    if(!preg_match(regularEmail, email)){
        return false;
    }
    else{
        return true;
    }
}
function checkPassword(password) {

}