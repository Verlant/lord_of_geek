<?php

/**
 * Controleur pour les commandes
 * @author Loic LOG
 */
switch ($action) {
    case 'passerCommande':
        $n = $session->nbJeuxDuPanier();
        if ($n > 0) {
            $nom = '';
            $rue = '';
            $ville = '';
            $cp = '';
            $mail = '';
        } else {
            afficheMessage("Panier vide !!");
            $uc = '';
        }
        break;
    case 'confirmerCommande':
        $nom = filter_input(INPUT_POST, 'nom');
        $rue = filter_input(INPUT_POST, 'rue');
        $ville = filter_input(INPUT_POST, 'ville');
        $cp = filter_input(INPUT_POST, 'cp');
        $mail = filter_input(INPUT_POST, 'mail');
        $errors = M_Commande::estValide($nom, $rue, $ville, $cp, $mail);
        if (count($errors) > 0) {
            // Si une erreur, on recommence
            afficheErreurs($errors);
        } else {
            $lesIdJeu = $session->getLesIdJeuxDuPanier();
            M_Commande::creerCommande($nom, $rue, $cp, $ville, $mail, $lesIdJeu);
            $session->supprimerPanier();
            afficheMessage("Commande enregistrée");
            $uc = '';
        }
        break;
}


class C_PasserCommande
{

    public function actionPasserCommande(C_Session $session, String $action)
    {
        switch ($action) {
            case 'passerCommande':
                $n = $session->nbJeuxDuPanier();
                if ($n > 0) {
                    $nom = '';
                    $rue = '';
                    $ville = '';
                    $cp = '';
                    $mail = '';
                } else {
                    afficheMessage("Panier vide !!");
                    $uc = '';
                }
                break;
            case 'confirmerCommande':
                $nom = filter_input(INPUT_POST, 'nom');
                $rue = filter_input(INPUT_POST, 'rue');
                $ville = filter_input(INPUT_POST, 'ville');
                $cp = filter_input(INPUT_POST, 'cp');
                $mail = filter_input(INPUT_POST, 'mail');
                $errors = M_Commande::estValide($nom, $rue, $ville, $cp, $mail);
                if (count($errors) > 0) {
                    // Si une erreur, on recommence
                    afficheErreurs($errors);
                } else {
                    $lesIdJeu = $session->getLesIdJeuxDuPanier();
                    M_Commande::creerCommande($nom, $rue, $cp, $ville, $mail, $lesIdJeu);
                    $session->supprimerPanier();
                    afficheMessage("Commande enregistrée");
                    $uc = '';
                }
                break;
        }
    }
}
