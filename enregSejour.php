<?php
require_once('configSession.php');
require('fonctionsCommunes.php');
require("header.php");

if (!issetNotEmpty($_SESSION['user']['id'])) {
    header('Location: connexion.php');
    exit;
}

$idUser = $_SESSION['user']['id'];
$photoSej1;
$photoSej2;
$photoSej3;
$compteur = $i + 1;
$codeErreur = $_FILES['photo' . $compteur]['error'][0];

if (issetNotEmpty($_FILES['photo1']) || issetNotEmpty($_FILES['photo2']) || issetNotEmpty($_FILES['photo3']) && $codeErreur == 0) {
    for ($i = 0; $i < 3; $i++) {
    }
}
