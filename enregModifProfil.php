<?php
require_once('configSession.php');
require('fonctionsCommunes.php');

if (
    issetNotEmpty($_POST['email']) && issetNotEmpty($_POST['nom']) && issetNotEmpty($_POST['prenom']) && issetNotEmpty($_POST['adresse'])
    && issetNotEmpty($_POST['cp']) && issetNotEmpty($_POST['ville']) && issetNotEmpty($_POST['tel']) && issetNotEmpty($_POST['mdpActuel'])
) {

    if (!issetNotEmpty($_SESSION)) {
        header('Location: connexion.php');
    }
    if (!issetNotEmpty($_SESSION['user']['id'])) {
        header('Location: connexion.php');
    }
    $idUserSession = $_SESSION['user']['id'];
    $pEmail = strip_tags($_POST['email']);

    if (!filter_var($pEmail, FILTER_VALIDATE_EMAIL)) {
        header('Location: profil.php?erreur=erreurEmail');
    };

    $pNom = strip_tags($_POST['nom']);
    $pPrenom = strip_tags($_POST['prenom']);
    $pAdresse = strip_tags($_POST['adresse']);
    $pCp = strip_tags($_POST['cp']);
    $pCp = (int)$pCp;
    $pVille = strip_tags($_POST['ville']);
    $pTel = strip_tags($_POST['tel']);
    $pTel = (int)$pTel;
    $pMdpActuel = $_POST['mdpActuel'];

    if ($pCp == 0 || $pTel == 0) {
        header('Location: profil.php?erreur=erreurNum');
    }

    $resultMdp; // va servir à stocker le mdp recupéé dans la BDD et en vu de le comparer à celui saisie par le user

    $maCon = connexion();
    $stmt = $maCon->prepare("SELECT mdp FROM membre WHERE idMembre = ?");
    $stmt->bind_param(("i"), $idUserSession);
    $stmt->execute();
    $stmt->bind_result($resultMdp);
    $stmt->fetch();
    $stmt->close();

    //verification du mdp actuel
    if (!password_verify($pMdpActuel, $resultMdp)) {
        mysqli_close($maCon);
        header('Location: profil.php?erreur=erreurMdp');
    }


    $stmt = mysqli_stmt_init($maCon);
    $sqlUpdate = "UPDATE azurocean.membre SET email = ?, nom = ?, prenom = ?, adresse = ?, cp = ?, ville = ?, tel = ? WHERE idMembre = ?";

    if (mysqli_stmt_prepare($stmt, $sqlUpdate)) {
        mysqli_stmt_bind_param($stmt, "ssssisii", $pEmail, $pNom, $pPrenom, $pAdresse, $pCp, $pVille, $pTel, $idUserSession);

        try {
            $result = mysqli_stmt_execute($stmt);
            mysqli_close($maCon);
            header('Location: profil.php?modif=modifReussie');
        } catch (mysqli_sql_exception $e) {
            if (mysqli_errno($maCon) == 1062) {
                mysqli_close($maCon);
                header('Location: profil.php?erreur=erreurEmail');
            }
            die("Erreur dans la saisie");
            //voir si on renvoie le code erreur
        }
    }

    mysqli_close($maCon);
    header('Location: profil.php?modif=modifReussie');
} else {
    die("Erreur dans la saisie");
}
