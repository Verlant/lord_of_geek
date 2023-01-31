<?php
// $controleur = new C_Consultation();
// $controleur->setLesCategories();
// $lesJeux = $controleur->consultation_action($action);
?>
<section>
    <h1>
        Lord Of Geek
    </h1>
    <h2>
        Le prince des jeux sur internet
    </h2>
    <h3>Derniers jeux disponibles : </h3>
    <section id="derniers_jeux">
        <?php
        foreach ($lesJeux as $unJeu) :
            $id = $unJeu['id'];
            $description = $unJeu['nomJeux'];
            $prix = $unJeu['prixVente'];
            $image = $unJeu['imageJeux'];
            $etat = $unJeu['descriptionEtat'];
            $categorie = $unJeu['categorie_id']
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
                    <a href="index.php?uc=accueil&jeu=<?= $id; ?>&action=ajouterAuPanier">
                        <img src="public/images/mettrepanier.png" title="Ajouter au panier" class="add" />
                    </a>
                </p>
            </article>
        <?php endforeach; ?>
    </section>
</section>