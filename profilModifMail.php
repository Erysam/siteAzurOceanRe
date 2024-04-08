<?php

require_once('configSession.php');
require('header.php');
require('fonctionsCommunes.php');

if (!issetNotEmpty($_SESSION)) {
    header('Location: connexion.php');
}

//Si le user n'est pas deconnecté par le $sessionLifeTime ou autre
if (!issetNotEmpty($_SESSION['user']['id'])) {
    header('Location: connexion.php');
}

if (isset($_GET['modif']) && $_GET['modif'] === 'modifReussie') {
    echo ('Modification reussie.');
}

if (isset($_GET['erreur']) && $_GET['erreur'] === 'erreurMdp') {
    echo ('Veuillez saisir un password valide.');
}

if (isset($_GET['erreur']) && $_GET['erreur'] === 'erreurEmail') {
    echo ("Veuillez saisir un format d'email valide.");
}


$idUserSession = $_SESSION['user']['id'];
$mEmail;


$maCon = connexion(); //methode pour acceder à ma BDD
$stmt = mysqli_stmt_init($maCon);
$sqlSelect = "SELECT email FROM membre WHERE idMembre = ?";

if (mysqli_stmt_prepare($stmt, $sqlSelect)) {
    mysqli_stmt_bind_param($stmt, "i", $idUserSession);
    $result = mysqli_stmt_execute($stmt);
    // mysqli_stmt_store_result($stmt);
    if ($result) {
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_bind_result($stmt, $mEmail);
            mysqli_stmt_fetch($stmt);
        } else {
            echo "Aucun résultat trouvé pour ce membre";
            mysqli_stmt_close($stmt);
            mysqli_close($maCon);
            session_destroy();
            header("Location: connexion.php? erreurNoResult=noResult");
            exit;
        }
    } else {
        echo "Erreur lors de l'exécution de la requête ";
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Erreur lors de la préparation de la requête ";
}
mysqli_close($maCon);

?>


<div class="h4">
    <h4>Modifier votre Email: <?php echo $mEmail; ?></h4>
</div>
<div class="img-content">
    <div class="img-conx">
        <img src="image/voilierDuCiel.jpg" alt="bateaux">
    </div>
</div>
<div class="h4">
    <h6>Cliquez sur la case pour effectuer les modifications</h6>
</div>

<?php
if (isset($_GET['erreur']) && $_GET['erreur'] === 'duplication') {
    echo "Les données saisies existent déjà. Veuillez corriger votre saisie.";
}

?>

<form action="enregModifMail.php" method="POST" class="formConx">

    <div class="formConxDiv">
        <label for="mail">Email</label>
        <input type="email" class="form-control" name="email" id="mail" value="<?php echo $mEmail; ?>" required>
    </div>


    <div class="formConxDiv">
        <label for="mdp">Saisissez votre password pour valider les modifications</label>
        <input type="password" class="form-control" name="mdpActuel" id="pass" placeholder="" required>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" onclick="afficheMdp()">
            <label class="form-check-label" for="flexSwitchCheckDefault">Afficher le mot de passe</label>
        </div>
    </div>
    <div class="h4">
        <h5>
            <font style="color:white">un email de confirmation vous sera envoyé</font>
        </h5>
    </div>

    <br />
    <div class="formConxDiv">
        <label class="buttonSub" for="enreg"> <input type="submit" id="enreg" value="Enregistrer"></label>
    </div>
</form>


<?php
include('footer.php');
?>