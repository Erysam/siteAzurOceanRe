<?php
require_once('configSession.php');
include('header.php');
include('fonctionsCommunes.php');

?>

<div class="h4">
    <h4>SEJOUR CHOISI</h4>
</div>
<div class="">
    <div class="imgEnTete">


        <?php
        if (!issetNotEmpty($_SESSION)) {
            header('Location: connexion.php?resa=emptyID');
            exit;
        }

        if (issetNotEmpty($_POST['idSejour'])) {

            //  echo '<img src="image/chaisesLongues.jpg" class="imgBord" alt="chaises longues, barques face à la mer et au soleil">';

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
            $bPlace;

            $idSej = $_POST['idSejour'];

            $maCon = connexion();
            $stmt = mysqli_stmt_init($maCon);
            $sqlSelect = "SELECT s.idBateau, s.typeNavSej, s.intituleSej, s.descriptionSej, s.dateDebutSej, s.dateFinSej, s.cpSej, s.villeSej, s.prixSej, s.photoSej1, s.photoSej2, s.photoSej3, b.places FROM sejour s JOIN bateau b ON s.idBateau = b.idBateau WHERE s.idSejour = ?";

            if (mysqli_stmt_prepare($stmt, $sqlSelect)) {

                mysqli_stmt_bind_param($stmt, "i", $idSej);

                $result = mysqli_stmt_execute($stmt);

                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) > 0) {
                    mysqli_stmt_bind_result($stmt, $sIdBat, $sTypeNav, $sIntit, $sDescript, $sDateDeb, $sDateFin, $sCp, $sVille, $sPrix, $sPhoto1, $sPhoto2, $sPhoto3, $bPlace);
                    mysqli_stmt_fetch($stmt);
                    echo '<div class="container">';
                    echo "<br>";
                    echo '<div class="titreResa">';
                    echo "<h2> Séjour dans la ville de $sVille ($sCp) </h2>";
                    echo "<h4>[ <font style=\"color:white\"> $sIntit </font> ] </h4>";

                    echo '</div>';
                    echo <<<_END
            <div>
            <img src="$sPhoto1" class="imgSejResa" alt="photo sejour" class="imgBord" style="max-width: 300px; max-height: 300px;">
            <img src="$sPhoto2" class="imgSejResa" alt="photo sejour" class="imgBord" style="max-width: 300px; max-height: 300px;">
            <img src="$sPhoto3" class="rounded mx-auto d-block" alt="photo sejour" class="imgBord" style="max-width: 300px; max-height: 300px;">
            </div>
            <br>
            _END;
                    echo " <p> [ <font style=\"color:black\"> Séjour : $sDescript </font> ] </p>";
                    echo "<br>";
                    echo " <p>[ <font style=\"color:white\">Date début : $sDateDeb</font> ] [ <font style=\"color:white\">Date fin : $sDateFin</font> ]</p>";
                    echo " <p>[ <font style=\"color:white\"> Séjour : $sTypeNav </font> ] ";
                    echo " [ <font style=\"color:white\"> Prix : $sPrix €</font> ] </p>";
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
            header('Location: sejours.php?resa=emptyResa');
            exit;
        }
        ?>



        <form action="enregSejour.php" method="POST" class="formConx" enctype="multipart/form-data" onsubmit="return verifNumberCp();">

            <h5>RESERVEZ VOTRE SEJOUR</h5>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="idBat">avez-vous le permis bateau?</label>
                    <select class="form-select" aria-label="select" name="idBat">
                        <option value='noPermis'>Pas de permis bateau</option>
                        <option value='permisC'>Côtier</option>
                        <option value='permisH'>Hauturier</option>
                    </select>
                </div>


                <div class="col-md-6 mb-3">
                    <label for="cp">nbre de personnes (max <?php echo $bPlace; ?>)</label>
                    <input type="number" class="form-control" name="nbPersonne" placeholder="1" min="1" max=<?php echo $bPlace; ?>>
                </div>

            </div>


            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="dateDeb">Date de début de séjour</label>
                    <input type="date" id="dateDeb" name="dateDeb" min="<?php echo date('Y-m-d'); ?>" max="2050-12-31" />
                </div>

                <div class="col-md-6 mb-3">
                    <label for="dateFin">Date de fin de séjour</label>
                    <input type="date" id="dateFin" name="dateFin" max="2050-12-31" onchange="gestionDateDebDateFin()" />
                </div>
            </div>

            <br>

            <div class="formConxDiv">
                <label class="buttonSub" for="enreg"> <input type="submit" id="enreg" value="Valider votre réservation"></label>
            </div>
        </form>

        <?php
        include('footer.php')
        ?>