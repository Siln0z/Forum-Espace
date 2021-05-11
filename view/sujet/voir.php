<?php
    $sujet = $data['sujet'];
    $reponses = $data["reponses"];
    use App\Core\Session;


    if(Session::get("utilisateur")){
        if(isset($sujet)){
            if(Session::get("utilisateur")->getBlocage() == 0){
            ?>
                <h1 id="utilisateurBanni">Vous ne pouvez voir le sujet, vous êtes banni</h1>        
            <?php
            }
            else{
            ?>


            <main id="" class="" >
            <article class="">
                <div id="headReponses">
                    <h1 class=""><?= $sujet->getTitre() ?></h1>
                    <p>Sujet créé par <?= $sujet->getUtilisateur() ?> le <?= $sujet->getDateCreation() ?></p>
                    <hr>
                </div>
                <?php
                foreach($reponses as $reponse){
                ?>
                <div id="reponses">
                <div class="uk-card uk-card-default ">
                    <div class="uk-card-header">
                        <div class="uk-grid-small uk-flex-middle" uk-grid>
                            <div class="uk-width-auto">
                                <img class="uk-border-circle" width="60" height="60" src="<?= IMG_PATH ?>/avatar.png">
                            </div>
                            <div class="uk-width-expand">
                                <h3 class="uk-card-title uk-margin-remove-bottom"><?=$reponse->getUtilisateur() ? $reponse->getUtilisateur() : "User supprimé" ?></h3>
                                <p class="uk-text-meta uk-margin-remove-top"><?= $reponse->getDateReponse() ?></time></p>
                            </div>
                        </div>
                    </div>
                    <div class="uk-card-body">
                        <p><?= $reponse->getTexte() ?></p>
                    </div>
                        <?php
                            if(Session::get("utilisateur")){
                                $authorId = $sujet->getUtilisateur() ? $sujet->getUtilisateur()->getId() : 0;
                                    if(Session::get("utilisateur")->getId() == $authorId || Session::get("utilisateur")->hasRole("ADMIN")){
                                    ?>
                                    <div class="uk-card-footer">
                                        <td>
                                            <p>fonctions de modération : <a href='?ctrl=security&action=deleteRep&id=<?= $reponse->getId() ?>'>Supprimer</a></p>
                                        </td>
                                    </div>
                                    <?php
                                    }
                                    }
                                    else{
                                        ?>
                                        
                                        <?php
                            }
                        ?>
                    
                    </div>
                    <article class="">
                        <p></p>
                        <p class=""></p>
                        <p class=""></p>
                    </article>
                </div>
                <?php
                }
                if($sujet->getModerationSujet() == '1'){
                ?>
                <div>
                    <h1>Repondre : </h1>
                    <form action="?ctrl=security&action=RepondreAuSujet&id=<?= $sujet->getId() ?>" method="post">
                    <p>
                        <label for="message">Message:</label>
                    </p>
                    <p>
                        <textarea id="message" name="message" rows="5" cols="200"></textarea>
                    </p>
                    <p>
                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                        <input type="submit" name="submit" value="Créer">
                    </p>
                </div>
                <?php
                }
                else {
                ?>
                    <h1>Sujet vérouillé</h1>
                <?php
                }
                ?>
                
            </article>
            </main>
        <?php
            }
        }
        else{
        ?>
        <div id="error404">
            <a href='?ctrl=security&action=connexion'><h2>Ce sujet n'existe pas !</h2></a>
            <img src="<?= IMG_PATH ?>/planetes.png">
        </div>
        <?php    
        }
    }
    else{
    ?>
        <div id="error404">
            <a href='?ctrl=security&action=connexion'><h2>Connectez vous pour acceder au forum</h2></a>
            <img src="<?= IMG_PATH ?>/planetes.png">
        </div>
    <?php
    }
    ?>

