<?php

class M_Client
{
    // private String $mailClient;
    // private String $motDePasse;
    // private String $nomPrenom;


    /**
     * Fonction qui vérifie que l'identification saisie est correcte.
     */
    public function utilisateur_existe($identifiant, $mot_de_passe)
    {
        // $conn = M_Client->getPDO();
        $sql = 'SELECT 1 FROM client ';
        $sql .= 'WHERE identifiant = :login AND mot_de_passe = :mdp';

        // prepare and bind
        $stmt = AccesDonnees::prepare($sql);
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
}
