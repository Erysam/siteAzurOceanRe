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

//permet d afficher l image dans le navigateur par un script php sans avoir à passer par l url (+ sécurisé)
function affichePhoto($photoPath)
{
    if (file_exists($photoPath)) {
        // recup le type MIME de l'image
        $imageInfo = getimagesize($photoPath);
        $contentType = $imageInfo['mime'];

        // envoi l en-tête http avec type de contenu
        header("Content-type: $contentType");

        // Lit contenu de l'image et l'envoie au navigateur
        readfile($photoPath);
    } else {
        echo "Image not found.";
    }
}
