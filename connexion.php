<?php
session_start();
session_regenerate_id(true);

include('fonctionsCommunes.php');
include('header.php');

if (isset($_GET['enregistrement']) && $_GET['enregistrement'] === 'reussi') {
    echo ('Enregistrement réussi');
}

if (isset($_GET['erreurNoResult']) && $_GET['erreurNoResult'] === 'noResult') {
    echo ('Pas de résultat pour ce membre, veuillez-vous connecter');
}

?>

<h4>Se connecter</h4>
<div class="img-content">
    <div class="img-conx">
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
        <a href="formEnregMembre.php" class="buttonstyle" type="button">S'enregistrer</a>
    </div>
</div>
<?php


if (!empty($_POST)) { //cela permet de ne pas aller direct sur le else quand on charge la page
    if (issetNotEmpty($_POST['username']) && issetNotEmpty($_POST['password'])) {

        $userEmail = strip_tags($_POST['username']);
        $mdpSaisi = $_POST['password'];
        $maCon = connexion();
        $stmt = $maCon->prepare("SELECT idMembre, email, nom, prenom, mdp FROM membre WHERE email = ?");
        $stmt->bind_param("s", $userEmail);
        $stmt->execute();
        $stmt->bind_result($mId, $mEmail, $mNom, $mPren, $mMdp);
        $stmt->fetch();
        $stmt->close(); //le stmt close ne ferme pas la connexion à la bd
        mysqli_close($maCon);

        if (!$mEmail || !password_verify($mdpSaisi, $mMdp)) { // si mMail est vide ou false c'ets que le mail ne correspond pas (en gros la comparaison se fait durant la requete) 
            var_dump($mEmail);
            var_dump($mMdp);
            var_dump($mdpSaisi);
            die("Identifiant ou mot de passe incorrect.");
        }

        $_SESSION["user"] = [
            "email" => $mEmail,
            "nom" => $mNom,
            "prenom" => $mPren,
            "id" => $mId
        ];
        session_regenerate_id(true);
        header('Location: index.php');
        exit;
    } else {
        die("Veuillez remplir tous les champs");
    }
}
include('footer.php')
?>