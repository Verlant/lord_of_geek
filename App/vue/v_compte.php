<!-- <p style="text-align: center;">
    <img src="./public/images/a_venir.png" width="500px" hight="auto">
</p> -->
<div>
    <h1>Espace client</h1>
    <h2>Informations personnelles :</h2>
    <ul>
        <li>Pseudo : <?= $infosClient['pseudoClient'] ?></li>
        <li>Nom : <?= $infosClient['nomPrenomClient'] ?></li>
        <li>E-mail : <?= $infosClient['mailClient'] ?></li>
    </ul>
    <h2>Adresses :</h2>
    <h3>Ajoutez une adresse :</h3>
    <div>
        <fieldset>
            <legend>Nouvelle adresse</legend>
            <form action="index.php?uc=compte&action=ajouterAdresse" method="post">
                <p>
                    <label for="nom">Nom : </label>
                    <input type="text" name="nom" id="nom">
                </p>
                <p>
                    <label for="adresse">Adresse : </label>
                    <input type="text" name="adresse" id="adresse">
                </p>
                <p>
                    <label for="ville">Ville : </label>
                    <input type="text" name="ville" id="ville">
                </p>
                <p>
                    <label for="codePostal">Code postal : </label>
                    <input type="text" name="codePostal" id="codePostal" maxlength="5">
                </p>
                <p>
                    <input type="submit" value="Valider l'adresse" name="valider">
                    <input type="reset" value="Annuler" name="annuler">
                </p>
            </form>
        </fieldset>
    </div>
</div>