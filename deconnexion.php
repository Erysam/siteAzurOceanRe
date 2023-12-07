<?php
session_start();
session_destroy();
header("Location: index.php");
exit;  //  exit() est different du die car on peut mettre un code de statut : 0 ok et 1 erreur par exemple;
