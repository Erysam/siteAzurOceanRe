<?php
session_start();
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