<?php
session_start();
session_regenerate_id(true); // inclus en cas de connexion et deconnexion en general
include('fonctionsCommunes.php');
include('header.php');

if (isset($_GET['enregistrement']) && $_GET['enregistrement'] === 'reussi') {
    echo ('Enregistrement réussi, votre compte est activé');
}

if (isset($_GET['erreurNoResult']) && $_GET['erreurNoResult'] === 'noResult') {
    echo ('Pas de résultat pour ce membre, veuillez-vous connecter');
}

if (isset($_GET['erreur']) && $_GET['erreur'] === 'erreurMailOuMdp') {
    echo ('Veuillez saisir un mot de passe ou un mail valide');
}

if (isset($_GET['erreurCpteNonActif']) && $_GET['erreurCpteNonActif'] === 'noActif') {
    echo ('Veuillez valider le mail d\'activation qui vous a été envoyé sur votre adresse email');
}

if (isset($_GET['resa']) === 'emptyID') {
    echo 'Veuillez vous connecter ou vous enregistrer afin de faire une réservation';
}

?>

<div class="h4">
    <h4>Se connecter</h4>
</div>

<div class="img-content">
    <div class="imgEnTete">
        <img src="image/voilierDuCiel.jpg" alt="bateaux">
    </div>
</div>
<div>

</div>

<form class="formConx" method="POST" action="connexion.php">
    <div class="formConxDiv">
        <label for="username1">Identifiant (email):</label>
        <input type="text" class="form-control" id="username1" name="username" required>
    </div>

    <div class="formConxDiv">
        <label for="pass">Mot de passe : </label>
        <input type="password" class="form-control" id="pass" name="password" required>
    </div>

    <div class="formConxDiv">
        <input type="submit" value="Se connecter">
    </div>
</form>
<br>
<h5>Si vous n'avez pas de compte, vous pouvez vous enregistrer :</h5>
<div class="container">
    <div class="formConxDiv">
        <a href="formEnregMembre.php" class="" type="link">S'enregistrer</a>
    </div>
</div>
<?php


if (!empty($_POST)) { //cela permet de ne pas aller direct sur le else quand on charge la page
    if (issetNotEmpty($_POST['username']) && issetNotEmpty($_POST['password'])) {

        $userEmail = strip_tags($_POST['username']);
        $mdpSaisi = $_POST['password'];
        $maCon = connexion();
        $stmt = $maCon->prepare("SELECT idMembre, email, nom, prenom, mdp, actif FROM membre WHERE email = ?");
        $stmt->bind_param("s", $userEmail);
        $stmt->execute();
        $stmt->bind_result($mId, $mEmail, $mNom, $mPren, $mMdp, $mActif);
        $stmt->fetch();
        $stmt->close(); //le stmt close ne ferme pas la connexion à la bd
        mysqli_close($maCon);

        if (!$mEmail || !password_verify($mdpSaisi, $mMdp)) { // si mMail est vide ou false c'ets que le mail ne correspond pas (en gros la comparaison se fait durant la requete) 
            //  echo 'Veuillez valider le mail d\'activation qui vous a été envoyé sur votre adresse email';
            header("Location: connexion.php?erreur=erreurMailOuMdp");
            die("Identifiant ou mot de passe incorrect.");
        }

        if ($mActif != 1) { // si mMail est vide ou false c'ets que le mail ne correspond pas (en gros la comparaison se fait durant la requete) 
            //  echo 'Veuillez valider le mail d\'activation qui vous a été envoyé sur votre adresse email';
            header("Location: connexion.php?erreurCpteNonActif=noActif");
            die("Compte non actif.");
        }

        $_SESSION["user"] = [
            "email" => $mEmail,
            "nom" => $mNom,
            "prenom" => $mPren,
            "id" => $mId
        ];

        header('Location: index.php');
        exit;
    } else {

        die("");
    }
}
include('footer.php')
?>