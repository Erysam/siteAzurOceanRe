<?php
require_once('configSession.php');
include('header.php');
include('fonctionsCommunes.php');

$idUserSession;
if (!issetNotEmpty($_SESSION)) {
    header('Location: connexion.php?resa=emptyID');
    exit;
} else {
    $idUserSession = $_SESSION['user']['id'];
}

$messageSejourPropMail = '
Le séjour, que vous avez proposé, a été réservé. Vous pouvez consulter la liste sur :
http://localhost/siteAzurOceanRe/listSejourProp.php?
 
---------------
Ceci est un mail automatique, Merci de ne pas y répondre.';


if ($_POST['idSej']) {
    $idSejResa = $_POST['idSej'];
    $maCon = connexion();
    $stmt = mysqli_stmt_init($maCon);
    $sqlInsert = "INSERT INTO arzurocean.reservation(idReservation, idSej, idMembre) VALUE (NULL, ?, ?)";
    if (mysqli_stmt_prepare($stmt, $sqlInsert)) {
        mysqli_stmt_bind_param($stmt, "iii", $idSejResa, $idUserSession);
    }
    try {
        mysqli_stmt_execute($stmt);

        $mailInfo = mail($mail, "Le séjour que vous avez proposé a été réservé", "From emailazurocean888@gmail.com\r\nReply-To:emailazurocean888@gmail.com ", $messageSejourPropMail);
        mysqli_stmt_close($stmt);

        $stmt = mysqli_stmt_init($maCon);
        $sqlUpdate = "UPDATE azurocean.sejour SET reservation = ? WHERE idMembre = ?";
        if (mysqli_stmt_prepare($stmt, $sqlUpdate)) {
            mysqli_stmt_bind_param($stmt, "si", 1, $idUserSession);
        }
        $result = mysqli_stmt_execute($stmt);
        $stmt->close();
        mysqli_close($maCon);
        header('Location: index.php?sejourResa=reserve');
    } catch (mysqli_sql_exception $e) {
        if (mysqli_errno($maCon) == 1062) {
            mysqli_close($maCon);
            // Redir vers le form avec get erreur pour expliquer au user l'erreur (script php sur le form)
            header('Location: séjour.php?sejourResa=duplication');
        }
    }
}



    /*
   Faire une condition afin que les reservations en 1dans la col reservation dans la table sejour ne s'affiche plus dans les recherches.
   voi
*/
