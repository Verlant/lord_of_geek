<?php
require('App/modele/M_Categorie.php');
require('App/modele/M_Exemplaire.php');
class C_Consultation
{
    private array $lesCategories;
    // $lesCategories = M_Categorie::trouveLesCategories();

    private String $categorie;
    // $categorie = filter_input(INPUT_GET, 'categorie');

    private int $idJeu;
    // $idJeu = filter_input(INPUT_GET, 'jeu');

    /**
     * Controleur pour la consultation des exemplaires
     * @param String $action
     * @return Array $lesJeux
     */
    public function consultation(String $action, String $uc)
    {
        /**
         * Controleur pour la consultation des exemplaires
         * @author Loic LOG
         */
        switch ($action) {
            case 'derniersJeuxSortis':
                $lesJeux = $this->derniersJeuxSortis();
                break;
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
    public function voirJeux()
    {
        $this->setCategorie(filter_input(INPUT_GET, 'categorie'));
        $categorie = $this->getCategorie(filter_input(INPUT_GET, 'categorie'));
        return M_Exemplaire::trouveLesJeuxDeCategorie($categorie);
    }

    /**
     *  Ajoute le jeu demandé au panier en gardant l'affichage des jeux de la page actuelle
     * @return Array
     */
    public function ajouterAuPanier()
    {
        // Ajoute le jeu au panier s'il n'y est pas
        $this->setIdJeu(filter_input(INPUT_GET, 'jeu'));
        $idJeu = $this->getIdJeu(filter_input(INPUT_GET, 'jeu'));
        if (!ajouterAuPanier($idJeu)) {
            afficheErreurs(["Ce jeu est déjà dans le panier !!"]);
        } else {
            afficheMessage("Ce jeu a été ajouté");
        }

        // Condition nécessaire afin de garder les bons jeux affiché après ajout au panier
        if (isset($_GET['categorie']) and !empty($_GET['categorie'])) {
            $this->setCategorie(filter_input(INPUT_GET, 'categorie'));
            $categorie = $this->getCategorie(filter_input(INPUT_GET, 'categorie'));
            return M_Exemplaire::trouveLesJeuxDeCategorie($categorie);
        } else {
            return M_Exemplaire::trouveLesJeuxDepuis();
        }
    }

    public function tousLesJeux()
    {
        return M_Exemplaire::trouveLesJeux();
    }

    /**
     * Get the value of lesCategories
     * @return Array
     */
    public function getLesCategories()
    {
        return $this->lesCategories;
    }

    /**
     * Set the value of lesCategories
     * @param Array
     * @return void
     */
    public function setLesCategories($lesCategories)
    {
        $this->lesCategories = $lesCategories;
    }

    /**
     * Get the value of categorie
     * @return String
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set the value of categorie
     *
     * @param String
     * @return void
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * Get the value of idJeu
     * @return int
     */
    public function getIdJeu()
    {
        return $this->idJeu;
    }

    /**
     * Set the value of idJeu
     * @param int
     * @return  void
     */
    public function setIdJeu($idJeu)
    {
        $this->idJeu = $idJeu;
    }
}
