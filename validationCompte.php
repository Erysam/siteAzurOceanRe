<?php
require_once('configSession.php'); // différence avec require, require_ once vérifie si le fichier a déjà été inclus si oui, elle ne l inclusq pas de nouveau
require('fonctionsCommunes.php');
include('header.php');
?>

<div class="h4">
    <h4>Après validation du mail d'activation, vous pouvez saisir vos données :</h4>
</div>

<div class="img-content">
    <div class="imgPhoto">
        <img src="image/sunOdyssey.jpg" alt="bateaux">
    </div>
</div>

<?php

if (!empty($_GET)) {
    if (issetNotEmpty($_GET['mail']) && issetNotEmpty($_GET['cle'])) {
        $mail = strip_tags($_GET['mail']);
        $cle = $_GET['cle'];
        $cleRequete;
        $maCon = connexion();
        $stmt = $maCon->prepare("SELECT cle FROM membre WHERE email = ?");
        $stmt->bind_param("s", $mail);
        $stmt->execute();
        $stmt->bind_result($cleRequete);
        $stmt->fetch();
        $stmt->close();
        if ($cle == $cleRequete) {
            mysqli_close($maCon);
            header('Location: connexion.php?enregistrement=reussi');
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