<?php
class C_Consultation
{

    /**
     *  Renvoie les jeux ajouté ou modifié depuis 1 mois
     * @return Array
     */
    public function derniersJeuxSortis()
    {
        return M_Exemplaire::trouveLesJeuxDepuis();
    }

    /**
     *  Renvoie de la catégorie demandé
     * @return Array
     */
    public function voirJeux(int $categorie)
    {
        return M_Exemplaire::trouveLesJeuxDeCategorie($categorie);
    }

    /**
     *  Ajoute le jeu demandé au panier en gardant l'affichage des jeux de la page actuelle
     * @return Array
     */
    public function ajouterAuPanier(C_Session $session, int $idJeu, int $categorie)
    {
        // Ajoute le jeu au panier s'il n'y est pas
        if (!$session->ajouterJeuSession($idJeu) and $idJeu > 0) {
            afficheErreurs(["Ce jeu est déjà dans le panier !!"]);
        } else {
            afficheMessage("Ce jeu a été ajouté");
        }

        // Condition nécessaire afin de garder les bons jeux affiché après ajout au panier
        if ($categorie > 0) {
            return M_Exemplaire::trouveLesJeuxDeCategorie($categorie);
        } else {
            return M_Exemplaire::trouveLesJeuxDepuis();
        }
    }

    /**
     * Renvoie tous les jeux
     * @return Array
     */
    public function tousLesJeux()
    {
        return M_Exemplaire::trouveLesJeux();
    }

    /**
     * Renvoie les catégories
     * @return Array
     */
    public function getLesCategories()
    {
        return M_Categorie::trouveLesCategories();
    }
}
