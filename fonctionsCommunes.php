<?php

function issetNotEmpty($var1)
{
    $IssNoEmpt = isset($var1) && !empty($var1);
    return $IssNoEmpt;
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


function isFiveNumber($var1) // pour siteNautique.php pour verif cp
{
    $isFiveNum = is_numeric($var1) && (strlen($var1) === 5); //strlen utilisé avce l égalité stricte va vérifier q'il y a bien 5 char et isNumeric que ce sont bien des nombres
    return $isFiveNum;
}


function affichePhoto($photoPath)
{
    if (isset(($photoPath))) {
        // recup le type MIME de l'image
        $imageInfo = getimagesize($photoPath);
        $contentType = $imageInfo['mime'];

        // envoi l en-tête http avec type de contenu
        ob_start();
        readfile($photoPath);
        $imageContent = ob_get_clean();

        // Lit contenu de l'image et l'envoie au navigateur
        return array(
            'contentType' => $contentType,
            'content' => $imageContent
        );
    } else {
        return false;
    }
}
