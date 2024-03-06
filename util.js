//appelle les fonctions js en incluant dans le footer php : <script src="util.js">



//Affiche le MDP lorsqu'on coche ou décoche la case (detection par le onclick de la balise input de la checkbox)
function afficheMdp() {
    var passwordChamp = document.getElementById("pass");
    var confirmPassChamp = document.getElementById("confirmPass");
    //c'est le type de champ dans la balise input qui determine si le texte est masqué ou non
    passwordChamp.type = passwordChamp.type === "password" ? "text" : "password";
    confirmPassChamp.type = confirmPassChamp.type === "password" ? "text" : "password";

    //setTimeout est une fx predefinie dans laquelle on met la fx à executer et le delai d'execution de la fx
    //(function()) est une fonction anonyme souvent utilisée quand c est une fonction local (non reutilisée) ou pour être concis (utilisée dans les callback dans le cadre des opérations asynchrone)
    setTimeout(function () {
        passwordChamp.type = "password";
        confirmPassChamp.type = "password";
    }, 30000); //30 millisec
}

//verifie que les deux champs sont identiques (pass et confirmpass)
function verifierMotDePasse() {
    console.log()
    //.value : récupère la valeur immediate de l'élément (ce que le user saisie en temps reel), au dessus on en a pas besoin car c est juste une valeur d affichage 
    var password = document.getElementById("pass").value;
    var confirmPass = document.getElementById("confirmPass").value;

    if (password !== confirmPass) {
        alert("Les mots de passe ne correspondent pas. Veuillez les vérifier.");
        return false; // Empêche l'envoi du formulaire
    }

    return true; // Permet l'envoi du formulaire si les mots de passe correspondent
}


//obliger le user à mettre des maj char spé et symbole

function verifMdpChar() {
    var password = document.getElementById("pass").value;

    // Au moins une majuscule
    var majusculeRegex = /[A-Z]/;
    // Au moins un chiffre
    var chiffreRegex = /[0-9]/;
    // Au moins un caractère spécial (à personnaliser)
    var caractereSpecialRegex = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/;

    if (!majusculeRegex.test(password) || !chiffreRegex.test(password) || !caractereSpecialRegex.test(password)) {
        alert("passe doit contenir au moins une majuscule, un chiffre et un caractère spécial.");
        return false;
    }

    return true;
}


function verifNumber(input) {
    console.debug("verifNumber => nbrAverif");
    var nbrAverif = input.value;
    console.debug(nbrAverif);
    var chiffreRegex = /^[0-9]*$/; //'^' début de la chaine, '$' fin de la chaine et '+' le chiffre precedent peut apparait plus d'une fois
    if (!chiffreRegex.test(nbrAverif)) {
        input.setCustomValidity("Doit contenir uniquement des nombres. !!!"); //Message d erreur 'true' donc le form ne peut etre envoyé 
    } else {
        input.setCustomValidity(""); //le message est vide donc le form  peut etre envoyé  (même fonctionnement qu un true/false)
    }

}

function verifNumberCp() {
    var getCp = document.getElementById("cp").value;
    var chiffreRegex = [0 - 9];
    if (!chiffreRegex.test(getCp)) {
        alert("Le code postal doit contenir uniquement des nombres.");
        return false;
    }
    if (getCp > 1000 && getCp < 98891) {
        alert("Le code postal doit être valide.")
        return false;
    }
    return true;
}


