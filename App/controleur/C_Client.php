<?php

class C_Client
{
    public function inscription(
        String $mail,
        String $pseudo,
        String $mdp,
        String $nomPrenom
    ): void {
        $mdp = password_hash($mdp, PASSWORD_BCRYPT);
        M_Client::creerCompteClient($mail, $pseudo, $mdp, $nomPrenom);
    }

    public function infosClient(C_Session $session): array | false
    {
        $idClient = $session::getIdClient();
        return M_Client::getInfosClientParId($idClient);
    }

    public function adressesClient(C_Session $session): array | false
    {
        $client_id = $session::getIdClient();
        return M_AdresseLivraison::trouveLesAdresses($client_id);
    }

    public function creerAdresseLivraison(
        String $adresse,
        String $nom,
        String $ville,
        String $cp,
        C_Session $session
    ): void {
        // Démarre une transaction
        M_AccesDonnees::beginTransaction();

        // Vérifie si la ville existe deja dans la bdd
        // Si oui ne l'ajoute pas et récupère son id
        // Si non l'ajoute dans la bdd
        if (M_Ville::trouveLaVille($ville) == false) {
            $ville_id = M_Ville::creerVille($ville);
        } else {
            $ville_id = M_Ville::trouveLaVille($ville)['id'];
        }

        // Vérifie si le code postal existe deja dans la bdd
        // Si oui ne l'ajoute pas et récupère son id
        // Si non l'ajoute dans la bdd
        if (M_CodePostal::trouveLeCodePostal($cp) == false) {
            $cp_id = M_CodePostal::creerCodePostal($cp);
        } else {
            $cp_id = M_CodePostal::trouveLeCodePostal($cp)['id'];
        }

        $client_id = $session::getIdClient();
        M_AdresseLivraison::creerAdresseLivraison($adresse,  $nom, $ville_id, $cp_id, $client_id);

        // Commit la transaction
        M_AccesDonnees::commit();
    }

    /**
     * Retourne vrai si pas d'erreur
     * Remplie le tableau d'erreur s'il y a
     *
     * @param $nom : chaîne
     * @param $rue : chaîne
     * @param $ville : chaîne
     * @param $cp : chaîne
     * @param $mail : chaîne
     * @return Array : array
     */
    public static function adresseEstValide($nom, $rue, $ville, $cp)
    {
        $erreurs = [];
        if ($nom == "") {
            $erreurs[] = "Il faut saisir le champ Nom";
        }
        if ($rue == "") {
            $erreurs[] = "Il faut saisir le champ Adresse";
        }
        if ($ville == "") {
            $erreurs[] = "Il faut saisir le champ Ville";
        }
        if ($cp == "") {
            $erreurs[] = "Il faut saisir le champ Code postal";
        } else if (!estUnCp($cp)) {
            $erreurs[] = "erreur de code postal";
        }
        return $erreurs;
    }

    public function listeLesCommandes(C_Session $session): array
    {
        return M_Commande::listeDesCommandes($session->getIdClient());
    }

    public function listeLesJeuxParCommandes(array $commandes)
    {
        foreach ($commandes as $commande) {
            $jeuxParCommande[$commande["id_commande"]] = M_Commande::trouveLesJeuxParCommande($commande["id_commande"]);
        }
        return $jeuxParCommande;
    }
}
