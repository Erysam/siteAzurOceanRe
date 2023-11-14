<?php
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
        <p>AzurOcéan permet à des propriétaires de bateaux,<br> des skippers professionnels de proposer des séjours
            nautiques.
            <br> Notre site vous propose des séjours sur des bateaux en haute mer, <br /> ou en navigation côtière.
            <br> Si vous êtes une entreprise, il est possible d'organiser vos fêtes d'entreprise, <br> séminaires ou
            évènements promotionnel sur de magnifiques embarcations.<br>
        </p>
    </div>
</div>

<div class="img-content">
    <div class="img">
        <img src="image/lalonde.jpg" alt="bateaux">


    </div>
</div>




<div id="container">
    <div class="footer">
        <?php
        include('footer.php')
        ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>



</html>