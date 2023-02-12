<?php

class C_Commande
{
    public function passerCommande(C_Session $session, String $uc): String
    {
        if (empty($session->nbJeuxDuPanier())) {
            afficheMessage("Panier Vide !!");
            $uc = '';
        }
        return $uc;
    }

    public function confirmerCommande(C_Session $session, String $adresse_id): String
    {
        $client_id = $session->getIdClient();
        $lesIdJeu = $session->getLesIdJeuxDuPanier();
        M_Commande::creerCommande($client_id, $adresse_id, $lesIdJeu);
        $session->supprimerPanier();
        afficheMessage("Commande enregistrée");
        return 'compte';
    }
}
