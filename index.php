<?php

session_start();


// Pour afficher les erreurs PHP
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Attention : A supprimer en production !!!

require 'util/autoLoad.php';
require 'util/fonctions.inc.php';
require 'util/validateurs.inc.php';
autoLoad();


$uc = filter_input(INPUT_GET, 'uc'); // Use Case
$action = filter_input(INPUT_GET, 'action'); // Action
$categorie = filter_input(INPUT_GET, 'categorie'); // ID de categorie
$idJeu = filter_input(INPUT_GET, 'jeu'); // ID de jeu
initPanier();



if (!isset($uc) or empty($uc)) {
    $uc = 'accueil';
    // $action = 'voirDerniersJeuxSortis';
}
if (!isset($action) or empty($action)) {
    $action = 'voirDerniersJeuxSortis';
}
if (!isset($categorie) or empty($categorie)) {
    $categorie = 0;
}
if (!isset($idJeu) or empty($idJeu)) {
    $idJeu = 0;
}
// Controleur principale
switch ($uc) {
    case 'accueil':
        $controleur = new C_Consultation();
        if ($action == 'ajouterAuPanier') {
            $controleur->ajouterAuPanier($idJeu, $categorie);
        }
        $lesJeux = $controleur->derniersJeuxSortis();
        break;
    case 'visite':
        $controleur = new C_Consultation();
        $lesCategories = $controleur->getLesCategories();
        $lesJeux = action_visite($controleur, $action, $idJeu, $categorie);
        break;
    case 'panier':
        $controleur = new C_GestionPanier();
        $lesJeuxDuPanier = action_panier($controleur, $action, $idJeu);
        $uc = count($lesJeuxDuPanier) > 0 ? $uc : "";
        break;
    case 'commander':
        require('App/controleur/c_passerCommande.php');
        break;
    case 'administrer':
        require('App/controleur/C_MonCompte.php');
        break;
    case 'compte':
        // $controleur = new C_MonCompte();
        // $controleur->action_monCompte();
        break;
    default:
        header('Location: index.php?uc=accueil&action=derniersJeuxSortis');
        exit();
        break;
}


require("App/vue/template.php");
