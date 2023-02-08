<?php

class M_Client
{
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

    public static function getInfoClientPourSession(String $mail): array | false
    {
        $req = "SELECT id, pseudoClient, motDePasse FROM client WHERE mailClient = :mail";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ':mail', $mail, PDO::PARAM_STR);
        M_AccesDonnees::execute($res);
        $data = $res->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public static function getInfosClientParId(int $id): array | false
    {
        $req = "SELECT mailClient, pseudoClient, nomPrenomClient FROM client WHERE id = :id";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ':id', $id, PDO::PARAM_INT);
        M_AccesDonnees::execute($res);
        $data = $res->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
}
