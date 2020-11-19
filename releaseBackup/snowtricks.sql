-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 19 nov. 2020 à 08:40
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `snowtricks`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `trick_id` int(11) NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526CA76ED395` (`user_id`),
  KEY `IDX_9474526CB281BE2E` (`trick_id`)
) ENGINE=InnoDB AUTO_INCREMENT=664 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `trick_id`, `content`, `created_at`, `updated_at`, `is_deleted`) VALUES
(660, 325, 291, 'Hello! Que pensez-vous de mon premier trick? J\'aimerais avoir des retours pour l\'améliorer :)', '2020-11-12 09:13:27', '2020-11-12 09:13:27', 0),
(661, 325, 291, 'Bon après quelques modifs c\'est mieux non?', '2020-11-12 10:31:53', '2020-11-12 10:31:53', 0),
(662, 326, 291, 'Ok pour moi c\'est mieux aussi! :)', '2020-11-12 10:32:45', '2020-11-12 10:32:45', 0),
(663, 326, 292, 'Bon contenue ca!', '2020-11-13 15:05:36', '2020-11-13 15:05:36', 0);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20200820074535', '2020-08-20 07:45:43', 96),
('DoctrineMigrations\\Version20200820074732', '2020-08-20 07:47:40', 59),
('DoctrineMigrations\\Version20200820075611', '2020-08-20 07:56:31', 200),
('DoctrineMigrations\\Version20200820075732', '2020-08-20 07:57:35', 280),
('DoctrineMigrations\\Version20200820080809', '2020-08-20 08:08:14', 394),
('DoctrineMigrations\\Version20200820082735', '2020-08-20 08:27:39', 129),
('DoctrineMigrations\\Version20200910091657', '2020-09-10 09:17:32', 101),
('DoctrineMigrations\\Version20200915214059', '2020-09-15 21:41:21', 239),
('DoctrineMigrations\\Version20201023091824', '2020-10-23 09:22:46', 169),
('DoctrineMigrations\\Version20201029135143', '2020-10-29 13:51:58', 131),
('DoctrineMigrations\\Version20201029140423', '2020-10-29 14:05:03', 60);

-- --------------------------------------------------------

--
-- Structure de la table `picture`
--

DROP TABLE IF EXISTS `picture`;
CREATE TABLE IF NOT EXISTS `picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trick_id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `legend` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_main` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_16DB4F89B281BE2E` (`trick_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `picture`
--

INSERT INTO `picture` (`id`, `trick_id`, `path`, `legend`, `is_main`, `created_at`, `updated_at`, `is_deleted`) VALUES
(6, 291, 'mute1-5f9bd3d31b6a6.jpeg', NULL, 1, '2020-10-30 08:50:27', '2020-10-30 08:50:27', 0),
(7, 291, 'mute2-5f9bd408d9246.jpeg', NULL, 0, '2020-10-30 08:51:20', '2020-11-12 10:23:09', 0),
(8, 291, 'unnamed-5f9bd41c7f6a4.jpeg', NULL, 0, '2020-10-30 08:51:40', '2020-11-12 10:21:44', 0),
(9, 291, 'maxresdefault-5f9bd432d3ac8.jpeg', NULL, 0, '2020-10-30 08:52:02', '2020-11-12 09:41:54', 0),
(13, 292, 'regvsgoof-5fad37ee37b76.jpeg', NULL, 1, '2020-11-12 13:26:06', '2020-11-12 13:26:20', 1),
(14, 292, 'snowboard-goofy-or-regular-for-post-5fad38176ea4a.jpeg', NULL, 1, '2020-11-12 13:26:47', '2020-11-12 13:28:38', 1),
(15, 292, 'v4-1200px-Determine-if-You-re-Regular-or-Goofy-Foot-Step-12-5fad38869c172.jpeg', NULL, 1, '2020-11-12 13:28:38', '2020-11-12 13:28:38', 0),
(16, 292, 'regvsgoof-5fad389151700.jpeg', NULL, 0, '2020-11-12 13:28:49', '2020-11-12 13:28:49', 0),
(17, 292, 'snowboard-goofy-or-regular-for-post-5fad389cbf253.jpeg', NULL, 0, '2020-11-12 13:29:00', '2020-11-12 13:29:00', 0),
(18, 290, 'Your-First-Frontside-180-720x-5fae878152b6a.jpeg', NULL, 1, '2020-11-13 13:17:53', '2020-11-13 13:17:53', 0),
(19, 289, 'background-5fae8942bd7cf.jpeg', NULL, 1, '2020-11-13 13:25:22', '2020-11-13 13:25:22', 0),
(20, 288, 'cab9254974c4709ca505f775fa6f8413-5fae8b025f7a4.jpeg', NULL, 1, '2020-11-13 13:32:50', '2020-11-13 13:34:41', 1),
(21, 288, 'Snowboard-programme-pour-vous-echauffer-5fae8b720162f.jpeg', NULL, 1, '2020-11-13 13:34:42', '2020-11-13 13:34:42', 0),
(22, 288, 'cab9254974c4709ca505f775fa6f8413-5fae8b8bc844a.jpeg', NULL, 0, '2020-11-13 13:35:07', '2020-11-13 13:35:07', 0),
(23, 288, 'telechargement-5fae8b9648a98.jpeg', NULL, 0, '2020-11-13 13:35:18', '2020-11-13 13:35:18', 0),
(24, 287, '11-5fae94110df03.jpeg', NULL, 1, '2020-11-13 14:11:29', '2020-11-13 14:11:29', 0),
(25, 286, 'one-foot-trick-1-5fae9474645a2.jpeg', NULL, 1, '2020-11-13 14:13:08', '2020-11-13 14:13:08', 0),
(26, 285, '21-5fae95456f75c.jpeg', NULL, 1, '2020-11-13 14:16:37', '2020-11-13 14:16:37', 0);

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=409 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`id`, `name`, `created_at`, `updated_at`, `is_deleted`) VALUES
(401, 'Manière de rider', '2020-09-12 12:30:38', '2020-09-12 12:30:38', 0),
(402, 'Grab', '2020-09-12 12:30:38', '2020-09-12 12:30:38', 0),
(403, 'Rotation', '2020-09-12 12:30:38', '2020-09-12 12:30:38', 0),
(404, 'Flip', '2020-09-12 12:30:38', '2020-09-12 12:30:38', 1),
(405, 'Rotation désaxée', '2020-09-12 12:30:38', '2020-09-12 12:30:38', 0),
(406, 'Slide', '2020-09-12 12:30:38', '2020-09-12 12:30:38', 0),
(407, 'One foot trick', '2020-09-12 12:30:38', '2020-09-12 12:30:38', 0),
(408, 'Old school', '2020-09-12 12:30:38', '2020-09-12 12:30:38', 0);

-- --------------------------------------------------------

--
-- Structure de la table `trick`
--

DROP TABLE IF EXISTS `trick`;
CREATE TABLE IF NOT EXISTS `trick` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_online` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `slug` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D8F0A91E5E237E06` (`name`),
  UNIQUE KEY `UNIQ_D8F0A91E989D9B62` (`slug`),
  KEY `IDX_D8F0A91EA76ED395` (`user_id`),
  KEY `IDX_D8F0A91EBAD26311` (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=293 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `trick`
--

INSERT INTO `trick` (`id`, `user_id`, `tag_id`, `name`, `content`, `is_online`, `created_at`, `updated_at`, `is_deleted`, `slug`) VALUES
(285, 325, 408, 'Japan Air', '<p>The Grab:</p>\r\n<p>Front hand wraps around the front leg and grabs toe edge between the bindings. Knees are bent folding legs backwards toward the board.</p>\r\n<p>&nbsp;</p>\r\n<p>The Tweak:</p>\r\n<p>Knees are fully bent, pulling up and back on the grab.</p>\r\n<p>&nbsp;</p>\r\n<p>Performed By: Harrison Gordon.</p>\r\n<p>&nbsp;</p>\r\n<p>The History:</p>\r\n<p>According to Tony Hawk, &ldquo;There was a TWS article with a feature on Japan around &rsquo;84. The first spread was a huge picture of a Japanese guy doing a tweaked mute air with the headline JAPAN above it. We had never seen an air like that and immediately started calling it by that name because the magazine layout almost named it by default. Someone should find that issue.&rdquo;</p>\r\n<p>&nbsp;</p>\r\n<p>Well, after leafing through enough pages of old TransWorld SKATEboarding issues to make our thumbs raw, we found it. Memory can be a slippery thing, and it turns out the trick appeared in the February 1985 issue, and the photo is the little inset, not a spread. Otherwise, Hawks recollection is spot on, and the unknown Japanese skaters unique tweak on a conventional mute grab laid the foundation for what will forever be referred to as a Japan. Inspired, Hawk began to replicate this move, and his lanky build accentuated this tweak like no one else could. Shortly after, two shots of Hawk ran in the August 1985 TWSKATE immortalizing the grab and name forever.</p>\r\n<p>&nbsp;</p>\r\n<p>The article in the February 1985 issue of TransWorld SKATEboarding that inspired the japan air.&nbsp;</p>\r\n<p>The article in the February 1985 issue of TransWorld SKATEboarding that inspired the Japan Air.</p>\r\n<p>A closer look at the photo of the unknown skater who inspired Tony Hawk\'s first Japan Air.&nbsp;</p>\r\n<p>A closer look at the photo of the unknown skater that gave Tony Hawk the idea for the Japan Air.</p>\r\n<p>The first of Tony Hawk\'s Japan Airs to appear in the August 1985 issue of TransWorld SKATEboarding. The caption reads: \"Tony Hawk\'s Japan airs boggled minds, half cabs followed by full caballaerials, his very deep sack of tricks made him win. Last run of the evening.\" Photo: Morton</p>\r\n<p>The first of Tony Hawk&rsquo;s Japan Airs to appear in the August 1985 issue of TransWorld SKATEboarding. The caption reads: &ldquo;Tony Hawk&rsquo;s Japan airs boggled minds, half cabs followed by full caballaerials, his very deep sack of tricks made him win. Last run of the evening.&rdquo; Photo: Morton</p>\r\n<p>The second of Tony Hawk\'s Japan Airs to appear in the August 1985 issue of TransWorld SKATEboarding.&nbsp;</p>\r\n<p>The second of Tony Hawk&rsquo;s Japan Airs to appear in the August 1985 issue of TransWorld SKATEboarding.</p>\r\n<p>Cover of the August 1985 issue of TransWorld SKATEboarding.&nbsp;</p>\r\n<p>Cover of the August 1985 issue of TransWorld SKATEboarding.</p>\r\n<p>Snowboarders naturally blended this tweak into our trick vernacular, and have attempted to recreate what Hawk and the anonymous Japanese skater introduced in the mid-&rsquo;80s. Battling the restriction of bindings, boots, and winter pants, the classic skate tweak is often hard to mimic on snow. Terje Haakonsen has inserted them into historic contest runs mid-McTwist, and Nicolas M&uuml;ller has brought them into the backcountry, to the arena jumps of Air + Style during backside 720s, and Cab 900s. In the summer of 2008, Bode Merrill landed perhaps snowboardings most insane Japan to date at High Cascade Snowboard Camp with a one-footed backside 720 Japan, allowing him to tweak the grab (and onlookers minds) beyond all known limits.</p>', 1, '2020-10-23 10:35:23', '2020-11-13 14:16:19', 0, 'japan-air'),
(286, 325, 407, 'One foot : Tuto', '<p>Le One foot manual est un manual assez particulier puisqu\'il consiste &agrave; rouler sur un pied et l\'arri&egrave;re du skateboard. Le placement du pied se fait au niveau du truck, c\'est gr&acirc;ce &agrave; vos bras et &agrave; quelques lanc&eacute;es de pied que vous parviendrez &agrave; tenir l\'&eacute;quilibre. Observez bien les bras ainsi que le placement du pied sur la vid&eacute;o en slow motion ci dessous.</p>', 1, '2020-10-23 10:36:31', '2020-11-13 14:13:49', 0, 'one-foot-tuto'),
(287, 325, 406, 'Nose slide', '<p>Le nose slide est un des slides les plus faciles &agrave; faire en skateboard. Il consiste &agrave; glisser sur le nose de la planche sur un obstacle glissant. Particuli&egrave;rement stable, il ne n&eacute;cessite pas &eacute;norm&eacute;ment d&rsquo;&eacute;quilibre et peut m&ecirc;me se faire sans ollie. Bref, c&rsquo;est le slide id&eacute;al pour les d&eacute;butants.</p>\r\n<p>&nbsp;</p>\r\n<p>Il n&rsquo;y a pas vraiment de difficult&eacute; ou de dangerosit&eacute; particuli&egrave;re avec ce trick et en quelques sessions, la plupart des d&eacute;butants arriveront &agrave; faire leurs premiers nose slide.</p>\r\n<p>&nbsp;</p>\r\n<p>Apprendre le nose slide en skate</p>\r\n<p>Le nose slide (ou bs nose slide) est le (vrai) slide le plus simple dans la boite &agrave; tricks du skateur. Pour le faire, il vaut mieux ma&icirc;triser le ollie mais comme cette figure est permissive, m&ecirc;me des ollies approximatifs suffiront. Pour r&eacute;aliser un nose slide :</p>\r\n<p>&nbsp;</p>\r\n<p>Il faut arriver vers le trottoir ou le muret avec suffisamment de vitesse (car sans vitesse, pas de slide) ;</p>\r\n<p>Le skateur doit &ecirc;tre situ&eacute; &agrave; environ 1/2 ou 1 planche de l&rsquo;obstacle et arriver bien parall&egrave;le ;</p>\r\n<p>Placer ses pied comme pour un ollie et enclencher une rotation des &eacute;paules en direction de l&rsquo;obstacle ;</p>\r\n<p>Lancer un ollie avec une rotation d&rsquo;un quart de tour (un 90 degr&eacute;s) ;</p>\r\n<p>Si r&eacute;alis&eacute; correctement, le ollie colle au pied et tourne en m&ecirc;me temps que le skateur ;</p>\r\n<p>Le pied avant doit alors se d&eacute;placer pour se positionner sur le nose ;</p>\r\n<p>Le skateur doit alors viser et appuyer pour plaquer le nose sur le coin ;</p>\r\n<p>Une fois positionn&eacute;, le poids du skateur doit &ecirc;tre sur le nose afin de bien rester cal&eacute; sur l&rsquo;obstacle ;</p>\r\n<p>En fonction de la vitesse et de la facilit&eacute; de l&rsquo;obstacle &agrave; glisser, il faudra se pencher plus ou moins en avant ou en arri&egrave;re afin de faire glisser la planche ;</p>\r\n<p>La sortie se fait &laquo; comme on peut &raquo;, soit en avant soit en arri&egrave;re.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>Les trucs pour r&eacute;ussir le nose slide</p>\r\n<p>Ma&icirc;triser le ollie est un plus mais pas obligatoire. Sur un trottoir dont l&rsquo;angle est bien glissant, il est possible d&rsquo;approcher en ayant un angle avec la planche le pied sur le nose et de basculer son poids sur l&rsquo;avant. Au lieu de rouler, la force accumul&eacute;e va se transformer en glissade sur le nose. Sans ollie, l&rsquo;exercice n&rsquo;est pas si facile que &ccedil;a car il faut vraiment bien viser et aller vite. Ceux qui ma&icirc;trisent d&eacute;j&agrave; le ollie trouveront &ccedil;a plus dur que ceux qui ne savent pas encore faire de ollie.</p>\r\n<p>Le pied avant est tr&egrave;s important : il doit &ecirc;tre sur le nose au moment ou ce dernier touche l&rsquo;obstacle et c&rsquo;est la pointe de pied qui appuie (pas le talon qui peut toucher l&rsquo;obstacle et freiner).</p>\r\n<p>La position du corps est importante. Tout le poids doit &ecirc;tre sur le nose mais le corps doit &ecirc;tre l&eacute;g&egrave;rement en arri&egrave;re. Sinon, on risque de planter la planche et de se faire &eacute;jecter vers l&rsquo;avant.</p>\r\n<p>Une des difficult&eacute;s de cette figure est de bien caler son nose &agrave; 90 degr&eacute;s. Un peu plus ou un peu moins et &ccedil;a risque de coincer en frottant trop fort contre une roue. Id&eacute;alement, c&rsquo;est le bord du truck qui touche l&rsquo;obstacle et qui glisse &ndash; pas les roues.</p>\r\n<p>Si la planche est trop proche de l&rsquo;obstacle, le risque est d&rsquo;avoir les roues qui glissent par dessus l&rsquo;obstacle au lieu de se caler sur l&rsquo;angle. Et l&agrave;, zipette et chute assur&eacute;e.</p>\r\n<p>Exercices pour s&rsquo;entra&icirc;ner au nose slide</p>\r\n<p>Une difficult&eacute; &agrave; la fois. On peut d&eacute;j&agrave; essayer sans vitesse. Pour cela, face &agrave; un trottoir, rouler et venir caler le nose pour rester en &eacute;quilibre au-dessus.</p>\r\n<p>R&eacute;aliser le m&ecirc;me exercice mais en claquant un ollie.</p>\r\n<p>Une fois plac&eacute; en position de nose slide &agrave; l&rsquo;arr&ecirc;t, rester en &eacute;quilibre l&agrave;-haut. Appuyer plus ou moins sur le pied arri&egrave;re et basculer son poids entre les deux jambes pour faire pencher la planche et trouver le bon &eacute;quilibre.</p>\r\n<p>Toujours en position, apprendre &agrave; sortir &agrave; l&rsquo;arr&ecirc;t. Pour ce faire donner un coup d&rsquo;&eacute;paule dans un sens ou dans l&rsquo;autre (tout d&eacute;pend dans quel sens le skateur veut sortir : marche avant ou marche arri&egrave;re). La sortie en marche arri&egrave;re est plus naturelle car elle poursuit la rotation enclench&eacute;e pour se positionner en nose slide.</p>\r\n<p>Essayer un nose slide en se positionnant &laquo; &agrave; pied &raquo; sur un curb de skatepark. Pour que &ccedil;a marche, il faut choisir un module avec le curb en descente. Attention, &eacute;quilibre instable.</p>', 1, '2020-10-29 14:03:18', '2020-11-13 14:10:47', 0, 'nose-slide'),
(288, 325, 405, 'C koi un corkscrew?', '<p>bon, alors on va tacher de faire clair et concis...</p>\r\n<p>comment expliquer cela, euh..</p>\r\n<p>On va dire, tu consid&egrave;res un gars vu de face sur ses skis ok. Maintenant, consid&egrave;es qu\'au niveau des bijoux de famille du gars, tu as un axe de rotation qui lui rentre dans le c** et qui lui ressort pas les **** (oui je sais, c\'est un peu crade).</p>\r\n<p>*En position debout, on va dire que c\'est un angle de 0&deg;. Dans cette position, tu as toutes les rotations normales du type 360, 720, 900 ou fakie 360, fakkie 720, etc...</p>\r\n<p>*Ensuite, penche le skieur de 45&deg; d\'un c&ocirc;t&eacute; et en envoyant soit en avant soit en arri&egrave;re en gardant cet angle, on consid&egrave;re &ccedil;a comme une rotation d&icirc;tes corkscrew avec autant de tours que tu le souhaites (surtout que tu le peux...). La t&ecirc;te ne passe jamais vraiment en dessous du corps.</p>\r\n<p>*Apr&egrave;s, avec un angle de 90&deg;, le skieur est \"parall&egrave;le\" au sol, c\'est une rotation de type flatspin. Pareil pr le nombre de tours...</p>\r\n<p>*Avec une rotation de 135&deg; par rapport &agrave; notre axe, tu entres dans le domaine des rotations \"t&ecirc;te en bas\". Si tu envoie une rotation avec cet angle et en avant, tu vas balancer un misty. A la diff&eacute;rence, en arri&egrave;re, tu va balancer un rodeo. Apr&egrave;s, pour compter si c\'est rodeo720 ou misty1260, ce n\'est pas comme une rotation &agrave; plat o&ugrave; tu comptes le nombre r&eacute;el de tours. Par exemple, losrque tu rentres un 720 normal, tu fais 2 tours complets. Dans un misty 720, tu ne rentres en fait qu\'une rotation de 360&deg; mais il faut prendre en compte le fait que tu rentres aussi une \"rotation pseudo verticale\" qui est le frontflip (pseudo car tu ne rentres pas vraiment un front, mais plut&ocirc;t un esp&egrave;ce de saut p&eacute;rilleux assez bizzare, limite sur le c&ocirc;t&eacute;...). Moralit&eacute;, un rodeo720, c\'est un 360&deg;+un backflip d&eacute;cal&eacute; de c&ocirc;t&eacute;.</p>\r\n<p>regarde quelques photos tu comprendras mieux,</p>\r\n<p>pour le cork le skieur regarde par terre apr&egrave;s 180&deg; de rotation.</p>\r\n<p>Pour le rod&eacute;o, apr&egrave;s 180&deg; de rotation il regarde en l\'air, le dos face au sol.</p>\r\n<p>sur les photos on voit bien qu\'&agrave; l\'impulsion c\'est pas du tout pareil.</p>\r\n<p>enfin je crois que c\'est &ccedil;a, si je me trompe qu\'on me corrige !</p>', 1, '2020-10-29 15:17:21', '2020-11-13 13:34:51', 0, 'c-koi-un-corkscrew'),
(289, 325, 404, 'Intro au flip', '<p><em>On peut aussi l&rsquo;appeler rod&eacute;o back 3.6 si on le tourne un peu sur le c&ocirc;t&eacute;, mais c&rsquo;est le m&ecirc;me mouvement.</em></p>\r\n<p><strong>comment-faire-un-backflip-tutos-franky</strong></p>\r\n<p>1- Le mieux c&rsquo;est de s&rsquo;entrainer &agrave; le faire sur un trampoline car le mouvement est le m&ecirc;me.</p>\r\n<p>2- Choisissez un kicker de bord de piste, qui kicke un peu de pr&eacute;f&eacute;rence, pour vous aider &agrave; envoyer facilement</p>\r\n<p>3- Arrivez bien fl&eacute;chi en appui sur les 2 jambes et fixez le bout du kicker. L&rsquo;impulsion se fait &agrave; 2 pieds au bout du kicker et pas avant : si on envoie trop t&ocirc;t on risque de taper la t&ecirc;te dans le kicker ou de trop tourner, de faire un tour et demi et de tomber sur la t&ecirc;te. Deux situations &agrave; &eacute;viter...</p>\r\n<p>4- Donc impulsion &agrave; deux pieds, et on envoie la t&ecirc;te en arri&egrave;re pour chercher le mouvement. D&egrave;s que l&rsquo;on a d&eacute;coll&eacute; il faut remonter les genoux pour enrouler le mouvement. Les profs de gym ont tendance &agrave; dire que l&rsquo;on envoie le mouvement avec le bassin, ce qui n&rsquo;est pas faux mais c&rsquo;est surtout quand on a compris le mouvement et que l&rsquo;on est &agrave; l&rsquo;aise avec.</p>\r\n<p>5- Donc regrouper les jambes en les montant. A ce moment on peut aussi penser &agrave; grabber mais ce n&rsquo;est pas oblig&eacute; pour commencer... On continue d&rsquo;emmener la rotation avec la t&ecirc;te en arri&egrave;re.</p>\r\n<p>6- Tr&egrave;s vite on peut voir la r&eacute;ception et on va pouvoir g&eacute;rer la fin de al rotation soit en se tendant un peu pour la ralentir, soit en se regroupant encore davantage pour tourner plus vite.</p>\r\n<p>7- Replacez bien la board sous votre corps avant d&rsquo;atterrir, et amortir en pliant les jambes</p>\r\n<p><em>Amusez vous bien avec ce tricks, et attention : plus le kicker est gros plus il faut envoyer le mouvement doucement...</em></p>', 1, '2020-10-29 15:47:52', '2020-11-13 13:27:44', 0, 'intro-au-flip'),
(290, 325, 403, 'Backside 180', '<p style=\"text-align: left;\">Pour votre plus grand plaisir, on continue notre s&eacute;rie didactique et p&eacute;dagogique sur les bases du snowboard avec le 180 back. Franky Moissonnier d&eacute;cortique en vid&eacute;o ce qui est probablement l\'un des plus beaux tricks !&nbsp;</p>\r\n<p><em>Pour les n&eacute;ophytes, le backside 180 ou 180 back est un saut avec un demi tour qui s\'effectue c&ocirc;t&eacute; pointes de pieds en envoyant les &eacute;paules dos &agrave; la pente lors de la rotation, ce qui fait qu\'&agrave; l&rsquo;atterrissage on se retrouve en marche arri&egrave;re. Comme dans toute rotation l&rsquo;important est la synchronisation entre l&rsquo;impulsion et la rotation des &eacute;paules.</em></p>\r\n<p>Le Backside 180 peut s&rsquo;expliquer en plusieurs phases :</p>\r\n<ol>\r\n<li>&nbsp;La phase d&rsquo;approche consiste &agrave; avoir sa planche la plus &agrave; plat possible ou l&eacute;g&egrave;rement sur la carre frontside ; le regard est point&eacute; vers le spot (l&rsquo;endroit o&ugrave; on veut d&eacute;coller). Les jambes sont fl&eacute;chies, pr&ecirc;tes &agrave; donner une impulsion.<br /><br /></li>\r\n<li>L&rsquo;impulsion : on a le choix entre un ollie fa&ccedil;on skate (comme on peut le voir dans notre tuto sur le Ollie) et une impulsion franche &agrave; deux pieds. L&rsquo;impulsion &agrave; deux pieds conviendra mieux sur un kicker de park alors qu&rsquo;un ollie plus skate et un peu sur la carre est plus &eacute;vident en bord de piste. Donc on envoie une impulsion&nbsp; en enclenchant tr&egrave;s doucement les &eacute;paules de 30&deg;.</li>\r\n<li>Engager la rotation &agrave; l&rsquo;aveugle, de dos&hellip; pas de panique, l&rsquo;astuce est de regarder votre pied arri&egrave;re pour voir d&eacute;filer le sol en dessous et permettre au corps de faire un 180&deg; progressif. Attendez de voir la r&eacute;ception pour ajuster la board&nbsp; tout en gardant les &eacute;paules dans l&rsquo;axe de la planche ou l&eacute;g&egrave;rement en retard pour bien arr&ecirc;ter la rotation.<br /><br /></li>\r\n<li>En r&eacute;ception : bien amortir sur les jambes, continuer de regarder entre les pieds pour garder l&rsquo;&eacute;quilibre. Ce n&rsquo;est qu&rsquo;une fois que l\'on a bien amorti qu\'on pourra relever la t&ecirc;te et regarder ou l\'on va&hellip;</li>\r\n</ol>\r\n<p>Avant d&rsquo;essayer un 180 back, le mieux est d\'essayer de bien rider en switch pour que ce ne soit pas trop la panique &agrave; l&rsquo;atterrissage et de bien rep&eacute;rer le terrain et les autres rideurs pour ne pas provoquer de collisions.&nbsp;</p>\r\n<p><em>&Agrave; vous de jouer ! Comme d&rsquo;habitude, allez y progressivement, amusez vous&nbsp; et prenez beaucoup de plaisir pour faire des backside 180, qui est &agrave; notre avis un de plus beaux tricks du snowboard&hellip;</em></p>', 1, '2020-10-30 08:14:30', '2020-11-13 13:19:18', 0, 'backside-180'),
(291, 325, 402, 'Mute', '<p><span style=\"font-size: 14pt;\">Le mute consiste &agrave; saisir la <em>carre <strong>Frontside </strong></em>de la planche entre les deux pieds avec la main avant.</span></p>\r\n<p><span style=\"font-size: 14pt;\"><strong>Approche</strong></span></p>\r\n<p style=\"padding-left: 40px;\"><span style=\"font-size: 14pt;\">Commencez directement derri&egrave;re le kicker &agrave; un point qui vous permettra d\'atterrir en toute s&eacute;curit&eacute; sur le dessus de la table ou juste au-dessus de l\'articulation. Recr&eacute;ez une forme d\'entonnoir avec vos virages en vous concentrant sur la conduite droite au centre du kicker.</span></p>\r\n<p><span style=\"font-size: 14pt;\"><strong>D&eacute;collage</strong></span></p>\r\n<p style=\"padding-left: 40px;\"><span style=\"font-size: 14pt;\">Visez &agrave; &ecirc;tre une base plate lorsque vous remontez le kicker avec le haut du corps align&eacute; avec la planche. Vous avez la possibilit&eacute; de maintenir cette base plate ou de transf&eacute;rer l&eacute;g&egrave;rement la pression sur vos orteils lorsque vous lancez un pop ou un ollie. Vous pouvez monter le kicker l&eacute;g&egrave;rement plus bas que la normale pour r&eacute;duire la distance de d&eacute;placement de la pince.</span></p>\r\n<p><span style=\"font-size: 14pt;\"><strong>Tour</strong></span></p>\r\n<p style=\"padding-left: 40px;\"><span style=\"font-size: 14pt;\">La prise de sourdine peut initialement sembler maladroite, mais pers&eacute;v&egrave;re. Saisissez le bord des orteils entre les fixations avec votre main avant.</span></p>', 1, '2020-10-30 08:50:27', '2020-11-12 10:38:19', 0, 'mute'),
(292, 325, 401, 'Regular Vs Goofy', '<p style=\"text-align: center;\">Bonjour &agrave; tous, aujourd\'hui on va parler d\'un <strong>BA-SI-QUE!</strong><br /><br />Si vous comptez vous initier au snowboard cet hiver, pour bien r&eacute;ussir vos d&eacute;buts, la premi&egrave;re chose &agrave; savoir c\'est si vous mettrez le pied droit ou alors le pied gauche en avant sur la planche, et quel pied vous mettrez derri&egrave;re pour vous donner de l\'impulsion.</p>\r\n<p>Logiquement, vous avez deux pieds, donc deux options :</p>\r\n<p><strong>Regular </strong>: Avec le pied gauche devant</p>\r\n<p><strong>Goofy </strong>: Avec le pied droit devant</p>\r\n<p>&nbsp;</p>\r\n<p>Voici 4 astuces pour d&eacute;terminer si vous &ecirc;tes goofy ou regular :</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>Demandez &agrave; quelqu\'un de vous pousser</li>\r\n</ul>\r\n<p>Comment proc&eacute;der : Vous vous mettez de dos par rapport &agrave; votre pote, et vous lui demandez de vous pousser&hellip; Le pied que vous mettez instinctivement en premier est celui qu\'il faut mettre devant sur la planche.</p>\r\n<p>Notre conseil : Si vous &ecirc;tes pr&eacute;par&eacute;, c\'est bien, mais il faudrait que votre pote vous pousse &agrave; un moment o&ugrave; vous ne vous y attendez pas du tout afin de pas &ecirc;tre conditionn&eacute;s par ce que vous dit votre t&ecirc;te.</p>\r\n<p><em>Attention : Ne choisissez pas Floyd Mayweather ni votre pire ennemi pour vous pousser, ou vous ne risquez de d&eacute;couvrir si vous &ecirc;tes goofy ou regular qu\'apr&egrave;s avoir mang&eacute; le sol...</em></p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>Glissez comme des enfants</li>\r\n</ul>\r\n<p>Comment proc&eacute;der : Mettez des chaussettes, commencez &agrave; courir puis freinez juste devant la porte our le mur comme quand vous &eacute;tiez enfants (vous l\'&ecirc;tes peut-&ecirc;tre encore, d\'ailleurs). Le pied que vous mettez en avant pour vous arr&ecirc;ter est celui qu\'il faut mettre devant sur le snowboard.</p>\r\n<p>Notre conseil : Faites le dans un couloir assez long et freinez &agrave; temps...</p>\r\n<p><em>Attention : Si vous n\'avez pas de surface glissante chez vous ou que vos chaussettes sont trou&eacute;es, trouvez une autre m&eacute;thode, mais surtout achetez-vous des nouvelles chaussettes, &ccedil;a ne co&ucirc;te vraiment pas grand-chose !</em></p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>Les escaliers</li>\r\n</ul>\r\n<p>Comment proc&eacute;der : Positionnez-vous pieds joints devant un escalier. Montez-le ou descendez-le rapidement. Le pied que vous avez mis en premier d&eacute;termine si vous &ecirc;tes goofy ou regular.</p>\r\n<p><em>Notre conseil : Il faut le faire instinctivement sans r&eacute;fl&eacute;chir. Nous sommes bien entendu tous capables de monter les escaliers en mettant n\'importe quel pied en premier.</em></p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>Le surf ou le skateboard</li>\r\n</ul>\r\n<p>Comment proc&eacute;der : Si vous pratiquez un de ces sports, vous savez quel pied vous mettez en premier. C\'est le m&ecirc;me pour le snowboard.</p>\r\n<p><em>Notre conseil : Ne vous lancez pas uniquement parce que vous faites d&eacute;j&agrave; du surf ou du skate. La neige peut &ecirc;tre parfois tra&icirc;tresse si vous faites une mauvaise chute.</em></p>\r\n<p>&nbsp;</p>\r\n<p style=\"text-align: center;\"><em><strong>Derni&egrave;re chose, &ecirc;tre goofy ou regular n\'a aucune incidence sur le niveau ou les performances. La preuve, Gigi R&uuml;f, que vous pouvez voir &agrave; l\'&oelig;uvre en train de passer un saut monstrueux, est regular.</strong></em></p>', 1, '2020-11-05 15:21:15', '2020-11-12 13:23:35', 0, 'regular-vs-goofy');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_registered` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `asked_reset_password` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=327 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`, `email`, `picture_path`, `token`, `is_registered`, `created_at`, `updated_at`, `is_deleted`, `asked_reset_password`) VALUES
(325, 'Benjamin', '[]', '$argon2i$v=19$m=65536,t=4,p=1$V1hlTVFiY21TbXFEVk1sRg$6OE0gEGBjBDDYzDEotH0fY+YkUOZ/QRF+R6rsN9NhHA', 'benjaminhaise@gmail.com', 'EdhYBP7UYAATjhx-5fae9d41d607c.jpeg', '6a20b3f8e1c0579fa6b49763e2a3ebcb35fe808cf6581da243131e0181aaeb7f7d84628a345fe4d19afdccf6e969d6349c2cfb52014ed684bcac21b3', 1, '2020-09-17 10:14:52', '2020-11-13 14:50:41', 0, 0),
(326, 'Demo', '[]', '$argon2i$v=19$m=65536,t=4,p=1$WkxDeUMySldNQ1d5ejI4Zg$/bDDpb/F6r3uMKUZWyFSIo8SratcVcKkkYbG5w46jF0', 'demo@snowtricks.org', NULL, 'dd600b18eb6665b05fbf087aea084ee008e70fd89d2524be9cbc477674d77db564be6a625889584055de2db5ec9d93f5d50c2b1854c97d561acfc944', 1, '2020-11-13 15:02:48', '2020-11-13 15:07:18', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trick_id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7CC7DA2CB281BE2E` (`trick_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `video`
--

INSERT INTO `video` (`id`, `trick_id`, `url`, `created_at`, `updated_at`, `is_deleted`) VALUES
(2, 291, 'Opg5g4zsiGY', '2020-10-30 08:54:14', '2020-11-12 09:04:34', 0),
(3, 291, 'k6aOWf0LDcQ', '2020-10-30 08:54:28', '2020-10-30 08:54:28', 0),
(4, 291, 'aVLP9hy0Dd4', '2020-10-30 08:54:41', '2020-11-12 09:03:32', 0),
(5, 285, 'AzJPhQdTRQQ', '2020-11-12 08:52:46', '2020-11-12 08:52:46', 0),
(6, 292, 'UzVBSo9Xx6k', '2020-11-12 13:27:02', '2020-11-12 13:27:02', 0),
(7, 292, 'FyR43LSV0y4', '2020-11-12 13:27:16', '2020-11-12 13:27:16', 0),
(8, 290, 'Sj7CJH9YvAo', '2020-11-13 13:05:42', '2020-11-13 13:05:42', 0),
(9, 290, 'NQ1MERtpFLQ', '2020-11-13 13:05:55', '2020-11-13 13:05:55', 0),
(10, 289, 'QF2rtZBsjIo', '2020-11-13 13:22:35', '2020-11-13 13:22:35', 0),
(11, 289, 'RvO2Dqnj7B4', '2020-11-13 13:22:44', '2020-11-13 13:22:44', 0),
(12, 288, 'FMHiSF0rHF8', '2020-11-13 13:31:15', '2020-11-13 13:31:15', 0),
(13, 287, '9HCDI7eSwcg', '2020-11-13 14:11:48', '2020-11-13 14:11:48', 0),
(14, 286, '0HgXRHwblZU', '2020-11-13 14:14:13', '2020-11-13 14:14:13', 0),
(15, 286, '8ITyXgXeQXc', '2020-11-13 14:14:25', '2020-11-13 14:14:25', 0),
(16, 285, 'jH76540wSqU', '2020-11-13 14:16:48', '2020-11-13 14:16:48', 0),
(17, 285, 'CzDjM7h_Fwo', '2020-11-13 14:17:00', '2020-11-13 14:17:00', 0),
(18, 285, 'I7N45iRPrhw', '2020-11-13 14:17:11', '2020-11-13 14:17:11', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_9474526CB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`);

--
-- Contraintes pour la table `picture`
--
ALTER TABLE `picture`
  ADD CONSTRAINT `FK_16DB4F89B281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`);

--
-- Contraintes pour la table `trick`
--
ALTER TABLE `trick`
  ADD CONSTRAINT `FK_D8F0A91EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_D8F0A91EBAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`);

--
-- Contraintes pour la table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `FK_7CC7DA2CB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
