<div>
    <fieldset>
        <legend>Connexion</legend>
        <form action="index.php?uc=connexion&action=connexion" method="post">
            <p>
                <label for="mail_connexion">E-mail : </label>
                <input type="email" name="mail_connexion" id="mail_connexion">
            </p>
            <p>
                <label for="mdp_connexion">Mot de passe : </label>
                <input type="password" name="mdp_connexion" id="mdp_connexion">
            </p>
            <p>
                <input type="submit" value="Se connecter" name="valider">
                <input type="reset" value="Annuler" name="annuler">
            </p>
        </form>
    </fieldset>
</div>

<div>
    <fieldset>
        <legend>Inscription</legend>
        <form action="index.php?uc=connexion&action=inscription" method="post">
            <p>
                <label for="mail">E-mail : </label>
                <input type="email" name="mail" id="mail">
            </p>
            <p>
                <label for="pseudo">Pseudo : </label>
                <input type="text" name="pseudo" id="pseudo">
            </p>
            <p>
                <label for="mdp">Mot de passe : </label>
                <input type="password" name="mdp" id="mdp">
            </p>
            <p>
                <label for="prenom">Prénom : </label>
                <input type="text" name="prenom" id="prenom">
            </p>
            <p>
                <label for="nom">Nom : </label>
                <input type="text" name="nom" id="nom">
            </p>
            <p>
                <input type="submit" value="S'inscrire" name="valider">
                <input type="reset" value="Annuler" name="annuler">
            </p>
        </form>
    </fieldset>
</div>