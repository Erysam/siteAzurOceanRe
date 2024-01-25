<?php
session_start();
include('fonctionsCommunes.php');
include('header.php');
?>

<div class="img-content">
    <div class="img">
        <img src="image/sunOdyssey391.JPG" alt="rgpd">
    </div>
</div>

<?php
if (!empty($_GET['cp'])) {
    if (issetNotEmpty($_GET['cp']) && (is_numeric($_GET['cp'])) && (strlen($_GET['cp']) == 5)) {

        $cp = $_GET['cp'];

        $maCon = connexion();
        $stmt = mysqli_stmt_init($maCon);
        $sqlSelect = "SELECT * FROM sejour WHERE cpSejour = ?"; // Ajoutez la condition appropriée ici

        if (mysqli_stmt_prepare($stmt, $sqlSelect)) {

            mysqli_stmt_bind_param($stmt, "i", $cp);

            $result = mysqli_stmt_execute($stmt);

            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) > 0) {
                mysqli_stmt_bind_result($stmt, $sIdSej, $sIdBat, $sTypeNav, $sIntit, $sDescript, $sDateDeb, $sDateFin, $sAdress, $sCp, $sVille, $sPrix, $sPhoto1, $sPhoto2, $sPhoto3);

                while (mysqli_stmt_fetch($stmt)) {
                    // Traitez chaque ligne de résultat ici
                    echo "<br/>";
                    echo "<h1> Séjour dans la ville de $sVille ($sCp) </h1>";
                    echo " [ <font style=\"color:orange\"> Séjour : $sTypeNav </font> ]";
                    echo " [ <font style=\"color:purple\">Date début : $sDateDeb</font> ] [ <font style=\"color:green\">Date fin : $sDateDeb</font> ]";
                    echo "<br>";
                    echo "[ <font style=\"color:orange\"> Séjour : $sDescript </font> ] ";
                    echo "<br/>";
                    echo "[ Photo séjour : $sPhoto1 ] ";
                    echo "<br/>";
                    echo <<<_END
                    <div class="formConxDiv">
                        <form action="reservation.php" method="post">
                            <input type="hidden" name="idSejour" value="$sIdSej">
                          
                            <input type="submit" class="buttonRes" value="Reserver">
                           
                        </form>
                    </div>
                    _END;
                }
            } else {
                mysqli_stmt_close($stmt);
                mysqli_close($maCon);
                header('Location: index.php?cp=emptyCp');
                include('footer.php');
                exit;
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($maCon);
    } else {
        echo "<a class=\"lien\" href=\"index.php\">Revenir à l'accueil</a><br>";
        die("Les données sont invalides, vous devez saisir des nombres valides ");
    }
} else {

    die('Les données sont vides');
}
?>

<?php
include('footer.php')
?>