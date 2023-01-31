<?php

/**
 * Requetes sur les exemplaires  de jeux videos
 *
 * @author Loic LOG
 */
class M_Exemplaire
{

    /**
     * Retourne sous forme d'un tableau associatif tous les jeux de la
     * catégorie passée en argument
     *
     * @param $idCategorie
     * @return Array un tableau associatif
     */
    public static function trouveLesJeuxDeCategorie($idCategorie)
    {
        $req = "SELECT 
                    exemplaire.id AS id,
                    categorie_id,
                    prixAchat, 
                    prixVente,
                    anneeAchat, 
                    dateCreation, 
                    dateModification, 
                    nomJeux, 
                    imageJeux, 
                    anneeSortie, 
                    nomConsole, 
                    descriptionEtat
                FROM
                    exemplaire
                JOIN
                    jeux ON jeux_id = jeux.id
                JOIN
                    console ON console_id = console.id
                JOIN
                    etat ON etat_id = etat.id 
                WHERE
                    categorie_id = '$idCategorie'";
        $res = AccesDonnees::query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }

    /**
     * Retourne les jeux concernés par le tableau des idProduits passée en argument
     *
     * @param $desIdJeux tableau d'idProduits
     * @return Array un tableau associatif
     */
    public static function trouveLesJeuxDuTableau($desIdJeux)
    {
        $nbProduits = count($desIdJeux);
        $lesProduits = array();
        if ($nbProduits != 0) {
            foreach ($desIdJeux as $unIdProduit) {
                $req = "SELECT 
                            exemplaire.id AS id,
                            prixAchat, 
                            prixVente, 
                            anneeAchat, 
                            dateCreation, 
                            dateModification, 
                            nomJeux, 
                            imageJeux, 
                            anneeSortie, 
                            nomConsole, 
                            descriptionEtat
                        FROM
                            exemplaire
                        JOIN
                            jeux ON jeux_id = jeux.id
                        JOIN
                            console ON console_id = console.id
                        JOIN
                            etat ON etat_id = etat.id 
                        WHERE
                            exemplaire.id = '$unIdProduit'";
                $res = AccesDonnees::query($req);
                $unProduit = $res->fetch();
                $lesProduits[] = $unProduit;
            }
        }
        return $lesProduits;
    }


    /**
     * Retourne les derniers jeux acquis ou modifié le mois dernier
     *
     * @return Array un tableau associatif
     */
    public static function trouveLesJeuxDepuis()
    {
        $dateVariable = date('Y-m-d H:i:s');
        $req = "SELECT 
                    exemplaire.id AS id,
                    categorie_id,
                    prixAchat, 
                    prixVente,
                    anneeAchat, 
                    dateCreation, 
                    dateModification, 
                    nomJeux, 
                    imageJeux, 
                    anneeSortie, 
                    nomConsole, 
                    descriptionEtat
                FROM
                    exemplaire
                JOIN
                    jeux ON jeux_id = jeux.id
                JOIN
                    console ON console_id = console.id
                JOIN
                    etat ON etat_id = etat.id 
                WHERE
                    dateCreation < '$dateVariable' OR dateModification < '$dateVariable'";
        $res = AccesDonnees::query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }

    /**
     * Retourne les derniers jeux acquis ou modifié le mois dernier
     *
     * @return Array un tableau associatif
     */
    public static function trouveLesJeux()
    {
        $req = "SELECT 
                    exemplaire.id AS id,
                    categorie_id,
                    prixAchat, 
                    prixVente,
                    anneeAchat, 
                    dateCreation, 
                    dateModification, 
                    nomJeux, 
                    imageJeux, 
                    anneeSortie, 
                    nomConsole, 
                    descriptionEtat
                FROM
                    exemplaire
                JOIN
                    jeux ON jeux_id = jeux.id
                JOIN
                    console ON console_id = console.id
                JOIN
                    etat ON etat_id = etat.id";
        $res = AccesDonnees::query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }
}
