<section id="visite">
    <aside id="categories">
        <ul>
            <?php
            foreach ($lesCategories as $uneCategorie) :
                $idCategorie = $uneCategorie['id'];
                $libCategorie = $uneCategorie['nomCategorie'];
            ?>
                <li>
                    <a href=index.php?uc=visite&categorie=<?= $idCategorie ?>&action=voirJeux><?= $libCategorie ?></a>
                </li>
            <?php endforeach ?>
        </ul>
    </aside>
    <section id="jeux">
        <?php
        foreach ($lesJeux as $unJeu) :
            $id = $unJeu['id'];
            $description = $unJeu['nomJeux'];
            $prix = $unJeu['prixVente'];
            $image = $unJeu['imageJeux'];
            $etat = $unJeu['descriptionEtat']
        ?>
            <article>
                <?php if (empty($image)) : ?>
                    <img src="public/images/jeux/default.png" alt="Image de <?= $description; ?>" />
                <?php else : ?>
                    <img src="public/images/jeux/<?= $image; ?>" alt="Image de <?= $description; ?>" />
                <?php endif ?>
                <p><?= $description; ?></p>
                <p>&Eacute;tat : <?= $etat; ?></p>
                <p><?= "Prix : " . $prix . " Euros"; ?>
                    <a href="index.php?uc=visite&categorie=<?= $categorie; ?>&jeu=<?= $id; ?>&action=ajouterAuPanier">
                        <img src="public/images/mettrepanier.png" title="Ajouter au panier" class="add" />
                    </a>
                </p>
            </article>
        <?php endforeach; ?>
    </section>
</section>