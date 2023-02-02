<!-- <p style="text-align: center;">
    <img src="./public/images/a_venir.png" width="500px" hight="auto">
</p> -->
<div>
    <fieldset>
        <legend>Inscription</legend>
        <form action="index.php?uc=compte&action=connexion" method="post">
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
                <label for="nom">Nom : </label>
                <input type="text" name="nom" id="nom">
            </p>
            <p>
                <label for="prenom">Prénom : </label>
                <input type="text" name="prenom" id="prenom">
            </p>
            <p>
                <input type="submit" value="Valider" name="valider">
                <input type="reset" value="Annuler" name="annuler">
            </p>
        </form>
    </fieldset>
</div>