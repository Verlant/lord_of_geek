<?php

class M_AdresseLivraison
{
    // A modifier si une ville/code_postal est deja inscrite dans la bdd
    /**
     * @param String $adresse
     * @param String $nom
     * @param String $ville
     * @param String $cp
     * @return void
     */
    public static function creerAdresseLivraison(String $adresse, String $nom, String $cp_id, int $client_id): void
    {
        // Requete d'ecriture d'une adresse
        $req = "INSERT INTO adresse_livraison(adresseRueLivraison, nomPrenomLivraison, code_postal_id, client_id) VALUES (:adresse, :nom, :cp_id, :client_id)";
        $res = M_AccesDonnees::prepare($req);
        // $res->bindParam(':adresse', $adresse);
        // $res->bindParam(':nom', $nom);
        // $res->bindParam(':cp_id', $cp_id);
        M_AccesDonnees::bindParam($res, ':adresse', $adresse, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($res, ':nom', $nom, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($res, ':cp_id', $cp_id, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($res, ':client_id', $client_id, PDO::PARAM_INT);
        M_AccesDonnees::execute($res);
    }

    public static function trouveLesAdresses(int $client_id): array | false
    {
        $req = "SELECT DISTINCT adresseRueLivraison, nomPrenomLivraison, nomVille, code_postal_id
                FROM adresse_livraison
                    JOIN code_postal
                        ON code_postal.id = code_postal_id
                    JOIN ville
                        ON ville.id = ville_id
                WHERE client_id = :client_id";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ':client_id', $client_id, PDO::PARAM_STR);
        M_AccesDonnees::execute($res);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
}
