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
        <li>
            <a class="lien" href="formEnregMembre.php">Vous êtes propriétaire de bateau,
                vous voulez réserver un séjour ou un organiser un event, veuillez vous enregistrer</a>
        </li>

        <li>
            <a class="lien" href="formEnregBateau.php">Vous souhaitez enregistrer un bateau</a>
        </li>

        <li>
            <a class="lien" href="connexion.php">Vous êtes déjà enregistré, cliquez ici </a>
        </li>
    </ul>
</div>

<?php
include('footer.php')
?>