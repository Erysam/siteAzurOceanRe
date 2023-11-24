<?php
include('header.php');
?>


<h4>Saisir vos données :</h4>

<div class="img-content">
    <div class="img_formEenregM">
        <img src="image/voilierDuCiel.jpg" alt="bateaux">
    </div>
</div>


<form action="enregMembre.php" method="POST" class="formConx">


    <div class="formConxDiv">
        <label for="mail">Email</label>
        <input type="email" class="form-control" name="email" id="mail" placeholder="name@exemple.com">
    </div>


    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="nom">Nom : </label>
            <input type="text" class="form-control" name="nom" id="nom" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="prenom"> Prénom :</label>
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

    <div class="formConxDiv">
        <label for="pass">Password (chiffres, lettres et caractères spéciaux):</label>
        <input type="password" class="form-control" id="pass" name="mdp" minlength="8" required placeholder="8 caractères minimum">
    </div>

    <br />
    <div class="formConxDiv">
        <label class="buttonSub" for="enreg"> <input type="submit" id="enreg" value="Enregistrer"></label>
    </div>
</form>



<?php
include('footer.php')
?>