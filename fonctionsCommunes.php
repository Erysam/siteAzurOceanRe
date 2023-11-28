<?php

function issetEmpty($var1)
{
    $IssEmpt = isset($var1) && !empty($var1);
    return $IssEmpt;
}


function connexion()
{
    $conx = mysqli_connect("localhost", "root", "") or
        die("connection localhost impossible (0)");
    mysqli_select_db($conx, "azurocean") or die("pb avec BD (1)");
    return $conx;
}
