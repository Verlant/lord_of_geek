<?php
include 'App/modele/M_Exemplaire.php';
/**
 * Controleur pour la gestion du panier
 * @author Loic LOG
 */
// switch ($action) {
//     case 'supprimerUnJeu':
//         $idJeu = filter_input(INPUT_GET, 'jeu');
//         retirerDuPanier($idJeu);
//     case 'voirPanier':
//         $n = nbJeuxDuPanier();
//         if ($n > 0) {
//             $desIdJeu = getLesIdJeuxDuPanier();
//             $lesJeuxDuPanier = M_Exemplaire::trouveLesJeuxDuTableau($desIdJeu);
//         } else {
//             afficheMessage("Panier Vide !!");
//             $uc = '';
//         }
//         break;
// }

class C_GestionPanier
{
    private int $idJeu;
    // $idJeu = filter_input(INPUT_GET, 'jeu');
    private array $desIdjeu;
    // $desIdJeu = getLesIdJeuxDuPanier();

    /**
     * Controleur pour la gestion du panier
     * @param String $action
     * @return Array $lesJeuxDuPanier
     */
    public function actionGestionPanier(String $action)
    {
        $lesJeuxDuPanier = [];
        switch ($action) {
            case 'supprimerUnJeu':
                $this->supprimerUnJeu();
            case 'voirPanier':
                $lesJeuxDuPanier = $this->voirPanier();
                break;
            default:
                header('Location: index.php?uc=accueil&action=derniersJeuxSortis');
                exit();
                break;
        }
        return $lesJeuxDuPanier;
    }

    /**
     * Supprime un jeu du panier
     * @return void
     */
    public function supprimerUnJeu()
    {
        $this->setIdJeu(filter_input(INPUT_GET, 'jeu'));
        $idJeu = $this->getIdJeu();
        retirerDuPanier($idJeu);
    }

    /**
     * Affiche les jeux contenus dans le panier
     * @return Array
     */
    public function voirPanier()
    {
        $lesJeuxDuPanier = [];
        $n = nbJeuxDuPanier();
        if ($n > 0) {
            $this->setDesIdjeu(getLesIdJeuxDuPanier());
            $desIdJeu = $this->getDesIdjeu();
            $lesJeuxDuPanier = M_Exemplaire::trouveLesJeuxDuTableau($desIdJeu);
        } else {
            afficheMessage("Panier Vide !!");
        }
        return $lesJeuxDuPanier;
    }

    /**
     * Get the value of idJeu
     */
    public function getIdJeu(): int
    {
        return $this->idJeu;
    }

    /**
     * Set the value of idJeu
     */
    public function setIdJeu(int $idJeu): void
    {
        $this->idJeu = $idJeu;
    }

    /**
     * Get the value of desIdjeu
     */
    public function getDesIdjeu(): array
    {
        return $this->desIdjeu;
    }

    /**
     * Set the value of desIdjeu
     */
    public function setDesIdjeu(array $desIdjeu): void
    {
        $this->desIdjeu = $desIdjeu;
    }
}
