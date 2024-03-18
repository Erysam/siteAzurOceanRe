<?php

require_once('configSession.php');
require('fonctionsCommunes.php');

if (issetNotEmpty($_POST['email']) && issetNotEmpty($_POST['mdpActuel'])) {


    if (!issetNotEmpty($_SESSION['user']['id']) || !issetNotEmpty($_SESSION)) {
        header('Location: connexion.php');
    }
    $idUserSession = $_SESSION['user']['id'];

    // verification de connexion login : email, mdp 
    $pEmail = strip_tags($_POST['email']);
    $pMdpActuel = $_POST['mdpActuel'];


    if (!filter_var($pEmail, FILTER_VALIDATE_EMAIL)) {
        header('Location: profilModifMail.php?erreur=erreurEmail');
    }

    $resultMdp; // va servir à stocker le mdp recupéé dans la BDD et en vu de le comparer à celui saisie par le user
    $maCon = connexion();
    $stmt = $maCon->prepare("SELECT mdp FROM membre WHERE idMembre = ?");
    $stmt->bind_param(("i"), $idUserSession);
    $stmt->execute();
    $stmt->bind_result($resultMdp);
    $stmt->fetch();

    if (!password_verify($pMdpActuel, $resultMdp)) {
        mysqli_close($maCon);
        header('Location: profilModifMail.php?erreur=erreurMdp');
    }

    $stmt = mysqli_stmt_init($maCon);
    $sqlUpdate = "UPDATE azurocean.membre SET email = ? WHERE idMembre = ?";
    if (mysqli_stmt_prepare($stmt, $sqlUpdate)) {
        mysqli_stmt_bind_param($stmt, "si", $pEmail, $idUserSession);

        try {
            $result = mysqli_stmt_execute($stmt);
            $stmt->close();
            mysqli_close($maCon);
            header('Location: profilModifMdp.php?modif=modifReussie');
            //envoi d 'un email pour informer de la modification aux deux emails(ancien et nouveau avec la focntion mail) 
            //la fonction mail prend en param : <adresse du destinataire>,<titre du mail>,<corps du message>,<entête>);
            mail($pEmail, "modification de votre email", "Nous vous informons de la modification de votre email", "From emailazurocean888@gmail.com\r\nReply-To:contact@azurocean.fr");
            //\r\n signifie passer une ligne pour le protocole SMTP
        } catch (mysqli_sql_exception $e) {
            header('Location: profilModifMail.php?erreur=erreurEmail');
            die(("Erreur modification mdp : " . $e->getMessage()));
        }
        die("Erreur de mise à jour du nouvel email");
    }
}
