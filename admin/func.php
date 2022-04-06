<?php
function validate($str)
{
    $str = str_replace("'", '&#39;', $str);
    $str = str_replace('"', '&quot;', $str);
    $str = str_replace('<', '&lt;', $str);
    $str = str_replace('>', '&gt;', $str);
    return $str;
}

function encodeID($id)
{
    $id += 1000000;
    return base_convert($id, 10, 36);
}

function decodeID($id)
{
    $id = base_convert($id, 36, 10);
    $id -= 1000000;
    return $id;
}

function isEmail($email){
    if(!preg_match('^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$',$email)){
        return false;
    }
    else {
        return true;
    }
}
function isPhone($phone){
    if(!preg_match('/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/',$phone)){
        return false;
    }
    else {
        return true;
    }
}

