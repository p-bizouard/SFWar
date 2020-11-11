-- phpMyAdmin SQL Dump
-- version 2.10.0-beta1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Mercredi 30 Mai 2007 à 22:05
-- Version du serveur: 5.0.33
-- Version de PHP: 5.2.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de données: `stargate`
-- 

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=56 ;

-- 
-- Contenu de la table `sg_planete`
-- 

INSERT INTO `sg_planete` (`id`, `pseudo`, `nom`, `coord_X`, `coord_Y`, `race`, `clan`, `image`, `orisis`) VALUES 
(47, 'neutre', 'Planète mère 1', 24, 26, '0', 0, 'images/plapla_mere_1', 0),
(48, 'neutre', 'Planète mère 2', 25, 26, '0', 0, 'images/plapla_mere_2', 0),
(49, 'neutre', 'Planète mère 3', 26, 26, '0', 0, 'images/plapla_mere_3', 0),
(50, 'neutre', 'Planètre mère 4', 24, 25, '0', 0, 'images/plapla_mere_4', 0),
(51, 'neutre', 'Planète mère 5', 25, 25, '0', 0, 'images/plapla_mere_5', 0),
(52, 'neutre', 'Planètre mère 6', 26, 25, '0', 0, 'images/plapla_mere_6', 0),
(53, 'neutre', 'Planète mère 7', 24, 24, '0', 0, 'images/plapla_mere_7', 0),
(54, 'neutre', 'Planètre mère 8', 25, 24, '0', 0, 'images/plapla_mere_8', 0),
(55, 'neutre', 'Planète mère 9', 26, 24, '0', 0, 'images/plapla_mere_9', 0);
