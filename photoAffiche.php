<?php
session_start();
include('fonctionsCommunes.php');

if (issetNotEmpty($_GET["idSej"])) {

    $photoPath = $_GET["idSej"];

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
