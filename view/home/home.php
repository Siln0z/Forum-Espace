<?php
    use App\Core\Session;
    $sujets = $data['sujets'];
?>


<?php
    if(Session::get("utilisateur")){
    ?>
        <div class="uk-overflow-auto">
            <table class="uk-table uk-table-hover uk-table-middle uk-table-divider">
                <thead>
                    <tr>
                        <!-- <th class="uk-table-shrink"></th> -->
                        <th class="uk-table-shrink"></th>
                        <th class="uk-table-expand">Sujet</th>
                        <th class="uk-width-small">Utilisateur</th>
                        <th class="uk-width-small">posté le</th>
                        <th class="uk-table-shrink uk-text-nowrap">Etat</th>
                    </tr>
                </thead>
                <?php
                foreach($sujets as $sujet){
                ?>
                    <tbody>
                        <tr>
                            <!-- <td><input class="uk-checkbox" type="checkbox"></td> -->
                            <td><img class="uk-preserve-width " src="<?= IMG_PATH ?>/astroflag.png" width="40" alt=""></td>
                            <td class="uk-table-link">
                            <h5 class="uk-card-title">
                            <a href="?ctrl=sujet&action=voirSujet&id=<?= $sujet->getId() ?>"><?= $sujet->getTitre() ?></a>
                            </td>
                            <td class="uk-text-truncate"><?=$sujet->getUtilisateur() ? $sujet->getUtilisateur() : "User supprimé" ?></td>
                            <td class="uk-text-nowrap"><?= $sujet->getDateCreation() ?></td>
                            <?php
                                if(Session::get("utilisateur")){
                                    $authorId = $sujet->getUtilisateur() ? $sujet->getUtilisateur()->getId() : 0;
                                    if(Session::get("utilisateur")->getId() == $authorId || Session::get("utilisateur")->hasRole("ADMIN")){
                                    ?>
                                    <td>
                                        <a href='?ctrl=security&action=etatSujet&id=<?= $sujet->getId() ?>'>
                                        <?= $sujet->getModerationSujet() ? "<i class='fas fa-lock-open'></i>" : "<i class='fas fa-lock'></i>" ?>
                                        </a>
                                    </td>
                                    <?php
                                }
                                }
                                else{
                                    ?>
                                    <td>
                                        <?= $sujet->getModerationSujet() ? "<i class='fas fa-lock-open'></i>" : "<i class='fas fa-lock'></i>" ?>
                                    </td>
                                    <?php
                                }
                            ?>
                        </tr>
                    </tbody>
                
    <?php
                }?>
                </table>
    <?php
    }
    else{
    ?>
        <div class="accueil">
            <p class='quote'>“Pour une raison étrange, il nous faut toute cette technologie pour aller là-haut et comprendre la simplicité des choses: la Terre, le cosmos et la vie ne font qu'un. Depuis l'espace, c'est si difficile de comprendre nos frontières, les guerres et la haine.”</p>
            <p class='auteur'>Thomas Pesquet - Astronaute de l'Agence Spatiale Européenne</p>
            <h1>Welcome aboard !</h1><br>
            <a class="hoverOrange" href='?ctrl=security&action=connexion'><h2>Connectez vous pour acceder au forum</h2></a>        
            <img src="<?= IMG_PATH ?>/decollage.png">
        </div>
    <?php    
    }
    ?>
            
           
                
    
</main>
   