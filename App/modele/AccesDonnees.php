<?php

/**
 * Classe d'accès aux données.

 * Utilise les services de la classe PDO
 * pour l'application Lord Of Geek (LOG)
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO
 * $monPdoGsb qui contiendra l'unique instance de la classe
 *
 * @package default
 * @author Loïc LOG
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */
class AccesDonnees
{

    private static String $serveur = 'mysql:host=localhost';
    private static String $bdd = 'dbname=lord_of_geek';
    private static String $user = 'root';
    private static String $mdp = '';

    // '*76CD18F0C4007A49A5C5B225B97D86157835A5F7'

    /**
     *
     * @var PDO
     */
    private static $monPdo;

    /**
     * Fonction statique qui crée l'unique instance de la classe
     * retourne l'unique objet de la classe
     * @return PDO
     */
    public static function getPdo()
    {
        if (AccesDonnees::$monPdo == null) {
            AccesDonnees::$monPdo = new PDO(AccesDonnees::$serveur . ';' . AccesDonnees::$bdd, AccesDonnees::$user, AccesDonnees::$mdp);
            AccesDonnees::$monPdo->query("SET CHARACTER SET utf8");
        }
        return AccesDonnees::$monPdo;
    }

    /**
     * Exécution d'une requete de lecture
     * @param string $requete_sql
     * @return PDOStatement
     */
    public static function prepare(string $requete_sql)
    {
        return AccesDonnees::getPdo()->prepare($requete_sql);
    }

    /**
     * Execution d'une requete d'écriture
     * @param string $requete_sql
     * @return int
     */
    public static function exec(string $requete_sql)
    {
        return AccesDonnees::getPdo()->exec($requete_sql);
    }
}
