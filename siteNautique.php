<?php
session_start();
include('fonctionsCommunes.php');
include('header.php');
?>

<div class="img-content">
    <div class="imgEnTete">
        <img src="image/sunOdyssey391.JPG" alt="rgpd" class="imgBord">
    </div>
</div>

<?php
if (!empty($_GET['cp'])) {
    if (issetNotEmpty($_GET['cp']) && (isFiveNumber($_GET['cp']) == 5)) {

        $cp = $_GET['cp'];

        $maCon = connexion();
        $stmt = mysqli_stmt_init($maCon);
        $sqlSelect = "SELECT * FROM sejour WHERE cpSej = ? AND reservation != '1'";

        if (mysqli_stmt_prepare($stmt, $sqlSelect)) {

            mysqli_stmt_bind_param($stmt, "i", $cp);

            $result = mysqli_stmt_execute($stmt);

            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) > 0) {
                mysqli_stmt_bind_result($stmt, $sIdSej, $sIdBat, $sTypeNav, $sIntit, $sDescript, $sDateDeb, $sDateFin, $sAdress, $sCp, $sVille, $sPrix, $sPhoto1, $sPhoto2, $sPhoto3);

                while (mysqli_stmt_fetch($stmt)) {

                    echo "<br/>";
                    echo "<h1> Séjour dans la ville de $sVille ($sCp) </h1>";
                    echo " [ <font style=\"color:orange\"> Séjour : $sTypeNav </font> ]";
                    echo " [ <font style=\"color:purple\">Date début : $sDateDeb</font> ] [ <font style=\"color:green\">Date fin : $sDateDeb</font> ]";
                    echo "<br>";
                    echo "[ <font style=\"color:orange\"> Séjour : $sDescript </font> ] ";
                    echo "<br/>";
                    echo "<div class=\"imgPhoto\">";

                    for ($i = 0; $i < 3; $i++) {
                        $sPhoto = ${"sPhoto" . $i + 1};
                        $photoPath = $sPhoto . $i + 1;

                        if (isset($photoPath)) {
                            $photoData = affichePhoto($photoPath);
                            if ($photoData) {
                                header("Content-type: " . $photoData['contentType']);
                                echo $photoData['content'];
                            } else {
                                var_dump($photoData);
                                echo 'ERREUR';
                            }
                        } else {
                            echo var_dump($photoPath);
                            echo 'image non trouvée';
                        }
                    }
                    echo "<div/>";
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