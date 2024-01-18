<?php
session_start();
session_regenerate_id(true);
require('header.php');
require('fonctionsCommunes.php');


$iduserSession = $_SESSION['user']['id'];
$mIdMembre;
$mEmail;
$mNom;
$mPrenom;
$mAdresse;
$mCp;
$mVille;
$mTel;
$mMdp;

$maCon = connexion();
$stmt = mysqli_stmt_init($maCon);
$sqlSelect = "SELECT * FROM membre WHERE idMembre = $iduserSession";

if (mysqli_stmt_prepare($stmt, $sqlSelect)) {
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_bind_result($stmt, $idMembre, $email, $nom, $prenom, $adresse, $cp, $ville, $tel, $mdp); //voir pour retirer ou non le mdp, puisque non traité ici, cause sécu
        if (mysqli_stmt_fetch($stmt)) {
            $mIdMembre = $idMembre;
            $mEmail = $email;
            $mNom = $nom;
            $mPrenom = $prenom;
            $mAdresse = $adresse;
            $mCp = $cp;
            $mVille = $ville;
            $mTel = $tel;
            $mMdp = $mdp;
        }
    } else {
        echo "Aucun résultat trouvé pour ce membre";
    }
}
mysqli_stmt_close($stmt);
mysqli_close($maCon);

?>


<div class="h4">
    <h4>Conserver ou modifier vos données existantes:</h4>
</div>
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

<form action="enregModifMembre.php" method="POST" class="formConx onsubmit=" onsubmit="return verifierMotDePasse() && verifMdpChar();">


    <div class="formConxDiv">
        <label for="mail">Email</label>
        <input type="email" class="form-control" name="email" id="mail" placeholder="<?php echo $mEmail; ?>" required>
    </div>


    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="nom">Nom : </label>
            <input type="text" class="form-control" name="nom" id="nom" placeholder="<?php echo $mNom; ?>" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="prenom">Prénom :</label>
            <input type="text" class="form-control" name="prenom" id="prenom" placeholder="<?php echo $mPrenom; ?>" required>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="adresse">Adresse : </label>
            <input type="text" class="form-control" name="adresse" id="adresse" placeholder="<?php echo $mAdresse; ?>" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="cpP">Code postal </label>
            <input type="text" class="form-control" name="cp" id="cpP" placeholder="<?php echo $mCp; ?>" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="ville">Ville :</label>
            <input type="text" class="form-control" name="ville" id="ville" placeholder="<?php echo $mVille; ?>" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="tel">Téléphone :</label>
            <input type="text" class="form-control" name="tel" id="tel" placeholder="<?php echo $mTel; ?>" required>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="pass">Nouveau password*:</label>
            <input type="password" class="form-control" id="pass" name="mdp" minlength="8" required placeholder="***************">
            <label class="check" for="checkbox"><input type="checkbox" onclick="afficheMdp()" class="afficheMdp">Afficher le mot de passe</label>

        </div>

        <div class="col-md-6 mb-3">
            <label for="confirmPass">Confirmer le nouveau password:</label>
            <input type="password" class="form-control" id="confirmPass" name="confirmMdp" minlength="8" required placeholder="**************">

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


<script>
    //Afficheme MDP lorsqu'on coche ou décoche la case
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
include('footer.php');
?>