<?php

$sessionLifetime = 1800; //  durée de la session 30mn 60sec x 30mn = 1800 sec
session_set_cookie_params($sessionLifetime);

session_start();
session_regenerate_id(true);
require('header.php');
require('fonctionsCommunes.php');

if (!issetNotEmpty($_SESSION)) {
    header('Location: connexion.php');
}

if (isset($_GET['modif']) && $_GET['modif'] === 'modifReussie') {
    echo ('Modifications effectuées.');
}

if (isset($_GET['erreur']) && $_GET['erreur'] === 'erreurMdp') {
    echo ('Veuillez saisir un password valide.');
}

if (isset($_GET['erreur']) && $_GET['erreur'] === 'erreurEmail') {
    echo ('Veuillez saisir un email valide.');
}

if (isset($_GET['erreur']) && $_GET['erreur'] === 'erreurNum') {
    echo ('Veuillez saisir un téléphone ou/et un cp valide.');
}
//Si le user n'est pas deconnecté par le $sessionLifeTime ou autre
if (!issetNotEmpty($_SESSION['user']['id'])) {
    header('Location: connexion.php');
}

$idUserSession = $_SESSION['user']['id'];
//$mIdMembre;
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
$sqlSelect = "SELECT * FROM membre WHERE idMembre = $idUserSession";

if (mysqli_stmt_prepare($stmt, $sqlSelect)) {
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_bind_result($stmt, $idMembre, $email, $nom, $prenom, $adresse, $cp, $ville, $tel, $mdp); //voir pour retirer ou non le mdp, puisque non traité ici, cause sécu
        if (mysqli_stmt_fetch($stmt)) {
            //  $mIdMembre = $idMembre;
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
<div class="h4">
    <h6>Cliquez sur les cases pour modifier vos données</h6>
</div>

<?php
if (isset($_GET['erreur']) && $_GET['erreur'] === 'duplication') {
    echo "Les données saisies existent déjà. Veuillez corriger votre saisie.";
}

?>

<form action="enregModifProfil.php" method="POST" class="formConx">

    <div class="formConxDiv">
        <label for="mail">Email</label>
        <input type="email" class="form-control" name="email" id="mail" value="<?php echo $mEmail; ?>" required>
    </div>


    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="nom">Nom : </label>
            <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $mNom; ?>" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="prenom">Prénom :</label>
            <input type="text" class="form-control" name="prenom" id="prenom" value="<?php echo $mPrenom; ?>" required>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="adresse">Adresse : </label>
            <input type="text" class="form-control" name="adresse" id="adresse" value="<?php echo $mAdresse; ?>" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="cpP">Code postal </label>
            <input type="text" class="form-control" name="cp" id="cpP" value="<?php echo $mCp; ?>" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="ville">Ville :</label>
            <input type="text" class="form-control" name="ville" id="ville" value="<?php echo $mVille; ?>" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="tel">Téléphone :</label>
            <input type="text" class="form-control" name="tel" id="tel" value="<?php echo $mTel; ?>" required>
        </div>
    </div>
    <div class="formConxDiv">
        <label for="mdp">Saisissez votre password pour valider les modifications</label>
        <input type="password" class="form-control" name="mdpActuel" id="mdp" placeholder="" required>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" onclick="afficheMdp()">
            <label class="form-check-label" for="flexSwitchCheckDefault">Afficher le mot de passe</label>
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