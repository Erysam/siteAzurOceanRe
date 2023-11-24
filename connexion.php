<?php
include('header.php');
?>

<form action="connexion.php" method="POST" class="formConx">
    <div class="formConxDiv">
        <label for="username1">Identifiant:</label>
        <input type="text" id="username1" name="username">
    </div>

    <div class="formConxDiv">
        <label for="pass">Mot de passe (8 characters minimum): </label>
        <input type="password" id="pass" name="password" minlength="8" maxlength="15" required>
    </div>
    <div class="formConxDiv">
        <input type="submit" value="Valider">
    </div>
</form>
<div class="img-content">
    <div class="img-conx">
        <img src="image/bateauAvoile.jpg" alt="bateaux">
    </div>
</div>

<?php
include('footer.php')
?>