<?php

class M_Ville
{

    public static function creerVille(String $ville): int | false
    {
        $req = "INSERT INTO ville(nomVille) VALUES (:ville)";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ':ville', $ville, PDO::PARAM_STR);
        M_AccesDonnees::execute($res);
        return M_AccesDonnees::lastInsertId();
    }

    public static function trouveLaVille(String $ville): array | false
    {
        $req = "SELECT * FROM ville WHERE nomVille = :ville";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ':ville', $ville, PDO::PARAM_STR);
        M_AccesDonnees::execute($res);
        return $res->fetch(PDO::FETCH_ASSOC);
    }
}
