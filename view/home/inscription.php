<div id="inscription">
<h1>Inscription :</h1>
<form action="?ctrl=security&action=inscription" method="post">
    <p>
        <label for="pseudo">Pseudo : </label><br>
        <input type="text" name="pseudo" id="pseudo" required>
    </p>
    <p>
        <label for="mail">email : </label><br>
        <input type="email" name="email" id="mail" required>
    </p>
    <p>
        <label for="pass">mot de passe : </label><br>
        <input type="password" name="password" id="pass" required>
    </p>
    <p>
        <label for="passr">Ressaisir le mot de passe : </label><br>
        <input type="password" name="password_repeat" id="passr" required>
    </p>
    <p>
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <input type="submit" name="submit" value="S'INSCRIRE">
    </p>
</form>
</div>