<?php

session_start();


// Pour afficher les erreurs PHP
error_reporting(E_ALL);
ini_set("display_errors", 1);
// Attention : A supprimer en production !!!

require('util/fonctions.inc.php');
require('util/validateurs.inc.php');
require('App/modele/AccesDonnees.php');


$uc = filter_input(INPUT_GET, 'uc'); // Use Case
$action = filter_input(INPUT_GET, 'action'); // Action
initPanier();




if (!isset($uc) or empty($uc)) {
    $uc = 'accueil';
    $action = 'voirDerniersJeuxSortis';
}
if (!isset($action) or empty($action)) {
    $action = 'voirDerniersJeuxSortis';
}

// Controleur principale
switch ($uc) {
    case 'accueil':
        require('App/controleur/C_Consultation.php');
        $controleur = new C_Consultation();
        $lesJeux = $controleur->actionConsultation($action, $uc);
        break;
    case 'visite':
        require('App/controleur/C_Consultation.php');
        $controleur = new C_Consultation();
        $controleur->setLesCategories(M_Categorie::trouveLesCategories());
        $lesCategories = $controleur->getLesCategories();
        $lesJeux = $controleur->actionConsultation($action, $uc);
        break;
    case 'panier':
        require('App/controleur/C_GestionPanier.php');
        $controleur = new C_GestionPanier();
        $lesJeuxDuPanier = $controleur->actionGestionPanier($action);
        $uc = count($lesJeuxDuPanier) > 0 ? $uc : "";
        break;
    case 'commander':
        require('App/controleur/c_passerCommande.php');
        break;
    case 'administrer':
        require('App/controleur/c_monCompte.php');
        break;
    case 'compte':
        include("App/controleur/c_monCompte.php");
        break;
    default:
        header('Location: index.php?uc=accueil&action=derniersJeuxSortis');
        exit();
        break;
}


require("App/vue/template.php");
