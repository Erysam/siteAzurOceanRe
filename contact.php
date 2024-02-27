<?php
require_once('configSession.php'); // différence avec require, require_ once vérifie si le fichier a déjà été inclus si oui, elle ne l inclusq pas de nouveau
require('header.php');

echo  <<<_END

<h1> Ste AzurOcéan </h1> 

<h3>8 avenue des 50es Hurlants <br/>
88088 Nepture/mer <br/</h3>
<h4>Tél : 01 48 08 88 08 
</h4>

<h4>contact@azurocean.fr</h4>


_END;

?>
    <?php
    include('footer.php')
    ?>
