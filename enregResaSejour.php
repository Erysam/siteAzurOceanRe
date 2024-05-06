<?php
require_once('configSession.php');
include('header.php');
include('fonctionsCommunes.php');

$idSejResa;
$idUserSession;
if (!issetNotEmpty($_SESSION)) {
    header('Location: connexion.php?resa=emptyID');
    exit;
}

$idUserSession = $_SESSION['user']['id'];
$mail = $_SESSION['user']['email'];


$messageSejourPropMail = 'Vous avez reservé un séjour en bateau sur notre site. Vous pouvez consulter la liste sur :
http://localhost/siteAzurOceanRe//listReservations.php
 
---------------
Ceci est un mail automatique, Merci de ne pas y répondre.';


if ($_POST['idSej']) {
    $idSejResa = $_POST['idSej'];
    $passager = $_POST['nbPassagers'];
    $permis = $_POST['permisBat'];
    $maCon = connexion();
    $stmt = mysqli_stmt_init($maCon);
    $sqlInsert = "INSERT INTO reservation(idReservation, idSej, idMembre, passagers, permisBat) VALUES (NULL, ?, ?, ?, ?)";
    if (mysqli_stmt_prepare($stmt, $sqlInsert)) {
        mysqli_stmt_bind_param($stmt, "iiis", $idSejResa, $idUserSession, $passager, $permis);

        try {
            mysqli_stmt_execute($stmt);

            $mailInfo = mail($mail, "Séjour réservé", "From emailazurocean888@gmail.com\r\nReply-To:emailazurocean888@gmail.com ", $messageSejourPropMail);
            mysqli_stmt_close($stmt);

            $stmt = mysqli_stmt_init($maCon);
            $reservationStatus = 1;
            $sqlUpdate = "UPDATE sejour SET reservation = ? WHERE idSejour = ?";
            if (mysqli_stmt_prepare($stmt, $sqlUpdate)) {
                mysqli_stmt_bind_param($stmt, "si", $reservationStatus, $idSejResa);
                $result = mysqli_stmt_execute($stmt);
                $stmt->close();
                mysqli_close($maCon);
                header('Location: index.php?sejourResa=reserve');
                exit;
            }
        } catch (mysqli_sql_exception $e) {
            if (mysqli_errno($maCon) == 1062) {
                mysqli_close($maCon);
                // Redir vers le form avec get erreur pour expliquer au user l'erreur (script php sur le form)
                header('Location: sejours.php?sejourResa=duplication');
                exit;
            }
        }
    }
} else {
    header('Location: sejours.php?resa=emptyResa');
    exit;
}
