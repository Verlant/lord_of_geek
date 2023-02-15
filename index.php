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
$session->initPanier();


// if ($formulaireRecu == "S'inscrire") {
//     $mail = filter_input(INPUT_POST, 'mail');
//     $pseudo = filter_input(INPUT_POST, 'pseudo');
//     $mdp = filter_input(INPUT_POST, 'mdp');
//     $nomPrenom = filter_input(INPUT_POST, 'prenom') . " " . filter_input(INPUT_POST, 'nom');
// } else if ($formulaireRecu == 'Se connecter') {
//     $mail = filter_input(INPUT_POST, 'mail_connexion');
//     $mdp = filter_input(INPUT_POST, 'mdp_connexion');
// } else if ($formulaireRecu == "Valider l'adresse") {
//     $nom = filter_input(INPUT_POST, 'nom');
//     $adresse = filter_input(INPUT_POST, 'adresse');
//     $ville = filter_input(INPUT_POST, 'ville');
//     $codePostal = filter_input(INPUT_POST, 'codePostal');
// } else if ($formulaireRecu == "Valider l'adresse de livraison") {
//     $adresse_id = filter_input(INPUT_POST, 'adresse_id');
// }

$formulaireRecu = filter_input(INPUT_POST, "valider");
if (isset($formulaireRecu)) {
    switch ($formulaireRecu) {
        case "Se connecter":
            $mail = filter_input(INPUT_POST, 'mail_connexion');
            $mdp = filter_input(INPUT_POST, 'mdp_connexion');
            break;
        case "S'inscrire":
            $mail = filter_input(INPUT_POST, 'mail');
            $pseudo = filter_input(INPUT_POST, 'pseudo');
            $mdp = filter_input(INPUT_POST, 'mdp');
            $nomPrenom = filter_input(INPUT_POST, 'prenom') . " " . filter_input(INPUT_POST, 'nom');
            break;
        case "Valider l'adresse":
            $nom = filter_input(INPUT_POST, 'nom');
            $adresse = filter_input(INPUT_POST, 'adresse');
            $ville = filter_input(INPUT_POST, 'ville');
            $codePostal = filter_input(INPUT_POST, 'codePostal');
            break;
        case "Valider l'adresse de livraison":
            $adresse_id = filter_input(INPUT_POST, 'adresse_id');
            break;
        default:
            break;
    }
}

if (!isset($uc) or empty($uc)) {
    $uc = 'accueil';
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
            $controleur->ajouterAuPanier($session, $idJeu, $categorie);
        }
        $lesJeux = $controleur->derniersJeuxSortis();
        break;
    case 'visite':
        $controleur = new C_Consultation();
        $lesCategories = $controleur->getLesCategories();
        // $lesJeux = actionVisite($controleur, $session, $action, $idJeu, $categorie);
        if ($action == 'voirJeux') {
            $lesJeux = $controleur->voirJeux($categorie);
        } elseif ($action == 'ajouterAuPanier') {
            $lesJeux = $controleur->ajouterAuPanier($session, $idJeu, $categorie);
        } else {
            $lesJeux = $controleur->tousLesJeux();
        }
        break;
    case 'panier':
        $controleur = new C_GestionPanier();
        // $lesJeuxDuPanier = actionPanier($controleur, $session, $action, $idJeu);
        if ($action == 'supprimerUnJeu') {
            $controleur->supprimerUnJeu($session, $idJeu);
        }
        $desIdJeu = $session->getLesIdJeuxDuPanier();
        $lesJeuxDuPanier = $controleur->voirPanier($session, $desIdJeu);
        $uc = count($lesJeuxDuPanier) > 0 ? $uc : "";
        break;
    case 'commander':
        $controleur_client = new C_Client;
        $controleur_commande = new C_Commande;
        if ($action == 'confirmerCommande') {
            $uc = $controleur_commande->confirmerCommande($session, $adresse_id);
        } else {
            $uc = $controleur_commande->passerCommande($session, $uc);
            $adressesClient = $controleur_client->adressesClient($session);
        }
        $infosClient = $controleur_client->infosClient($session);
        $adressesClient = $controleur_client->adressesClient($session);
        break;
    case 'administrer':
        //TODO
        break;
    case 'compte':
        $controleur = new C_Client;
        if ($action == 'deconnexion') {
            session_destroy();
            header('Location: index.php?uc=accueil&action=derniersJeuxSortis');
            exit();
        } else if ($action == 'ajouterAdresse') {
            $erreursSaisieAdresse = $controleur->adresseEstValide($nom, $adresse, $ville, $codePostal);
            if (empty($erreursSaisieAdresse) and $codePostal != "00000") {
                $controleur->creerAdresseLivraison($adresse,  $nom,  $ville,  $codePostal, $session);
            } else if ($codePostal == "00000") {
                afficheErreurs(["Le code postal 00000 n'existe pas."]);
            } else {
                afficheErreurs($erreursSaisieAdresse);
            }
        }
        $infosClient = $controleur->infosClient($session);
        $adressesClient = $controleur->adressesClient($session);
        $commandes = $controleur->listeLesCommandes($session);
        $jeuxParCommandes = $controleur->listeLesJeuxParCommandes($commandes);
        break;
    case 'connexion':
        $controleur = new C_Client();
        if (isset($mail) and isset($mdp)) {
            if ($action == 'inscription' and estUnMail($mail)) {
                $controleur->inscription($mail, $pseudo, $mdp, $nomPrenom);
                afficheMessage('Votre compte a bien été créé.');
            } else if ($action == 'connexion' and estUnMail($mail) and $session->verifMotDePasse($mail, $mdp)) {
                $uc = 'compte';
                header('Location: index.php?uc=compte');
                exit();
            } else if (!estUnMail($mail)) {
                afficheErreurs(["Mail non valide.", "Format demandé : exemple@domaine.com"]);
            } else if (!$session->verifMotDePasse($mail, $mdp)) {
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
