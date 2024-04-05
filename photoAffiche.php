<?php
session_start();
include('fonctionsCommunes.php');

//une méthode appelée "serveur d'image sécurisé" envoie un script php au navigateur plutot que de charger les images dans le navigateur

if (issetNotEmpty($_GET["idSej"])) {

    $sPhoto1;
    $sPhoto2;
    $sPhoto3;

    $idSej = $_GET["idSej"];
    echo var_dump($_GET["idSej"]);
    $maCon = connexion();
    $stmt = mysqli_stmt_init($maCon);
    $sqlSelect = "SELECT photo1, photo2, photo3 FROM sejour WHERE idSej = ?";
    if (mysqli_stmt_prepare($stmt, $sqlSelect)) {
        mysqli_stmt_bind_param($stmt, 'i', $idSej);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) < 0) {
            mysqli_stmt_bind_result($stmt, $sPhoto1, $sPhoto2, $sPhoto3);
        }
    }


    $photoPath = $_GET["photoPath"];
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
