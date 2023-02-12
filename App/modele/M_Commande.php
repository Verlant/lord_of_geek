<?php

/**
 * Requetes sur les commandes
 *
 * @author Loic LOG
 */
class M_Commande
{

    /**
     * Crée une commande
     *
     * Crée une commande à partir des arguments validés passés en paramètre, l'identifiant est
     * construit à partir du maximum existant ; crée les lignes de commandes dans la table contenir à partir du
     * tableau d'idProduit passé en paramètre
     * @param int $client_id
     * @param int $adresse_id
     * @param Array $listJeux
     */
    public static function creerCommande($client_id, $adresse_id, $listIdJeux)
    {
        M_AccesDonnees::beginTransaction();
        $req = "INSERT INTO commande(client_id, adresse_id) VALUES (:client_id, :adresse_id)";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ':client_id', $client_id, PDO::PARAM_INT);
        M_AccesDonnees::bindParam($res, ':adresse_id', $adresse_id, PDO::PARAM_INT);
        M_AccesDonnees::execute($res);
        $commande_id = M_AccesDonnees::lastInsertId();
        foreach ($listIdJeux as $exemplaire_id) {
            $req = "INSERT INTO lignes_commande(commande_id, exemplaire_id) VALUES (:commande_id, :exemplaire_id)";
            $res = M_AccesDonnees::prepare($req);
            M_AccesDonnees::bindParam($res, ':commande_id', $commande_id, PDO::PARAM_INT);
            M_AccesDonnees::bindParam($res, ':exemplaire_id', $exemplaire_id, PDO::PARAM_INT);
            M_AccesDonnees::execute($res);
        }
        M_AccesDonnees::commit();
    }
}
