<?php

class M_Client
{
    /** 
     * Effectue la requete d'insertion des données d'un client dans la bdd
     * @param String $mail
     * @param String $pseudo
     * @param String $mdp
     * @param String $nomPrenom
     * @return void
     */
    public static function creerCompteClient(String $mail, String $pseudo, String $mdp, String $nomPrenom): void
    {
        $req = "INSERT INTO client (mailClient, pseudoClient, motDePasse, nomPrenomClient)
                VALUES (:mail, :pseudo, :mdp, :nomPrenom)";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ':mail', $mail, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($res, ':pseudo', $pseudo, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($res, ':mdp', $mdp, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($res, ':nomPrenom', $nomPrenom, PDO::PARAM_STR);
        M_AccesDonnees::execute($res);
    }

    // public function modifCompteClient(String $mail, String $pseudo, String $mdp, String $nomPrenom)
    // {
    //     $req = "UPDATE client (mailClient, pseudoClient, motDePasse, nomPrenomClient)
    //             VALUES (:mail, :pseudo, :mdp, :nomPrenom)";
    //     $res = M_AccesDonnees::prepare($req);
    //     M_AccesDonnees::bindParam($res, ':mail', $mail, PDO::PARAM_STR);
    //     M_AccesDonnees::bindParam($res, ':pseudo', $pseudo, PDO::PARAM_STR);
    //     M_AccesDonnees::bindParam($res, ':mdp', $mdp, PDO::PARAM_STR);
    //     M_AccesDonnees::bindParam($res, ':nomPrenom', $nomPrenom, PDO::PARAM_STR);
    //     M_AccesDonnees::execute($res);
    //     return M_AccesDonnees::lastInsertId();
    // }

    /**
     * Effectue une requete de lecture en fonction de l'adresse mail d'un client afin de récupérer son id pseudo et mdp
     * Utilisé uniquement par le controleur de session lors de la connexion d'un utilisateur au site
     * renvoie false en cas d'erreur
     * @param String $mail
     * @return Array|false
     */
    public static function getInfoClientPourSession(String $mail): array | false
    {
        $req = "SELECT id, pseudoClient, motDePasse FROM client WHERE mailClient = :mail";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ':mail', $mail, PDO::PARAM_STR);
        M_AccesDonnees::execute($res);
        return $res->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Effectue une requete de lecture a la bdd afin de renvoyer les infos d'un client en fonction de son id
     * Renvoie false en cas d'erreur
     * @param int $id
     * @return Array|false
     */
    public static function getInfosClientParId(int $id): array | false
    {
        $req = "SELECT mailClient, pseudoClient, nomPrenomClient FROM client WHERE id = :id";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ':id', $id, PDO::PARAM_INT);
        M_AccesDonnees::execute($res);
        return $res->fetch(PDO::FETCH_ASSOC);
    }
}
