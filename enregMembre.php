<?php
session_start();
include('fonctionsCommunes.php');
require("header.php");


if (issetEmpty($_POST['email']) && issetEmpty($_POST['nom']) && issetEmpty($_POST['prenom']) && issetEmpty($_POST['adresse']) && issetEmpty($_POST['cp']) && issetEmpty($_POST['ville']) && issetEmpty($_POST['tel']) && issetEmpty($_POST['login']) && issetEmpty($_POST['mdp'])) {
    $mail = strip_tags($_POST['email']); //strip...permet d'éviter l'injection de balises XSS (malware)

    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        die("Le mail est incorrect.");
    } //FILTER... permet de verifier le mail

    $nom = strip_tags($_POST['nom']);
    $prenom = strip_tags($_POST['prenom']);
    $adresse = strip_tags($_POST['adresse']);
    $cp = strip_tags($_POST['cp']);
    $ville = strip_tags($_POST['ville']);
    $tel = strip_tags($_POST['tel']);
    $log = strip_tags($_POST['login']);
    $mdp = password_hash($_POST['mdp'], PASSWORD_ARGON2ID);


    $maCon = connexion();
    $stmt = mysqli_stmt_init($maCon);
    $sqlInser = "INSERT INTO azurocean.membre (idMembre, email, nom, prenom, adresse, cp, ville, tel, login, mdp) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    //(NULL, '$mail','$nom', '$prenom', '$adresse', '$cp', '$ville', '$tel', '$log', '$mdp', '$type')";

    mysqli_stmt_prepare($stmt, $sqlInser);
    mysqli_stmt_bind_param($stmt, "ssssisiss", $mail, $nom, $prenom, $adresse, $cp, $ville, $tel, $log, $mdp); /* le nbre de s represente le nbre de ? et le s pour des 
    valeurs string dans la table et i pour les valeur int dans la table (le NULL n'est pas à compter dans les i ou s)*/
    $result = mysqli_stmt_execute($stmt) or die("query fail ");
    header('Location: connexion.php');
    exit();
} else {

    echo "Vous n'avez pas reussi à vous enregistrer";
    // A CORRIGER echo "<a href=\"http://work2/Site%20AzurOcean/pageEnregProprio.html\">Pour enregistrer votre profil</a>";
    // A CORRIGER echo "<a href=\"http://work2/Site%20AzurOcean/pageDaccueil.html\">Pour revenir à l'accueil</a>";

}
mysqli_close($maCon);
require("footer.php");
