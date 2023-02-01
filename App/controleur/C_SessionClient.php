<?php
require 'App/modele/M_CompteClient.php';
class C_SessionClient
{
    /**
     * Fonction qui vérifie que l'identification saisie est correcte.
     */
    function utilisateur_existe($identifiant, $mot_de_passe)
    {
        // $conn = M_Client->getPDO();
        $sql = 'SELECT 1 FROM utilisateurs ';
        $sql .= 'WHERE identifiant = :login AND mot_de_passe = :mdp';

        // prepare and bind
        $stmt = ->prepare($sql);
        $stmt->bindParam(":login", $identifiant);
        $stmt->bindParam(":mdp", $mot_de_passe);

        // Exécution
        $stmt->execute();

        // L'identification est bonne si la requête a retourné
        // une ligne (l'utilisateur existe et le mot de passe
        // est bon).
        // Si c'est le cas $existe contient 1, sinon elle est
        // vide. Il suffit de la retourner en tant que booléen.
        if ($stmt->rowCount() > 0) {
            // ok, il existe
            $existe = true;
        } else {
            $existe = false;
        }
        return (bool) $existe;
    }
    //Si public n'est pas ecrit, la methode est publique de base

    public function register(String $pseudo, String $password): bool
    {
        $conn = $this->connexion();
        $password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO utilisateurs (identifiant, mot_de_passe)
                    VALUES (:pseudo, :password);";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":pseudo", $pseudo);
        $stmt->bindParam(":password", $password);

        $stmt->execute();
        return true;
    }

    public function checkPassword(String $pseudo, String $password)
    {
        $conn = $this->connexion();
        $sql = "SELECT id, mot_de_passe FROM utilisateurs WHERE identifiant = :pseudo";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":pseudo", $pseudo);
        $stmt->execute();

        $data = $stmt->fetch();
        $password_bdd = $data['mot_de_passe'];

        if (!password_verify($password, $password_bdd)) {
            $data['id'] = false;
        }

        return $data['id'];
    }
}
