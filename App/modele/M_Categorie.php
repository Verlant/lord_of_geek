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
     *
     * @return Array le tableau associatif des catégories
     */
    public static function trouveLesCategories()
    {
        $req = "SELECT DISTINCT categorie.id, nomCategorie FROM lord_of_geek.categorie JOIN jeux ON categorie.id = categorie_id";
        $res = AccesDonnees::query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }
}
