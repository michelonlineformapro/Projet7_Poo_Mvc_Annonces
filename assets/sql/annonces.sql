-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 29 mai 2022 à 07:48
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `petite_annonces`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

DROP TABLE IF EXISTS `annonces`;
CREATE TABLE IF NOT EXISTS `annonces` (
  `id_annonce` int(11) NOT NULL AUTO_INCREMENT,
  `nom_annonce` varchar(255) NOT NULL,
  `description_annonce` text NOT NULL,
  `prix_annonce` float NOT NULL,
  `photo_annonce` varchar(255) NOT NULL,
  `date_depot` datetime NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `regions_id` int(11) NOT NULL,
  PRIMARY KEY (`id_annonce`),
  KEY `regions_id` (`regions_id`),
  KEY `utilisateur_id` (`utilisateur_id`),
  KEY `categorie_id` (`categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`id_annonce`, `nom_annonce`, `description_annonce`, `prix_annonce`, `photo_annonce`, `date_depot`, `categorie_id`, `utilisateur_id`, `regions_id`) VALUES
(1, 'Pc-engine', 'En avance sur son temps, la PC-Engine possède un processeur central 8 bits et un processeur graphique 16 bits, ainsi elle est considérée comme une console de quatrième génération. Conçue pour être modulaire et évolutive, c\'est aussi la première console de jeux de l\'histoire à utiliser dès décembre 1988, le support des CD-ROMs, grâce à un lecteur en option.', 125.25, '../assets/img/PC_Engine.jpg', '2022-05-10 00:00:00', 1, 11, 6),
(2, 'Table bois', 'Retrouvez l\'authenticité du bois à travers la table à manger indus en acacia et métal noir PALISSANDRE ! Sa particularité ? Un plateau à l\'état brut qui fait la part belle aux aspérités du bois. Fixée sur deux pieds modernes en métal noir, cette table à manger 8/10 personnes conjugue les styles avec goût. Nouvelle mission : dénichez les chaises parfaites qui l\'accompagneront !', 125.25, '../assets/img/table.jpg', '2022-04-29 00:00:00', 2, 13, 8),
(4, 'Balancoire', 'Portique le plus grand du marché, aucun entretien à prévoir, en bois pour une intégration parfaite dans votre jardin.\r\n\r\nPortique bois OLIVER - GAMME BOIS ADO/ADULTE 3,00 m de hauteur équipé de : 1 balançoire bois vernis avec fixation par mousquetons, une corde à noeuds, une paire d\'anneaux métal et un trapèze anneaux coloris sable. Ce portique peut accueillir jusqu\'à 4 personnes de plus de 14 ans. Caractéristiques techniques : liaison pieds/poutre : manchons métal sable. Deux entretoises de liaison entre les pieds avant et arrière, pin traité autoclave classe IV. Corde en polypropylène. Diamètre poutre 100 mm et pieds : 100 mm. Taille hors tout (L x l x h) : 395 x 300 x 300 cm. Scellement béton impératif + pattes de scellement fournies.', 458.95, '../assets/img/balance.jpg', '2022-05-11 00:00:00', 3, 13, 8),
(5, 'PC Gamer FIX', 'Le PC Gamer HP Omen GT11-1228nf (4J799EA) est un PC Gaming efficace et stylé sous la forme d\'un boitier de 25 litres. Il s\'appuie sur des composants performants pour vous permettre de jouer à vos jeux PC favoris dans les meilleures conditions : Processeur Intel Core i7-11700F, 16 Go de DDR4, SSD NVme avec 2 To et carte graphique NVIDIA GeForce RTX 3060.', 741.25, '../assets/img/pc.jpg', '2022-05-11 00:00:00', 5, 12, 8),
(6, 'PC Engine', 'En avance sur son temps, la PC-Engine possède un processeur central 8 bits et un processeur graphique 16 bits, ainsi elle est considérée comme une console de quatrième génération. Conçue pour être modulaire et évolutive, c\'est aussi la première console de jeux de l\'histoire à utiliser dès décembre 1988, le support des CD-ROMs,', 250.35, '../assets/img/PC_Engine.jpg', '2022-05-12 00:00:00', 1, 14, 13),
(7, 'Machine a laver', 'COMPLET : Machine à laver de camping avec une puissance de lavage de 250W. Poids relativement léger - seulement 7.4 kg. 2 programmes : linge normal et linge délicat\r\nPRATIQUE : Poignées latérales pour un transport indolore. Fonctionnement silencieux', 4523.35, '../assets/img/machine.jpg', '2022-05-16 00:00:00', 4, 15, 7),
(8, 'Livre Php 7', 'Ce qui distingue PHP des langages de script comme le Javascript, est que le code est exécuté sur le serveur, générant ainsi le HTML, qui sera ensuite envoyé au client. Le client ne reçoit que le résultat du script, sans aucun moyen d\'avoir accès au code qui a produit ce résultat. Vous pouvez configurer votre serveur web afin qu\'il analyse tous vos fichiers HTML comme des fichiers PHP. Ainsi, il n\'y a aucun moyen de distinguer les pages qui sont produites dynamiquement des pages statiques.', 35.25, '../assets/img/php.jpg', '2022-05-16 00:00:00', 6, 15, 8),
(9, 'Table bois et fer', 'Table à manger de la collection Tarraco. Fabriquée en chêne massif avec une belle finition dorée, des bords droits et des pieds en forme de U. Hauteur de la table 76 cm.', 451.25, '../assets/img/table2.webp', '2022-05-16 00:00:00', 2, 15, 8),
(10, 'Serveur Cisco', 'Les serveurs racks Cisco UCS offrent de meilleures performances applicatives et améliorent la satisfaction des clients et des collaborateurs.', 4589.25, '../assets/img/serveur.webp', '2022-05-16 00:00:00', 5, 16, 15),
(11, 'Four a pizza', 'Chaleur tournante pulsée - Nettoyage : Pyrolyse\r\nRails téléscopiques\r\nPorte : Froide - Ouverture standard\r\nEncastrement standard (60cm)', 78.25, '../assets/img/four.jpg', '2022-05-16 00:00:00', 4, 16, 15),
(12, 'Ampli guitare', 'Puissance: 10 Watt\r\n1 haut-parleur 6&quot; Custom Voiced\r\nCircuit d\'émulation de lampe TEC\r\nSélecteur de canal Overdrive/Boost\r\nContrôle Gain\r\nEQ 3 bandes (graves, médiums, aigus)\r\nSortie casque\r\nEntrée Aux\r\nDimensions: 314 x 289 x 176 mm\r\nPoids: 4,2 kg', 452.35, '../assets/img/ampli.jpg', '2022-05-16 00:00:00', 4, 16, 15),
(13, 'Sac a main', 'Pratiques et stylés, les sacs ont la côte. Une besace ou un cabas coloré la journée, une pochette pailletée ou un sac baguette en soirée et le tour est joué. Les plus beaux modèles pour upgrader son look sont ici.', 85.25, '../assets/img/armani.jpg', '2022-05-16 00:00:00', 2, 17, 9),
(14, 'Betonniere', 'Cuve entièrement soudée, bord de cuve renforcé; Graisseurs sur les roulements de la cuve et sur l\'axe de pignon; Capuchon de protection des roulements à billes; Protection totale de la couronne donc réduction du risque d\'accident; Volant grand diamètre;\r\n\r\nBETONNIERE 160L', 452.25, '../assets/img/beton.jpg', '2022-05-16 00:00:00', 3, 17, 9),
(15, 'Blouse chimie', '( Existe aussi en blouse enfant )\r\nBlouse Blanche 100 % coton col tailleur manches longues idéale comme blouse de chimie ou comme blouse médicale. 3 poches plaquées fermeture pression Tissus 200 gr./m2', 45.25, '../assets/img/blouse.jpg', '2022-05-16 00:00:00', 3, 18, 16),
(16, 'Pack de livre', 'Un livre de bord, en navigation maritime, est un registre où sont indiqués tous les renseignements concernant la navigation d\'un navire.\r\nL\'expression religions du Livre fait référence aux religions juive, chrétienne et islamique.\r\nUn livre blanc est un document officiel publié par un gouvernement ou une organisation internationale.\r\nEn comptabilité, le grand livre est le recueil de l\'ensemble des comptes d\'une entreprise.\r\nUn livre numérique est un fichier informatique pouvant être lu par un appareil électronique portable voué à l\'affichage de textes numérisés.\r\nUn livre-objet est un produit complexe dans lequel interviennent à la fois des éléments d\'ordre textuel et/ou typographique et des éléments d\'ordre artistique.', 78.35, '../assets/img/book.jpg', '2022-05-16 00:00:00', 6, 18, 16),
(17, 'Bled Français', 'Le Bled est un journal de la presse militaire coloniale française1 publié de 1955 à 1962, qui a acquis une certaine notoriété pendant la Guerre d\'Algérie. Cet hebdomadaire d’information militaire était publié par le service d’action psychologique et d’information de l\'Armée française, avec un tirage très important pour l\'époque, de 300 000 à 350 000 exemplaires chaque semaine, et un recours massif à la photographie, y compris en première page et en mettant à contribution les appareils photos du demi-million d\'appelés du contingent en Algérie, qui formaient aussi le lectorat du journal.', 789.25, '../assets/img/bookkssss.jpg', '2022-05-16 00:00:00', 6, 18, 16),
(18, 'Brique rouge', 'Une brique est un élément de construction généralement en forme de parallélépipède rectangle constitué de terre argileuse crue, séchée au soleil — brique crue — ou cuite au four, employée principalement dans la construction de murs.', 124.25, '../assets/img/brique.jpg', '2022-05-16 00:00:00', 3, 19, 10),
(19, 'Brosse a cheveux', 'La brosse à cheveux est un instrument biface ou uniface initialement conçu pour la coiffure. Elle est utilisée pour démêler les cheveux.\r\n\r\nIl existe aussi des brosses à cheveux autonettoyantes qui éjectent les cheveux coincés dans leurs picots par une simple pression. Pour un démêlage, on utilise plutôt une brosse à picots. Pour le coiffage, une brosse circulaire souvent utilisée pour le brushing.', 785.25, '../assets/img/brosse.jpg', '2022-05-16 00:00:00', 4, 19, 10),
(20, 'Chaise enfant', 'La tablette peut se relever pour positionner un enfant qui ne pourrait être introduit par le haut ;\r\nUn appui pieds réglable ;\r\nSur certains modèles :\r\nl’assise peut être retirée pour découvrir une seconde assise percée et qui reçoit un pot de chambre et se transforme en chaise percée ;\r\nLa chaise peut se replier pour former un ensemble plus bas et plus stable (assise à environ 25 cm du sol), qui permet à l’enfant de disposer d’une grande tablette pour y déposer ses jouets. Des roulettes permettent le déplacement aisé de la chaise.', 325.25, '../assets/img/buro.jpg', '2022-05-26 00:00:00', 11, 21, 14),
(21, 'Cartouche encre HP', 'Une cartouche d\'encre est un petit réservoir contenant une encre destinée aux stylos-plume ou à du matériel d\'impression (imprimante, fax, photocopieuse, etc.). Dans un nombre croissant de pays, les cartouches d\'encres pour impression doivent être recyclées ou valorisées, parfois comme DEEE1, en raison de la présence de connecteurs et/ou de puce électronique intégrée.', 56.35, '../assets/img/cartouche.jpg', '2022-05-27 00:00:00', 5, 23, 11),
(22, 'Citroën C4', 'La Citroën C4, ou Citroën Type C4 [Citroën C4 A Torpédo], est une automobile du constructeur automobile Citroën, présentée avec sa version 6 cylindres Citroën C6 au Mondial de l\'automobile de Paris de 1928, et produite à 121 000 exemplaires jusqu\'en 19321 (ne pas confondre avec les modèles Citroën C4 (2004) et Citroën C6 (2005)).', 6525.25, '../assets/img/c4.jpg', '2022-05-27 00:00:00', 13, 23, 11);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD CONSTRAINT `annonces_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id_categorie`),
  ADD CONSTRAINT `annonces_ibfk_2` FOREIGN KEY (`regions_id`) REFERENCES `regions` (`id_regions`),
  ADD CONSTRAINT `annonces_ibfk_3` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
