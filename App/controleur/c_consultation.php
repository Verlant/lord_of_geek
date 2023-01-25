<?php
include 'App/modele/M_categorie.php';
include 'App/modele/M_exemplaire.php';

/**
 * Controleur pour la consultation des exemplaires
 * @author Loic LOG
 */
switch ($action) {
    case 'voirDerniersJeuxSortis':
        $lesJeux = M_Exemplaire::trouveLesJeuxDepuis();
        break;
    case 'voirJeux':
        $categorie = filter_input(INPUT_GET, 'categorie');
        $lesJeux = M_Exemplaire::trouveLesJeuxDeCategorie($categorie);
        break;
    case 'ajouterAuPanier':
        $idJeu = filter_input(INPUT_GET, 'jeu');
        $categorie = filter_input(INPUT_GET, 'categorie');
        if (!ajouterAuPanier($idJeu)) {
            afficheErreurs(["Ce jeu est déjà dans le panier !!"]);
        } else {
            afficheMessage("Ce jeu a été ajouté");
        }
        $lesJeux = M_Exemplaire::trouveLesJeuxDeCategorie($categorie);
        break;
    default:
        $lesJeux = [];
        break;
}

$lesCategories = M_Categorie::trouveLesCategories();
