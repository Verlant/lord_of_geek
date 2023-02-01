-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema lord_of_geek
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema lord_of_geek
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `lord_of_geek` DEFAULT CHARACTER SET utf8mb4 ;
USE `lord_of_geek` ;

-- -----------------------------------------------------
-- Table `lord_of_geek`.`categorie`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lord_of_geek`.`categorie` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomCategorie` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nomCategorie_UNIQUE` (`nomCategorie` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `lord_of_geek`.`ville`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lord_of_geek`.`ville` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nomVille` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `lord_of_geek`.`code_postal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lord_of_geek`.`code_postal` (
  `id` CHAR(5) NOT NULL,
  `ville_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_code_postal_ville2_idx` (`ville_id` ASC),
  CONSTRAINT `fk_code_postal_ville2`
    FOREIGN KEY (`ville_id`)
    REFERENCES `lord_of_geek`.`ville` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `lord_of_geek`.`adresse_livraison`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lord_of_geek`.`adresse_livraison` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `adresseRueLivraison` VARCHAR(250) NOT NULL,
  `nomPrenomLivraison` VARCHAR(45) NOT NULL,
  `dateCreation` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateModification` VARCHAR(45) NULL,
  `code_postal_id` CHAR(5) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_adresse_livraison_code_postal1_idx` (`code_postal_id` ASC),
  CONSTRAINT `fk_adresse_livraison_code_postal1`
    FOREIGN KEY (`code_postal_id`)
    REFERENCES `lord_of_geek`.`code_postal` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `lord_of_geek`.`client`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lord_of_geek`.`client` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `mailClient` VARCHAR(100) NOT NULL,
  `motDePasse` VARCHAR(45) NOT NULL,
  `nomPrenomClient` VARCHAR(45) NOT NULL,
  `dateCreation` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateModification` TIMESTAMP NULL,
  `adresse_livraison_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_client_adresse_livraison1_idx` (`adresse_livraison_id` ASC),
  UNIQUE INDEX `mailClient_UNIQUE` (`mailClient` ASC),
  CONSTRAINT `fk_client_adresse_livraison1`
    FOREIGN KEY (`adresse_livraison_id`)
    REFERENCES `lord_of_geek`.`adresse_livraison` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `lord_of_geek`.`commande`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lord_of_geek`.`commande` (
  `id` INT UNSIGNED NOT NULL,
  `dateCreation` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateModification` TIMESTAMP NULL DEFAULT NULL,
  `client_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_commandes_client1_idx` (`client_id` ASC),
  CONSTRAINT `fk_commandes_client1`
    FOREIGN KEY (`client_id`)
    REFERENCES `lord_of_geek`.`client` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `lord_of_geek`.`console`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lord_of_geek`.`console` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nomConsole` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nomConsole_UNIQUE` (`nomConsole` ASC))
ENGINE = InnoDB;
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `lord_of_geek`.`jeux`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lord_of_geek`.`jeux` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nomJeux` VARCHAR(150) NOT NULL,
  `imageJeux` VARCHAR(32) NULL,
  `anneeSortie` YEAR NOT NULL,
  `categorie_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_jeux_categories1_idx` (`categorie_id` ASC),
  UNIQUE INDEX `nomJeux_UNIQUE` (`nomJeux` ASC),
  CONSTRAINT `fk_jeux_categories1`
    FOREIGN KEY (`categorie_id`)
    REFERENCES `lord_of_geek`.`categorie` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `lord_of_geek`.`etat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lord_of_geek`.`etat` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descriptionEtat` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `description_UNIQUE` (`description` ASC))
ENGINE = InnoDB;
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `lord_of_geek`.`exemplaire`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `lord_of_geek`.`exemplaire` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `prixAchat` DECIMAL(10,2) NULL,
  `prixVente` DECIMAL(10,2) NOT NULL,
  `anneeAchat` YEAR NULL,
  `dateCreation` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateModification` TIMESTAMP NULL,
  `console_id` INT NOT NULL,
  `jeux_id` INT NOT NULL,
  `etat_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_exemplaires_console1_idx` (`console_id` ASC),
  INDEX `fk_exemplaires_jeux1_idx` (`jeux_id` ASC),
  INDEX `fk_exemplaires_etat1_idx` (`etat_id` ASC),
  CONSTRAINT `fk_exemplaires_console1`
    FOREIGN KEY (`console_id`)
    REFERENCES `lord_of_geek`.`console` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_exemplaires_jeux1`
    FOREIGN KEY (`jeux_id`)
    REFERENCES `lord_of_geek`.`jeux` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_exemplaires_etat1`
    FOREIGN KEY (`etat_id`)
    REFERENCES `lord_of_geek`.`etat` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `lord_of_geek`.`lignes_commande`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lord_of_geek`.`lignes_commande` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `commande_id` INT UNSIGNED NOT NULL,
  `exemplaire_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `lignes_commande_commande_id_foreign` (`commande_id` ASC),
  INDEX `lignes_commande_exemplaire_id_foreign` (`exemplaire_id` ASC),
  CONSTRAINT `lignes_commande_commande_id_foreign`
    FOREIGN KEY (`commande_id`)
    REFERENCES `lord_of_geek`.`commande` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `lignes_commande_exemplaire_id_foreign`
    FOREIGN KEY (`exemplaire_id`)
    REFERENCES `lord_of_geek`.`exemplaire` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


-- MODIF TABLE

-- ALTER TABLE `lord_of_geek`.`commande` 
-- DROP COLUMN `prixVente`;

-- ALTER TABLE `lord_of_geek`.`exemplaire` 
-- ADD COLUMN `prixVente` DECIMAL(10,2) NOT NULL AFTER `prixAchat`,
-- CHANGE COLUMN `jeux_id` `jeux_id` INT(11) NOT NULL AFTER `dateModification`;

-- ALTER TABLE `lord_of_geek`.`jeux` 
-- CHANGE COLUMN `image` `imageJeux` VARCHAR(32) NULL DEFAULT NULL ;