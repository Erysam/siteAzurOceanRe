<?php
include('header.php');
session_start();
?>
<div>
    <h1>Se connecter</h1>
</div>


<form class="formConx" method="POST" action="connexion.php">
    <div class="formConxDiv">
        <label for="username1">Identifiant:</label>
        <input type="text" id="username1" name="username">
    </div>

    <div class="formConxDiv">
        <label for="pass">Mot de passe : </label>
        <input type="password" id="pass" name="password" required>
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
<div class="img-content">
    <div class="img-conx">
        <img src="image/voilierDuCiel.jpg" alt="bateaux">
    </div>
</div>

<?php

include('fonctionsCommunes.php');
if (!empty($_POST)) { //cela permet de ne pas aller direct sur le else quand on charge la page
    if (issetEmpty($_POST['username']) && issetEmpty($_POST['password'])) {
        $login = strip_tags($_POST['username']);
        $mysqli = connexion();
        $stmt = $mysqli->prepare("SELECT * FROM membre WHERE login = ?");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $stmt->bind_result($mId, $mEmail, $mNom, $mPren, $mAdr, $mCp, $mVil, $mTel, $mLog, $mMdp);
        $stmt->fetch();
        $stmt->close();
        // mysqli_close($maCon); est ce pertinent apres un $stmt close
        if ($login != $mLog) {
            die("query fail10 : Login ou MDP erronés");
        };
        if (!password_verify($_POST['password'], $mMdp)) {
            die("query fail11 : Login ou MDP erronés");
        }
        $_SESSION["user"] = [
            "email" => $mEmail,
            "nom" => $mNom,
            "prenom" => $mPren,
            "id" => $mId
        ];
        header('Location: index.php'); // A CREER

    }
}
include('footer.php')
?>