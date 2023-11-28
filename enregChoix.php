<?php
session_start();
require('header.php');


?>

<div class="img-content">
    <div class="img">
        <img src="image/voilier.jpg" alt="bateaux au mouillage">
    </div>
</div>

<div class="liste">
    <ul>
        <li><a class="lien" href="formEnregMembre.php">Vous êtes propriétaire de bateau, vous êtes un client souhaitant organiser un séjour ou un event</a></li>
        <li><a class="lien" href="connexion.php">Vous êtes déjà enregistré, cliquez ici </a></li>
    </ul>
</div>

<?php
include('footer.php')
?>