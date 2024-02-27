<?php
require_once('configSession.php');
require('header.php');
require('fonctionsCommunes.php');

if (!issetNotEmpty($_SESSION)) {
    header('Location: connexion.php');
}

if (isset($_GET['modif']) && $_GET['modif'] === 'modifReussie') {
    echo ('Modification reussie.');
}

if (isset($_GET['erreur']) && $_GET['erreur'] === 'erreurMdp') {
    echo ('Veuillez saisir un password valide.');
}

if (isset($_GET['erreur']) && $_GET['erreur'] === 'erreurMdp2') {
    echo ('Veuillez saisir un password valide2.');
}

if (isset($_GET['erreur']) && $_GET['erreur'] === 'erreurEmail') {
    echo ('Veuillez saisir un email valide.');
}

//Si le user n'est pas deconnecté par le $sessionLifeTime ou autre
if (!issetNotEmpty($_SESSION['user']['id'])) {
    header('Location: connexion.php');
}

?>


<div class="h4">
    <h4>Modifier votre mot de passe:</h4>
</div>
<div class="img-content">
    <div class="img-conx">
        <img src="image/voilierDuCiel.jpg" alt="bateaux">
    </div>
</div>
<div class="h4">
    <h6>Pour modifier votre mot de passe veuillez saisir les informations demandées</h6>
</div>


<form action="enregModifMdp.php" method="POST" class="formConx" onsubmit="return verifierMotDePasse() && verifMdpChar();">

    <div class="formConxDiv">
        <label for="mail">Email</label>
        <input type="email" class="form-control" name="email" id="mail" required>
    </div>

    <div class="formConxDiv">
        <label for="mdp">Saisissez l'ancien password pour valider les modifications</label>
        <input type="password" class="form-control" name="mdpActuel" id="mdpActuel" placeholder="" required>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="pass">Nouveau password*:</label>
            <input type="password" class="form-control" id="pass" name="mdp" minlength="8" placeholder="">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" onclick="afficheMdp()">
                <label class="form-check-label" for="flexSwitchCheckDefault">Afficher le mot de passe</label>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <label for="confirmPass">Confirmer le nouveau password:</label>
            <input type="password" class="form-control" id="confirmPass" name="confirmMdp" minlength="8" placeholder="">

        </div>
    </div>
    <div class="passwordHelp">
        <small id="passwordHelp" class="form-text text-muted">
            *8 caractères minimum, inclure au moins une majuscule, une minuscule, un chiffre
            <br>
            et un caractère spécial.
        </small>
    </div>

    <br />
    <div class="formConxDiv">
        <label class="buttonSub" for="enreg"> <input type="submit" id="enreg" value="Enregistrer"></label>
    </div>
</form>

<?php
include('footer.php');
?>