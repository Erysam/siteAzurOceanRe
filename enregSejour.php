<?php
require_once('configSession.php');
require('fonctionsCommunes.php');
require("header.php");
require_once 'UpLoadFileException.php';

if (!issetNotEmpty($_SESSION['user']['id'])) {
    header('Location: connexion.php');
    exit;
}

$idUser = $_SESSION['user']['id'];
$photoSej1 = "test";
$photoSej2;
$photoSej3;


if (issetNotEmpty($_FILES['photo1']) || issetNotEmpty($_FILES['photo2']) || issetNotEmpty($_FILES['photo3'])) {
    try {
        for ($i = 0; $i < 3; $i++) {
            $compteur = $i + 1;
            $codeErreur = $_FILES['photo' . $compteur]['error'][0];
            if ($codeErreur === 0) {
                //traitement nom fichier
                $originalFileName = $_FILES['photo' . $compteur]['name'][0]; //nom original, ne servant qu'à extraire l'extension du fichier dans PATHINFO_EXT ligne 30
                $nameTab = "photo" . $compteur;
                $extensionName = pathinfo($originalFileName, PATHINFO_EXTENSION);
                $randomBytes = bin2hex(random_bytes(8));
                $uniqueFileName = $nameTab . '_' . $randomBytes . '.' . $extensionName;
                $fileTmpPath = $_FILES[$nameTab]['tmp_name'][0]; //chemin temporaire

                //traitement type de fichier acceptés
                $typeFile = $_FILES[$nameTab]['type'][0];
                $allowedImagesTypes = ['image/jpg', 'image/jpeg', 'image/png'];

                if (!in_array($typeFile, $allowedImagesTypes)) {
                    echo "Erreur : Seuls les fichiers JPEG et PNG sont autorisés.";
                    continue;
                }
                //taille max de fichier accepté
                $maxFileSize = 2 * 1024 * 1024;
                $sizeFile = $_FILES[$nameTab]['size'][0];
                if ($sizeFile > $maxFileSize) {
                    header('Location: formEnregSejour.php?erreur===tailleMaxFichierAtteinte');
                }
                $destinationFile = "C:/laragon/www/siteAzurOceanRe/azurOceanRe_imagesUsersBateaux/" . $uniqueFileName;
                move_uploaded_file($fileTmpPath, $destinationFile);

                ${'photoSej' . ($compteur)} = $destinationFile;
            } else {
                throw new UpLoadFileException($_FILES['file']['error']); //je lance et créé l'objet exception en passant le param de class
            }
        }
    } catch (UpLoadFileException $e) {
        echo "erreur téléchargement" . $e->getMessage(); // j attrape l'exception et renvoie le message correspondant de la classe
    }
}


//idBat adresse cp ville prix description
var_dump($_POST);

if (issetNotEmpty($_POST['idBat']) && ($_POST['typeNav']) && ($_POST['intitule']) && issetNotEmpty($_POST['description']) && ($_POST['dateDeb']) && ($_POST['dateFin']) && issetNotEmpty($_POST['adresse']) && issetNotEmpty($_POST['cp']) && issetNotEmpty($_POST['ville']) && issetNotEmpty($_POST['prix'])) {
    $sIdBat = ($_POST['idBat']);
    $sTypeNav = ($_POST['typeNav']);
    $sIntitule = ($_POST['intitule']);
    $sDescription = ($_POST['description']);
    $sDateDebut = ($_POST['dateDeb']);
    $sDateFin = ($_POST['dateFin']);
    $sAdresse = ($_POST['adresse']);
    $sCp = ($_POST['cp']);
    $sVille = ($_POST['ville']);
    $sPrix = ($_POST['prix']);
    $maCon = connexion();
    $sql = mysqli_stmt_init($maCon);
    $sqlInsert = "INSERT INTO sejour idBateau, typeNavSej, intituleSej, descriptionSej, dateDebutSej, dateFinSej, adresseSej, cpSej, villeSej, prixSej, photoSej1, photoSej2, photoSej3 VALUE (NULL,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    if (mysqli_stmt_prepare($stmt, $sqlInsert)) {
        mysqli_stmt_bind_param($stmt, "iisssssisisss", $sIdBats, $TypeNav, $sIntitule, $sDescription, $sDateDebut, $sDateFin, $sAdresse, $sCp, $sVille, $sPrix, $photoSej1, $photoSej2, $photoSej3);
        try {
            $result = mysqli_stmt_execute($stmt);
            mysqli_close($maCon);
            header('Location: formEnregSejour.php?enreg=enregReussi');
        } catch (mysqli_sql_exception $e) {
            mysqli_close($maCon);
            header("Location:formEnregSejour.php?erreur=erreurEnreg");
        }
    }
}
