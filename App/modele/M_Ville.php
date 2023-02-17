<?php

class M_Ville
{

    /**
     * Effectue une requete d'insertion pour ajouter une ville dans la bdd
     * Renvoie l'id de la ville ajouté en cas de succès
     * Renvoie false en cas d'echec
     * @param String nom ville
     * @return int|false
     */
    public static function creerVille(String $ville): int | false
    {
        $req = "INSERT INTO ville(nomVille) VALUES (:ville)";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ':ville', $ville, PDO::PARAM_STR);
        M_AccesDonnees::execute($res);
        if (M_AccesDonnees::lastInsertId() == 0) {
            return false;
        }
        return M_AccesDonnees::lastInsertId();
    }

    /**
     * Effectue une requete de lecture afin de renvoyer l'id d'une ville en fonction de son nom
     * Renvoie false en cas d'echec
     * @param String nom ville
     * @return Array|false
     */
    public static function trouveLaVille(String $ville): array | false
    {
        $req = "SELECT id FROM ville WHERE nomVille = :ville";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ':ville', $ville, PDO::PARAM_STR);
        M_AccesDonnees::execute($res);
        return $res->fetch(PDO::FETCH_ASSOC);
    }
}
