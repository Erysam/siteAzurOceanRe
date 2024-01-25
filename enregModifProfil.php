<?php
session_start();
require('fonctionsCommunes.php');

var_dump($_SESSION);
if (
    issetNotEmpty($_POST['email']) && issetNotEmpty($_POST['nom']) && issetNotEmpty($_POST['prenom']) && issetNotEmpty($_POST['adresse']) && issetNotEmpty($_POST['cp']) && issetNotEmpty($_POST['ville']) && issetNotEmpty($_POST['tel'])
) {
    $idUserSession = $_SESSION['user']['id'];
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

    if ($pCp == 0 || $pTel == 0) {
        header('Location: profil.php?erreur=erreurNum');
        die("Code postal ou tél erronés.");
    }

    $maCon = connexion();
    $stmt = mysqli_stmt_init($maCon);
    $sqlSelect = "INSERT INTO azurocean.membre (idMembre, email, nom, prenom, adresse, cp, ville, tel, mdp) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, NULL)";


    //NPPT Faire un ?erreur=duplication pour le email avec une verif de doublon voir avec un try catch



    if (issetNotEmpty($_POST['mdp']) && issetNotEmpty($_POST['confirmMdp'])) {

        if (!$_POST['mdp'] === $_POST['confirmMdp']) {
            header('Location: profil.php?erreur=erreurMdp');
            die('passwords différents');
        }

        if (verifMdpCharPhp($mdp)) {
            $mdp = password_hash($_POST['mdp'], PASSWORD_ARGON2ID);
        } else {
            die("erreur 36913");
        }
        $resultMdp; //NPPT : $mMdp doit être initialisé avec le mdp de la BDD recup plus bas

        $stmt = $maCon->prepare("SELECT mdp FROM membre WHERE idMembre = ?");
        $stmt->bind_param(("i"), $idUserSession);
        $stmt->execute();
        $stmt->bind_result($resultMdp);
        $stmt->fetch();
        $stmt->close();

        if (!password_verify($_POST['mdpAncien'], $resultMdp)) {
            mysqli_close($maCon);
            header('Location: profil.php?erreur=erreurMdp');
            die("MDP actuel erronés");
        }

        $stmt = mysqli_stmt_init($maCon);
        $sqlInser = "INSERT INTO azurocean.membre (mdp) VALUES (?)";
        if (mysqli_stmt_prepare($stmt, $sqlInser)) {
            //s'assurer que la préparation de la requête est correcte avant exécution
            mysqli_stmt_bind_param($stmt, "s", $mdp); /* le nbre de s represente le nbre de ? et le s pour des 
            valeurs string dans la table et i pour les valeur int dans la table (le NULL n'est pas à compter dans les i ou s)*/
            try {
                $result = mysqli_stmt_execute($stmt);
                header('Location: profil.php?modif=modifReussie');
                mysqli_close($maCon);
            } catch (mysqli_sql_exception $e) {
                header('Location: profil.php?erreur=erreurMdp');
                die("Une erreur s'est produite lors de l'inscription.");
            }
        }
    }
    mysqli_close($maCon);
    header('Location: profil.php?modif=modifReussie');
} else {
}
