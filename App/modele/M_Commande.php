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

    /**
     * Effectue une requete de lecture afin de récupérer la liste des commandes
     * effectué par un client en fonciton de son id
     * Renvoie false en cas d'erreur
     * @param int id client
     * @return Array|false
     */
    public static function listeDesCommandes(int $client_id): array | false
    {
        $req = "SELECT commande.id AS id_commande,
                        SUM(prixVente) as prixTotal,
                        nomPrenomLivraison as nom,
                        adresseRueLivraison as rue,
                        nomVille as ville,
                        codePostal as cp
                FROM lignes_commande
                JOIN commande ON commande_id = commande.id  
                JOIN exemplaire ON exemplaire_id = exemplaire.id
                JOIN adresse_livraison ON adresse_livraison.id = adresse_id
                JOIN ville ON ville.id = ville_id
                JOIN code_postal ON code_postal.id = code_postal_id
                WHERE commande.client_id = :client_id
                GROUP BY commande.id
                ORDER BY commande.dateCreation DESC";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ":client_id", $client_id, PDO::PARAM_INT);
        M_AccesDonnees::execute($res);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Effectue une requete de lecture afin de récupérer la liste des jeux commandé par un client
     * en fonction de leur id de commande
     * Renvoie false en cas d'erreur
     * @param int id commande
     * @return Array|false
     */
    public static function trouveLesJeuxParCommande(int $id_commande): array | false
    {
        $req = "SELECT commande.id as commande_id, nomJeux, nomCategorie, nomConsole, descriptionEtat, imageJeux, prixVente
                FROM lignes_commande
                JOIN commande ON commande_id = commande.id  
                JOIN exemplaire ON exemplaire_id = exemplaire.id
                JOIN jeux ON jeux.id = jeux_id
                JOIN console ON console.id = console_id
                JOIN categorie ON categorie.id = categorie_id
                JOIN etat ON etat.id = etat_id
                WHERE commande.id = :id_commande";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ":id_commande", $id_commande, PDO::PARAM_INT);
        M_AccesDonnees::execute($res);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
}
