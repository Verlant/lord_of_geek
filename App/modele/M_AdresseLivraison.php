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
    public static function creerAdresseLivraison(String $adresse, String $nom, String $ville, String $cp, int $client_id)
    {
        // Démarre une transaction
        M_AccesDonnees::beginTransaction();

        // Requete d'ecriture d'une ville
        $reqVille = "INSERT INTO ville(nomVille) VALUES (:ville)";
        $resVille = M_AccesDonnees::prepare($reqVille);
        // $resVille->bindParam(':ville', $ville);
        M_AccesDonnees::bindParam($resVille, ':ville', $ville, PDO::PARAM_STR);
        M_AccesDonnees::execute($resVille);

        // Requete d'ecriture d'un code postal
        $ville_id = M_AccesDonnees::lastInsertId();
        $reqCodePostal = "INSERT INTO code_postal VALUES (:cp, :ville_id)";
        $resCodePostal = M_AccesDonnees::prepare($reqCodePostal);
        // $resCodePostal->bindParam(':cp', $cp);
        // $resCodePostal->bindParam(':ville_id', $ville_id);
        M_AccesDonnees::bindParam($resCodePostal, ':cp', $cp, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($resCodePostal, ':ville_id', $ville_id, PDO::PARAM_INT);
        M_AccesDonnees::execute($resCodePostal);

        // Requete d'ecriture d'une adresse
        $cp_id = M_AccesDonnees::lastInsertId();
        $reqAdresse = "INSERT INTO adresse_livraison(adresseRueLivraison, nomPrenomLivraison, code_postal_id, client_id) VALUES (:adresse, :nom, :cp_id, client_id)";
        $resAdresse = M_AccesDonnees::prepare($reqAdresse);
        // $resAdresse->bindParam(':adresse', $adresse);
        // $resAdresse->bindParam(':nom', $nom);
        // $resAdresse->bindParam(':cp_id', $cp_id);
        M_AccesDonnees::bindParam($resAdresse, ':adresse', $adresse, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($resAdresse, ':nom', $nom, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($resAdresse, ':cp_id', $cp_id, PDO::PARAM_INT);
        M_AccesDonnees::bindParam($resAdresse, ':client_id', $client_id, PDO::PARAM_INT);
        M_AccesDonnees::execute($resAdresse);

        // Commit la transaction
        M_AccesDonnees::commit();
    }
}
