<?php
session_start();
require('header.php');

echo  <<<_END
<h2> RGPD : Loi sur la protection des données personnelles</h2> 

<h5>RÈGLEMENT (UE) 2016/679 DU PARLEMENT EUROPÉEN ET DU CONSEIL du 27 avril 2016 relatif à la protection des personnes physiques à l'égard du traitement des données à caractère personnel <br/>
et à la libre circulation de ces données, et abrogeant la directive 95/46/CE (règlement général sur la protection des données)

Les informations recueillies sur ce formulaire sont enregistrées dans un fichier informatisé par Ste AzurOcéan 8 avenue des 40es rugissants 88088 Nepture/mer <br/>
pour l'activité de service de la Ste AzurOcéan. 
La base légale du traitement est le consentement.
Les données collectées seront communiquées aux seuls destinataires suivants :Ste AzurOcéan.<br/>
Les données sont conservées pendant 50 ans par le responsable du traitement ou critères permettant de la déterminer.<br/>
Vous pouvez accéder aux données vous concernant, les rectifier, demander leur effacement ou exercer votre droit à la limitation du traitement de vos données. <br/>
(en fonction de la base légale du traitement, mentionner également : Vous pouvez retirer à tout moment votre consentement au traitement de vos données ; <br/>
Vous pouvez également vous opposer au traitement de vos données ; Vous pouvez également exercer votre droit à la portabilité de vos données)
Consultez le site <a class ="cnil" href="https://www.cnil.fr/">cnil.fr</a> pour plus d’informations sur vos droits.

Pour exercer ces droits ou pour toute question sur le traitement de vos données dans ce dispositif, <br/>
vous pouvez contacter (le cas échéant, notre délégué à la protection des données ou le service chargé de l’exercice de ces droits) : <br/>
jean.lecam@azurocean.fr Ste AzurOcéan 8 avenue des 40es rugissants 88088 Nepture/mer.<br/>
Si vous estimez, après nous avoir contactés, que vos droits « Informatique et Libertés » ne sont pas respectés, vous pouvez adresser une réclamation à la CNIL.</h5>

_END;
?>
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