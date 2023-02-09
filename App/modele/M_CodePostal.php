<?php

class M_CodePostal
{
    public static function creerCodePostal(String $cp): int | false
    {
        $req = "INSERT INTO code_postal (codePostal) VALUES (:cp)";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ':cp', $cp, PDO::PARAM_STR);
        M_AccesDonnees::execute($res);
        return M_AccesDonnees::lastInsertId();
    }

    public static function trouveLeCodePostal(String $cp): array | false
    {
        $req = "SELECT * FROM code_postal WHERE codePostal = :cp";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ':cp', $cp, PDO::PARAM_STR);
        M_AccesDonnees::execute($res);
        return $res->fetch(PDO::FETCH_ASSOC);
    }
}
