<?php
session_start();
include('header.php');
?>





<form enctype="multipart/form-data" actionexit="enregBoat.php" method="POST" class="form1">
    <h4 class="h4EngBat">Saisir les informations <br />relatives à votre bateau :</h4>

    <div class="form1">
        <label for="nom">Nom du bateau</label>
        <input type="text" name="nom" id="nom" required>
    </div>
    <div class="form1">
        <label for="type"> Type (voile ou moteur)</label>
        <input type="text" name="type" id="type" required>
    </div>
    <div class="form1">
        <label for="type_nav">type de navigation possible (Côtier, hauturier)</label>
        <input type="text" name="type_nav" id="type_nav" required>
    </div>
    <div class="form1">
        <label for="places_hors_couchage">Places (hors couchage)</label>
        <input type="text" name="places_hors_couchage" id="places_hors_couchage" required>
    </div>
    <div class="form1">
        <label for="couchage">Nombre de couchages possible</label>
        <input type="text" name="couchage" id="couchage" required>
    </div>
    <div class="form1">
        <label for="cp_site">Code postal du site nautique</label>
        <input type="text" name="cp_site" id="cp_site" required>
    </div>
    <div class="form1">
        <label for="ville">Ville du site nautique</label>
        <input type="text" name="ville_site" id="ville" required>
    </div>
    <div class="form1">
        <label for="desc">Descrition du bateau</label>
        <input type="text" name="description" id="desc" required>
    </div>

    <br />
    <div class="form1">
        <label for="formFile">Photo du bateau</label>
        <input class="formControl" type="file" name="photo" id="formFile">
    </div>
    <br />
    <div class="form1">
        <label for="enreg2"> <input type="submit" value="Enregistrer" id="enreg2"></label>
    </div>
</form>

<?php
include('footer.php')
?>