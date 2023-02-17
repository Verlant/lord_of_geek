<?php
// require 'App/modele/M_Client.php';
class C_Session
{
    /**
     * Fonction qui vérifie si le mdp est bon lors de la connexion en fonction du mail
     * Retourne l'id de l'utilisateur en cas de réussite
     * Retourne false en cas d'échec
     * @return int|bool
     */
    public function verifMotDePasse(String $mail, String $mdp): int
    {
        $data = M_Client::getInfoClientPourSession($mail);
        $mdp_bdd = $data['motDePasse'];
        if (password_verify($mdp, $mdp_bdd) and estEntier($data['id'])) {
            $_SESSION['id'] = $data['id'];
            $_SESSION['pseudo'] = $data['pseudoClient'];
        } else {
            $data['id'] = false;
        }
        return $data['id'];
    }

    /**
     * Fonction qui renvoie l'id de l'utilisateur connecté via la session
     * Retourne false en cas d'échec
     * @return int|bool
     */
    public static function getIdClient(): int | false
    {
        if (isset($_SESSION['id']) and !empty($_SESSION['id'])) {
            return $_SESSION['id'];
        } else {
            return false;
        }
    }

    /**
     * Initialise le panier
     *
     * Crée une variable de type session dans le cas
     * où elle n'existe pas
     * @return void
     */
    public function initPanier(): void
    {
        if (!isset($_SESSION['jeux'])) {
            $_SESSION['jeux'] = array();
        }
    }

    /**
     * Supprime le panier
     * Supprime la variable de type session
     * @return void
     */
    public function supprimerPanier(): void
    {
        unset($_SESSION['jeux']);
    }

    /**
     * Ajoute un jeu au panier
     *
     * Teste si l'identifiant du jeu est déjà dans la variable session 
     * ajoute l'identifiant à la variable de type session dans le cas où
     * où l'identifiant du jeu n'a pas été trouvé
     * @param $idJeu : identifiant de jeu
     * @return vrai si le jeu n'était pas dans la variable, faux sinon 
     */
    public function ajouterJeuSession($idJeu)
    {
        $ok = false;
        if (!in_array($idJeu, $_SESSION['jeux'])) {
            $_SESSION['jeux'][] = $idJeu;
            $ok = true;
        }
        return $ok;
    }

    /**
     * Retourne les jeux du panier
     *
     * Retourne le tableau des identifiants de jeu
     * @return : le tableau
     */
    public function getLesIdJeuxDuPanier()
    {
        return $_SESSION['jeux'];
    }

    /**
     * Retourne le nombre de jeux du panier
     *
     * Teste si la variable de session existe
     * et retourne le nombre d'éléments de la variable session
     * @return : le nombre 
     */
    public function nbJeuxDuPanier()
    {
        $n = 0;
        if (isset($_SESSION['jeux'])) {
            $n = count($_SESSION['jeux']);
        }
        return $n;
    }

    /**
     * Retire un de jeux du panier
     *
     * Recherche l'index de l'idProduit dans la variable session
     * et détruit la valeur à ce rang
     * @param $idProduit : identifiant de jeu
     * @return void
     */
    public function retirerDuPanier($idProduit): void
    {
        $index = array_search($idProduit, $_SESSION['jeux']);
        unset($_SESSION['jeux'][$index]);
    }
}
