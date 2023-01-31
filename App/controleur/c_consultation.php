<?php
include 'App/modele/M_categorie.php';
include 'App/modele/M_exemplaire.php';
class C_Consultation
{
    private array $lesCategories;
    // $lesCategories = M_Categorie::trouveLesCategories();

    private String $categorie;
    // $categorie = filter_input(INPUT_GET, 'categorie');

    private int $idJeu;
    // $idJeu = filter_input(INPUT_GET, 'jeu');

    /**
     * Exécution d'une requete de lecture
     * @param String $action
     * @return Array $lesJeux
     */
    public function consultation_action(String $action, String $uc)
    {
        /**
         * Controleur pour la consultation des exemplaires
         * @author Loic LOG
         */
        switch ($action) {
            case 'voirDerniersJeuxSortis':
                $lesJeux = M_Exemplaire::trouveLesJeuxDepuis();
                break;
            case 'voirJeux':
                $this->setCategorie(filter_input(INPUT_GET, 'categorie'));
                $categorie = $this->getCategorie(filter_input(INPUT_GET, 'categorie'));
                $lesJeux = M_Exemplaire::trouveLesJeuxDeCategorie($categorie);
                break;
            case 'ajouterAuPanier':
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
                    $lesJeux = M_Exemplaire::trouveLesJeuxDeCategorie($categorie);
                } else {
                    $lesJeux = M_Exemplaire::trouveLesJeuxDepuis();
                }
                break;
            default:
                // $lesJeux = [];
                $lesJeux = M_Exemplaire::trouveLesJeux();
                break;
        }
        return $lesJeux;
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
