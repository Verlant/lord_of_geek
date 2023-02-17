<?php

/**
 * Les jeux sont rangés par catégorie
 *
 * @author Loic LOG
 */
class M_Categorie
{

    /**
     * Retourne toutes les catégories sous forme d'un tableau associatif
     * Renvoie false en cas d'erreur
     *
     * @return Array|false le tableau associatif des catégories
     */
    public static function trouveLesCategories(): array|false
    {
        $req = "SELECT DISTINCT categorie.id, nomCategorie FROM lord_of_geek.categorie JOIN jeux ON categorie.id = categorie_id";
        $res = M_AccesDonnees::prepare($req);
        // $res->execute();
        M_AccesDonnees::execute($res);
        $lesLignes = $res->fetchAll(PDO::FETCH_ASSOC);
        return $lesLignes;
    }
}
