<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/favicon.ico" sizes="16x16" href="image/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" title="style1" href="azurOceanCss.css" />
    <title>Bienvenue chez AzurOcéan</title>
</head>

<body>

    <div><img src="image/logo.jpg" alt="logo" class="logo" /></div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Accueil</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="sejours.php">Séjours</a>
                    </li>


                    <?php
                    if (isset($_SESSION['user'])) {
                        echo  <<<_END
                    <li class="nav-item">
                        <a class="nav-link" href="profil.php">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="deconnexion.php">Déconnexion</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="reservation.php">Reservations</a></li>
                            <li><a class="dropdown-item" href="formEnregBateau.php">Enregistrement Bateau</a></li>
                            <li><a class="dropdown-item" href="formEnregSejour.php">Enregistrement Séjour</a></li>
                        </ul>
                    </li>
                    _END;
                    } else {
                        echo  <<<_END
                    <li class="nav-item">
                        <a class="nav-link" href="formEnregMembre.php">Enregistrement</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="connexion.php">Connexion</a>
                    </li>
                    _END;
                    } ?>

                </ul>
            </div>
        </div>
    </nav>