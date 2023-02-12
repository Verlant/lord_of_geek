<section id="creationCommande">
    <form method="POST" action="index.php?uc=commander&action=confirmerCommande">
        <fieldset class="form-commande">
            <legend>Commande</legend>
            <?php $i = 1;
            foreach ($adressesClient as $adresse) :
                $id = $adresse['id'];
                $nom = $adresse['nomPrenomLivraison'];
                $rue = $adresse['adresseRueLivraison'];
                $ville = $adresse['nomVille'];
                $cp = $adresse['codePostal'];
            ?>
                <div class="div-commande">
                    <label for="adresse_<?= $i ?>" class="label">
                        <p class="bold">Adresse n°<?= $i ?></p>
                        <ul>
                            <li><span class="underline">Nom</span> : <?= $nom ?></li>
                            <li><span class="underline">Rue</span> : <?= $rue ?></li>
                            <li><span class="underline">Ville</span> : <?= $ville ?></li>
                            <li><span class="underline">Code postal</span> : <?= $cp ?></li>
                        </ul>
                    </label>
                    <input type="hidden" name="adresse_id" value="<?= $id ?>" />
                    <input type="radio" name="adresse" id="adresse_<?= $i ?>" class="input-commande" />
                </div>
            <?php $i++;
            endforeach; ?>
            <input type="submit" value="Valider l'adresse de livraison" name="valider" class="input-commande">
        </fieldset>
    </form>
</section>