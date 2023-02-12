<?php

class C_GestionPanier
{

    /**
     * Supprime un jeu du panier
     * @return void
     */
    public function supprimerUnJeu(C_Session $session, int $idJeu)
    {
        $session->retirerDuPanier($idJeu);
    }

    /**
     * Affiche les jeux contenus dans le panier
     * @return Array
     */
    public function voirPanier(C_Session $session, array $desIdJeu)
    {
        $lesJeuxDuPanier = [];
        $n = $session->nbJeuxDuPanier();
        if ($n > 0) {
            $lesJeuxDuPanier = M_Exemplaire::trouveLesJeuxDuTableau($desIdJeu);
        } else {
            afficheMessage("Panier Vide !!");
        }
        return $lesJeuxDuPanier;
    }
}
