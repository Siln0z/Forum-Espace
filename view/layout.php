<?php
    use App\Core\Session;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.18/dist/css/uikit.min.css" />
    <!-- CSS perso -->
    <link rel="stylesheet" href="<?= CSS_PATH ?>/style.css">
    <!-- FONT Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" 
                integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" 
                crossorigin="anonymous" />
    <link rel="icon" type="image/png" href="<?= IMG_PATH ?>/saturne.png" />
    <title>Forum Espace<?= $title ? " - ".$title : "" ?></title>
</head>
<body>
    
        <nav id="navbar" class="uk-navbar-container" uk-navbar>
            <a class="uk-navbar-item uk-logo" href="/"><img class="logo" src="<?= IMG_PATH ?>/rocketcircle.png" alt="logo" width="100" height="200">FORUM ESPACE</a>
            
            <div class="uk-navbar-right">
                <ul class="uk-navbar-nav">
                    <li class="uk-navbar-item">
                        <i class="fa-2x fas fa-globe-europe"><a href='?ctrl=home'></i>Accueil</a>
                    </li>
                    <?php
                    if(Session::get("utilisateur")){
                        ?>
                        <li class="uk-navbar-item">
                        <i class="fa-2x fas fa-rocket"><a href='?ctrl=security&action=nouveauSujet'></i> Nouveau sujet</a>
                        </li>
                        <!-- <li class="uk-navbar-item">
                            <a href='?ctrl=security&action=membres'>Membres</a>
                        </li> -->
                        <li class="uk-navbar-item">
                        <i class="fa-2x fas fa-plane-slash"><a href='?ctrl=security&action=deconnexion'></i>Déconnexion</a>
                        </li>
                        <li class="uk-navbar-item">
                        <i class="fa-2x fas fa-user-astronaut"></i><a href='#!'><?= Session::get("utilisateur")->getPseudo() ?></a>
                        </li>
                        <?php
                    }
                    else{
                        ?>
                        <li class="uk-navbar-item">
                        <i class="fa-2x fas fa-satellite"></i><a href='?ctrl=security&action=inscription'>Inscription</a>
                        </li>
                        <li class="uk-navbar-item">
                        <i class="fa-2x fas fa-satellite-dish"></i><a href='?ctrl=security&action=connexion'>Connexion</a>
                        </li>
                        </ul>
                    <?php
                    }
                    if(Session::get("utilisateur")){
                        ?>
                    <li class="uk-navbar-item">
                        <i class="fa-2x fas fa-users"></i><a href='?ctrl=utilisateur&action=membres'></i>Membres</a>
                    </li>
                    <?php
                    }
                    else{
                    }
                    ?>
            </div>  
        </nav>
    </div>
    <?php include("messages.php"); ?>
    <div>
        <?= $page //ici s'intègrera la page que le contrôleur aura renvoyé !!?> 
    </div>

<footer>
    <div>
        <p id="lienregles"><a  href="./view/home/regle.php">Règles du forum</a></p>
        <p class='uk-text-center'>&copy; 2021 - Capsule Corp</p>
    </div>
</footer>

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.18/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.18/dist/js/uikit-icons.min.js"></script>
</body>
</html>