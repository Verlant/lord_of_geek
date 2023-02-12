<?php

/**
 * Affiche une liste d'erreur
 * @param array $msgErreurs
 */
function afficheErreurs(array $msgErreurs)
{
    echo '﻿<div class="erreur"><ul>';
    foreach ($msgErreurs as $erreur) {
?>
        <li><?php echo $erreur ?></li>
<?php
    }
    echo '</ul></div>';
}

/**
 * Affiche un message bleu
 * @param string $msg
 */
function afficheMessage(string $msg)
{
    echo '﻿<div class="message">' . $msg . '</div>';
}

/**
 * Fonction qui gère les différentes action sur la page visite
 * @param String $action
 * @return Array $lesJeux
 */
function actionVisite(C_Consultation $controleur, C_Session $session, String $action, int $idJeu, int $categorie)
{
    if ($action == 'voirJeux') {
        $lesJeux = $controleur->voirJeux($categorie);
    } elseif ($action == 'ajouterAuPanier') {
        $lesJeux = $controleur->ajouterAuPanier($session, $idJeu, $categorie);
    } else {
        $lesJeux = $controleur->tousLesJeux();
    }
    return $lesJeux;
}

/**
 * Fonction qui gère les différentes action sur la page visite
 * @param String $action
 * @return Array $lesJeux
 */
function actionPanier(C_GestionPanier $controleur, C_Session $session, String $action, int $idJeu)
{
    if ($action == 'supprimerUnJeu') {
        $controleur->supprimerUnJeu($session, $idJeu);
    }
    $desIdJeu = $session->getLesIdJeuxDuPanier();
    $lesJeuxDuPanier = $controleur->voirPanier($session, $desIdJeu);
    return $lesJeuxDuPanier;
}
