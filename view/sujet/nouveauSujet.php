<?php

    use App\Core\Session;


    // $utilisateur = $data["utilisateur"];


    if(Session::get("utilisateur")->getBlocage() == 0){
    ?>
        <h1 id="utilisateurBanni">Vous ne pouvez pas poster de sujet, vous êtes banni</h1>        
    <?php
    }
    else{
    ?>
        <div id="ajoutSujet">
        <section>
            <h1>Créer un nouveau sujet : </h1>
            <form action="?ctrl=security&action=nouveauSujet" method="post">
            <p>
                <label for="titre">titre du sujet : </label><br>
                <input type="text" name="titre" id="titre" required>
            </p>
            <p>
                <label for="message">Message:</label><br>
                <textarea id="message" name="message" rows="5" cols="200"></textarea>
            </p>
            <p>
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                <input type="submit" name="submit" value="Créer">
            </p>
        </section>
        </div>
    <?php
    }