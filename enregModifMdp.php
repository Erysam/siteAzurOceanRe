<?php
require_once('configSession.php');
require('fonctionsCommunes.php');

if (issetNotEmpty($_POST['email']) && issetNotEmpty($_POST['mdpActuel']) && issetNotEmpty($_POST['mdp']) && issetNotEmpty($_POST['confirmMdp'])) {


    if (!issetNotEmpty($_SESSION['user']['id']) || !issetNotEmpty($_SESSION)) {
        header('Location: connexion.php');
    }
    $idUserSession = $_SESSION['user']['id'];

    // verification de connexion login : email, mdp 
    $pEmail = strip_tags($_POST['email']);
    $pMdpActuel = $_POST['mdpActuel'];


    if (!filter_var($pEmail, FILTER_VALIDATE_EMAIL)) {
        header('Location: profilModifMdp.php?erreur=erreurEmail');
    }

    $resultMdp; // va servir à stocker le mdp recupéé dans la BDD et en vu de le comparer à celui saisie par le user
    $resultEmail;
    $maCon = connexion();
    $stmt = $maCon->prepare("SELECT email, mdp FROM membre WHERE idMembre = ?");
    $stmt->bind_param(("i"), $idUserSession);
    $stmt->execute();
    $stmt->bind_result($resultEmail, $resultMdp);
    $stmt->fetch();


    //verification du mdp actuel et de l'email
    if (!password_verify($pMdpActuel, $resultMdp)) {
        // var_dump($pMdpActuel);
        //  var_dump($resultMdp);
        //    var_dump($resultEmail);
        mysqli_close($maCon);
        header('Location: profilModifMdp.php?erreur=erreurMdp');
    }
    if (!$pEmail === $resultEmail) {
        mysqli_close($maCon);
        header('Location: profilModifMdp.php?erreur=erreurEmail');
    }

    //verification du nouveau mdp et insertion

    $pMdp = $_POST['mdp'];
    $pConfirmMdp = $_POST['confirmMdp'];
    if (!$pMdp === $pConfirmMdp) {
        header('Location: profilModifMdp.php?erreur=erreurMdp2');
    }

    if (verifMdpCharPhp($_POST['mdp'])) {
        $pMdp = password_hash($_POST['mdp'], PASSWORD_ARGON2ID);
    } else {
        mysqli_close($maCon);
        die("erreur 36913");
    }

    $stmt = mysqli_stmt_init($maCon);
    $sqlUpdate = "UPDATE azurocean.membre SET mdp = ? WHERE idMembre = ?";
    if (mysqli_stmt_prepare($stmt, $sqlUpdate)) {
        mysqli_stmt_bind_param($stmt, "si", $pMdp, $idUserSession);

        try {
            $result = mysqli_stmt_execute($stmt);
            $stmt->close();
            mysqli_close($maCon);
            header('Location: profilModifMdp.php?modif=modifReussie');
            //prevoir l envoi d un mail de conf au user
        } catch (mysqli_sql_exception $e) {
            header('Location: profilModifMdp.php?erreur=erreurEmail');
            die(("Erreur modification mdp : " . $e->getMessage()));
        }
        die("Erreur dans la saisie");
    }
}
