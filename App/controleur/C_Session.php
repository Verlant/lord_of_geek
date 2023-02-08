<?php
// require 'App/modele/M_Client.php';
class C_Session
{
    /**
     * Fonction qui vérifie que l'identification saisie est correcte.
     */
    // function utilisateur_existe($identifiant, $mot_de_passe)
    // {
    //     $conn = new PDO();
    //     $sql = 'SELECT 1 FROM utilisateurs ';
    //     $sql .= 'WHERE identifiant = :login AND mot_de_passe = :mdp';

    //     // prepare and bind
    //     $stmt = (M_Client->getPDO())->prepare($sql);
    //     $stmt->bindParam(":login", $identifiant);
    //     $stmt->bindParam(":mdp", $mot_de_passe);

    //     // Exécution
    //     $stmt->execute();

    //     // L'identification est bonne si la requête a retourné
    //     // une ligne (l'utilisateur existe et le mot de passe
    //     // est bon).
    //     // Si c'est le cas $existe contient 1, sinon elle est
    //     // vide. Il suffit de la retourner en tant que booléen.
    //     if ($stmt->rowCount() > 0) {
    //         // ok, il existe
    //         $existe = true;
    //     } else {
    //         $existe = false;
    //     }
    //     return (bool) $existe;
    // }




    //Si public n'est pas ecrit, la methode est publique de base

    // public function register(String $pseudo, String $password): bool
    // {
    //     $conn = $this->connexion();
    //     $password = password_hash($password, PASSWORD_BCRYPT);
    //     $sql = "INSERT INTO utilisateurs (identifiant, mot_de_passe)
    //                 VALUES (:pseudo, :password);";
    //     $stmt = $conn->prepare($sql);

    //     $stmt->bindParam(":pseudo", $pseudo);
    //     $stmt->bindParam(":password", $password);

    //     $stmt->execute();
    //     return true;
    // }



    // public function verifConnexion(String $uc)
    // {
    //     if (!isset($_SESSION['pseudo'])) {
    //         $uc = 'connexion';
    //     }
    //     return $uc;
    // }

    public function verifMotDePasse(String $mail, String $mdp)
    {
        $data = M_Client::getInfoClientPourSession($mail);
        $mdp_bdd = $data['motDePasse'];
        if (password_verify($mdp, $mdp_bdd)) {
            $_SESSION['id'] = $data['id'];
            $_SESSION['pseudo'] = $data['pseudoClient'];
        } else {
            $data['id'] = false;
        }
        return $data['id'];
    }

    public static function getIdClient()
    {
        if (isset($_SESSION['id']) and !empty($_SESSION['id'])) {
            return $_SESSION['id'];
        } else {
            return false;
        }
    }
}
