<?php
//NPPT faudra gerer les noms de bateaux poiur qu ils soient unique par propriétaire
$sessionLifetime = 1800; //  durée de la session 30mn 60sec x 30mn = 1800 sec
session_set_cookie_params($sessionLifetime);
session_start();

require('fonctionsCommunes.php');
include('header.php');


if (!issetNotEmpty($_SESSION['user']['id']) || !issetNotEmpty($_SESSION)) {
    header('Location: connexion.php');
}
$idUserSession = $_SESSION['user']['id'];

$pathPhoto1;
$pathPhoto2;
$pathPhoto3;

if (issetNotEmpty($_FILES['photo1']) && issetNotEmpty($_FILES['photo2']) && issetNotEmpty($_FILES['photo3'])) {

    /*le tableau $_FILES a 3 index (photo1, photo2, photo3) avec un tab de 6 dans chacun des 3 et dans chacun des tab de 6 
   (avec nom du tab, size....)il y a un tab de 1 avec la donnée qu on cherche, pour cette raison l'index recherché est toujours 0*/
    $compteurDerreurParPhoto = [0, 0, 0]; //VOIR COMMENT GERER LES AUTRES ERREURS PLUS TARD

    for ($i = 0; $i < 3; $i++) {

        if ($codeErreur == 0) {
            $compteur = $i + 1;
            $codeErreur = $_FILES['photo' . $compteur]['error'][0];

            // randomBytes() permet de générer un nom de fichier unique
            //pathinfo() retourne un tableau associatif contenant le nom du fichier, le nom du répertoire, l'extension du fichier
            $originalFileName = $_FILES['photo' . $compteur]['name'][0];
            $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);
            $randomBytes = bin2hex(random_bytes(8));
            //var_dump('RANDOMBYTES' . $randomBytes);

            $uniqueFileName = 'photo' . $compteur . $randomBytes . '.' . $extension;
            //$i est simplement là pour suivre l'iteration
            //le nom du fichier sera une serie de chiffre et lettre generés par randomBytes suivi de l'extension (.jpg)
            // Les autres informations du fichier
            $fileTmpName = $_FILES['photo' . $compteur]['tmp_name'][0]; //chemin temporaire avant d'enregistrer le fichier
            $fileSize = $_FILES['photo' . $compteur]['size'][0];
            $fileType = $_FILES['photo' . $compteur]['type'][0];


            // In array Vérifier si les param(JPEG ou PNG) dans la variable $allowedIm... sont bien dans le tableau filetype(dans lequel il y a  le type de fichier image)
            $allowedImageTypes = ['image/jpeg', 'image/png'];
            //cherche l'aiguille dans la botte de foin
            if (!in_array($fileType, $allowedImageTypes)) {
                echo "Erreur : Seuls les fichiers JPEG et PNG sont autorisés.";
                continue; // Passer au fichier suivant
            }

            $maxFileSize = 2 * 1024 * 1024; // taille max 2MO
            // Vérifier la taille du fichier
            if ($fileSize > $maxFileSize) {
                echo "Erreur : La taille du fichier dépasse la limite autorisée (2 Mo).";
                continue; // Passer au fichier suivant
            }

            $destination = "C:/laragon/www/siteAzurOceanRe/azurOceanRe_imagesUsersBateaux/" . $uniqueFileName;
            move_uploaded_file($fileTmpName, $destination);
            ${"pathPhoto" . ($compteur)} = $destination;
            $compteurDerreurParPhoto[$i] = 1;
            // ${"pathPhoto" . ($compteur)} = $destination;interpolation de variables (variable variable ou variable dynamique)
        } else {
            echo ('erreur de téléchargement');
        }

        echo "Tous les fichiers ont été téléchargés avec succès.";
        var_dump('TABerreurs' . $compteurDerreurParPhoto);
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
    $sqlInser = "INSERT INTO azurocean.bateau (idBateau, idProp, nomBateau, adresseSite, cpSite, villeSite, typeBat, typeNav, taille, places, description, photo1, photo2, photo3) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if (mysqli_stmt_prepare($stmt, $sqlInser)) {
        //s'assurer que la préparation de la requête est correcte avant exécution

        mysqli_stmt_bind_param($stmt, "issisiiiissss", $idUserSession, $nomB, $adresseB, $cpB, $villeB, $typeB, $typeNavB, $tailleB, $placesB, $descrptB, $pathPhoto1, $pathPhoto2, $pathPhoto3);

        try {
            $result = mysqli_stmt_execute($stmt);
            mysqli_close($maCon);
            // Si l'insertion réussit, redirigez vers la page de connexion
            //if ($result) {
            header('Location: formEnregBateau.php?modif=modifReussie'); //le exit ou die n a pas sa place, car header termine le script php automatiquement 


            //} 

        } catch (mysqli_sql_exception $e) { //$e instance de classe mysqli-sql-exception pour acceder à la methode getMessage() afin d avoir un piste sur l'erreur.)

            // $e types erreurs lors de l'exécution (genre string à la place de int...)
            mysqli_close($maCon);
            header('Location: formEnregBateau.php?erreur=erreur1');
            die("Une erreur s'est produite lors de l'inscription.");
        }
        // on peut var_dump le code erreur de l exception avec $e->getMessage());
    }
}



include('footer.php');
