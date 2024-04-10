<?php
require_once('configSession.php');
include('header.php');
include('fonctionsCommunes.php');
?>

<div class="h4">
    <h4>Reservez votre séjour</h4>
</div>

<div class="img-content">
    <div class="img-conx">
        <img src="image/chaisesLongues.jpg" alt="chaises longues, barques face à la mer et au soleil">
    </div>
</div>
<br>

<?php
if (!issetNotEmpty($_SESSION)) {
    header('Location: connexion.php?resa=emptyID');
}
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
            echo "<br>";
            echo "<h1> Séjour dans la ville de $sVille ($sCp) </h1>";
            echo " [ <font style=\"color:orange\"> Séjour : $sTypeNav </font> ]";
            echo " [ <font style=\"color:purple\">Date début : $sDateDeb</font> ] [ <font style=\"color:green\">Date fin : $sDateDeb</font> ]";
            echo "<br>";
            echo "[ <font style=\"color:orange\"> Séjour : $sDescript </font> ] ";
            echo "<br>";
            //  echo "<div class=\"imgPhoto\">";
            echo <<<_END
            <div>

            <img src="$sPhoto1" class="imgSejResa" alt="photo sejour" class="imgBord" style="max-width: 300px; max-height: 300px;">
            <img src="$sPhoto2" class="imgSejResa" alt="photo sejour" class="imgBord" style="max-width: 300px; max-height: 300px;">
            <img src="$sPhoto3" class="rounded mx-auto d-block" alt="photo sejour" class="imgBord" style="max-width: 300px; max-height: 300px;">
            </div>
            <br>
            _END;
            /*
            echo '<img src="' . $sPhoto2 . '" alt="photo sejour" class="imgBord" style="max-width: 300px; max-height: 300px;">';
            echo '<img src="' . $sPhoto3 . '" alt="photo sejour" class="imgBord" style="max-width: 300px; max-height: 300px;">';*/
            echo "</div>";
        }
    }
} else {
    mysqli_stmt_close($stmt);
    mysqli_close($maCon);
    header('Location: sejour.php?resa=emptyResa');
    exit;
}
?>
<?php
include('footer.php')
?>