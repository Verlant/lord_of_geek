<section>
    <img src="public/images/panier.gif" alt="Panier" title="panier" />
    <?php
    foreach ($lesJeuxDuPanier as $unJeu) :
        $id = $unJeu['id'];
        $description = $unJeu['nomJeux'];
        $image = $unJeu['imageJeux'];
        $prix = $unJeu['prixVente'];
        $etat = $unJeu['descriptionEtat']
    ?>
        <p>
            <?php if (empty($image)) : ?>
                <img src="public/images/jeux/default.png" alt="Image de <?= $description; ?>" width=100 height=100 />
            <?php else : ?>
                <img src="public/images/jeux/<?= $image; ?>" alt="Image de <?= $description; ?>" width=100 height=100 />
            <?php endif ?>
            <?= $description . " ($prix Euros) "; ?>
            &Eacute;tat : <?= $etat; ?>
            <a href="index.php?uc=panier&jeu=<?= $id; ?>&action=supprimerUnJeu" onclick="return confirm('Voulez-vous vraiment retirer ce jeu ?');">
                <img src="public/images/retirerpanier.png" TITLE="Retirer du panier">
            </a>
        </p>
    <?php endforeach; ?>
    <br>
    <a href=index.php?uc=commander&action=passerCommande>
        <img src="public/images/commander.jpg" title="Passer commande">
    </a>
</section>