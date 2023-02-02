<?php

class C_GestionPanier
{

    /**
     * Supprime un jeu du panier
     * @return void
     */
    public function supprimerUnJeu(int $idJeu)
    {
        retirerDuPanier($idJeu);
    }

    /**
     * Affiche les jeux contenus dans le panier
     * @return Array
     */
    public function voirPanier(array $desIdJeu)
    {
        $lesJeuxDuPanier = [];
        $n = nbJeuxDuPanier();
        if ($n > 0) {
            $lesJeuxDuPanier = M_Exemplaire::trouveLesJeuxDuTableau($desIdJeu);
        } else {
            afficheMessage("Panier Vide !!");
        }
        return $lesJeuxDuPanier;
    }
}
