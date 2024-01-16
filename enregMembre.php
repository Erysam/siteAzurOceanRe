<?php
session_start();
include('fonctionsCommunes.php');
require("header.php");

if (issetEmpty($_POST['email']) && issetEmpty($_POST['nom']) && issetEmpty($_POST['prenom']) && issetEmpty($_POST['adresse']) && issetEmpty($_POST['cp']) && issetEmpty($_POST['ville']) && issetEmpty($_POST['tel']) && issetEmpty($_POST['mdp']) && issetEmpty($_POST['confirmMdp'])) {

    $mail = strip_tags($_POST['email']); //strip...permet d'éviter l'injection de balises XSS (malware)

    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        die("Le mail est incorrect.");
        echo "<a href=\"http://localhost/siteAzurOceanRe/formEnregMembre.php\">Pour enregistrer votre profil</a>";
    } //FILTER... permet de verifier le format du mail

    $mdp = $_POST['mdp'];
    $confirmMdp = $_POST['confirmMdp'];
    $nom = strip_tags($_POST['nom']);
    $prenom = strip_tags($_POST['prenom']);
    $adresse = strip_tags($_POST['adresse']);
    $cp = strip_tags($_POST['cp']);
    $ville = strip_tags($_POST['ville']);
    $tel = strip_tags($_POST['tel']);
    $mdp = password_hash($_POST['mdp'], PASSWORD_ARGON2ID);


    // Converti les valeurs initialement en string (type texte dans le form), en entiers
    $cp = (int)$cp;
    $tel = (int)$tel;


    //verifier que la conversion a marché :
    if ($cp == 0 || $tel == 0) {
        // quand les valeurs ne sont pas des entiers, le 0 est renvoyé à la BD automatiquement
        header('Location: formEnregMembre.php?erreur=erreurNum');
        die("Le code postal et le téléphone doivent être des nombres.");
    }

    $maCon = connexion();
    $stmt = mysqli_stmt_init($maCon);
    $sqlInser = "INSERT INTO azurocean.membre (idMembre, email, nom, prenom, adresse, cp, ville, tel, mdp) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)";
    //(NULL, '$mail','$nom', '$prenom', '$adresse', '$cp', '$ville', '$tel', '$mdp', '$type')";

    if (mysqli_stmt_prepare($stmt, $sqlInser)) {
        //s'assurer que la préparation de la requête est correcte avant exécution

        mysqli_stmt_bind_param($stmt, "ssssisis", $mail, $nom, $prenom, $adresse, $cp, $ville, $tel, $mdp); /* le nbre de s represente le nbre de ? et le s pour des 
    valeurs string dans la table et i pour les valeur int dans la table (le NULL n'est pas à compter dans les i ou s)*/

        try {
            $result = mysqli_stmt_execute($stmt);

            // Si l'insertion réussit, redirigez vers la page de connexion
            //if ($result) {
            header('Location: connexion.php'); //le exit ou die n a pas sa place, car header termine le script php automatiquement 
            mysqli_close($maCon);

            //} 

        } catch (mysqli_sql_exception $e) { //$e instance de classe mysqli-sql-exception pour acceder à la methode getMessage() afin d avoir un piste sur l'erreur.)

            // Vérif violation clé d'unicité grace au code erreur de duplicité errno 1062
            if (mysqli_errno($maCon) == 1062) {
                mysqli_close($maCon);
                // Redir vers le form avec get erreur pour expliquer au user l'erreur (script php sur le form)
                header('Location: formEnregMembre.php?erreur=duplication');
            }
            // Autres types erreurs lors de l'exécution (genre string à la place de int...)
            die("Une erreur s'est produite lors de l'inscription.");
        }
        // on peut var_dump le code erreur de l exception avec $e->getMessage());
        // var_dump(mysqli_errno($maCon) == 1062) pour savoir si le code erreur c est produit ou non : renvoi true or false;
    }
} else {
    die("Erreur dans la saisie du formulaire.");
}

mysqli_close($maCon);
require("footer.php");
