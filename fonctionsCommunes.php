<?php

function issetNotEmpty($var1)
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



function verifMdpCharPhp($password)
{
    // Au moins une majuscule
    $majusculeRegex = '/[A-Z]/';
    // Au moins un chiffre
    $chiffreRegex = '/[0-9]/';
    // Au moins un caractère spécial (on peut en ajouter ou en retirer)
    $caractereSpecialRegex = '/[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/';

    if (!preg_match($majusculeRegex, $password) || !preg_match($chiffreRegex, $password) || !preg_match($caractereSpecialRegex, $password)) {
        echo "Le mot de passe doit contenir une majuscule, un chiffre et un caractère spécial.";
        return false;
    }

    return true;
}
