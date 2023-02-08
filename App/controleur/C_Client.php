<?php

class C_Client
{
    public function inscription(String $mail, String $pseudo, String $mdp, String $nomPrenom)
    {
        $mdp = password_hash($mdp, PASSWORD_BCRYPT);
        M_Client::creerCompteClient($mail, $pseudo, $mdp, $nomPrenom);
    }

    public function infosClient(C_Session $session)
    {
        $idClient = $session::getIdClient();
        return M_Client::getInfosClientParId($idClient);
    }

    public function creerAdresseLivraison(String $adresse, String $nom, String $ville, String $cp, C_Session $session)
    {
        $client_id = $session::getIdClient();
        M_AdresseLivraison::creerAdresseLivraison($adresse,  $nom,  $ville,  $cp, $client_id);
    }
}
