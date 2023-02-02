<?php

//! TODO

class C_MonCompte
{

    public function action_monCompte($action)
    {
    }

    public function inscription(String $mail, String $pseudo, String $mdp, String $nomPrenom)
    {
        M_Client::creerCompteClient($mail, $pseudo, $mdp, $nomPrenom);
    }
}
