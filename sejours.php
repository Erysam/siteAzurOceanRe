<?php

$sessionLifetime = 1800; //  durée de la session 30mn 60sec x 30mn = 1800 sec
session_set_cookie_params($sessionLifetime);
session_start();
session_regenerate_id(true);
include('header.php');
include('fonctionsCommunes.php');

?>

<?php

$maCon = connexion();
$stmt = mysqli_stmt_init($maCon);
$sqlSelect = "SELECT * FROM sejour";

if (mysqli_stmt_prepare($stmt, $sqlSelect)) {

    $result = mysqli_stmt_execute($stmt);

    mysqli_stmt_store_result($stmt);
    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_bind_result($stmt, $sIdSej, $sIdBat, $sTypeNav, $sIntitil, $sDescript, $sDateDeb, $sDateFin, $sAdresse, $sCp, $sVille, $sPrix, $sPhoto1, $sPhoto2, $sPhoto3);

        $num = 0; //compteur pour mon carousel afin que id soit différente pour chaque séjour
        while (mysqli_stmt_fetch($stmt)) { //tant que je recup des resultats de mon stmt, je traite chq result ici
            echo "<br/>";
            echo "<h1> Séjour dans la ville de $sVille ($sCp) </h1>";
            echo " [ <font style=\"color:orange\"> Séjour : $sTypeNav </font> ]";
            echo " [ <font style=\"color:purple\">Date début : $sDateDeb</font> ] [ <font style=\"color:green\">Date fin : $sDateDeb</font> ]";
            echo "<br>";
            echo "[ <font style=\"color:orange\"> Séjour : $sDescript </font> ] ";
            echo "<br/>";
            $num = $num + 1;

            echo <<<_END
        
            <div id="myCarousel$num" class="carousel slide"data-ride="carousel">

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="$sPhoto1" class="d-block w-100" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img src="$sPhoto2" class="d-block w-100" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img src="$sPhoto3" class="d-block w-100" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#myCarousel$num" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel$num" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        
            _END;

            echo <<<_END

            <div class="formConxDiv">
                <form action="reservation.php" method="post">
                    <input type="hidden" name="idSejour" value="$sIdSej">
                    <input type="submit" class="buttonRes" value="Reserver">
                </form>
            </div>
            
            _END;
        }
        mysqli_stmt_close($stmt);
    } else {
        mysqli_stmt_close($stmt);
        mysqli_close($maCon);
        header('Location: index.php?cp=emptyCp');
        include('footer.php');
        exit;
    }
} else {
    mysqli_close($maCon);
    die('pas de réponse');
}

mysqli_close($maCon);

include('footer.php');
