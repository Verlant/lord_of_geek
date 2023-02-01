<?php

class M_AdresseLivraison
{
    // A modifier si on veut qu'un client puisse avoir plusieures adresses associées
    /**
     * @param String $adresse
     * @param String $nom
     * @param String $ville
     * @param String $cp
     * @return void
     */
    public function creerAdresseLivraison(String $adresse, String $nom, String $ville, String $cp)
    {
        // Démarre une transaction
        AccesDonnees::beginTransaction();

        // Requete d'ecriture d'une ville
        $reqVille = "INSERT INTO ville(nomVille) VALUES (:ville)";
        $resVille = AccesDonnees::prepare($reqVille);
        $resVille->bindParam(':ville', $ville);
        AccesDonnees::execute($resVille);

        // Requete d'ecriture d'un code postal
        $ville_id = AccesDonnees::lastInsertId();
        $reqCodePostal = "INSERT INTO code_postal VALUES (:cp, :ville_id)";
        $resCodePostal = AccesDonnees::prepare($reqCodePostal);
        $resCodePostal->bindParam(':cp', $cp);
        $resCodePostal->bindParam(':ville_id', $ville_id);
        AccesDonnees::execute($resVille);

        // Requete d'ecriture d'une adresse
        $cp_id = AccesDonnees::lastInsertId();
        $reqAdresse = "INSERT INTO adresse_livraison(adresseRueLivraison, nomPrenomLivraison, code_postal_id) VALUES (:adresse, :nom, :cp_id)";
        $resAdresse = AccesDonnees::prepare($reqAdresse);
        $resAdresse->bindParam(':adresse', $adresse);
        $resAdresse->bindParam(':nom', $nom);
        $resAdresse->bindParam(':cp_id', $cp_id);
        AccesDonnees::execute($resVille);

        // Commit la transaction
        AccesDonnees::commit();
    }
}
