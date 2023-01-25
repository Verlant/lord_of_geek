<?php
include 'App/modele/M_exemplaire.php';
/**
 * Controleur pour la gestion du panier
 * @author Loic LOG
 */
switch ($action) {
    case 'supprimerUnJeu':
        $idJeu = filter_input(INPUT_GET, 'jeu');
        retirerDuPanier($idJeu);
    case 'voirPanier':
        $n = nbJeuxDuPanier();
        if ($n > 0) {
            $desIdJeu = getLesIdJeuxDuPanier();
            $lesJeuxDuPanier = M_Exemplaire::trouveLesJeuxDuTableau($desIdJeu);
        } else {
            afficheMessage("Panier Vide !!");
            $uc = '';
        }
        break;
}
