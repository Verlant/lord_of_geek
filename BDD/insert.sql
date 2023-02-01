-- Catégorie
INSERT INTO `lord_of_geek`.`categorie` (`id`, `nomCategorie`) VALUES ('1', 'Combat');
INSERT INTO `lord_of_geek`.`categorie` (`id`, `nomCategorie`) VALUES ('2', 'Aventure');
INSERT INTO `lord_of_geek`.`categorie` (`id`, `nomCategorie`) VALUES ('3', 'Logique');

-- Jeux
INSERT INTO `lord_of_geek`.`jeux` (`nomJeux`, `image`,`anneeSortie`, `categorie_id`)
            VALUES ('The Legend of Zelda', 'zelda-nes.jpeg', '1986','2');
INSERT INTO `lord_of_geek`.`jeux` (`nomJeux`,`anneeSortie`, `categorie_id`) VALUES ('Skyrim', '2011','2');
INSERT INTO `lord_of_geek`.`jeux` (`nomJeux`,`anneeSortie`, `categorie_id`) VALUES ('Tekken', '1994','1');

-- Console
INSERT INTO `lord_of_geek`.`console` (`nomConsole`) VALUES ('NES');
INSERT INTO `lord_of_geek`.`console` (`nomConsole`) VALUES ('Xbox 360');
INSERT INTO `lord_of_geek`.`console` (`nomConsole`) VALUES ('PlayStation');


-- Etat
INSERT INTO `lord_of_geek`.`etat` (`description`) VALUES ('Neuf');
INSERT INTO `lord_of_geek`.`etat` (`description`) VALUES ('Bon');
INSERT INTO `lord_of_geek`.`etat` (`description`) VALUES ('Moyen');
INSERT INTO `lord_of_geek`.`etat` (`description`) VALUES ('Mauvais');
INSERT INTO `lord_of_geek`.`etat` (`description`) VALUES ('Très mauvais');

-- Exemplaire
INSERT INTO `lord_of_geek`.`exemplaire` (`console_id`, `jeux_id`, `etat_id`, `prixVente`) VALUES ('1', '1', '1', '30.00');
INSERT INTO `lord_of_geek`.`exemplaire` (`console_id`, `jeux_id`, `etat_id`, `prixVente`) VALUES ('2', '2', '2', '10.00');
INSERT INTO `lord_of_geek`.`exemplaire` (`console_id`, `jeux_id`, `etat_id`, `prixVente`) VALUES ('3', '3', '3', '5.00');

-- UPDATE `lord_of_geek`.`exemplaire` SET `prixVente` = '30.00' WHERE (`id` = '5');
-- UPDATE `lord_of_geek`.`exemplaire` SET `prixVente` = '10.00' WHERE (`id` = '6');
-- UPDATE `lord_of_geek`.`exemplaire` SET `prixVente` = '5.00' WHERE (`id` = '7');
