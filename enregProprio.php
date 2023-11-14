<?php
session_start();
function issetEmpty($var1){
	$IssEmpt =isset($var1) && !empty($var1);
    return $IssEmpt;
}
function connexion (){
    $conx = mysqli_connect("localhost", "root", "") or
    die("connection localhost impossible (0)");
    mysqli_select_db($conx, "azurocean") or die("pb avec la base azurocean (1)"); 
    return $conx;   
    }
    
$type = 0;
if ($_POST['type'] == 'on'){
    $type = 1;
}

if (issetEmpty($_POST['email']) && issetEmpty($_POST['nom']) && issetEmpty($_POST['prenom']) && issetEmpty($_POST['adresse']) && issetEmpty($_POST['cp']) && issetEmpty($_POST['ville']) && issetEmpty($_POST['tel']) && issetEmpty($_POST['login']) && issetEmpty($_POST['mdp'])){
    $mail = $_POST['email'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['adresse'];
    $cp = $_POST['cp'];
    $ville = $_POST['ville'];
    $tel = $_POST['tel'];
    $log = $_POST['login'];
    $mdp = $_POST['mdp'];

$maCon = connexion ();
$stmt = mysqli_stmt_init($maCon);
$sqlInser= "INSERT INTO azurocean.client (id, email, nom, prenom, adresse, cp, ville, tel, login, mdp, type) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

mysqli_stmt_prepare($stmt, $sqlInser);
mysqli_stmt_bind_param($stmt, "sssssssssi", $mail, $nom, $prenom, $adresse, $cp, $ville, $tel, $log, $mdp, $type); 
$result = mysqli_stmt_execute($stmt) or die("query fail 2");

header('Location: http://work2/Site%20AzurOcean/connexion.html');
exit();
}
else {
    require ("en_tete.html");
    echo "Vous n'avez pas reussi à vous enregistrer";
    echo "<br/>";
    echo "<a href=\"http://work2/Site%20AzurOcean/pageEnregProprio.html\">Pour enregistrer votre profil<\a>";
    echo "<a href=\"http://work2/Site%20AzurOcean/pageDaccueil.html\">Pour revenir à l'accueil<\a>";
    require ("footer.html");
}
mysqli_close($maCon); 
?>