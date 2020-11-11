-- phpMyAdmin SQL Dump
-- version 2.10.0-beta1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Lundi 28 Mai 2007 à 15:57
-- Version du serveur: 5.0.33
-- Version de PHP: 5.2.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de données: `stargate`
-- 

-- --------------------------------------------------------

-- 
-- Structure de la table `sg_batiment`
-- 

CREATE TABLE `sg_batiment` (
  `id` int(18) unsigned NOT NULL auto_increment,
  `nom_batiment` varchar(50) NOT NULL default '',
  `chemin_image` varchar(100) NOT NULL default '',
  `description_batiment` text NOT NULL,
  `type` int(2) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Contenu de la table `sg_batiment`
-- 

INSERT INTO `sg_batiment` (`id`, `nom_batiment`, `chemin_image`, `description_batiment`, `type`) VALUES 
(1, 'Technologie de l''extraction du minerais de fer', 'images/fer.png', 'Le fer est le matériau le plus utilisé dans la galaxie pour créer des armes et des vaisseaux. A la fois pour son abondance et sa simplicité d''utilisation.', 0),
(2, 'Technologie de l''extraction du minerais de carbone', 'images/carbone.png', 'Le carbone est l''un des métaux les plus courament utilisés pour la construction d''armes et de vaisseaux spaciaux.', 0),
(3, 'Technologie de l''extraction du minerais d''or', 'images/or.png', 'L''or est le minerai utilisé pour les transactions de toutes formes, allant du simple achat de matériel pour le combatant de base, jusqu''au financement d''un vaisseau mère ou de classe Odyssé.', 0),
(4, 'Technologie de l''extraction du minerais de naquada', 'images/naquada.png', 'Le naquada est un métal permettant d''emmagasiner de l''energie et de la restituer sous forme amplifiée. Ce matériau a servi à la construction de la porte des étoiles.', 0),
(5, 'Technologie de l''extraction du minerais de trinium', 'images/trinium.png', 'Le trinium est surement le métal le plus rare de la galaxie, mais aussi le plus résistant. Celui ci est employé dans la construction des parois des vaissseaux de grande envergure.', 0),
(6, 'Technologie architecturale', 'images/immeuble.png', 'Cette technologie sert à améliorer les batiments et améliorant les constructions de logements pour la population', 1);

-- --------------------------------------------------------

-- 
-- Structure de la table `sg_config_carte`
-- 

CREATE TABLE `sg_config_carte` (
  `X_max` varchar(5) collate latin1_general_ci NOT NULL default '50',
  `Y_max` varchar(5) collate latin1_general_ci NOT NULL default '50'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Contenu de la table `sg_config_carte`
-- 

INSERT INTO `sg_config_carte` (`X_max`, `Y_max`) VALUES 
('50', '50');

-- --------------------------------------------------------

-- 
-- Structure de la table `sg_construction`
-- 

CREATE TABLE `sg_construction` (
  `pseudo` varchar(20) collate latin1_general_ci NOT NULL default '',
  `fer` int(32) NOT NULL default '1',
  `carbone` int(32) NOT NULL default '1',
  `or` int(32) NOT NULL default '1',
  `naquada` int(32) NOT NULL default '1',
  `trinium` int(32) NOT NULL default '1',
  `stockfer` int(32) NOT NULL default '0',
  `stockcarbone` int(32) NOT NULL default '0',
  `stockor` int(32) NOT NULL default '0',
  `stocknaquada` int(32) NOT NULL default '0',
  `stocktrinium` int(32) NOT NULL default '0',
  `chantier` int(32) NOT NULL default '0',
  `immeuble` int(32) NOT NULL default '0',
  `timeup222` int(32) NOT NULL default '0',
  `timeend` int(32) NOT NULL default '0',
  `batiment` varchar(30) collate latin1_general_ci NOT NULL default '',
  KEY `pseudo` (`pseudo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Contenu de la table `sg_construction`
-- 

INSERT INTO `sg_construction` (`pseudo`, `fer`, `carbone`, `or`, `naquada`, `trinium`, `stockfer`, `stockcarbone`, `stockor`, `stocknaquada`, `stocktrinium`, `chantier`, `immeuble`, `timeup222`, `timeend`, `batiment`) VALUES 
('x1', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
('x2', 6, 2, 1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, ''),
('x3', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
('re', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
('x5', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
('test truc2', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
('x7', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
('az', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
('x9', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
('azer', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
('ori', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
('tauri', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
('goauld', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
('''+e_%p', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
('x15', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '');

-- --------------------------------------------------------

-- 
-- Structure de la table `sg_flotte`
-- 

CREATE TABLE `sg_flotte` (
  `id` bigint(40) unsigned NOT NULL auto_increment,
  `pseudo` varchar(40) NOT NULL default '',
  `coord_X` mediumint(10) NOT NULL default '0',
  `coord_Y` mediumint(10) NOT NULL default '0',
  `race` varchar(50) NOT NULL,
  `clan` int(2) NOT NULL default '1',
  `nom` varchar(40) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- 
-- Contenu de la table `sg_flotte`
-- 

INSERT INTO `sg_flotte` (`id`, `pseudo`, `coord_X`, `coord_Y`, `race`, `clan`, `nom`) VALUES 
(1, 'x1', 20, 43, 'tauri', 1, 'hfgh'),
(2, 'x2', 22, 8, 'tauri', 1, 'f'),
(4, 're', 21, 10, 'goauld', 2, 're Yipayop'),
(5, 're', 0, 46, 'goauld', 2, 'kiklaule'),
(7, 'x5', 37, 10, 'bsg', 1, '42');

-- --------------------------------------------------------

-- 
-- Structure de la table `sg_flotte_units`
-- 

CREATE TABLE `sg_flotte_units` (
  `id` int(15) unsigned NOT NULL auto_increment,
  `id_joueur` int(5) NOT NULL default '0',
  `id_flotte` int(15) NOT NULL default '0',
  `type` smallint(6) NOT NULL default '0',
  `nombre` mediumint(9) NOT NULL default '0',
  `ordre` int(11) NOT NULL default '0',
  `unit` varchar(10) collate latin1_general_ci NOT NULL default 'spacial',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

-- 
-- Contenu de la table `sg_flotte_units`
-- 

INSERT INTO `sg_flotte_units` (`id`, `id_joueur`, `id_flotte`, `type`, `nombre`, `ordre`, `unit`) VALUES 
(4, 4, 2, 0, 11, 0, 'spatial'),
(7, 4, 1, 0, 10000, 0, 'spatial');

-- --------------------------------------------------------

-- 
-- Structure de la table `sg_guilde`
-- 

CREATE TABLE `sg_guilde` (
  `id` int(5) NOT NULL auto_increment,
  `nom` varchar(20) NOT NULL default '',
  `description` text NOT NULL,
  `image` varchar(200) NOT NULL default '',
  `date` int(10) NOT NULL default '0',
  `leader` varchar(30) NOT NULL default '0',
  `clan` varchar(20) NOT NULL default '',
  `inscription` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 PACK_KEYS=0 AUTO_INCREMENT=4 ;

-- 
-- Contenu de la table `sg_guilde`
-- 

INSERT INTO `sg_guilde` (`id`, `nom`, `description`, `image`, `date`, `leader`, `clan`, `inscription`) VALUES 
(3, 'MJ', 'VIve les MJ', '', 1157830139, 'x1iiii', '0', 'open'),
(1, 'Tauri''s Guilde', '[center][img]http://www.starbase8.de/diverse/stargate/merch-sg1/patches/tauri.jpg[/img]<br /><br />Bienvenus à vous, chers Tauris, x1 vous aime11<br />[/center]', '', 1157820139, 'x1', '1', 'open'),
(2, 'Goa''ulds Guilde', 'Pour les Goa''ulds', '', 1133393546, 'xxxx', '2', 'open');

-- --------------------------------------------------------

-- 
-- Structure de la table `sg_historique`
-- 

CREATE TABLE `sg_historique` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `message` text NOT NULL,
  `pseudo` varchar(40) NOT NULL default '',
  `time` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=443 ;

-- 
-- Contenu de la table `sg_historique`
-- 

INSERT INTO `sg_historique` (`id`, `message`, `pseudo`, `time`) VALUES 
(1, 'Ajout de la fonction "Messages envoyés" dans la messagerie', 'x1', 1154830595),
(2, 'Vous avez été promus aux commandes d''un empire !', 'x12', 1157121306),
(3, 'Vous avez été promus aux commandes d''un empire !', 'az', 1157141250),
(5, 'Vous avez quitté votre guilde (Tauri''s Guilde)', 'x1', 1157901526),
(6, 'Vous avez quitté votre guilde (Tauri''s Guilde)', 'x1', 1157901683),
(7, 'Vous avez quitté votre guilde (Tauri''s Guilde)', 'x1', 1157901718),
(8, 'Vous avez quitté votre guilde (Tauri''s Guilde)', 'x1', 1157901763),
(9, 'Vous avez quitté votre guilde (Tauri''s Guilde--postul)', 'x1', 1157903638),
(10, 'Vous avez quitté votre guilde ()', 'x1', 1157903742),
(11, 'Vous avez annulé votre postulation à la guilde Tauri''s Guilde--postul', 'x1', 1157906631),
(12, 'Vous avez annulé votre postulation à la guilde Tauri''s Guilde', 'x1', 1157906688),
(13, 'Vous venez d''être admis en temps que membre dans la guilde Tauri''s Guilde', 'x12', 1158085311),
(14, 'Vous venez d''être exclu de la guilde Tauri''s Guilde', 'x12', 1158089006),
(15, 'Vous avez été promus aux commandes d''un empire !', 'ppp', 1158089094),
(16, 'Vous venez d''être admis en temps que membre dans la guilde Tauri''s Guilde', 'ppp', 1158090446),
(17, 'Vous venez d''être exclu de la guilde Tauri''s Guilde', 'ppp', 1158090493),
(18, 'Vous venez de créer la guilde gfdgfdg', 'x1', 1158252124),
(19, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', '', 1159646402),
(20, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159646440),
(21, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159646440),
(22, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159646440),
(23, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159646440),
(24, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159646440),
(25, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159646440),
(26, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159646440),
(27, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159646440),
(28, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159646440),
(29, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159646440),
(30, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159646458),
(31, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159646458),
(32, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159646458),
(33, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159646458),
(34, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159646458),
(35, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159646458),
(36, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159646458),
(37, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159646458),
(38, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159646458),
(39, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159646458),
(40, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159646582),
(41, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159646582),
(42, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159646582),
(43, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159646582),
(44, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159646582),
(45, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159646582),
(46, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159646582),
(47, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159646582),
(48, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159646582),
(49, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159646582),
(50, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159646846),
(51, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159646846),
(52, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159646846),
(53, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159646846),
(54, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159646846),
(55, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159646846),
(56, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159646846),
(57, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159646846),
(58, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159646846),
(59, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159646846),
(60, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159646848),
(61, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159646848),
(62, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159646848),
(63, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159646848),
(64, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159646848),
(65, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159646848),
(66, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159646848),
(67, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159646848),
(68, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159646848),
(69, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159646848),
(70, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159646849),
(71, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159646849),
(72, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159646849),
(73, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159646849),
(74, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159646849),
(75, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159646849),
(76, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159646849),
(77, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159646849),
(78, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159646849),
(79, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159646849),
(80, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159646940),
(81, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159646940),
(82, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159646940),
(83, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159646940),
(84, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159646940),
(85, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159646940),
(86, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159646940),
(87, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159646940),
(88, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159646940),
(89, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159646940),
(314, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159708862),
(91, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'goaukd', 1159646940),
(92, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159646941),
(93, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159646941),
(94, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159646941),
(95, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159646941),
(96, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159646941),
(97, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159646941),
(98, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159646941),
(99, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159646941),
(100, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159646941),
(101, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159646941),
(313, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159708862),
(103, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'goaukd', 1159646941),
(104, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159646942),
(105, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159646942),
(106, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159646942),
(107, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159646942),
(108, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159646942),
(109, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159646942),
(110, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159646942),
(111, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159646942),
(112, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159646942),
(113, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159646942),
(312, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159708821),
(115, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'goaukd', 1159646942),
(116, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159647044),
(117, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159647044),
(118, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159647044),
(119, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159647044),
(120, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159647044),
(121, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159647044),
(122, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159647044),
(123, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159647044),
(124, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159647044),
(125, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159647044),
(126, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'goaukd', 1159647044),
(127, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'oris', 1159647044),
(128, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159647046),
(129, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159647046),
(130, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159647046),
(131, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159647046),
(132, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159647046),
(133, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159647046),
(134, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159647046),
(135, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159647046),
(136, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159647046),
(137, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159647046),
(138, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'goaukd', 1159647046),
(311, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159708821),
(140, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159647184),
(141, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159647184),
(142, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159647184),
(143, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159647184),
(144, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159647184),
(145, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159647184),
(146, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159647184),
(147, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159647184),
(148, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159647184),
(149, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159647184),
(150, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'goaukd', 1159647184),
(151, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'oris', 1159647184),
(152, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159647278),
(153, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159647278),
(154, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159647278),
(155, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159647278),
(156, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159647278),
(157, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159647278),
(158, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159647278),
(159, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159647278),
(160, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159647278),
(161, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159647278),
(162, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'goaukd', 1159647278),
(310, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159708821),
(164, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159647298),
(165, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159647298),
(166, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159647298),
(167, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159647298),
(168, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159647298),
(169, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159647298),
(170, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159647298),
(171, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159647298),
(172, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159647298),
(173, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159647298),
(174, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'goaukd', 1159647298),
(175, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'oris', 1159647298),
(176, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159647460),
(177, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159647460),
(178, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159647460),
(179, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159647460),
(180, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159647460),
(181, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159647460),
(182, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159647460),
(183, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159647460),
(184, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159647460),
(185, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159647460),
(186, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'oris', 1159647460),
(306, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159708821),
(189, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159648084),
(190, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159648084),
(191, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159648084),
(192, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159648085),
(193, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159648085),
(194, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159648085),
(195, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159648085),
(196, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159648085),
(197, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159648085),
(198, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159648085),
(305, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159708820),
(201, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'oris', 1159648085),
(202, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159648094),
(203, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159648094),
(204, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159648094),
(205, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159648094),
(206, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159648094),
(207, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159648094),
(208, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159648094),
(209, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159648094),
(210, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159648094),
(211, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159648094),
(212, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'oris', 1159648094),
(303, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159708820),
(304, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159708820),
(215, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159648095),
(216, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159648095),
(217, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159648095),
(218, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159648095),
(219, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159648095),
(220, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159648095),
(221, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159648095),
(222, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159648095),
(223, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159648095),
(224, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159648095),
(309, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159708821),
(302, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159708731),
(227, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'oris', 1159648095),
(228, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159648100),
(229, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159648100),
(230, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159648100),
(231, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159648100),
(232, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159648100),
(233, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159648100),
(234, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159648100),
(235, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159648100),
(236, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159648100),
(237, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159648100),
(238, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'oris', 1159648100),
(301, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159708731),
(241, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159648104),
(242, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159648104),
(243, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159648104),
(244, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159648104),
(245, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159648104),
(246, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159648104),
(247, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159648104),
(248, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159648104),
(249, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159648104),
(250, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159648104),
(308, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159708821),
(300, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159708731),
(253, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'oris', 1159648104),
(254, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159648669),
(255, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159648669),
(256, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159648669),
(257, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159648669),
(258, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159648669),
(259, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159648669),
(260, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159648669),
(261, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159648669),
(262, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159648669),
(263, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159648669),
(297, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159708731),
(298, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159708731),
(267, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159649004),
(268, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159649004),
(269, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159649004),
(270, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159649004),
(271, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159649004),
(272, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159649004),
(273, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159649004),
(274, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159649004),
(275, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159649004),
(276, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159649004),
(307, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159708821),
(299, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159708731),
(296, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159708731),
(280, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159704051),
(281, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159704051),
(282, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159704051),
(283, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159704051),
(284, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159704051),
(285, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159704051),
(286, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159704051),
(287, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159704051),
(288, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159704051),
(289, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159704051),
(293, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159708731),
(294, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159708731),
(295, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159708731),
(315, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159708862),
(316, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159708862),
(317, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159708862),
(318, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159708862),
(319, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159708862),
(320, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159708862),
(321, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159708862),
(322, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159708862),
(323, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159708863),
(324, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159708863),
(325, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159708863),
(326, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159708863),
(327, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159708863),
(328, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159708863),
(329, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159708863),
(330, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159708863),
(331, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159708863),
(332, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159708863),
(333, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159708868),
(334, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159708868),
(335, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159708868),
(336, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159708868),
(337, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159708868),
(338, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159708868),
(339, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159708868),
(340, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159708869),
(341, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159708869),
(342, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159708869),
(348, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159708892),
(347, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159708892),
(346, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159708892),
(349, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159708892),
(350, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159708892),
(351, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159708892),
(352, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159708892),
(353, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159708892),
(354, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159708892),
(355, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159708892),
(361, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159708894),
(360, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159708894),
(359, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159708894),
(362, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159708894),
(363, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159708894),
(364, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159708894),
(365, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159708894),
(366, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159708894),
(367, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159708894),
(368, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159708894),
(369, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'ori', 1159708894),
(370, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'goauld', 1159708894),
(371, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'tauri', 1159708894),
(372, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159708965),
(373, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159708965),
(374, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159708965),
(375, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159708965),
(376, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159708965),
(377, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159708965),
(378, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159708965),
(379, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159708965),
(380, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159708965),
(381, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159708965),
(382, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'tauri', 1159708965),
(383, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'goauld', 1159708965),
(384, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'ori', 1159708965),
(385, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxx', 1159708966),
(386, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x1', 1159708966),
(387, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x14', 1159708966),
(388, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 're', 1159708966),
(389, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xx', 1159708966),
(390, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'test truc2', 1159708966),
(391, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'x12', 1159708966),
(392, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'az', 1159708966),
(393, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'xxxxxx', 1159708966),
(394, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'azer', 1159708966),
(395, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'ori', 1159708966),
(396, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'tauri', 1159708966),
(397, '<font color="green">Vous avez été promus aux commandes d''un empire !</font>', 'goauld', 1159708966),
(398, 'Vous avez été promus aux commandes d''un empire !', '''+e_%p', 1159984508),
(399, 'Vous avez été promus aux commandes d''un empire !', 're', 1179075612),
(400, '', 'x1', 1179343228),
(401, '', 'goauld', 1179343228),
(402, ', et vous remportez le combat. La planète Dakara est à vous !', 'x1', 1179344178),
(403, ', mais vos défenses ont faillit. Vous perdez la planète Dakara.', 'goauld', 1179344178),
(404, ', et vous remportez le combat. La planète Dakara est à vous !', 'x1', 1179344224),
(405, ', mais vos défenses ont faillit. Vous perdez la planète Dakara.', 'goauld', 1179344224),
(406, ', et vous remportez le combat. La planète Dakara est à vous !', 'x1', 1179344404),
(407, ', mais vos défenses ont faillit. Vous perdez la planète Dakara.', 'goauld', 1179344404),
(408, ', et vous remportez le combat. La planète Dakara est à vous !', 'x1', 1179344410),
(409, ', mais vos défenses ont faillit. Vous perdez la planète Dakara.', 'goauld', 1179344410),
(410, ', et vous remportez le combat. La planète Dakara est à vous !', 'x1', 1179344630),
(411, ', mais vos défenses ont faillit. Vous perdez la planète Dakara.', 'goauld', 1179344631),
(412, '', 'x1', 1179344827),
(413, '', 'goauld', 1179344827),
(414, '', 'x1', 1179344833),
(415, '', 'goauld', 1179344833),
(416, '', 'x1', 1179344838),
(417, '', 'goauld', 1179344838),
(418, '', 'x1', 1179344844),
(419, '', 'goauld', 1179344844),
(420, '', 'x1', 1179344854),
(421, '', 'goauld', 1179344854),
(422, '', 'x1', 1179344859),
(423, '', 'goauld', 1179344859),
(424, '', 'x1', 1179344907),
(425, '', 'goauld', 1179344907),
(426, '', 'x1', 1179344915),
(427, '', 'goauld', 1179344915),
(428, ', et vous remportez le combat. La planète Dakara est à vous !', 'x1', 1179345011),
(429, ', mais vos défenses ont faillit. Vous perdez la planète Dakara.', 'goauld', 1179345011),
(430, '', 'x1', 1179345018),
(431, '', 'goauld', 1179345018),
(432, '', 'x1', 1179346013),
(433, '', 'goauld', 1179346013),
(434, 'Votre flotte f a attaqué la planète Dakara, mais vous n''avez pas réussit a briser la défense adverse.', 'x1', 1179346066),
(435, ', et vous avez contré l''attaque énnemie. Félicitation.', 'goauld', 1179346066),
(436, 'Votre flotte f a attaqué la planète Dakara, et vous remportez le combat. La planète Dakara est à vous !', 'x1', 1179346101),
(437, ', mais vos défenses ont faillit. Vous perdez la planète Dakara.', 'goauld', 1179346101),
(438, 'Votre flotte f a attaqué la planète , et vous remportez le combat. La planète  est à vous !', 'x1', 1179580756),
(439, ', mais vos défenses ont faillit. Vous perdez la planète .', 'az', 1179580756),
(440, 'Vous venez d''être exclu de la guilde Tauri''s Guilde', 'azer', 1180350019),
(441, 'Vous venez d''être exclu de la guilde ', 'azer', 1180350027),
(442, 'Vous avez été promus aux commandes d''un empire !', 'x2', 1180356504);

-- --------------------------------------------------------

-- 
-- Structure de la table `sg_mess`
-- 

CREATE TABLE `sg_mess` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `heure` int(11) NOT NULL default '0',
  `message` text NOT NULL,
  `pseudo` varchar(20) NOT NULL default '',
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Contenu de la table `sg_mess`
-- 

INSERT INTO `sg_mess` (`id`, `heure`, `message`, `pseudo`) VALUES 
(9, 1179412661, 'huhu', 'x1');

-- --------------------------------------------------------

-- 
-- Structure de la table `sg_messagerie`
-- 

CREATE TABLE `sg_messagerie` (
  `id` int(9) unsigned NOT NULL auto_increment,
  `sujet` varchar(65) NOT NULL default '',
  `message` text NOT NULL,
  `destinataire` varchar(50) NOT NULL default '',
  `destinateur` varchar(50) NOT NULL default '',
  `vue` varchar(10) NOT NULL default 'false',
  `type` varchar(20) NOT NULL default '',
  `color` varchar(20) NOT NULL default 'black',
  `heure` int(15) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 PACK_KEYS=0 AUTO_INCREMENT=33 ;

-- 
-- Contenu de la table `sg_messagerie`
-- 

INSERT INTO `sg_messagerie` (`id`, `sujet`, `message`, `destinataire`, `destinateur`, `vue`, `type`, `color`, `heure`) VALUES 
(1, 'Test', 'Ca maaaaaaaaaaaaaaaaaaaaaaarche :D', 'xxxx', 'x1', 'true', 'perso', 'black', 1141443812),
(2, 'tes', 'test', 'x1', 'x1', 'true', 'perso', 'black', 1141443820),
(3, 'btp', 'btp', 'x1', 'xx', 'true', 'perso', 'black', 1141755535),
(4, 'Test', 'Test', 'x1', 'x1', 'true', 'perso', 'green', 1142019435),
(5, 'test', 'de', 'x1', 're', 'true', 'perso', 'black', 1142192919),
(6, 'de', 'de', 're', 're', 'true', 'perso', 'black', 1142192929),
(10, 'salut', 'sxxxxxxxxxxsa ', 'xxxx', 'x1', 'true', 'perso', 'black', 1154799776),
(11, 'My angel', 'xxxxt', 'x1', 'x1', 'true', 'perso', 'black', 1154800309),
(12, 'test', 'test', 'x1', 'x1', 'true', 'perso', 'black', 1154805368),
(14, 'yfg', 'fdgfd', 'x1', 'x1', 'true', 'perso', 'black', 1157157067),
(15, 'gdf', 'gfd', 'x1', 'x1', 'true', 'perso', 'black', 1157157133),
(16, 'Coucou ^^', 'xxxxD', 'xxxxxx', 'x1', 'true', 'perso', 'black', 1157208854),
(17, 'hihi:D', 'xxx', 'x1', 'xxxxxx', 'true', 'perso', 'black', 1157209012),
(18, 'fdsfs', 'sdf<br />jkhkj<br />jhkhk', 'x1', 'x1', 'true', 'perso', 'black', 1158244943),
(32, 'cb', 'b', 'x1', 'x1', 'true', 'perso', 'black', 1180350767),
(31, '456', '646', 'Tauri''s Guilde', 'x1', 'true', 'guilde', 'black', 1180350120),
(30, '123123546', '546456', '1', 'x1', 'true', 'clan', 'black', 1180350105),
(29, 'Une nouvelle postulation pour la guilde', 'Bonjour<br />Le joueur \\''+e_%p vient de postuler à votre guilde. Pour accépter ou décliner sa demande, allez dans l''administration de votre guilde.', '', 'Guilde', 'false', 'perso', 'black', 1159992477);

-- --------------------------------------------------------

-- 
-- Structure de la table `sg_perso`
-- 

CREATE TABLE `sg_perso` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pseudo` varchar(20) collate latin1_general_ci NOT NULL default '',
  `pass` varchar(40) collate latin1_general_ci NOT NULL default '',
  `mail` varchar(32) collate latin1_general_ci NOT NULL default '',
  `time` int(14) NOT NULL default '0',
  `ip_inscription` varchar(30) collate latin1_general_ci NOT NULL default '',
  `race` varchar(10) collate latin1_general_ci NOT NULL,
  `clan` varchar(10) collate latin1_general_ci NOT NULL,
  `guilde` varchar(40) collate latin1_general_ci NOT NULL default '',
  `signature_message` text collate latin1_general_ci NOT NULL,
  `maj` int(32) NOT NULL default '0',
  `rapport_mail` int(1) NOT NULL default '0',
  `message_mail` int(1) NOT NULL default '0',
  `save` int(1) NOT NULL default '0',
  `win` int(6) NOT NULL default '0' COMMENT 'combats gagnés',
  `loose` int(6) NOT NULL default '0' COMMENT 'perdus',
  `equal` int(6) NOT NULL default '0' COMMENT 'exaequos',
  `game` int(3) NOT NULL default '1' COMMENT 'nb d eparties jouées',
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=107 ;

-- 
-- Contenu de la table `sg_perso`
-- 

INSERT INTO `sg_perso` (`id`, `pseudo`, `pass`, `mail`, `time`, `ip_inscription`, `race`, `clan`, `guilde`, `signature_message`, `maj`, `rapport_mail`, `message_mail`, `save`, `win`, `loose`, `equal`, `game`) VALUES 
(9, 'xxxx', 'xxxxxxxxxxxxxxxxxxxxx', '', 1133393546, '82.120.69.96', 'goauld', '2', 'Goa''ulds Guilde', '', 1141757855, 0, 0, 1, 3, 1, 1, 1),
(4, 'x1', 'xxxxxxxxxxxxxxxxxxxxx', 'x@hotmail.com', 1133378134, '86.192.198.58', 'tauri', '1', 'Tauri''s Guilde', 'Test de signature<br /><img src=http://www.google.fr/images/logo_sm.gif>', 1180359727, 0, 0, 1, 12, 3, 1, 1),
(8, 'x14', 'xxxxxxxxxxxxxxxxxxxxx', 'jj@hh.tt', 1133388408, '86.192.198.58', 'goauld', '', 'Goa''ulds Guilde', '', 1133370408, 0, 0, 1, 0, 0, 0, 1),
(10, 're', 'xxxxxxxxxxxxxxxxxxxxx', 're', 1141069867, '81.249.15.243', 'goauld', '2', 'Goa''ulds Guilde', '', 1179075909, 0, 0, 1, 0, 0, 0, 1),
(11, 'xx', 'xxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxx@msn.com', 1141391476, '83.197.101.49', 'tauri', '', 'Tauri''s Guilde', '', 1141758070, 0, 0, 1, 0, 0, 0, 1),
(12, 'test truc2', 'xxxxxxxxxxxxxxxxxxxxx', 'f', 1141405930, '86.208.118.31', 'tauri', '', 'Tauri''s Guilde', '', 1141405972, 0, 0, 1, 0, 0, 0, 1),
(13, 'x12', 'xxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxx@hotmail.com', 1157121306, '127.0.0.1', 'tauri', '', 'Tauri''s Guilde', '', 1157141230, 0, 0, 1, 0, 0, 0, 1),
(14, 'az', 'xxxxxxxxxxxxxxxxxxxxx', 'e', 1157141250, '127.0.0.1', 'goauld', '', 'Goa''ulds Guilde', '', 1157142297, 0, 0, 1, 0, 1, 0, 1),
(15, 'xxxxxx', 'xxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxx@yahoo.com', 1157208802, '84.73.196.184', 'tauri', '1', 'Tauri''s Guilde', '', 1157217836, 0, 0, 1, 0, 0, 0, 1),
(16, 'azer', 'xxxxxxxxxxxxxxxxxxxxx', 'z', 1157210449, '86.192.133.60', 'tauri', '', '', '', 1157211966, 0, 0, 1, 0, 0, 0, 1),
(104, 'ori', 'xxxxxxxxxxxxxxxxxxxxx', '', 1159708966, '', 'ori', '3', '', '', 0, 0, 0, 1, 0, 0, 0, 1),
(102, 'tauri', 'xxxxxxxxxxxxxxxxxxxxx', '', 1159708966, '', 'tauri', '1', '', '', 0, 0, 0, 1, 0, 0, 0, 1),
(103, 'goauld', 'xxxxxxxxxxxxxxxxxxxxx', '', 1159708966, '', 'goauld', '2', '', '', 0, 0, 0, 1, 1, 7, 0, 1),
(105, '''+e_%p', 'xxxxxxxxxxxxxxxxxxxxx', '''+e_%p', 1159984508, '127.0.0.1', 'goauld', '', 'Goa''ulds Guilde--postul', '', 1159992571, 0, 0, 0, 0, 0, 0, 1),
(106, 'x2', 'xxxxxxxxxxxxxxxxxxxxx', 'x2', 1180356504, '127.0.0.1', 'bsg', '2', '', '', 1180359738, 0, 0, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

-- 
-- Structure de la table `sg_planete`
-- 

CREATE TABLE `sg_planete` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pseudo` varchar(20) collate latin1_general_ci NOT NULL default '',
  `nom` varchar(20) collate latin1_general_ci NOT NULL default '',
  `coord_X` mediumint(5) NOT NULL default '0',
  `coord_Y` mediumint(5) NOT NULL default '0',
  `race` varchar(40) collate latin1_general_ci NOT NULL,
  `clan` int(2) NOT NULL default '1',
  `image` varchar(50) collate latin1_general_ci NOT NULL default '',
  `orisis` smallint(5) NOT NULL default '0',
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=45 ;

-- 
-- Contenu de la table `sg_planete`
-- 

INSERT INTO `sg_planete` (`id`, `pseudo`, `nom`, `coord_X`, `coord_Y`, `race`, `clan`, `image`, `orisis`) VALUES 
(1, 'tauri', 'Terre 3', 19, 41, 'tauri', 1, 'images/terre_3', 0),
(2, 'tauri', 'Terre 4', 20, 41, 'tauri', 1, 'images/terre_4', 0),
(3, 'tauri', 'Terre 1', 19, 42, 'tauri', 1, 'images/terre_1', 0),
(4, 'tauri', 'Terre 2', 20, 42, 'tauri', 1, 'images/terre_2', 0),
(5, 'x1', 'Dakara 3', 20, 8, 'tauri', 1, 'images/dakara_3', 0),
(6, 'x1', 'Dakara 4', 21, 8, 'tauri', 1, 'images/dakara_4', 0),
(7, 'goauld', 'Dakara 1', 20, 9, 'goauld', 2, 'images/dakara_1', 0),
(8, 'goauld', 'Dakara 2', 21, 9, 'goauld', 2, 'images/dakara_2', 0),
(9, 'ori', 'Super Porte 3', 39, 15, 'ori', 3, 'images/sporte_3', 0),
(10, 'ori', 'Super Porte 4', 40, 15, 'ori', 3, 'images/sporte_4', 0),
(11, 'ori', 'Super Porte 1', 39, 16, 'ori', 3, 'images/sporte_1', 0),
(12, 'ori', 'Super Porte 2', 40, 16, 'ori', 3, 'images/sporte_2', 0),
(13, 'xxxx', '', 13, 47, 'goauld', 2, '', 0),
(14, 'xxxx', '', 34, 8, 'goauld', 2, '', 0),
(15, 'x1', 'hfgh', 40, 34, 'tauri', 1, '', 0),
(16, 'x1', 'hgfh', 43, 28, 'tauri', 1, '', 0),
(17, 'x14', '', 3, 27, 'goauld', 2, '', 0),
(18, 'x14', '', 15, 34, 'goauld', 2, '', 0),
(42, 're', 're2', 16, 50, '', 1, '', 0),
(41, 're', 're1', 1, 47, '', 1, '', 0),
(21, 'xx', '', 5, 26, 'tauri', 1, '', 0),
(22, 'xx', '', 19, 0, 'tauri', 1, '', 0),
(23, 'test truc2', '', 16, 17, 'tauri', 1, '', 0),
(24, 'test truc2', '', 47, 20, 'tauri', 1, '', 0),
(25, 'x12', '', 7, 34, 'tauri', 1, '', 0),
(26, 'x12', '', 31, 47, 'tauri', 1, '', 0),
(27, 'x1', 'Plapla', 26, 4, 'tauri', 1, '', 0),
(28, 'az', '', 8, 46, 'goauld', 2, '', 0),
(29, 'xxxxxx', '', 46, 36, 'tauri', 1, '', 0),
(30, 'xxxxxx', '', 40, 9, 'tauri', 1, '', 0),
(31, 'azer', '', 16, 5, 'tauri', 1, '', 0),
(32, 'azer', '', 11, 5, 'tauri', 1, '', 0),
(33, 'ori', '', 9, 20, 'ori', 1, '', 0),
(34, 'ori', '', 33, 27, 'ori', 1, '', 0),
(35, 'tauri', '', 25, 8, 'tauri', 1, '', 0),
(36, 'tauri', '', 41, 40, 'tauri', 1, '', 0),
(37, 'goauld', '', 35, 25, 'goauld', 1, '', 0),
(38, 'goauld', '', 47, 36, 'goauld', 1, '', 0),
(39, '''+e_%p', '''+e_%p', 9, 10, 'goauld', 1, '', 0),
(40, '''+e_%p', '''+e_%p2', 33, 19, 'goauld', 1, '', 0),
(43, 'x2', 'x22', 37, 11, 'bsg', 2, '', 0),
(44, 'x2', 'x23', 50, 26, 'bsg', 2, '', 0);

-- --------------------------------------------------------

-- 
-- Structure de la table `sg_planete_units`
-- 

CREATE TABLE `sg_planete_units` (
  `id` int(15) unsigned NOT NULL auto_increment,
  `id_joueur` int(5) NOT NULL default '0',
  `id_planete` int(15) NOT NULL default '0',
  `type` smallint(6) NOT NULL default '0',
  `nombre` mediumint(9) NOT NULL default '0',
  `ordre` int(11) NOT NULL default '0',
  `unit` varchar(10) collate latin1_general_ci NOT NULL default 'spacial',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=30 ;

-- 
-- Contenu de la table `sg_planete_units`
-- 

INSERT INTO `sg_planete_units` (`id`, `id_joueur`, `id_planete`, `type`, `nombre`, `ordre`, `unit`) VALUES 
(29, 4, 6, 5, 12, 0, 'spatial'),
(28, 4, 6, 1, 15, 0, 'terrestre'),
(27, 4, 6, 0, 20, 0, 'terrestre'),
(25, 4, 6, 0, 10, 0, 'spatial'),
(26, 4, 5, 1, 50, 0, 'terrestre'),
(24, 4, 5, 0, 20, 0, 'spatial'),
(23, 4, 5, 1, 10, 0, 'spatial');

-- --------------------------------------------------------

-- 
-- Structure de la table `sg_ressource`
-- 

CREATE TABLE `sg_ressource` (
  `pseudo` varchar(20) NOT NULL default '',
  `fer` bigint(32) unsigned NOT NULL default '0',
  `or` bigint(32) unsigned NOT NULL default '0',
  `carbone` bigint(32) unsigned NOT NULL default '0',
  `naquada` decimal(32,2) unsigned NOT NULL default '0.00',
  `trinium` decimal(32,2) unsigned NOT NULL default '0.00',
  `population` bigint(32) unsigned NOT NULL default '0',
  `popularite` int(3) NOT NULL default '50',
  PRIMARY KEY  (`pseudo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `sg_ressource`
-- 

INSERT INTO `sg_ressource` (`pseudo`, `fer`, `or`, `carbone`, `naquada`, `trinium`, `population`, `popularite`) VALUES 
('xxxx', 0, 0, 0, 0.00, 0.00, 0, 50),
('x1', 554427439, 19003781, 27395334, 4046602.59, 2697878.29, 22000, 50),
('x14', 0, 0, 0, 0.00, 0.00, 0, 50),
('x2', 53260, 2955, 4439, 608.70, 407.68, 3229, 50),
('xx', 0, 0, 0, 0.00, 0.00, 0, 50),
('test truc2', 0, 0, 0, 0.00, 0.00, 0, 50),
('x12', 0, 0, 0, 0.00, 0.00, 0, 50),
('az', 0, 0, 0, 0.00, 0.00, 0, 50),
('xxxxxx', 0, 0, 0, 0.00, 0.00, 0, 50),
('azer', 0, 0, 0, 0.00, 0.00, 0, 50),
('ori', 0, 0, 0, 0.00, 0.00, 0, 50),
('tauri', 0, 0, 0, 0.00, 0.00, 0, 50),
('goauld', 0, 0, 0, 0.00, 0.00, 0, 50),
('''+e_%p', 129450, 5488, 9334, 1524.38, 1022.88, 8035, 50),
('re', 4894, 271, 409, 58.65, 39.09, 297, 50);

-- --------------------------------------------------------

-- 
-- Structure de la table `sg_triche`
-- 

CREATE TABLE `sg_triche` (
  `pseudo` varchar(20) collate latin1_general_ci NOT NULL default '',
  `ip` varchar(20) collate latin1_general_ci NOT NULL default '',
  `page` varchar(100) collate latin1_general_ci NOT NULL default '',
  `time` varchar(20) collate latin1_general_ci NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Contenu de la table `sg_triche`
-- 

INSERT INTO `sg_triche` (`pseudo`, `ip`, `page`, `time`) VALUES 
('x1', 'xxxxxx', '', '1137358087'),
('x1', 'xxxxxxxxxx', '', '1140746461'),
('x1', '127.0.0.1', '', '1157902489'),
('x1', '127.0.0.1', '/SG-War/jeu/accueil.php?page=guilde', '1157902510'),
('x1', '127.0.0.1', '/SG-War/jeu/accueil.php?page=guilde', '1157902549'),
('x1', '127.0.0.1', '/SG-War/jeu/accueil.php?page=guilde', '1157902577'),
('', '127.0.0.1', '/SG-War/jeu/accueil.php?page=guilde', '1157902596'),
('', '127.0.0.1', '/SG-War/jeu/accueil.php?page=guilde', '1157902605'),
('x1', '127.0.0.1', '/SG-War/jeu/accueil.php?page=guilde&action=administrer', '1157907746'),
('x1', '127.0.0.1', '/SG-War/jeu/accueil.php?page=guilde&action=administrer', '1157907805'),
('x1', '127.0.0.1', '/SG-War/jeu/accueil.php?page=guilde&action=administrer', '1157907813'),
('x1', '127.0.0.1', '/SG-War/jeu/accueil.php?page=guilde&action=administrer', '1157907827'),
('x1', '127.0.0.1', '/SG-War/jeu/accueil.php?page=guilde&action=administrer', '1157908142'),
('x1', '127.0.0.1', '/SG-War/jeu/accueil.php?page=guilde&action=administrer&action2=supprimer_membre&membre=13', '1158084692'),
('x1', '127.0.0.1', '/SG-War/jeu/accueil.php?page=guilde&action=administrer&action2=supprimer_membre&membre=13', '1158085249'),
('x1', '127.0.0.1', '/SG-War/jeu/accueil.php?page=guilde&action=administrer&action2=supprimer_membre&membre=13', '1158085310'),
('x1', '127.0.0.1', '/SG-War/jeu/accueil.php?page=guilde&action=administrer&action2=supprimer_membre&membre=13', '1158085596'),
('x1', '127.0.0.1', '/SG-War/jeu/accueil.php?page=guilde&action=administrer&action2=supprimer_membre&membre=13', '1158086810'),
('x1', '127.0.0.1', '/SG-War/jeu/accueil.php?page=guilde&action=administrer&action2=supprimer_membre&membre=13', '1158086810'),
('x1', '127.0.0.1', '/SG-War/jeu/accueil.php?page=guilde&action=administrer&action2=supprimer_membre&membre=13', '1158086833'),
('x1', '127.0.0.1', '/SG-War/jeu/accueil.php?page=guilde&action=administrer&action2=supprimer_membre&membre=13', '1158086833'),
('x1', '127.0.0.1', '/SG-War/jeu/accueil.php?page=guilde&action=administrer&action2=supprimer_membre&membre=13', '1158086863'),
('x1', '127.0.0.1', '/SG-War/jeu/accueil.php?page=guilde&action=administrer&action2=supprimer_membre&membre=13', '1158086863'),
('x1', '127.0.0.1', '/SG-War/jeu/accueil.php?page=guilde&action=administrer&action2=supprimer_membre&id=13', '1158086866'),
('x1', '127.0.0.1', '/SG-War/jeu/accueil.php?page=guilde&action=administrer&action2=supprimer_membre&id=13', '1158086866'),
('x1', '127.0.0.1', '/SG-War/jeu/accueil.php?page=guilde&action=administrer&action2=supprimer_membre&id=13', '1158089006'),
('x1', '127.0.0.1', '/SG-War/jeu/accueil.php?page=guilde&action=administrer&action2=accepter&id=15', '1158090446'),
('x1', '127.0.0.1', '/SG-War/jeu/accueil.php?page=guilde&action=administrer&action2=supprimer_membre&id=15', '1158090493'),
('x1', '127.0.0.1', '/SG-War/jeu/accueil.php?page=guilde&action=administrer', '1158252480'),
('x1', '127.0.0.1', '/www/SG-War/jeu/accueil.php?page=guilde&action=administrer&action2=supprimer_membre&id=16', '1180350019'),
('x1', '127.0.0.1', '/www/SG-War/jeu/accueil.php?page=guilde&action=administrer&action2=supprimer_membre&id=16', '1180350027');
