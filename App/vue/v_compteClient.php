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
    <div class="flex-wrap">
        <?php $i = 1;
        foreach ($adressesClient as $adresse) :
            $nom = $adresse['nomPrenomLivraison'];
            $rue = $adresse['adresseRueLivraison'];
            $ville = $adresse['nomVille'];
            $cp = $adresse['codePostal'];
        ?>
            <div>
                <h4>Adresse n°<?= $i ?></h4>
                <ul>
                    <li><span class="underline">Nom</span> : <?= $nom ?></li>
                    <li><span class="underline">Rue</span> : <?= $rue ?></li>
                    <li><span class="underline">Ville</span> : <?= $ville ?></li>
                    <li><span class="underline">Code postal</span> : <?= $cp ?></li>
                </ul>
            </div>
        <?php $i++;
        endforeach; ?>
    </div>

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
                    <label for="adresse">Rue : </label>
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

    <h3>Historique des commandes : </h3>
    <section class="historique-commandes">
        <?php foreach ($commandes as $commande) : ?>
            <article id="jeux_commandes">
                <div class="info_commande">
                    <h4>Commande n°<?= $commande["id_commande"] ?></h4>
                    <div><span class="bold">Prix total</span> : <?= $commande["prixTotal"] ?> €</div>
                    <span class="bold">Adresse livrée</span>
                    <ul>
                        <li><span class="underline">Nom</span> : <?= $commande["nom"] ?></li>
                        <li><span class="underline">Rue</span> : <?= $commande["rue"] ?></li>
                        <li><span class="underline">Ville</span> : <?= $commande["ville"] ?></li>
                        <li><span class="underline">Code postal</span> : <?= $commande["cp"] ?></li>
                    </ul>

                </div>
                <div class="jeux_commande">
                    <?php
                    foreach ($jeuxParCommandes[$commande["id_commande"]] as $unJeu) :
                        $description = $unJeu['nomJeux'];
                        $prix = $unJeu['prixVente'];
                        $image = $unJeu['imageJeux'];
                        $etat = $unJeu['descriptionEtat'];
                        $console = $unJeu['nomConsole'];
                    ?>
                        <div>
                            <?php if (empty($image)) : ?>
                                <img src="public/images/jeux/default.png" alt="Image de <?= $description; ?>" />
                            <?php else : ?>
                                <img src="public/images/jeux/<?= $image; ?>" alt="Image de <?= $description; ?>" />
                            <?php endif ?>
                            <p>Nom : <?= $description; ?></p>
                            <p>Console : <?= $console; ?></p>
                            <p>&Eacute;tat : <?= $etat; ?></p>
                            <p><?= "Prix : " . $prix . " Euros"; ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </article>
        <?php endforeach; ?>
    </section>
</div>