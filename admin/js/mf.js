
function turn_on() {

    document.getElementById('from-add').style.display = "block";
    document.getElementById('main').style.filter = "blur(14px)";
}
function turn_off() {
    document.getElementById('from-add').style.display = "none";
    document.getElementById('main').style.filter = "blur(0px)";
}