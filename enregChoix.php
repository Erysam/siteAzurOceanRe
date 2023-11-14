<?php
session_start();
require('header.php');

function issetEmpty($var1)
{
    $IssEmpt = isset($var1) && !empty($var1);
    return $IssEmpt;
}
//on peut aussi mettre du html dans le php de cette maniere : echo  <<<_END texteEnHtml _END;

?>

<div class="img-content">
    <div class="img">
        <img src="image/voilier.jpg" alt="bateaux au mouillage">
    </div>
</div>



<div class="liste">
    <ul>
        <li><a class="lien" href="pageEnregProprio.php">Vous êtes propriétaire de bateau</a></li>
        <li><a class="lien" href="pageEnregClient.php">Vous êtes un client souhaitant organiser un séjour ou un event </a></li>
        <li><a class="lien" href="connexion.php">Vous êtes déjà enregistré, cliquez ici </a></li>
    </ul>
</div>



<?php
include('footer.php')
?>