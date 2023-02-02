<?php

class M_Client
{
    public static function creerCompteClient(String $mail, String $pseudo, String $mdp, String $nomPrenom)
    {
        $req = "INSERT INTO client (mailClient, pseudoClient, motDePasse, nomPrenomClient)
                VALUES (:mail, :pseudo, :mdp, :nomPrenom)";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ':mail', $mail, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($res, ':pseudo', $pseudo, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($res, ':mdp', $mdp, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($res, ':nomPrenom', $nomPrenom, PDO::PARAM_STR);
        M_AccesDonnees::execute($res);
        return M_AccesDonnees::lastInsertId();
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
}
