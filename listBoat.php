<?php
require_once('configSession.php');
include('fonctionsCommunes.php');
include('header.php');
?>

<div class="img-content">
    <div class=imgEnTete>
        <h1>Liste de vos réservations</h1>
        <img src="image/zephyredim.jpg" class="imgBord" alt="Bateau à voile sur la mer">
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
    $sqlSelect = "SELECT * FROM bateau WHERE idProp = ?";

    if (mysqli_stmt_prepare($stmt, $sqlSelect)) {
        mysqli_stmt_bind_param($stmt, "i", $idUserSession);

        $result = mysqli_stmt_execute($stmt);

        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_bind_result($stmt, $bIdBat, $bIdProp, $bNomBateau, $bAdresseSite, $bCpSite, $bVilleSite, $bTypeBat, $bTypeNav, $bTaille, $bPlaces, $bDescription, $bPhoto1, $bPhoto2, $bPhoto3);
            $numBat = 0;

            while (mysqli_stmt_fetch($stmt)) {
                $numBat =  $numBat + 1;
                echo "<br/>";
                echo '<div class="titreResa">';
                echo '<div class="bordure">';
                echo '</div>';
                echo "<h2> $bNomBateau : $bVilleSite ($bCpSite) </h2>";
                echo " <p>[ <font style=\"color:white\"> type de navigation : $bTypeNav , places : $bPlaces passagers </font> ] ";
                echo "<h2><font style=\"color:white\"> [ $bTypeBat : $bDescription ]  </font> </h4>";
                echo '</div>';
                echo <<<_END
                <div>
                <img src="$bPhoto1" class="imgSejResa" alt="photo sejour" class="imgBord" style="max-width: 300px; max-height: 300px;">
                <img src="$bPhoto2" class="imgSejResa" alt="photo sejour" class="imgBord" style="max-width: 300px; max-height: 300px;">
                <img src="$bPhoto3" class="rounded mx-auto d-block" alt="photo sejour" class="imgBord" style="max-width: 300px; max-height: 300px;">
                </div>
                <br>
                _END;
                echo "<br>";

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