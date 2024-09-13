-- phpMyAdmin SQL Dump
-- version 5.2.1deb1ubuntu0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 13 sep. 2024 à 06:32
-- Version du serveur : 8.0.35-0ubuntu0.23.04.1
-- Version de PHP : 8.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `kata2`
--

-- --------------------------------------------------------

--
-- Structure de la table `accountRequests`
--

CREATE TABLE `accountRequests` (
  `id` bigint UNSIGNED NOT NULL,
  `firstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `genre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `martialArtType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `licenseId` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clubName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clubAddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clubEmail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ClubWebsiteUrl` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clubLogoPath` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clubDescription` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ClubIfuNumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `club_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `accountRequests`
--

INSERT INTO `accountRequests` (`id`, `firstName`, `lastName`, `email`, `role`, `phone`, `genre`, `martialArtType`, `licenseId`, `grade`, `clubName`, `clubAddress`, `clubEmail`, `status`, `comment`, `ClubWebsiteUrl`, `clubLogoPath`, `clubDescription`, `ClubIfuNumber`, `club_id`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 'Louqmane', 'INOUSSA', 'inoussalouqmane@gmail.com', 'Sensei', '+229 40804040', 'Homme', '2', 'LIC040', '2', 'Master Rachelle', 'North Side', 'rachelle@gmail.com', 'Approuvé', NULL, NULL, NULL, NULL, NULL, NULL, 3, '2024-09-06 22:15:59', '2024-09-06 22:16:18'),
(4, 'Rachelle', 'Migan', 'rachelle@gmail.com', 'Sensei', '+229 40804040', 'Homme', '2', 'LIC040', '2', 'Master Migan Club', 'North Side', 'rachelle@gmail.com', 'Approuvé', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-06 22:17:58', '2024-09-06 22:18:11'),
(5, 'Rachelle', 'Marbella', 'rachellemigan@gmail.com', 'Sensei', '+229 40804040', 'Homme', '2', 'LIC040', '2', 'Master Migan Club', 'North Side', 'rachellemigan@gmail.com', 'Approuvé', NULL, NULL, NULL, NULL, NULL, NULL, 5, '2024-09-06 22:20:23', '2024-09-06 22:20:31'),
(11, 'Freddy', 'GOUGOU', 'goufreddy@gmail.com', 'Sensei', '+229 40804040', 'Femme', '2', 'LIC040', '2', 'Master Migan Club', 'North Side', 'goufreddygan@gmail.com', 'Approuvé', NULL, NULL, NULL, NULL, NULL, NULL, 10, '2024-09-12 00:20:59', '2024-09-12 00:55:31'),
(13, 'abdou', 'rayana', 'abdouraya@gmail.com', 'Sensei', NULL, 'Femme', '1', 'jbks', '1', 'Piment Rouge', 'Agla', NULL, 'Pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-12 00:47:56', '2024-09-12 00:47:56'),
(14, 'Yasmine', 'INOUSSA', 'inoussayasmine@gmail.com', 'Sensei', NULL, 'Femme', '1', 'D', '1', 'Grifondor', 'Terroir', NULL, 'Pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-12 00:50:49', '2024-09-12 00:50:49');

-- --------------------------------------------------------

--
-- Structure de la table `clubs`
--

CREATE TABLE `clubs` (
  `id` bigint UNSIGNED NOT NULL,
  `RegisteredBy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `martialArtType` bigint UNSIGNED NOT NULL,
  `ifuNumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `websiteUrl` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `logoPath` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `clubs`
--

INSERT INTO `clubs` (`id`, `RegisteredBy`, `name`, `martialArtType`, `ifuNumber`, `address`, `email`, `websiteUrl`, `description`, `logoPath`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Dragon Rouge', 1, 'ADDYVAMP', 'Cotonou', 'rouge@gmail.com', NULL, NULL, NULL, '2024-09-06 22:12:38', '2024-09-06 22:12:38'),
(2, '3', 'Master Rachelle', 2, NULL, 'North Side', 'rachelle@gmail.com', NULL, NULL, NULL, '2024-09-06 22:16:18', '2024-09-06 22:16:18'),
(4, NULL, 'Rachelle Migan Club', 1, NULL, 'Calavi', 'migan@@gmail.com', NULL, NULL, NULL, '2024-09-06 22:19:42', '2024-09-06 22:19:42'),
(5, '5', 'Master Migan Club', 2, NULL, 'North Side', 'rachellemigan@gmail.com', NULL, NULL, NULL, '2024-09-06 22:20:31', '2024-09-06 22:20:31'),
(6, '10', 'Master Migan Club', 2, NULL, 'North Side', 'goufreddygan@gmail.com', NULL, NULL, NULL, '2024-09-12 00:55:31', '2024-09-12 00:55:31');

-- --------------------------------------------------------

--
-- Structure de la table `club_user`
--

CREATE TABLE `club_user` (
  `club_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `club_user`
--

INSERT INTO `club_user` (`club_id`, `user_id`) VALUES
(1, 2),
(2, 3),
(2, 7),
(2, 8),
(2, 9),
(5, 5),
(6, 10);

-- --------------------------------------------------------

--
-- Structure de la table `disciplines`
--

CREATE TABLE `disciplines` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Actif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `disciplines`
--

INSERT INTO `disciplines` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Kung-fu', 'Actif', '2024-09-06 22:10:18', '2024-09-06 22:10:18'),
(2, 'Taekwondo', 'Actif', '2024-09-06 22:10:24', '2024-09-06 22:10:24'),
(3, 'Karaté', 'Actif', '2024-09-06 22:10:32', '2024-09-06 22:10:32'),
(4, 'Wushu', 'Actif', '2024-09-06 22:10:37', '2024-09-06 22:10:37');

-- --------------------------------------------------------

--
-- Structure de la table `dojos`
--

CREATE TABLE `dojos` (
  `id` bigint UNSIGNED NOT NULL,
  `club_id` bigint UNSIGNED NOT NULL,
  `martialArtType` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id` bigint UNSIGNED NOT NULL,
  `uiid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `cost` int NOT NULL DEFAULT '0',
  `startDate` timestamp NOT NULL,
  `endDate` timestamp NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `uiid`, `title`, `description`, `cost`, `startDate`, `endDate`, `address`, `type`, `user_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Examen', NULL, 0, '2004-07-21 14:00:00', '2004-07-21 14:00:00', 'Zogbadjè', NULL, NULL, '2024-09-08 07:52:45', '2024-09-08 07:52:45'),
(2, NULL, 'Examen', NULL, 0, '2025-08-25 14:00:00', '2025-08-25 14:00:00', 'kfls', NULL, NULL, '2024-09-08 08:39:24', '2024-09-08 08:39:24'),
(3, NULL, 'Examen', NULL, 0, '2024-09-09 09:30:00', '2024-09-09 09:30:00', 'sf', NULL, NULL, '2024-09-08 10:09:32', '2024-09-08 10:09:32'),
(5, NULL, 'Examen', NULL, 0, '2024-09-10 14:03:00', '2024-09-10 14:03:00', 'Kaanari', NULL, NULL, '2024-09-08 10:42:26', '2024-09-08 10:42:26');

-- --------------------------------------------------------

--
-- Structure de la table `examResults`
--

CREATE TABLE `examResults` (
  `exam_id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `grade_id` bigint UNSIGNED NOT NULL,
  `noteKata` double(8,2) NOT NULL DEFAULT '0.00',
  `noteKihon` double(8,2) NOT NULL DEFAULT '0.00',
  `noteKumite` double(8,2) NOT NULL DEFAULT '0.00',
  `deliberation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `examResults`
--

INSERT INTO `examResults` (`exam_id`, `student_id`, `grade_id`, `noteKata`, `noteKihon`, `noteKumite`, `deliberation`) VALUES
(1, 7, 1, 0.00, 0.00, 0.00, 'failure'),
(1, 8, 1, 0.00, 0.00, 0.00, 'failure'),
(2, 8, 2, 50.00, 20.00, 20.00, 'success'),
(2, 9, 1, 0.00, 0.00, 0.00, 'failure'),
(3, 7, 3, 15.00, 15.00, 15.00, 'success'),
(3, 9, 3, 0.00, 0.00, 0.00, 'failure'),
(5, 7, 4, 0.00, 0.00, 0.00, 'failure'),
(5, 9, 4, 0.00, 0.00, 0.00, 'failure');

-- --------------------------------------------------------

--
-- Structure de la table `exams`
--

CREATE TABLE `exams` (
  `event_id` bigint UNSIGNED NOT NULL,
  `examStatus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `exams`
--

INSERT INTO `exams` (`event_id`, `examStatus`, `created_at`, `updated_at`) VALUES
(1, 'Archivé', '2024-09-08 07:52:45', '2024-09-08 07:53:53'),
(2, 'Archivé', '2024-09-08 08:39:24', '2024-09-08 10:08:36'),
(3, 'Terminé', '2024-09-08 10:09:32', '2024-09-08 10:09:55'),
(5, 'A venir', '2024-09-08 10:42:26', '2024-09-08 10:42:26');

-- --------------------------------------------------------

--
-- Structure de la table `exam_grade`
--

CREATE TABLE `exam_grade` (
  `exam_id` bigint UNSIGNED NOT NULL,
  `grade_id` bigint UNSIGNED NOT NULL,
  `cost` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `exam_grade`
--

INSERT INTO `exam_grade` (`exam_id`, `grade_id`, `cost`, `created_at`, `updated_at`) VALUES
(1, 1, 5000.00, NULL, NULL),
(2, 1, 4500.00, NULL, NULL),
(2, 2, 1800.00, NULL, NULL),
(3, 3, 4560.00, NULL, NULL),
(5, 4, 12300.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, '706ae7d1-b0dd-4461-935e-cbe44d3cb6b2', 'database', 'default', '{\"uuid\":\"706ae7d1-b0dd-4461-935e-cbe44d3cb6b2\",\"displayName\":\"App\\\\Mail\\\\AccountConfirmationSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:32:\\\"App\\\\Mail\\\\AccountConfirmationSent\\\":5:{s:8:\\\"username\\\";s:13:\\\"Shelby  Space\\\";s:8:\\\"usermail\\\";s:21:\\\"shelbyspace@gmail.com\\\";s:8:\\\"password\\\";s:8:\\\"c&5d6Q]7\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"shelbyspace@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 'Illuminate\\Queue\\TimeoutExceededException: App\\Mail\\AccountConfirmationSent has timed out. in /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/TimeoutExceededException.php:15\nStack trace:\n#0 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(796): Illuminate\\Queue\\TimeoutExceededException::forJob()\n#1 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(217): Illuminate\\Queue\\Worker->timeoutExceededException()\n#2 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/mailer/Transport/Smtp/Stream/AbstractStream.php(81): Illuminate\\Queue\\Worker->Illuminate\\Queue\\{closure}()\n#3 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(346): Symfony\\Component\\Mailer\\Transport\\Smtp\\Stream\\AbstractStream->readLine()\n#4 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(196): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->getFullResponse()\n#5 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(118): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand()\n#6 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(316): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#7 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(205): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->ping()\n#8 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#9 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(137): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#10 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(573): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#11 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(335): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#12 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(205): Illuminate\\Mail\\Mailer->send()\n#13 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#14 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(198): Illuminate\\Mail\\Mailable->withLocale()\n#15 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Mail/SendQueuedMailable.php(83): Illuminate\\Mail\\Mailable->send()\n#16 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle()\n#17 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#18 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#19 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#20 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/Container.php(662): Illuminate\\Container\\BoundMethod::call()\n#21 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#22 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#23 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#24 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#25 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#26 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#27 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#28 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then()\n#29 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#30 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#31 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(439): Illuminate\\Queue\\Jobs\\Job->fire()\n#32 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(389): Illuminate\\Queue\\Worker->process()\n#33 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(176): Illuminate\\Queue\\Worker->runJob()\n#34 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(137): Illuminate\\Queue\\Worker->daemon()\n#35 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(120): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#36 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#37 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#38 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#39 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#40 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/Container.php(662): Illuminate\\Container\\BoundMethod::call()\n#41 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Console/Command.php(211): Illuminate\\Container\\Container->call()\n#42 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/console/Command/Command.php(326): Illuminate\\Console\\Command->execute()\n#43 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Console/Command.php(180): Symfony\\Component\\Console\\Command\\Command->run()\n#44 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/console/Application.php(1096): Illuminate\\Console\\Command->run()\n#45 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/console/Application.php(324): Symfony\\Component\\Console\\Application->doRunCommand()\n#46 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/console/Application.php(175): Symfony\\Component\\Console\\Application->doRun()\n#47 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(201): Symfony\\Component\\Console\\Application->run()\n#48 /home/louqmane/Bureau/kataSaveBackend/artisan(35): Illuminate\\Foundation\\Console\\Kernel->handle()\n#49 {main}', '2024-09-06 22:59:08'),
(2, '4037ec43-fa7b-4cb8-96de-6fd297ea73da', 'database', 'default', '{\"uuid\":\"4037ec43-fa7b-4cb8-96de-6fd297ea73da\",\"displayName\":\"App\\\\Mail\\\\AccountRequestSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:27:\\\"App\\\\Mail\\\\AccountRequestSent\\\":4:{s:18:\\\"\\u0000*\\u0000receiverAddress\\\";s:19:\\\"goufreddy@gmail.com\\\";s:11:\\\"\\u0000*\\u0000Username\\\";s:6:\\\"Freddy\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:19:\\\"goufreddy@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 'Illuminate\\Queue\\TimeoutExceededException: App\\Mail\\AccountRequestSent has timed out. in /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/TimeoutExceededException.php:15\nStack trace:\n#0 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(796): Illuminate\\Queue\\TimeoutExceededException::forJob()\n#1 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(217): Illuminate\\Queue\\Worker->timeoutExceededException()\n#2 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/mailer/Transport/Smtp/Stream/AbstractStream.php(81): Illuminate\\Queue\\Worker->Illuminate\\Queue\\{closure}()\n#3 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(346): Symfony\\Component\\Mailer\\Transport\\Smtp\\Stream\\AbstractStream->readLine()\n#4 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(196): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->getFullResponse()\n#5 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(118): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand()\n#6 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(316): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#7 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(205): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->ping()\n#8 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#9 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(137): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#10 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(573): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#11 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(335): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#12 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(205): Illuminate\\Mail\\Mailer->send()\n#13 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#14 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(198): Illuminate\\Mail\\Mailable->withLocale()\n#15 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Mail/SendQueuedMailable.php(83): Illuminate\\Mail\\Mailable->send()\n#16 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle()\n#17 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#18 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#19 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#20 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/Container.php(662): Illuminate\\Container\\BoundMethod::call()\n#21 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#22 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#23 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#24 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#25 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#26 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#27 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#28 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then()\n#29 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#30 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#31 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(439): Illuminate\\Queue\\Jobs\\Job->fire()\n#32 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(389): Illuminate\\Queue\\Worker->process()\n#33 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(176): Illuminate\\Queue\\Worker->runJob()\n#34 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(137): Illuminate\\Queue\\Worker->daemon()\n#35 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(120): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#36 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#37 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#38 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#39 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#40 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/Container.php(662): Illuminate\\Container\\BoundMethod::call()\n#41 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Console/Command.php(211): Illuminate\\Container\\Container->call()\n#42 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/console/Command/Command.php(326): Illuminate\\Console\\Command->execute()\n#43 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Console/Command.php(180): Symfony\\Component\\Console\\Command\\Command->run()\n#44 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/console/Application.php(1096): Illuminate\\Console\\Command->run()\n#45 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/console/Application.php(324): Symfony\\Component\\Console\\Application->doRunCommand()\n#46 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/console/Application.php(175): Symfony\\Component\\Console\\Application->doRun()\n#47 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(201): Symfony\\Component\\Console\\Application->run()\n#48 /home/louqmane/Bureau/kataSaveBackend/artisan(35): Illuminate\\Foundation\\Console\\Kernel->handle()\n#49 {main}', '2024-09-12 00:19:21'),
(3, '180acc92-9330-4664-baff-31af514fc89c', 'database', 'default', '{\"uuid\":\"180acc92-9330-4664-baff-31af514fc89c\",\"displayName\":\"App\\\\Listeners\\\\SendWaitingForConfirmationEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":20:{s:5:\\\"class\\\";s:45:\\\"App\\\\Listeners\\\\SendWaitingForConfirmationEmail\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:27:\\\"App\\\\Events\\\\AccountRequested\\\":1:{s:14:\\\"accountRequest\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:25:\\\"App\\\\Models\\\\AccountRequest\\\";s:2:\\\"id\\\";i:9;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"failOnTimeout\\\";b:0;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Illuminate\\Database\\Eloquent\\ModelNotFoundException: No query results for model [App\\Models\\AccountRequest]. in /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Builder.php:621\nStack trace:\n#0 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/SerializesAndRestoresModelIdentifiers.php(109): Illuminate\\Database\\Eloquent\\Builder->firstOrFail()\n#1 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/SerializesAndRestoresModelIdentifiers.php(62): App\\Events\\AccountRequested->restoreModel()\n#2 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/SerializesModels.php(93): App\\Events\\AccountRequested->getRestoredPropertyValue()\n#3 [internal function]: App\\Events\\AccountRequested->__unserialize()\n#4 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(97): unserialize()\n#5 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(60): Illuminate\\Queue\\CallQueuedHandler->getCommand()\n#6 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#7 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(439): Illuminate\\Queue\\Jobs\\Job->fire()\n#8 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(389): Illuminate\\Queue\\Worker->process()\n#9 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(176): Illuminate\\Queue\\Worker->runJob()\n#10 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(137): Illuminate\\Queue\\Worker->daemon()\n#11 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(120): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#12 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#13 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#14 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#15 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#16 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/Container.php(662): Illuminate\\Container\\BoundMethod::call()\n#17 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Console/Command.php(211): Illuminate\\Container\\Container->call()\n#18 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/console/Command/Command.php(326): Illuminate\\Console\\Command->execute()\n#19 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Console/Command.php(180): Symfony\\Component\\Console\\Command\\Command->run()\n#20 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/console/Application.php(1096): Illuminate\\Console\\Command->run()\n#21 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/console/Application.php(324): Symfony\\Component\\Console\\Application->doRunCommand()\n#22 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/console/Application.php(175): Symfony\\Component\\Console\\Application->doRun()\n#23 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(201): Symfony\\Component\\Console\\Application->run()\n#24 /home/louqmane/Bureau/kataSaveBackend/artisan(35): Illuminate\\Foundation\\Console\\Kernel->handle()\n#25 {main}', '2024-09-12 00:32:39'),
(4, '3b2cebd2-24f2-4e36-97df-eac2f29630e8', 'database', 'default', '{\"uuid\":\"3b2cebd2-24f2-4e36-97df-eac2f29630e8\",\"displayName\":\"App\\\\Listeners\\\\SendWaitingForConfirmationEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":20:{s:5:\\\"class\\\";s:45:\\\"App\\\\Listeners\\\\SendWaitingForConfirmationEmail\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:27:\\\"App\\\\Events\\\\AccountRequested\\\":1:{s:14:\\\"accountRequest\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:25:\\\"App\\\\Models\\\\AccountRequest\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"failOnTimeout\\\";b:0;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Illuminate\\Database\\Eloquent\\ModelNotFoundException: No query results for model [App\\Models\\AccountRequest]. in /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Builder.php:621\nStack trace:\n#0 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/SerializesAndRestoresModelIdentifiers.php(109): Illuminate\\Database\\Eloquent\\Builder->firstOrFail()\n#1 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/SerializesAndRestoresModelIdentifiers.php(62): App\\Events\\AccountRequested->restoreModel()\n#2 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/SerializesModels.php(93): App\\Events\\AccountRequested->getRestoredPropertyValue()\n#3 [internal function]: App\\Events\\AccountRequested->__unserialize()\n#4 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(97): unserialize()\n#5 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(60): Illuminate\\Queue\\CallQueuedHandler->getCommand()\n#6 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#7 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(439): Illuminate\\Queue\\Jobs\\Job->fire()\n#8 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(389): Illuminate\\Queue\\Worker->process()\n#9 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(176): Illuminate\\Queue\\Worker->runJob()\n#10 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(137): Illuminate\\Queue\\Worker->daemon()\n#11 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(120): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#12 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#13 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#14 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#15 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#16 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/Container.php(662): Illuminate\\Container\\BoundMethod::call()\n#17 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Console/Command.php(211): Illuminate\\Container\\Container->call()\n#18 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/console/Command/Command.php(326): Illuminate\\Console\\Command->execute()\n#19 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Console/Command.php(180): Symfony\\Component\\Console\\Command\\Command->run()\n#20 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/console/Application.php(1096): Illuminate\\Console\\Command->run()\n#21 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/console/Application.php(324): Symfony\\Component\\Console\\Application->doRunCommand()\n#22 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/console/Application.php(175): Symfony\\Component\\Console\\Application->doRun()\n#23 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(201): Symfony\\Component\\Console\\Application->run()\n#24 /home/louqmane/Bureau/kataSaveBackend/artisan(35): Illuminate\\Foundation\\Console\\Kernel->handle()\n#25 {main}', '2024-09-12 00:32:39'),
(5, 'e7673ca8-ea23-4971-98d5-9dd5bf65e615', 'database', 'default', '{\"uuid\":\"e7673ca8-ea23-4971-98d5-9dd5bf65e615\",\"displayName\":\"App\\\\Mail\\\\AccountRequestSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:27:\\\"App\\\\Mail\\\\AccountRequestSent\\\":4:{s:18:\\\"\\u0000*\\u0000receiverAddress\\\";s:19:\\\"abdouraya@gmail.com\\\";s:11:\\\"\\u0000*\\u0000Username\\\";s:5:\\\"abdou\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:19:\\\"abdouraya@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 'Illuminate\\Queue\\TimeoutExceededException: App\\Mail\\AccountRequestSent has timed out. in /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/TimeoutExceededException.php:15\nStack trace:\n#0 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(796): Illuminate\\Queue\\TimeoutExceededException::forJob()\n#1 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(217): Illuminate\\Queue\\Worker->timeoutExceededException()\n#2 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/mailer/Transport/Smtp/Stream/AbstractStream.php(81): Illuminate\\Queue\\Worker->Illuminate\\Queue\\{closure}()\n#3 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(346): Symfony\\Component\\Mailer\\Transport\\Smtp\\Stream\\AbstractStream->readLine()\n#4 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(196): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->getFullResponse()\n#5 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/mailer/Transport/Smtp/EsmtpTransport.php(118): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand()\n#6 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(316): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand()\n#7 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(205): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->ping()\n#8 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/mailer/Transport/AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend()\n#9 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(137): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send()\n#10 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(573): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send()\n#11 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(335): Illuminate\\Mail\\Mailer->sendSymfonyMessage()\n#12 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(205): Illuminate\\Mail\\Mailer->send()\n#13 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#14 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(198): Illuminate\\Mail\\Mailable->withLocale()\n#15 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Mail/SendQueuedMailable.php(83): Illuminate\\Mail\\Mailable->send()\n#16 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle()\n#17 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#18 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#19 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#20 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/Container.php(662): Illuminate\\Container\\BoundMethod::call()\n#21 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#22 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#23 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#24 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#25 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#26 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(144): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#27 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#28 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then()\n#29 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#30 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#31 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(439): Illuminate\\Queue\\Jobs\\Job->fire()\n#32 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(389): Illuminate\\Queue\\Worker->process()\n#33 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(176): Illuminate\\Queue\\Worker->runJob()\n#34 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(137): Illuminate\\Queue\\Worker->daemon()\n#35 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(120): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#36 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#37 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#38 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#39 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#40 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Container/Container.php(662): Illuminate\\Container\\BoundMethod::call()\n#41 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Console/Command.php(211): Illuminate\\Container\\Container->call()\n#42 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/console/Command/Command.php(326): Illuminate\\Console\\Command->execute()\n#43 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Console/Command.php(180): Symfony\\Component\\Console\\Command\\Command->run()\n#44 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/console/Application.php(1096): Illuminate\\Console\\Command->run()\n#45 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/console/Application.php(324): Symfony\\Component\\Console\\Application->doRunCommand()\n#46 /home/louqmane/Bureau/kataSaveBackend/vendor/symfony/console/Application.php(175): Symfony\\Component\\Console\\Application->doRun()\n#47 /home/louqmane/Bureau/kataSaveBackend/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(201): Symfony\\Component\\Console\\Application->run()\n#48 /home/louqmane/Bureau/kataSaveBackend/artisan(35): Illuminate\\Foundation\\Console\\Kernel->handle()\n#49 {main}', '2024-09-12 00:49:02');

-- --------------------------------------------------------

--
-- Structure de la table `fees`
--

CREATE TABLE `fees` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` double(8,2) NOT NULL DEFAULT '0.00',
  `frequency` int NOT NULL DEFAULT '0',
  `club_id` bigint UNSIGNED NOT NULL,
  `last_charged_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fees`
--

INSERT INTO `fees` (`id`, `name`, `cost`, `frequency`, `club_id`, `last_charged_at`, `created_at`, `updated_at`) VALUES
(1, 'Mensualité', 4500.00, 0, 2, '2024-09-07 13:53:01', '2024-09-06 23:08:15', '2024-09-07 13:53:01'),
(2, 'Examens', 0.00, 0, 2, '2024-09-08 10:23:24', '2024-09-08 10:23:24', '2024-09-08 10:23:24');

-- --------------------------------------------------------

--
-- Structure de la table `grades`
--

CREATE TABLE `grades` (
  `id` bigint UNSIGNED NOT NULL,
  `beltName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `beltColor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numberOfRedBar` int DEFAULT '0',
  `numberOfWhiteBar` int DEFAULT '0',
  `numberOfYellowBar` int DEFAULT '0',
  `beltPicturePath` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `grades`
--

INSERT INTO `grades` (`id`, `beltName`, `beltColor`, `numberOfRedBar`, `numberOfWhiteBar`, `numberOfYellowBar`, `beltPicturePath`, `created_at`, `updated_at`) VALUES
(1, 'Noir', '#000000', NULL, NULL, NULL, NULL, '2024-09-06 22:21:52', '2024-09-06 22:21:52'),
(2, 'rouge', '#fa0000', NULL, NULL, NULL, NULL, '2024-09-06 22:21:58', '2024-09-06 22:21:58'),
(3, 'Vert', '#00ff91', NULL, NULL, NULL, NULL, '2024-09-06 22:22:08', '2024-09-06 22:22:08'),
(4, 'Marron', '#7f6c6c', NULL, NULL, NULL, NULL, '2024-09-06 22:22:19', '2024-09-06 22:22:19');

-- --------------------------------------------------------

--
-- Structure de la table `grade_resource`
--

CREATE TABLE `grade_resource` (
  `grade_id` bigint UNSIGNED NOT NULL,
  `resource_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `grade_user`
--

CREATE TABLE `grade_user` (
  `grade_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `grade_user`
--

INSERT INTO `grade_user` (`grade_id`, `user_id`) VALUES
(1, 8),
(1, 9),
(3, 7);

-- --------------------------------------------------------

--
-- Structure de la table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint UNSIGNED NOT NULL,
  `amount` int NOT NULL,
  `transaction_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `juryMembers`
--

CREATE TABLE `juryMembers` (
  `exam_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(130, '2014_10_12_000000_create_users_table', 1),
(131, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(132, '2019_08_19_000000_create_failed_jobs_table', 1),
(133, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(134, '2024_06_05_155035_create_clubs_table', 1),
(135, '2024_06_05_213857_create_club_user_pivot_table', 1),
(136, '2024_06_05_214321_create_dojos_table', 1),
(137, '2024_06_05_215734_create_grades_table', 1),
(138, '2024_06_05_220133_create_grade_user_pivot_table', 1),
(139, '2024_06_05_223705_create_events_table', 1),
(140, '2024_06_05_231206_create_exams_table', 1),
(141, '2024_06_06_090233_create_examResults_table', 1),
(142, '2024_06_07_093051_create_juryMembers_table', 1),
(143, '2024_06_07_094425_create_resources_table', 2),
(144, '2024_06_07_095157_create_resource_user_pivot_table', 2),
(145, '2024_06_07_100456_create_transfers_table', 2),
(146, '2024_06_07_101123_create_parentTutors_table', 2),
(147, '2024_06_07_102039_create_accountRequests_table', 2),
(148, '2024_07_26_091048_create_disciplines_table', 2),
(149, '2024_08_26_113909_exam_grade', 2),
(150, '2024_08_31_025540_grade_resource', 2),
(151, '2024_09_05_205142_create_fees_table', 2),
(153, '2024_09_06_210401_create_jobs_table', 2),
(154, '2024_06_07_094147_create_invoices_table', 3),
(157, '2024_09_06_112536_create_payments', 5),
(159, '2024_09_07_092716_create_transactions_table', 6);

-- --------------------------------------------------------

--
-- Structure de la table `parentTutors`
--

CREATE TABLE `parentTutors` (
  `Student_id` bigint UNSIGNED NOT NULL,
  `Parent_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `fee_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `payments`
--

INSERT INTO `payments` (`id`, `fee_id`, `created_at`, `updated_at`) VALUES
(7, 1, '2024-09-07 13:46:00', '2024-09-07 13:46:00'),
(8, 1, '2024-09-07 13:47:01', '2024-09-07 13:47:01'),
(9, 1, '2024-09-07 13:49:01', '2024-09-07 13:49:01'),
(10, 1, '2024-09-07 13:51:01', '2024-09-07 13:51:01'),
(11, 1, '2024-09-07 13:53:01', '2024-09-07 13:53:01'),
(13, 2, '2024-09-08 10:42:26', '2024-09-08 10:42:26');

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 3, 'my-app-token', '18720482760e16fa59c39236710826d329eb878cdb4644b50476acd4c18f3f98', '[\"*\"]', NULL, NULL, '2024-09-09 19:53:28', '2024-09-09 19:53:28'),
(2, 'App\\Models\\User', 3, 'my-app-token', '5581842b2eecd040e2575124fbc704a034e6d5958af988ed666d47cda3754a0a', '[\"*\"]', NULL, NULL, '2024-09-11 20:11:36', '2024-09-11 20:11:36'),
(3, 'App\\Models\\User', 3, 'my-app-token', '1d13bc8448d1141e520e3ed73fb8e1e7add778f7efec8f8d78065fb843bc2e7d', '[\"*\"]', NULL, NULL, '2024-09-11 20:11:55', '2024-09-11 20:11:55'),
(4, 'App\\Models\\User', 3, 'my-app-token', 'fd0751307959b6e856e30378495c576a030fa2eefcdc7a89e6f3ac90e5f85b18', '[\"*\"]', NULL, NULL, '2024-09-11 20:26:04', '2024-09-11 20:26:04'),
(5, 'App\\Models\\User', 3, 'my-app-token', 'f02f27082f3ceec804f621edc2d7e6c533d6018b3a64d4fe5474e038367828f6', '[\"*\"]', NULL, NULL, '2024-09-11 21:35:28', '2024-09-11 21:35:28'),
(6, 'App\\Models\\User', 3, 'my-app-token', 'ba1b1a8898dded8a684d4ca61928c82c5b9f524257abe064351a25870602bcc4', '[\"*\"]', NULL, NULL, '2024-09-11 21:37:07', '2024-09-11 21:37:07'),
(7, 'App\\Models\\User', 3, 'my-app-token', '67d57bbc918cb174d92bdff9d0b83da78116ed1c11e2f5532d53b60949edd435', '[\"*\"]', NULL, NULL, '2024-09-11 21:40:23', '2024-09-11 21:40:23'),
(8, 'App\\Models\\User', 3, 'my-app-token', 'da2c1bd093019df00801e67312422b171b8ef83294c215eaea738cdac9761ae9', '[\"*\"]', NULL, NULL, '2024-09-11 21:40:40', '2024-09-11 21:40:40'),
(9, 'App\\Models\\User', 3, 'my-app-token', 'eb5ceb3cb0ee1579864a110868d10a37068199b5e5671e5afc32f9623e9c290e', '[\"*\"]', NULL, NULL, '2024-09-11 21:41:33', '2024-09-11 21:41:33'),
(10, 'App\\Models\\User', 3, 'my-app-token', '89b3f6bd246111947ded843e554eb8c97621641d519fbe39adeaaedf6c13e447', '[\"*\"]', NULL, NULL, '2024-09-11 21:41:40', '2024-09-11 21:41:40'),
(11, 'App\\Models\\User', 3, 'my-app-token', '22808833bc1b98b7f60e67f6e60d3ff4cae60d08952ff33930c5323ed0663ffc', '[\"*\"]', NULL, NULL, '2024-09-11 21:42:19', '2024-09-11 21:42:19'),
(12, 'App\\Models\\User', 3, 'my-app-token', '944eb3971094da78a6f82a09245e8741ef8291caaac9fdb53a7a052f10be9d01', '[\"*\"]', NULL, NULL, '2024-09-11 21:42:23', '2024-09-11 21:42:23'),
(13, 'App\\Models\\User', 3, 'my-app-token', 'e930fd4b75030bb14451807fef94b17b367f8704aff5ef405324f1394c0a3a19', '[\"*\"]', NULL, NULL, '2024-09-11 21:50:48', '2024-09-11 21:50:48'),
(14, 'App\\Models\\User', 3, 'my-app-token', 'cd410683429c2825d020352ef45c843cc14ad6a236fdca70bc9a2ee3f94d5b18', '[\"*\"]', NULL, NULL, '2024-09-11 21:51:56', '2024-09-11 21:51:56'),
(15, 'App\\Models\\User', 3, 'my-app-token', '2430bc0c2046be70ce5a34d49fd13c192123672d02dedb99986744f49beb0151', '[\"*\"]', NULL, NULL, '2024-09-11 21:53:08', '2024-09-11 21:53:08'),
(16, 'App\\Models\\User', 3, 'my-app-token', '529cf347a89126f4fbfdf6de1ff77f16913c9395348d24e1df4577c5c59d3cec', '[\"*\"]', NULL, NULL, '2024-09-11 21:53:28', '2024-09-11 21:53:28'),
(17, 'App\\Models\\User', 3, 'my-app-token', '806d810cd22e5634141fe8377812f20c72921d93680a855817642a9375b4f475', '[\"*\"]', NULL, NULL, '2024-09-11 21:53:32', '2024-09-11 21:53:32'),
(18, 'App\\Models\\User', 3, 'my-app-token', '823c9d97116628ecb059e94ea3f5e89792d4636fab47e896d7a74e131acabf0c', '[\"*\"]', NULL, NULL, '2024-09-11 21:54:05', '2024-09-11 21:54:05'),
(19, 'App\\Models\\User', 3, 'my-app-token', 'b095b0cdb6fe71a63aa6e134f5fc7cc2cb3cef31623d3a980d77294801ebbc0d', '[\"*\"]', NULL, NULL, '2024-09-11 21:54:11', '2024-09-11 21:54:11'),
(20, 'App\\Models\\User', 3, 'my-app-token', 'e923fd5fab397ac22ccd15ae8daaaa85667349ff5431c61683293196050e6ea8', '[\"*\"]', NULL, NULL, '2024-09-11 21:54:48', '2024-09-11 21:54:48'),
(21, 'App\\Models\\User', 3, 'my-app-token', '47cc75a5c8e5425c9f4fcf10fac3d4dcca6a60cf614604f32e21180b8335770b', '[\"*\"]', NULL, NULL, '2024-09-11 21:55:03', '2024-09-11 21:55:03'),
(22, 'App\\Models\\User', 3, 'my-app-token', '5b03a32ed02d4c4467372d785ecc55ecdeebdaa4eeeda767f2385f31cefda6b2', '[\"*\"]', NULL, NULL, '2024-09-13 01:17:03', '2024-09-13 01:17:03'),
(23, 'App\\Models\\User', 3, 'my-app-token', '0f01dbfff8bc1bc52f3f89aa9a4d76a54d4dee9f87291a81394419d37c311be3', '[\"*\"]', NULL, NULL, '2024-09-13 01:17:10', '2024-09-13 01:17:10'),
(24, 'App\\Models\\User', 3, 'my-app-token', 'c308f5f8c8aa4a0af290023694c4341bc292316ade108165d1d6cdd3a1a859b7', '[\"*\"]', NULL, NULL, '2024-09-13 01:18:23', '2024-09-13 01:18:23'),
(25, 'App\\Models\\User', 3, 'my-app-token', 'c23230ce62c2b6c475994320edc6690ac1902d0585097a67f72cb20ef747b10b', '[\"*\"]', NULL, NULL, '2024-09-13 01:21:05', '2024-09-13 01:21:05'),
(26, 'App\\Models\\User', 3, 'my-app-token', '2ba6b94458a29da5cde22221024691de218b9c08529743ddf74d16c0df8217ba', '[\"*\"]', NULL, NULL, '2024-09-13 01:21:34', '2024-09-13 01:21:34');

-- --------------------------------------------------------

--
-- Structure de la table `resources`
--

CREATE TABLE `resources` (
  `id` bigint UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `videoLink` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isfavorite` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `resource_user`
--

CREATE TABLE `resource_user` (
  `resource_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `payer_id` bigint UNSIGNED NOT NULL,
  `payment_id` bigint UNSIGNED NOT NULL,
  `reference` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` float NOT NULL DEFAULT '0',
  `transaction_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Non payé',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `transactions`
--

INSERT INTO `transactions` (`id`, `payer_id`, `payment_id`, `reference`, `cost`, `transaction_status`, `created_at`, `updated_at`) VALUES
(1, 7, 7, '', 4500, 'Non payé', '2024-09-07 13:46:00', '2024-09-07 13:46:00'),
(2, 8, 7, 'LhSAiukNv', 4500, 'Soldé', '2024-09-07 13:46:00', '2024-09-07 23:40:09'),
(3, 9, 7, '', 4500, 'Non payé', '2024-09-07 13:46:00', '2024-09-07 13:46:00'),
(4, 7, 8, '', 4500, 'Non payé', '2024-09-07 13:47:01', '2024-09-07 13:47:01'),
(5, 8, 8, '', 4500, 'Non payé', '2024-09-07 13:47:01', '2024-09-07 13:47:01'),
(6, 9, 8, '', 4500, 'Non payé', '2024-09-07 13:47:01', '2024-09-07 13:47:01'),
(7, 7, 9, '', 4500, 'Non payé', '2024-09-07 13:49:01', '2024-09-07 13:49:01'),
(8, 8, 9, '1ToqmW6gW', 4500, 'Soldé', '2024-09-07 13:49:01', '2024-09-08 07:42:37'),
(9, 9, 9, '', 4500, 'Non payé', '2024-09-07 13:49:01', '2024-09-07 13:49:01'),
(10, 7, 10, '', 4500, 'Non payé', '2024-09-07 13:51:01', '2024-09-07 13:51:01'),
(11, 8, 10, '', 4500, 'Non payé', '2024-09-07 13:51:01', '2024-09-07 13:51:01'),
(12, 9, 10, '', 4500, 'Non payé', '2024-09-07 13:51:01', '2024-09-07 13:51:01'),
(13, 7, 11, '', 4500, 'Non payé', '2024-09-07 13:53:01', '2024-09-07 13:53:01'),
(14, 8, 11, '', 4500, 'Non payé', '2024-09-07 13:53:01', '2024-09-07 13:53:01'),
(15, 9, 11, '', 4500, 'Non payé', '2024-09-07 13:53:01', '2024-09-07 13:53:01'),
(16, 7, 13, NULL, 12300, 'Non payé', '2024-09-08 10:42:26', '2024-09-08 10:42:26'),
(17, 9, 13, NULL, 12300, 'Non payé', '2024-09-08 10:42:26', '2024-09-08 10:42:26');

-- --------------------------------------------------------

--
-- Structure de la table `transfers`
--

CREATE TABLE `transfers` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `InitiatingSensei_id` bigint UNSIGNED NOT NULL,
  `ApprovingSensei_id` bigint UNSIGNED DEFAULT NULL,
  `transferStatus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `transfers`
--

INSERT INTO `transfers` (`id`, `student_id`, `InitiatingSensei_id`, `ApprovingSensei_id`, `transferStatus`, `comment`, `created_at`, `updated_at`) VALUES
(1, 9, 3, 5, 'En attente', NULL, '2024-09-07 13:52:57', '2024-09-07 13:52:57');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `first_attempt` int NOT NULL DEFAULT '1',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `photoPath` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bioDescription` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `licenseId` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grade` int DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `first_attempt`, `status`, `firstName`, `lastName`, `email`, `phone`, `email_verified_at`, `photoPath`, `bioDescription`, `genre`, `password`, `role`, `licenseId`, `grade`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 0, 'active', 'Bourov', 'Zelensky', 'bourov@gmail.com', '+1 (308) 649-2034', '2024-09-06 22:08:02', NULL, 'Quo rerum et veritatis itaque rerum.', 'Femme', '$2y$12$PosTAWoxxv67.c9Bbzcc1ez0LzIZDgvh/dG0QR92MRGwFg7n2VfO.', 'Admin', '6192', 1, NULL, '2024-09-06 22:08:03', '2024-09-06 22:08:03'),
(3, 0, 'Actif', 'Louqmane', 'INOUSSA', 'inoussalouqmane@gmail.com', '+229 40804040', NULL, NULL, NULL, 'Homme', '$2y$12$YUNv1KzAedbGl5n4TMi3/ewYgymmxjE9Hg0LxJe/pF5Ir7TCudzDa', 'Sensei', 'LIC040', 2, NULL, '2024-09-06 22:16:18', '2024-09-06 22:21:12'),
(5, 1, 'Actif', 'Rachelle', 'Marbella', 'rachellemigan@gmail.com', '+229 40804040', NULL, NULL, NULL, 'Homme', '$2y$12$wr.yUIOuqUjBQ5wSblMLAuiwlq5G1s/XeNfuCERuzyHJQjf6m3d3y', 'Sensei', 'LIC040', 2, NULL, '2024-09-06 22:20:31', '2024-09-06 22:20:31'),
(7, 0, 'Actif', 'Shelby', 'Space', 'shelbyspace@gmail.com', '61786222', NULL, NULL, NULL, 'Homme', '$2y$12$yTPaEHSwr6he0bo0dsrnkOAUSxYuUEkKPM2Hm7OOKyE2JE8SsHl/.', 'Elève', NULL, 1, NULL, '2024-09-06 22:58:08', '2024-09-08 12:30:57'),
(8, 0, 'Actif', 'kanaari', 'solene', 'solene@gmail.com', '61786222', NULL, NULL, NULL, 'Homme', '$2y$12$Tj4RT0.9nXWqnzNQ6efm8O2s6.5Ctl9.nT/4d3.EUgW0DhjhYhWTy', 'Elève', NULL, 1, NULL, '2024-09-06 23:03:04', '2024-09-07 16:22:45'),
(9, 1, 'Actif', 'chromosome', 'Ally', 'ally@gmail.com', '+229 61786222', NULL, NULL, NULL, 'Homme', '$2y$12$7Dd5tl.lP4TOzBAiQfOmDOtLCm/WRtHOcEntFwPKUIGrIFbrA65Nm', 'Elève', NULL, 1, NULL, '2024-09-06 23:06:07', '2024-09-06 23:06:07'),
(10, 1, 'Actif', 'Freddy', 'GOUGOU', 'goufreddy@gmail.com', '+229 40804040', NULL, NULL, NULL, 'Femme', '$2y$12$7Ylttup5TEsI9hn5cctju.O.B1KYvdXE9wjITgGhXkS255Hv6I2vi', 'Sensei', 'LIC040', 2, NULL, '2024-09-12 00:55:31', '2024-09-12 00:55:31');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `accountRequests`
--
ALTER TABLE `accountRequests`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clubs_email_unique` (`email`);

--
-- Index pour la table `club_user`
--
ALTER TABLE `club_user`
  ADD PRIMARY KEY (`club_id`,`user_id`),
  ADD KEY `club_user_club_id_index` (`club_id`),
  ADD KEY `club_user_user_id_index` (`user_id`);

--
-- Index pour la table `disciplines`
--
ALTER TABLE `disciplines`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `disciplines_name_unique` (`name`);

--
-- Index pour la table `dojos`
--
ALTER TABLE `dojos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dojos_club_id_foreign` (`club_id`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_user_id_foreign` (`user_id`);

--
-- Index pour la table `examResults`
--
ALTER TABLE `examResults`
  ADD PRIMARY KEY (`exam_id`,`student_id`),
  ADD KEY `examresults_exam_id_index` (`exam_id`),
  ADD KEY `examresults_student_id_index` (`student_id`),
  ADD KEY `examresults_grade_id_index` (`grade_id`);

--
-- Index pour la table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`event_id`);

--
-- Index pour la table `exam_grade`
--
ALTER TABLE `exam_grade`
  ADD PRIMARY KEY (`exam_id`,`grade_id`),
  ADD KEY `exam_grade_grade_id_foreign` (`grade_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fees_club_id_index` (`club_id`);

--
-- Index pour la table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `grade_resource`
--
ALTER TABLE `grade_resource`
  ADD PRIMARY KEY (`grade_id`,`resource_id`),
  ADD KEY `grade_resource_grade_id_index` (`grade_id`),
  ADD KEY `grade_resource_resource_id_index` (`resource_id`);

--
-- Index pour la table `grade_user`
--
ALTER TABLE `grade_user`
  ADD PRIMARY KEY (`grade_id`,`user_id`),
  ADD KEY `grade_user_grade_id_index` (`grade_id`),
  ADD KEY `grade_user_user_id_index` (`user_id`);

--
-- Index pour la table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_transaction_id_foreign` (`transaction_id`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `juryMembers`
--
ALTER TABLE `juryMembers`
  ADD PRIMARY KEY (`exam_id`,`user_id`),
  ADD KEY `jurymembers_exam_id_index` (`exam_id`),
  ADD KEY `jurymembers_user_id_index` (`user_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `parentTutors`
--
ALTER TABLE `parentTutors`
  ADD PRIMARY KEY (`Student_id`,`Parent_id`),
  ADD KEY `parenttutors_student_id_index` (`Student_id`),
  ADD KEY `parenttutors_parent_id_index` (`Parent_id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_fee_id_index` (`fee_id`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `resource_user`
--
ALTER TABLE `resource_user`
  ADD PRIMARY KEY (`resource_id`,`user_id`),
  ADD KEY `resource_user_resource_id_index` (`resource_id`),
  ADD KEY `resource_user_user_id_index` (`user_id`);

--
-- Index pour la table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_payer_id_foreign` (`payer_id`),
  ADD KEY `transactions_payment_id_foreign` (`payment_id`);

--
-- Index pour la table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transfers_student_id_index` (`student_id`),
  ADD KEY `transfers_initiatingsensei_id_index` (`InitiatingSensei_id`),
  ADD KEY `transfers_approvingsensei_id_index` (`ApprovingSensei_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `accountRequests`
--
ALTER TABLE `accountRequests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `disciplines`
--
ALTER TABLE `disciplines`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `dojos`
--
ALTER TABLE `dojos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT pour la table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `club_user`
--
ALTER TABLE `club_user`
  ADD CONSTRAINT `club_user_club_id_foreign` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `club_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `dojos`
--
ALTER TABLE `dojos`
  ADD CONSTRAINT `dojos_club_id_foreign` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `examResults`
--
ALTER TABLE `examResults`
  ADD CONSTRAINT `examresults_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `examresults_grade_id_foreign` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `examresults_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Contraintes pour la table `exam_grade`
--
ALTER TABLE `exam_grade`
  ADD CONSTRAINT `exam_grade_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`event_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_grade_grade_id_foreign` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fees`
--
ALTER TABLE `fees`
  ADD CONSTRAINT `fees_club_id_foreign` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `grade_resource`
--
ALTER TABLE `grade_resource`
  ADD CONSTRAINT `grade_resource_grade_id_foreign` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `grade_resource_resource_id_foreign` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `grade_user`
--
ALTER TABLE `grade_user`
  ADD CONSTRAINT `grade_user_grade_id_foreign` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `grade_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `juryMembers`
--
ALTER TABLE `juryMembers`
  ADD CONSTRAINT `jurymembers_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`event_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jurymembers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `parentTutors`
--
ALTER TABLE `parentTutors`
  ADD CONSTRAINT `parenttutors_parent_id_foreign` FOREIGN KEY (`Parent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parenttutors_student_id_foreign` FOREIGN KEY (`Student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_fee_id_foreign` FOREIGN KEY (`fee_id`) REFERENCES `fees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `resource_user`
--
ALTER TABLE `resource_user`
  ADD CONSTRAINT `resource_user_resource_id_foreign` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resource_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_payer_id_foreign` FOREIGN KEY (`payer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `transactions_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`);

--
-- Contraintes pour la table `transfers`
--
ALTER TABLE `transfers`
  ADD CONSTRAINT `transfers_approvingsensei_id_foreign` FOREIGN KEY (`ApprovingSensei_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transfers_initiatingsensei_id_foreign` FOREIGN KEY (`InitiatingSensei_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transfers_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
