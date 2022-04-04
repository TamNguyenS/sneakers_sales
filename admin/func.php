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
