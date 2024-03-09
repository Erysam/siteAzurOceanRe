<?php
require("header.php");
require('fonctionsCommunes.php');
?>
<form action="testenreg.php" method="POST" class="formConx" enctype="multipart/form-data">
    <div class="formConx">
        <label for="formFile">Photo du séjour (max 3 images)</label>
        <input class="formFile" type="file" name="photo1[]" id="formFile" multiple accept="image/jpeg, image/png">
        <input class="formFile" type="file" name="photo2[]" id="formFile" multiple accept="image/jpeg, image/png">
    </div>

    <div class="formConxDiv">
        <label class="buttonSub" for="enreg"> <input type="submit" id="enreg" value="Enregistrer"></label>
    </div>
</form>