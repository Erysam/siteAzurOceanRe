//appeler les fonction js en incluant en haut du fichier php :
//<script src="util.js">



//Affiche le MDP lorsqu'on coche ou décoche la case
function afficheMdp() {
    var passwordField = document.getElementById("pass");
    var confirmPassField = document.getElementById("confirmPass");

    passwordField.type = passwordField.type === "password" ? "text" : "password";
    confirmPassField.type = confirmPassField.type === "password" ? "text" : "password";
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

