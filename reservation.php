<?php
require_once('configSession.php');
include('header.php');
include('fonctionsCommunes.php');
?>

<div class="h4">
    <h4>Reservez votre séjour</h4>
</div>

<div class="img-content">
    <div class="imgEnTete">
        <img src="image/chaisesLongues.jpg" class="imgBord" alt="chaises longues, barques face à la mer et au soleil">
    </div>
</div>
<br>

<?php

if (!issetNotEmpty($_SESSION)) {
    header('Location: connexion.php?resa=emptyID');
    exit;
}

/*
if (!isset($_POST['idSejour'])) {
    header('Location: sejours.php?resa=emptyResa');
    exit;
}*/
if (issetNotEmpty($_POST['idSejour'])) {
    $sIdBat;
    $sTypeNav;
    $sIntit;
    $sDescript;
    $sDateDeb;
    $sDateFin;
    $sAdress;
    $sCp;
    $sVille;
    $sPrix;
    $sPhoto1;
    $sPhoto2;
    $sPhoto3;

    $idSej = $_POST['idSejour'];

    $maCon = connexion();
    $stmt = mysqli_stmt_init($maCon);
    $sqlSelect = "SELECT idBateau,  typeNavSej,  intituleSej, descriptionSej, dateDebutSej,  dateFinSej,  adresseSej,  cpSej,  villeSej,  prixSej, photoSej1, photoSej2, photoSej3 FROM sejour WHERE idSejour = ?";

    if (mysqli_stmt_prepare($stmt, $sqlSelect)) {

        mysqli_stmt_bind_param($stmt, "i", $idSej);

        $result = mysqli_stmt_execute($stmt);

        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_bind_result($stmt, $sIdBat, $sTypeNav, $sIntit, $sDescript, $sDateDeb, $sDateFin, $sAdress, $sCp, $sVille, $sPrix, $sPhoto1, $sPhoto2, $sPhoto3);
            mysqli_stmt_fetch($stmt);
            echo '<div class=container>';
            echo "<br>";
            echo "<div lisere>";
            echo "<h1> Séjour dans la ville de $sVille ($sCp) </h1>";
            echo '</div>';

            echo <<<_END
            <div>
            <img src="$sPhoto1" class="imgSejResa" alt="photo sejour" class="imgBord" style="max-width: 300px; max-height: 300px;">
            <img src="$sPhoto2" class="imgSejResa" alt="photo sejour" class="imgBord" style="max-width: 300px; max-height: 300px;">
            <img src="$sPhoto3" class="rounded mx-auto d-block" alt="photo sejour" class="imgBord" style="max-width: 300px; max-height: 300px;">
            </div>
            <br>
            _END;

            echo "[ <font style=\"color:orange\"> Séjour : $sDescript </font> ] ";
            echo "<br>";
            echo " [ <font style=\"color:orange\"> Séjour : $sTypeNav </font> ]";
            echo " [ <font style=\"color:purple\">Date début : $sDateDeb</font> ] [ <font style=\"color:green\">Date fin : $sDateDeb</font> ]";
            echo '</div>';
            echo "<br>";
        }
    } else {
        mysqli_stmt_close($stmt);
        mysqli_close($maCon);
        header('Location: sejours.php?resa=emptyResa');
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}
?>



<form action="enregSejour.php" method="POST" class="formConx" enctype="multipart/form-data" onsubmit="return verifNumberCp();">

    <div class="row">
        <div class="formConxDiv">
            <label for="intitule">Intitulé du séjour</label>
            <input type="text" class="form-control" name="intitule" id="intitule" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="idBat">Nombre de personne</label>
            <select class="form-select" aria-label="select" name="idBat">
                <option value='1'>1</option>
            </select>
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


</form>

<?php
include('footer.php')
?>