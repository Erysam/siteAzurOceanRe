<?php
session_start();
session_regenerate_id(true);
include('header.php');
?>


<div class="container">
    <form class="d-flex" action="siteNautique.php" method="GET">
        <p>Site nautique</p>
        <input class="form-control me-2" type="search" placeholder="Saisir le code postal" name="cp" aria-label="Search">
    </form>
</div>

<div class="container">
    <div class="texte_superpose">
        <p>AzurOcéan permet à des propriétaires de bateaux,
            <br> des skippers professionnels de proposer des séjours nautiques.
            <br> Notre site vous propose des séjours sur des bateaux en haute mer,
            <br> ou en navigation côtière.
            <br> Si vous êtes une entreprise, il est possible d'organiser vos fêtes d'entreprise,
            <br> séminaires ou évènements promotionnel sur de magnifiques embarcations.
            <br>
        </p>

        <?php
        if (isset($_SESSION['user'])) {
            echo "<h1>Bienvenue, " . $_SESSION['user']['prenom'] . "!</h1>";
        } else {
            echo "<p>Connectez-vous pour profiter de fonctionnalités supplémentaires.</p>";
        }
        ?>

    </div>
</div>

<div class="img-content">
    <div class="img_index">
        <img src="image/lalonde.jpg" alt="bateaux">
    </div>
</div>


<?php
include('footer.php')
?>