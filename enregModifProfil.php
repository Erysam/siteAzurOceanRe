<?php

require('fonctionsCommunes.php');


if (
    issetNotEmpty($_POST['email']) && issetNotEmpty($_POST['nom']) && issetNotEmpty($_POST['prenom'])
    && issetNotEmpty($_POST['adresse']) && issetNotEmpty($_POST['cp']) && issetNotEmpty($_POST['ville']) && issetNotEmpty($_POST['tel']) && issetNotEmpty($_POST['$iduserSession'])
) {
    $iduserSession = $_POST['$iduserSession'];
    $pEmail = strip_tags($_POST['email']);

    if (!filter_var($pEmail, FILTER_VALIDATE_EMAIL)) {
        header('Location: profil.php?erreur=erreurEmail');
        die('email invalide');
    };
    $pNom = strip_tags($_POST['nom']);
    $pPrenom = strip_tags($_POST['prenom']);
    $pAdresse = strip_tags($_POST['adresse']);
    $pCp = strip_tags($_POST['cp']);
    $pCp = (int)$pCp;
    $pVille = strip_tags($_POST['ville']);
    $pTel = strip_tags($_POST['tel']);
    $pTel = (int)$pTel;

    if ($cp == 0 || $tel == 0) {
        header('Location: profil.php?erreur=erreurNum');
        die("Code postal ou tél erronés.");
    }




    if (!password_verify($_POST['mdpAncien'], $mMdp)) {
        die("Identifiant ou MDP erronés");
    }

    if (issetNotEmpty($_POST['mdp'])) {
        $maCon = connexion();
        $stmt = mysqli_stmt_init($maCon);
        $sqlSelect = "SELECT mdp FROM membre WHERE idMembre = $iduserSession";
    }
}
