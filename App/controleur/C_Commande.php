<?php

class C_Commande
{
    /**
     * Fonction qui affiche la vue v_commande lors de l'action passerCommande
     * ou affiche un message disant "panier vide" si celui-ci est vide
     * @param C_Session $session
     * @param String $uc
     * @return String
     */
    public function passerCommande(C_Session $session, String $uc): String
    {
        if (empty($session->nbJeuxDuPanier())) {
            afficheMessage("Panier Vide !!");
            $uc = '';
        }
        return $uc;
    }

    /**
     * Fonction servant a valider la commande effectué, vide le panier
     * et affiche un message validant la commande
     * @param C_Session $session
     * @param String $uc
     * @return void
     */
    public function confirmerCommande(C_Session $session, String $adresse_id): void
    {
        $client_id = $session->getIdClient();
        $lesIdJeu = $session->getLesIdJeuxDuPanier();
        M_Commande::creerCommande($client_id, $adresse_id, $lesIdJeu);
        $session->supprimerPanier();
        afficheMessage("Commande enregistrée");
    }
}
