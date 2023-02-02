<?php
class C_Consultation
{
    /**
     * Controleur pour la consultation des exemplaires
     * @param String $action
     * @return Array $lesJeux
     */
    public function actionConsultation(String $action)
    {
        /**
         * Controleur pour la consultation des exemplaires
         * @author Loic LOG
         */
        switch ($action) {
            case 'voirJeux':
                $lesJeux = $this->voirJeux();
                break;
            case 'ajouterAuPanier':
                $lesJeux = $this->ajouterAuPanier();
                break;
            case 'voirCategories':
                $lesJeux = $this->tousLesJeux();
                break;
            default:
                header('Location: index.php?uc=accueil&action=derniersJeuxSortis');
                exit();
                break;
        }
        return $lesJeux;
    }

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
    public function ajouterAuPanier(int $idJeu, int $categorie)
    {
        // Ajoute le jeu au panier s'il n'y est pas
        if (!ajouterAuPanier($idJeu)) {
            afficheErreurs(["Ce jeu est déjà dans le panier !!"]);
        } else {
            afficheMessage("Ce jeu a été ajouté");
        }

        // Condition nécessaire afin de garder les bons jeux affiché après ajout au panier
        if (isset($categorie) and !empty($categorie)) {
            return M_Exemplaire::trouveLesJeuxDeCategorie($categorie);
        } else {
            return M_Exemplaire::trouveLesJeuxDepuis();
        }
    }

    public function tousLesJeux()
    {
        return M_Exemplaire::trouveLesJeux();
    }
}
