<?php
include('header.php');
?>


<h4>Saisir vos données :</h4>

<div class="img-content">
    <div class="img-conx">
        <img src="image/voilierDuCiel.jpg" alt="bateaux">
    </div>
</div>

<?php
if (isset($_GET['erreur']) && $_GET['erreur'] == 'duplication') {
    echo "Les données saisies existent déjà. Veuillez corriger votre saisie.";
}
?>

<form action="enregMembre.php" method="POST" class="formConx onsubmit=" onsubmit="return verifierMotDePasse();">


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
            <input type="text" class="form-control" name="tel" id="tel" required>
        </div>
    </div>

    <div class="formConxDiv">
        <label for="username">Identifiant:</label>
        <input type="text" class="form-control" id="username" name="login" required>
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
            <label for="confirmPass">Confirmer le mot de passe:</label>
            <input type="password" class="form-control" id="confirmPass" name="confirmMdp" minlength="8" required placeholder="8 caractères minimum">

        </div>
    </div>



    <br />
    <div class="formConxDiv">
        <label class="buttonSub" for="enreg"> <input type="submit" id="enreg" value="Enregistrer"></label>
    </div>
</form>


<script>
    function afficheMdp() {
        var passwordField = document.getElementById("pass");
        var confirmPassField = document.getElementById("confirmPass");

        passwordField.type = passwordField.type === "password" ? "text" : "password";
        confirmPassField.type = confirmPassField.type === "password" ? "text" : "password";
    }

    function verifierMotDePasse() {
        //.value : récupère la valeur immediate de l'élément (ce que le user saisie en temps reel), au dessus on en a pas besoin car c est juste une valeur d affichage 
        var password = document.getElementById("pass").value;
        var confirmPass = document.getElementById("confirmPass").value;

        if (password !== confirmPass) {
            alert("Les mots de passe ne correspondent pas. Veuillez les vérifier.");
            return false; // Empêche l'envoi du formulaire
        }

        return true; // Permet l'envoi du formulaire si les mots de passe correspondent
    }
</script>

<?php
include('footer.php')
?>