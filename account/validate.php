<?php
function isPassword ($pwd) {
    if (!preg_match("#.*^(?=.{6,30})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $pwd)) {
        return false;
    }
    else {
        return true;
    }
}

function isEmailVlr ($email) {
    if ((!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email))) {
        return false;
    }

    return true;
}

function isPhone1 ($phone) {
    if ((!preg_match("/([\+84|84|0]+(3|5|7|8|9|1[2|6|8|9]))+([0-9]{8})\b/", $phone))) {
        return false;
    }

    return true;
}
function isNameNE ($name) {
    if ((!preg_match("/^[a-zA-Z0-9]*$/ix", $name))) {
        return false;
    }

    return true;
}

// function validate ($str) {
//     $str = str_replace("'", '&#39;', $str);
//     $str = str_replace('"', '&quot;', $str);
//     $str = str_replace('<', '&lt;', $str);
//     $str = str_replace('>', '&gt;', $str);
//     return $str;
// }