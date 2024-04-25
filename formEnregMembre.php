<?php
require_once('configSession.php'); // différence avec require, require_ once vérifie si le fichier a déjà été inclus si oui, elle ne l inclusq pas de nouveau
include('header.php');
?>

<div class="h4">
    <h4>Saisir vos données :</h4>
</div>

<div class="img-content">
    <div class="imgEnTete">
        <img src="image/voilierDuCiel.jpg" alt="bateaux">
    </div>
</div>

<?php
//get erreur recup depuis la page enregMembre.php
if (isset($_GET['erreur']) && $_GET['erreur'] === 'erreurNum') {
    echo "Veuillez saisir des nombres valides dans les champs 'Code postal' et 'Téléphone'.";
    echo "<br>";
}

if (isset($_GET['erreur']) && $_GET['erreur'] === 'duplication') {
    echo "Le champs 'Email' existe déjà. Veuillez corriger votre saisie.";
    echo "<br>";
}

//Les fonctions 2 premières sont appelées lorsque le user submit le form alors que la 3 est un onClick lorsque le user coche la checkbox
// voir a modifier la checkbox par un checkbox bootstarp plus actuel et que le mdp soit masqué automatiquement au bout de quelques secondes
?>

<form action="enregMembre.php" method="POST" class="formConx onsubmit=" onsubmit="return verifierMotDePasse() && verifMdpChar() && verifNumberCp();">

    <h5>Un mail vous sera envoyé pour activer le compte.</h5>
    <div class="formConxDiv">
        <label for="mail">Email</label>
        <input type="email" class="form-control" name="email" id="mail" placeholder="name@exemple.com" required>
    </div>


    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="nom">Nom : </label>
            <input type="text" class="form-control" name="nom" id="nom" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="prenom">Prénom :</label>
            <input type="text" class="form-control" name="prenom" id="prenom" required>
        </div>
    </div>


    <div class="row">

        <div class="col-md-6 mb-3">
            <label for="adresse">Adresse : </label>
            <input type="text" class="form-control" name="adresse" id="adresse" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="cpP">Code postal </label>
            <input type="text" class="form-control" name="cp" id="cpP" required>
        </div>

    </div>

    <div class="row">

        <div class="col-md-6 mb-3">
            <label for="ville">Ville :</label>
            <input type="text" class="form-control" name="ville" id="ville" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="tel">Téléphone :</label>
            <input type="text" class="form-control" name="tel" id="tel" oninput="verifNumber(this)" required>
        </div>

    </div>



    <div class="row">

        <div class="col-md-6 mb-3">
            <label for="pass">Password:</label>
            <input type="password" class="form-control" id="pass" name="mdp" minlength="8" required placeholder="8 caractères minimum*">
        </div>

        <div class="col-md-6 mb-3">
            <label for="confirmPass">Confirmer le password:</label>
            <input type="password" class="form-control" id="confirmPass" name="confirmMdp" minlength="8" required placeholder="8 caractères minimum*">
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" onclick="afficheMdp()">
            <label class="form-check-label" for="flexSwitchCheckDefault">Afficher le mot de passe</label>
        </div>
    </div>

    <div class="formConxDiv">
        <small id="passwordHelp" class="form-text text-muted">
            *Inclure au moins une majuscule, une minuscule, un chiffre et un caractère spécial.
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