<?php
use App\Core\Session;

$utilisateurs = $data['utilisateurs'];
// $nbSujetsReponses = $data['nbSujetsReponses'];
// var_dump($utilisateurs);
?>

<h1>Membres</h1>
<?php
    if(Session::get("utilisateur")){
?>
    <table class="uk-table">
                <thead>
                    <tr>
                        <th>Pseudo</th>
                        <th>nb Sujets</th>
                        <th>nb Reponses</th>
                    <?php
                        if(Session::get("utilisateur")->hasRole("ADMIN")){
                    ?>
                        <th>Bannir</th> 
                    <?php
                    }
                    ?>
                        
                    </tr>
                
            <?php 
                foreach($utilisateurs as $utilisateur){
                ?>
                </thead>
                        <tbody>
                            <tr>
                                <td><?= $utilisateur->getPseudo() ?><?= $utilisateur->getBlocage() ? " " : " (Utilisateur bloqué)" ?></td>
                                <td>nb sujets</td>
                                <td>nb reponses</td>
                    <?php
                    if(Session::get("utilisateur")->hasRole("ADMIN")){
                    ?>
                        <td><a href="?ctrl=utilisateur&action=bloquerUtilisateur&id=<?= $utilisateur->getId()?>"><i class="fa-2x fas fa-ban"></i></td></a>
                    <?php
                    }
                    ?>
                            </tr>
                        </tbody>
                    
                <?php
                }
                ?>
                </table>
    <?php
    }
    else{
    ?>
        <div id="error404">
            <a href='?ctrl=security&action=connexion'><h2>Connectez vous pour acceder aux membres</h2></a>
            <img src="<?= IMG_PATH ?>/ovni.png">
        </div>
    <?php
    }
    ?>