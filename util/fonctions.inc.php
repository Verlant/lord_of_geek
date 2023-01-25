<?php

/**
 * Initialise le panier
 *
 * Crée une variable de type session dans le cas
 * où elle n'existe pas 
 */
function initPanier() {
    if (!isset($_SESSION['jeux'])) {
        $_SESSION['jeux'] = array();
    }
}

/**
 * Supprime le panier
 *
 * Supprime la variable de type session 
 */
function supprimerPanier() {
    unset($_SESSION['jeux']);
}

/**
 * Ajoute un jeu au panier
 *
 * Teste si l'identifiant du jeu est déjà dans la variable session 
 * ajoute l'identifiant à la variable de type session dans le cas où
 * où l'identifiant du jeu n'a pas été trouvé
 * @param $idJeu : identifiant de jeu
 * @return vrai si le jeu n'était pas dans la variable, faux sinon 
 */
function ajouterAuPanier($idJeu) {
    $ok = false;
    if (!in_array($idJeu, $_SESSION['jeux'])) {
        $_SESSION['jeux'][] = $idJeu;
        $ok = true;
    }
    return $ok;
}

/**
 * Retourne les jeux du panier
 *
 * Retourne le tableau des identifiants de jeu
 * @return : le tableau
 */
function getLesIdJeuxDuPanier() {
    return $_SESSION['jeux'];
}

/**
 * Retourne le nombre de jeux du panier
 *
 * Teste si la variable de session existe
 * et retourne le nombre d'éléments de la variable session
 * @return : le nombre 
 */
function nbJeuxDuPanier() {
    $n = 0;
    if (isset($_SESSION['jeux'])) {
        $n = count($_SESSION['jeux']);
    }
    return $n;
}

/**
 * Retire un de jeux du panier
 *
 * Recherche l'index de l'idProduit dans la variable session
 * et détruit la valeur à ce rang
 * @param $idProduit : identifiant de jeu

 */
function retirerDuPanier($idProduit) {
    $index = array_search($idProduit, $_SESSION['jeux']);
    unset($_SESSION['jeux'][$index]);
}

/**
 * Affiche une liste d'erreur
 * @param array $msgErreurs
 */
function afficheErreurs(array $msgErreurs) {
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
function afficheMessage(string $msg) {
    echo '﻿<div class="message">'.$msg.'</div>';
}
