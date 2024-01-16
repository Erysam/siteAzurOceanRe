<?php
session_start();
include('fonctionsCommunes.php');
include('header.php');
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
    if (issetEmpty($_POST['username']) && issetEmpty($_POST['password'])) {

        $mEmail = strip_tags($_POST['username']);

        $maCon = connexion();
        $stmt = $maCon->prepare("SELECT * FROM membre WHERE email = ?");
        $stmt->bind_param("s", $mEmail);
        $stmt->execute();
        $stmt->bind_result($mId, $mEmail, $mNom, $mPren, $mAdr, $mCp, $mVil, $mTel, $mMdp);
        $stmt->fetch();
        $stmt->close(); //le stmt close ne ferme pas la connexion à la bd
        mysqli_close($maCon);
        if ($mEmail != $mEmail) {
            die("query fail10 : Identifiant ou MDP erronés");
        };
        if (!password_verify($_POST['password'], $mMdp)) {
            die("query fail11 : Identifiant ou MDP erronés");
        }


        $_SESSION["user"] = [
            "email" => $mEmail,
            "nom" => $mNom,
            "prenom" => $mPren,
            "id" => $mId
        ];
        session_regenerate_id(true);
        header('Location: index.php');
        echo "Nom du client";
        echo $_SESSION;
        exit;
    } else {
        die("erreur");
    }
}
include('footer.php')
?>