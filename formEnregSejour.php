<?php
session_start();
include('fonctionsCommunes.php');
require("header.php");
?>
<div class="h4">
    <h4>Proposer un séjour :</h4>
</div>

<div class="img-content">
    <div class="img-conx">
        <img src="image/voilierDuCiel.jpg" alt="bateaux">
    </div>
</div>


<container>
    <form action="enregSejour.php" method="POST" class="formConx" enctype="multipart/form-data">


        <div class="formConxDiv">
            <label for="nomBat">Nom de votre bateau</label>
            <input type="text" class="form-control" name="nomBat" id="nomBat" placeholder="Nom de votre bateau" required>
        </div><!--Envisager un menu deroulant avec la liste des bateaux du user-->

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="titreSej">Intitulé du séjour</label>
                <input type="text" class="form-control" name="titreSej" id="titreSej" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="typeNav">Type de navigation</label>
                <select class="form-select" aria-label="select">
                    <option value="1">Hauturier</option>
                    <option value="2">Côtier</option>
                    <option value="3">Fluvial</option>
                </select>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="adresse">Adresse</label>
                <input type="text" class="form-control" name="adresse" id="adresse" required>

            </div>

            <div class="col-md-6 mb-3">
                <label for="cp">Code postal</label>
                <input type="text" class="form-control" name="cp" id="cp" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="ville">Ville</label>
                <input type="text" class="form-control" name="ville" id="ville" required>
            </div>



            <div class="col-md-6 mb-3">
                <label for="prix">Prix</label>
                <input type="text" class="form-control" name="prix" id="prix" required>
            </div>
        </div>
        <div class="formConx">
            <label for="formFile">Photo du séjour (max 3 images)</label>
            <input class="formFile" type="file" name="photos[]" id="formFile" multiple accept="image/*">
            <!-- A la place de * qui accepte tous les fichiers images, on peut faire ' accept="image/jpeg, image/png, image/gif" ' Accepte uniquement les fichiers JPEG, PNG et GIF.-->
        </div>

        <div class="formConxDiv">
            <label for="description">Description</label>
            <textarea type="text" class="form-control" name="descript" id="descript" placeholder="Détaillez le séjour proposé" required rows="10"></textarea>
        </div>

        <br>

        <div class="formConxDiv">
            <label class="buttonSub" for="enreg"> <input type="submit" id="enreg" value="Enregistrer"></label>
        </div>
    </form>


</container>

<?php
include('footer.php');
?>