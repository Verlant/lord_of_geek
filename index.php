<?php

session_start();
// var_dump($_SESSION);

// Pour afficher les erreurs PHP
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Attention : A supprimer en production !!!

require 'util/autoLoad.php';
require 'util/fonctions.inc.php';
require 'util/validateurs.inc.php';
autoLoad();

$session = new C_Session;

$uc = filter_input(INPUT_GET, 'uc'); // Use Case
$action = filter_input(INPUT_GET, 'action'); // Action
$categorie = filter_input(INPUT_GET, 'categorie'); // ID de categorie
$idJeu = filter_input(INPUT_GET, 'jeu'); // ID de jeu
initPanier();

// Créer une fonction avec un switch en modifant le name de chaque formulaire pour avoir le meme name
$formulaireRecu = filter_input(INPUT_POST, "valider");
if ($formulaireRecu == "S'inscrire") {
    $mail = filter_input(INPUT_POST, 'mail');
    $pseudo = filter_input(INPUT_POST, 'pseudo');
    $mdp = filter_input(INPUT_POST, 'mdp');
    $nomPrenom = filter_input(INPUT_POST, 'prenom') . " " . filter_input(INPUT_POST, 'nom');
} elseif ($formulaireRecu == 'Se connecter') {
    $mail = filter_input(INPUT_POST, 'mail_connexion');
    $mdp = filter_input(INPUT_POST, 'mdp_connexion');
} elseif ($formulaireRecu == "Valider l'adresse") {
    $nom = filter_input(INPUT_POST, 'nom');
    $adresse = filter_input(INPUT_POST, 'adresse');
    $ville = filter_input(INPUT_POST, 'ville');
    $codePostal = filter_input(INPUT_POST, 'codePostal');
}

if (!isset($uc) or empty($uc)) {
    $uc = 'accueil';
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
        $lesJeux = actionVisite($controleur, $action, $idJeu, $categorie);
        break;
    case 'panier':
        $controleur = new C_GestionPanier();
        $lesJeuxDuPanier = actionPanier($controleur, $action, $idJeu);
        $uc = count($lesJeuxDuPanier) > 0 ? $uc : "";
        break;
    case 'commander':
        require('App/controleur/c_passerCommande.php');
        break;
    case 'administrer':
        require('App/controleur/C_MonCompte.php');
        break;
    case 'compte':
        $controleur = new C_Client;
        if ($action == 'deconnexion') {
            unset($session);
            session_destroy();
            header('Location: index.php?uc=accueil&action=derniersJeuxSortis');
            exit();
        } elseif ($action == 'ajouterAdresse') {
            $controleur->creerAdresseLivraison($adresse,  $nom,  $ville,  $codePostal, $session);
        }
        $infosClient = $controleur->infosClient($session);
        $adressesClient = $controleur->adressesClient($session);
        break;
    case 'connexion':
        $controleur = new C_Client();
        // $uc = $session->verifConnexion($uc);
        if ($action == 'inscription') {
            $controleur->inscription($mail, $pseudo, $mdp, $nomPrenom);
            afficheMessage('Votre compte a bien été créé.');
        } else if ($action == 'connexion') {
            if ($session->verifMotDePasse($mail, $mdp)) {
                $uc = 'compte';
                header('Location: index.php?uc=compte');
                exit();
            } else {
                afficheErreurs(['Mot de passe ou mail inconnu.', 'Réessayez']);
            }
        }
        break;
    default:
        header('Location: index.php?uc=accueil&action=derniersJeuxSortis');
        exit();
        break;
}


require("App/vue/template.php");
