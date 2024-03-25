<?php
require_once('configSession.php'); // différence avec require, require_ once vérifie si le fichier a déjà été inclus si oui, elle ne l inclusq pas de nouveau
require('fonctionsCommunes.php');
include('header.php');
?>

<div class="h4">
    <h4>Après validation du mail d'activation, vous pouvez saisir vos données :</h4>
</div>
<a href="connexion.php">Se connecter</a>

<div class="img-content">
    <div class="imgPhoto">
        <img src="image/sunOdyssey.jpg" alt="bateaux">
    </div>
</div>

<?php

if (!empty($_GET)) {
    if (issetNotEmpty($_GET['mail']) && issetNotEmpty($_GET['cle'])) {
        $idM;
        $actifValid = 1;
        $mail = strip_tags($_GET['mail']);
        $cle = $_GET['cle'];
        $cleRequete;
        $maCon = connexion();
        $stmt = $maCon->prepare("SELECT cle, idMembre FROM membre WHERE email = ?");
        $stmt->bind_param("s", $mail);
        $stmt->execute();
        $stmt->bind_result($cleRequete, $idM);
        $stmt->fetch();
        $stmt->close();
        if ($cle == $cleRequete) {
            $stmt = $maCon->prepare("UPDATE membre SET actif = ? WHERE idmembre = ?");
            $stmt->bind_param("ii", $actifValid, $idM);
            $stmt->execute();
            mysqli_close($maCon);
            header('Location: connexion.php?enregistrement=reussi');
            exit;
        }
    } else {
        mysqli_close($maCon);
        echo "l'activation n'est pas validé, veuillez contactez le support technique : supportt@azurocean.com ";
        exit;
    }
    echo "Le mail d'activation du compte n a pas été validé, Merci de la valider afin de pouvoir activer le compte et vous connecter";
}
include('footer.php')
?>