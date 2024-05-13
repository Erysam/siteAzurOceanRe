<?php
require_once('configSession.php');
include('fonctionsCommunes.php');
include('header.php');
?>

<div class="img-content">
    <div class=imgEnTete>
        <h1>Liste de vos réservations</h1>
        <img src="image/chaisesLongues.jpg" class="imgBord" alt="chaises longues, barques face à la mer et au soleil">
    </div>
</div>

<?php

if (!issetNotEmpty($_SESSION)) {
    header('Location: connexion.php?resa=emptyID');
    exit;
}

if (issetNotEmpty($_SESSION)) {
    $idUserSession = $_SESSION['user']['id'];
    $maCon = connexion();
    $stmt = mysqli_stmt_init($maCon);
    $sqlSelect = "SELECT s.idBateau, s.typeNavSej, s.intituleSej, s.descriptionSej, s.dateDebutSej, s.dateFinSej, s. adresseSej, s.cpSej, s.villeSej, s.prixSej, s.photoSej1, s.photoSej2, s.photoSej3, b.places
    FROM sejour s JOIN reservation r ON s.idSejour = r.idSej
    LEFT JOIN  bateau b on s.idBateau = b.idBateau
    WHERE r.idMembre = ?";

    if (mysqli_stmt_prepare($stmt, $sqlSelect)) {
        mysqli_stmt_bind_param($stmt, "i", $idUserSession);

        $result = mysqli_stmt_execute($stmt);

        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_bind_result($stmt, $sIdBat, $sTypeNav, $sIntit, $sDescript, $sDateDeb, $sDateFin, $sAdress, $sCp, $sVille, $sPrix, $sPhoto1, $sPhoto2, $sPhoto3, $placeBat);
            $numResa = 0;
            while (mysqli_stmt_fetch($stmt)) {
                $numResa =  $numResa + 1;
                echo "<br/>";
                echo '<div class="titreResa">';
                echo '<div class="bordure">';
                echo '</div>';
                echo "<h2> $numResa - Séjour dans la ville de $sVille ($sCp) </h2>";
                echo "<h2><font style=\"color:white\"> [ $sIntit ]  </font> </h4>";
                echo '</div>';
                echo <<<_END
                <div>
                <img src="$sPhoto1" class="imgSejResa" alt="photo sejour" class="imgBord" style="max-width: 300px; max-height: 300px;">
                <img src="$sPhoto2" class="imgSejResa" alt="photo sejour" class="imgBord" style="max-width: 300px; max-height: 300px;">
                <img src="$sPhoto3" class="rounded mx-auto d-block" alt="photo sejour" class="imgBord" style="max-width: 300px; max-height: 300px;">
                </div>
                <br>
                _END;
                echo " <p>  <font style=\"color:black\"> Séjour : $sDescript </font>  </p>";
                echo "<br>";
                echo " <p class='dateSej'> [ <font style=\"color:white\">Date début : $sDateDeb</font> ] [ <font style=\"color:white\">Date fin : $sDateFin</font> ]</p>";
                echo " <p>[ <font style=\"color:white\"> Séjour : $sTypeNav , $placeBat passagers </font> ] ";
                echo " [ <font style=\"color:white\"> Prix : $sPrix €</font> ] </p>";
                echo '</div>';
                echo "<br>";
            }
        }
    }
}


?>

<?php
include('footer.php')
?>