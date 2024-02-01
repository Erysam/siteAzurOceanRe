<?php


$sessionLifetime = 1800; //  durée de la session 30mn 60sec x 30mn = 1800 sec
session_set_cookie_params($sessionLifetime);
session_start();
require('fonctionsCommunes.php');
include('header.php');


if (!issetNotEmpty($_SESSION['user']['id']) || !issetNotEmpty($_SESSION)) {
    header('Location: connexion.php');
}
$idUserSession = $_SESSION['user']['id'];

$destinationPhoto1;
$destinationPhoto2;
$destinationPhoto3;

if (issetNotEmpty($_FILES['photos']) && is_array($_FILES['photos']['name'])) {

    $totalFiles = count($_FILES['photos']['name']);
    if ($totalFiles <= 3) {
        $maxFileSize = 2 * 1024 * 1024; // taille max 2MO

        for ($i = 0; $i < $totalFiles; $i++) {
            // uniqid() permet de générer un nom de fichier unique
            //pathinfo() retourne un tableau associatif contenant le nom du fichier, le nom du répertoire, l'extension du fichier, ...Je ne veux pas le nom d origine, juste l extension
            $originalFileName = $_FILES['photos']['name'][$i];
            $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);
            $randomBytes = bin2hex(random_bytes(8));
            $uniqueFileName = 'photo_' . $randomBytes . '.' . $extension;
            //$i est simplement là pour suivre l'iteration
            //le nom du fichier sera une serie de chiffre et lettre generés par uniqid suivi de l'extension (.jpg)
            // Les autres informations du fichier
            $fileTmpName = $_FILES['photos']['tmp_name'][$i]; //chemin temporaire avant d'enregistrer le fichier
            $fileSize = $_FILES['photos']['size'][$i];
            $fileType = $_FILES['photos']['type'][$i];

            // Vérifier le type de fichier (JPEG ou PNG)
            $allowedImageTypes = ['image/jpeg', 'image/png'];
            if (!in_array($fileType, $allowedImageTypes)) {
                echo "Erreur : Seuls les fichiers JPEG et PNG sont autorisés.";
                continue; // Passer au fichier suivant
            }


            // Vérifier la taille du fichier
            if ($fileSize > $maxFileSize) {
                echo "Erreur : La taille du fichier dépasse la limite autorisée (2 Mo).";
                continue; // Passer au fichier suivant
            }


            $destinationPhoto = 'Documents/azurOceanRe_imagesUsersBateaux/' . $uniqueFileName;
            move_uploaded_file($fileTmpName, $destination);
            ${"destinationPhoto" . ($i + 1)} = $destination; //interpolation de variables (variable variable ou variable dynamique)
        }

        echo "Tous les fichiers ont été téléchargés avec succès.";
    } else {
        echo "Aucun fichier n'a été téléchargé.";
    }
}

if (
    issetNotEmpty($_POST['nomBat']) && issetNotEmpty($_POST['adresse']) && issetNotEmpty($_POST['cp']) && issetNotEmpty($_POST['ville'])
    && issetNotEmpty($_POST['typeBat']) && issetNotEmpty($_POST['typeNav']) && issetNotEmpty($_POST['taille'])
    && issetNotEmpty($_POST['places']) && issetNotEmpty($_POST['descript'])
) {
    $nomB = $_POST['nomBat'];
    $adresseB = $_POST['adresse'];
    $cpB = $_POST['cp'];
    $villeB = $_POST['ville'];
    $typeB = $_POST['typeBat'];
    $typeNavB = $_POST['typeNav'];
    $tailleB = $_POST['taille'];
    $placesB = $_POST['places'];
    $descrptB = $_POST['descript'];

    $maCon = connexion();
    $stmt = mysqli_stmt_init($maCon);
    $sqlInser = "INSERT INTO azurocean.bateau (idBateau, idProp, nomBateau, adresseSite, cpSite, villeSite, typeBateau, typeNav, taille, places, description, ) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if (mysqli_stmt_prepare($stmt, $sqlInser)) {
        //s'assurer que la préparation de la requête est correcte avant exécution

        mysqli_stmt_bind_param($stmt, "issisiiiiss", $idUserSession, $nomB, $adresseB, $cpB, $villeB, $typeB, $typeNavB, $tailleB, $placesB, $descrptB, $destinationPhoto1, $destinationPhoto2, $destinationPhoto3); /* le nbre de s represente le nbre de ? et le s pour des 
    valeurs string dans la table et i pour les valeur int dans la table (le NULL n'est pas à compter dans les i ou s)*/

        try {
            $result = mysqli_stmt_execute($stmt);

            // Si l'insertion réussit, redirigez vers la page de connexion
            //if ($result) {
            header('Location: formEnregBateau.php?modif=modifReussie'); //le exit ou die n a pas sa place, car header termine le script php automatiquement 
            mysqli_close($maCon);

            //} 

        } catch (mysqli_sql_exception $e) { //$e instance de classe mysqli-sql-exception pour acceder à la methode getMessage() afin d avoir un piste sur l'erreur.)

            // $e types erreurs lors de l'exécution (genre string à la place de int...)
            mysqli_close($maCon);
            header('Location: formEnregBateau.php?erreur=duplication');
            die("Une erreur s'est produite lors de l'inscription.");
        }
        // on peut var_dump le code erreur de l exception avec $e->getMessage());
    }
}



include('footer.php');
