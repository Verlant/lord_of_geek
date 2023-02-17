<?php

/**
 * Controleur client gérant toutes les intérractions d'un utilisateur avec son compte client
 */
class C_Client
{
    /**
     * Appelle le modele pour inscrire un nouveau client dans la bdd
     * en fonction des données rentré dans le formulaire d'inscription
     * @param String $mail
     * @param String $pseudo
     * @param String $mdp
     * @param String $nomPrenom
     * @return void
     */
    public function inscription(
        String $mail,
        String $pseudo,
        String $mdp,
        String $nomPrenom
    ): void {
        $mdp = password_hash($mdp, PASSWORD_BCRYPT);
        M_Client::creerCompteClient($mail, $pseudo, $mdp, $nomPrenom);
    }

    /**
     * Appelle le modele pour retourner les informations d'un client
     * Retourne un tableau associatif contenant les données
     * Retourne false si la requete a échoué
     * @param C_Session $session
     * @return Array|false
     */
    public function infosClient(C_Session $session): array | false
    {
        $idClient = $session::getIdClient();
        return M_Client::getInfosClientParId($idClient);
    }

    /**
     * Appelle le modele pour retourner la ou les adresses d'un client contenue dans la bdd
     * Retourne un tableau associatif contenant les données
     * Retourne false si la requete a échoué
     * @param C_Session $session
     * @return Array|false
     */
    public function adressesClient(C_Session $session): array | false
    {
        $client_id = $session::getIdClient();
        return M_AdresseLivraison::trouveLesAdresses($client_id);
    }

    /**
     * Appelle le modele pour insérer une nouvelle adresse de livraison dans la bdd
     * @param String $adresse
     * @param String $nom
     * @param String $ville
     * @param String $cp
     * @param C_Session $session
     * @return void
     */
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
     * Retourne un tableau contenant des messages pour chaque erreur rencontrées
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

    /**
     * Renvoie la liste des commandes passé par le cient
     * Retourne false si une erreur est rencontré lors de la requete SQL par le modele
     * @param C_Session $session
     * @return Array|false
     */
    public function listeLesCommandes(C_Session $session): array | false
    {
        return M_Commande::listeDesCommandes($session->getIdClient());
    }

    /**
     * Récupère un tableau contenant la liste des commandes et le traite pour
     * renvoyer un tableau associatif contenant la liste des jeux par commande.
     * Renvoie false si une erreur est rencontré
     * @param Array|false $commandes
     * @return Array|false
     */
    public function listeLesJeuxParCommandes(array | false $commandes): array | false
    {
        if ($commandes == false) {
            return false;
        }
        foreach ($commandes as $commande) {
            $jeuxParCommande[$commande["id_commande"]] = M_Commande::trouveLesJeuxParCommande($commande["id_commande"]);
        }
        return $jeuxParCommande;
    }
}
