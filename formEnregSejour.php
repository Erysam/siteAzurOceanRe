<?php
require_once('configSession.php'); // différence avec require, require_ once vérifie si le fichier a déjà été inclus si oui, elle ne l inclusq pas de nouveau
require("header.php");
require('fonctionsCommunes.php');


if (!issetNotEmpty($_SESSION)) {
    header('Location: connexion.php');
}

//Si le user n'est pas deconnecté par le $sessionLifeTime ou autre (on peut avoir une session active mais ne pas etre connecté)
if (!issetNotEmpty($_SESSION['user']['id'])) {
    header('Location: connexion.php');
}

if (isset($_GET['modif']) && $_GET['modif'] === 'enregSéjourReussi') {
    echo ('Enregistrement du séjour effectué.');
}
/* NPPT est ce qu on fait une re identif pour securiser l'enregistrement du séjour? A voir
if (isset($_GET['erreur']) && $_GET['erreur'] === 'erreurMdp') {
    echo ('Veuillez saisir un password valide.');
}*/

if (isset($_GET['erreur']) && $_GET['erreur'] === 'erreurNum') {
    echo ('Veuillez saisir un téléphone ou/et un cp valide.');
}

if (isset($_GET['erreur']) && $_GET['erreur'] === 'erreurEnreg') {
    echo ("Erreur d'enregistrement, veuillez recommencer");
}
if (isset($_GET['enreg']) && $_GET['enreg'] === 'enregReussi') {
    echo ('Enregistrement du séjour réussi, voulez vous enregistrer un nouveau séjour?');
}
?>

<div class="h4">
    <h4>Proposer un séjour :</h4>
</div>

<div class="img-content">
    <div class="img-conx">
        <img src="image/zephyredim.jpg" alt="bateaux">
    </div>
</div>



<container>
    <form action="enregSejour.php" method="POST" class="formConx" enctype="multipart/form-data" onsubmit="return verifNumberCp()">

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="intitule">Intitulé du séjour</label>
                <input type="text" class="form-control" name="intitule" id="intitule" required>
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

        <div class="formConxDiv">
            <label for="idBat">Nom du bateau</label>
            <select class="form-select" aria-label="select" name="idBat">

                <?php
                $idUserSession = $_SESSION['user']['id'];
                $nomBat;
                $idBat;
                var_dump($idUserSession);
                $maCon = connexion(); //methode de connexion à ma BDD 
                $stmt = mysqli_stmt_init($maCon);
                $sqlSelect = "SELECT idBateau, nomBateau FROM bateau WHERE idProp = ?";
                if (mysqli_stmt_prepare($stmt, $sqlSelect)) {
                    mysqli_stmt_bind_param($stmt, "i", $idUserSession);
                    $result = mysqli_stmt_execute($stmt);

                    if ($result) {
                        mysqli_stmt_store_result($stmt);
                        if (mysqli_stmt_num_rows($stmt) > 0) {
                            mysqli_stmt_bind_result($stmt, $idBat, $nomBat);
                            $compteur = 1;
                            while (mysqli_stmt_fetch($stmt)) {
                                echo "<option value='$idBat'>$nomBat</option>";
                            }
                        } else {
                            echo "<option value='$compteur' disabled selected>Aucun bateau trouvé</option>";
                            $compteur++;
                        }
                    } else {
                        echo "Erreur lors de l'exécution de la requête";
                        exit();
                    }
                } else {
                    echo "Erreur lors de la préparation de la requête";
                }

                ?>

            </select>
        </div>



        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="adresse">Adresse</label>
                <input type="text" class="form-control" name="adresse" id="adresse">
                <small id="textmuted" class="form-text text-muted">
                    *Si adresse différente du port d'attache
                </small>
            </div>

            <div class="col-md-6 mb-3">
                <label for="cp">Code postal</label>
                <input type="text" class="form-control" name="cp" id="cp">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="ville">Ville</label>
                <input type="text" class="form-control" name="ville" id="ville">
            </div>


            <div class="col-md-6 mb-3">
                <label for="prix">Prix</label>
                <input type="text" class="form-control" name="prix" id="prix" oninput="verifNumber(this)" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="dateDeb">Date de début de séjour</label>
                <input type="date" id="start" name="dateDeb" max="2050-12-31" />
            </div>

            <div class="col-md-6 mb-3">
                <label for="dateFin">Date de fin de séjour</label>
                <input type="date" id="start" name="dateFin" max="2050-12-31" />
            </div>
        </div>

        <div class="formConxDiv">
            <label for="description">Description</label>
            <textarea type="text" class="form-control" name="description" id="description" placeholder="Détaillez le séjour proposé" required rows="10"></textarea>
        </div>

        <div class="formConx">
            <label for="formFile">Photo du séjour (max 3 images)</label>
            <input class="formFile" type="file" name="photo1[]" id="formFile" multiple accept="image/jpeg, image/png">
            <input class="formFile" type="file" name="photo2[]" id="formFile" multiple accept="image/jpeg, image/png">
            <input class="formFile" type="file" name="photo3[]" id="formFile" multiple accept="image/jpeg, image/png">
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