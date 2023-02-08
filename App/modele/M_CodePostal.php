<?php

class M_CodePostal
{
    public static function creerCodePostal(String $cp, int $ville_id): void
    {
        $req = "INSERT INTO code_postal VALUES (:cp, :ville_id)";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ':cp', $cp, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($res, ':ville_id', $ville_id, PDO::PARAM_INT);
        M_AccesDonnees::execute($res);
        // Renvoie une erreur lors de l'utilisation de lastInsert
        // return M_AccesDonnees::lastInsertId();
    }

    public static function trouveLeCodePostal(String $cp): array | false
    {
        $req = "SELECT * FROM code_postal WHERE id = :cp";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ':cp', $cp, PDO::PARAM_STR);
        M_AccesDonnees::execute($res);
        return $res->fetch(PDO::FETCH_ASSOC);
    }
}
