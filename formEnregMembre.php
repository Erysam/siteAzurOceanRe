<?php
session_start();
include('header.php');
?>

<div class="h4">
    <h4>Saisir vos données :</h4>
</div>

<div class="img-content">
    <div class="img-conx">
        <img src="image/voilierDuCiel.jpg" alt="bateaux">
    </div>
</div>

<?php
//get erreur recup depuis la page enregMembre.php
if (isset($_GET['erreur']) && $_GET['erreur'] == 'erreurNum') {
    echo "Veuillez saisir des nombres valides dans les champs 'Code postal' et 'Téléphone'.";
    echo "<br>";
}

if (isset($_GET['erreur']) && $_GET['erreur'] == 'duplication') {
    echo "Le champs 'Email' existe déjà. Veuillez corriger votre saisie.";
    echo "<br>";
}
?>

<form action="enregMembre.php" method="POST" class="formConx onsubmit=" onsubmit="return verifierMotDePasse() && verifMdpChar();">


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
            <input type="number" class="form-control" name="cp" id="cpP" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="ville">Ville :</label>
            <input type="text" class="form-control" name="ville" id="ville" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="tel">Téléphone :</label>
            <input type="number" class="form-control" name="tel" id="tel" required>
        </div>
    </div>

    <div class="passwordHelp">
        <small id="passwordHelp" class="form-text text-muted">
            Inclure au moins une majuscule, une minuscule, un chiffre et un caractère spécial.
        </small>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="pass">Password:</label>
            <input type="password" class="form-control" id="pass" name="mdp" minlength="8" required placeholder="8 caractères minimum">
            <label class="check" for="checkbox"><input type="checkbox" onclick="afficheMdp()" class="afficheMdp">Afficher le mot de passe</label>

        </div>

        <div class="col-md-6 mb-3">
            <label for="confirmPass">Confirmer le password:</label>
            <input type="password" class="form-control" id="confirmPass" name="confirmMdp" minlength="8" required placeholder="8 caractères minimum">

        </div>
    </div>



    <br />
    <div class="formConxDiv">
        <label class="buttonSub" for="enreg"> <input type="submit" id="enreg" value="Enregistrer"></label>
    </div>
</form>




<?php
include('footer.php');
?>