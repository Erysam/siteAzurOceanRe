<?php
require_once('configSession.php');
require('header.php');



if (isset($_GET['modif']) && $_GET['modif'] === 'modifReussie') {
    echo ('Enregistrement effectué, Voulez-vous enregistrer un autre bateau?');
}

?>
<div class="h4">
    <h4>Enregistrer un bateau:</h4>
</div>

<div class="img-content">
    <div class="img-conx">
        <img src="image/sunOdyssey.JPG" alt="bateaux">
    </div>
</div>



<form action="enregBoat.php" method="POST" class="formConx" enctype="multipart/form-data" onsubmit="return verifNumberCp();">

    <div class="row">
        <div class="">
            <label for="nomBat">Nom de votre bateau</label>
            <input type="text" class="form-control" name="nomBat" id="nomBat" placeholder="" required>
        </div>
    </div>
    <div class="row">
        <div class="">
            <label for="adresse">Adresse / Port d'attache</label>
            <input type="text" class="form-control" name="adresse" id="adresse" required>

        </div>
    </div>


    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="cp">Code postal</label>
            <input type="text" class="form-control" name="cp" id="cp" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="ville">Ville</label>
            <input type="text" class="form-control" name="ville" id="ville" required>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="typeNav">Type de bateau</label>
            <select class="form-select" aria-label="select" name="typeBat">
                <option value="1">Voile</option>
                <option value="2">Moteur</option>
                <option value="3">Autre</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="typeNav">Type de navigation</label>
            <select class="form-select" aria-label="select" name="typeNav">
                <option value="1">Hauturier</option>
                <option value="2">Côtier</option>
                <option value="3">Fluvial</option>
            </select>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="taille">taille (en pieds)</label>
            <input type="number" class="form-control" name="taille" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="places">Places (par personnes)*</label>
            <input type="number" class="form-control" name="places" placeholder="" required>
            <small id="textmuted" class="form-text text-muted">
                *Recommandation constructeur
            </small>
        </div>
    </div>

    <div class="formConxDiv">
        <label for="description">Description</label>
        <textarea type="text" class="form-control" name="descript" id="descript" placeholder="Détaillez le séjour proposé" required rows="10"></textarea>
    </div>
    <br>
    <div class="formConxDiv">
        <label for="formFile">Photos bateau (max 3 images, max 2Mo, format PNG ou jpeg)</label>
        <input class="formFile" type="file" name="photo1[]" id="formFile" multiple accept="image/jpeg, image/png">
        <input class="formFile" type="file" name="photo2[]" id="formFile" multiple accept="image/jpeg, image/png">
        <input class="formFile" type="file" name="photo3[]" id="formFile" multiple accept="image/jpeg, image/png">
    </div>
    <!--  les [] dans le nom de l'input indique qu il y a plusieurs fichiers et que cela se comportera comme un tableau: 
    les fichiers sont stockés dans $_FILES['photos'] en PHP sous forme de tableau
A la place de accept="image/jpeg, image/png" on peut mettre accept="image/*" qui accepte tous les fichiers images-->



    <br>

    <div class="formConxDiv">
        <label class="buttonSub" for="enreg"> <input type="submit" id="enreg" value="Enregistrer"></label>
    </div>
</form>




<?php
include('footer.php');
?>