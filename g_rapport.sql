-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 24 déc. 2023 à 13:34
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `g_rapport`
--

-- --------------------------------------------------------

--
-- Structure de la table `activites`
--

CREATE TABLE `activites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `fichier` varchar(255) DEFAULT NULL,
  `statut` enum('en cours','terminé','arrêté') NOT NULL DEFAULT 'en cours',
  `id_projet` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `activites`
--

INSERT INTO `activites` (`id`, `nom`, `description`, `date_debut`, `date_fin`, `fichier`, `statut`, `id_projet`, `created_at`, `updated_at`) VALUES
(2, 'Acte2', 'Assurez-vous d\'adapter cette méthode selon la structure de votre modèle Rapport, notamment les noms des attributs et la logique de gestion des rapports dans votre application Laravel.\n\nCe code suppose que vous avez un attribut $rapportId dans votre composant pour stocker l\'ID du rapport en cours d\'édition ou de modification dans le modal. Vous devez également vérifier que l\'ID du rapport est correct et que le rapport est récupéré avec succès avant de modifier et d\'enregistrer le statut.', '2023-12-20', '2023-12-31', NULL, 'arrêté', 1, '2023-12-18 15:25:00', '2023-12-20 10:56:11'),
(3, 'Acte12', 'Assurez-vous d\'adapter cette méthode selon la structure de votre modèle Rapport, notamment les noms des attributs et la logique de gestion des rapports dans votre application Laravel.\n\nCe code suppose que vous avez un attribut $rapportId dans votre composant pour stocker l\'ID du rapport en cours d\'édition ou de modification dans le modal. Vous devez également vérifier que l\'ID du rapport est correct et que le rapport est récupéré avec succès avant de modifier et d\'enregistrer le statut.', '2023-12-19', '2024-01-07', NULL, 'terminé', 2, '2023-12-18 15:31:50', '2023-12-20 10:52:05'),
(4, 'Activité 10', '\"En tant qu\'Agent d\'Exploitation Informatique au sein de INOV\'2B, je m\'engage fermement à poursuivre l\'amélioration continue des procédures internes. Je suis conscient de l\'importance cruciale de processus efficaces pour la productivité et le bon fonctionnement de l\'entreprise. À cet effet, je continuerai à travailler en étroite collaboration avec les différents départements pour identifier, analyser et digitaliser les procédures, visant ainsi à simplifier les opérations, à réduire les délais et à augmenter l\'efficacité globale. Mon objectif est de fournir des solutions informatiques innovantes et évolutives qui soutiendront la croissance et la réussite durable de notre entreprise.\"', '2023-12-09', '2023-12-31', NULL, 'terminé', 2, '2023-12-18 15:52:42', '2023-12-20 19:34:27'),
(5, 'inventaire de l\'année', 'Nous fais l\'inventaire de l\'année et cela démarre le 19 Décembre 2023 au sein de la société INOV\'2B', '2023-12-21', '2023-12-31', NULL, 'arrêté', 2, '2023-12-20 14:37:51', '2023-12-23 08:40:47');

-- --------------------------------------------------------

--
-- Structure de la table `besoins`
--

CREATE TABLE `besoins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `fichier` varchar(255) DEFAULT NULL,
  `statut` enum('en attente','Validé','rejeté') NOT NULL DEFAULT 'en attente',
  `id_projet` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `besoins`
--

INSERT INTO `besoins` (`id`, `libelle`, `contenu`, `fichier`, `statut`, `id_projet`, `created_at`, `updated_at`) VALUES
(2, 'Besoin 2', 'Assurez-vous que le champ caché rapportId est correctement mis à jour avec l\'ID du rapport dont vous souhaitez modifier le statut lorsque vous affichez le modal dans votre application.\n\nCette approche vous permettra de récupérer l\'ID du rapport sélectionné et de mettre à jour son statut en fonction de la valeur sélectionnée\nAssurez-vous que le champ caché rapportId est correctement mis à jour avec l\'ID du rapport dont vous souhaitez modifier le statut lorsque vous affichez le modal dans votre application.\n\nCette approche vous permettra de récupérer l\'ID du rapport sélectionné et de mettre à jour son statut en fonction de la valeur sélectionnée par l\'utilisateur.\n\n\n\n\n\n', NULL, 'en attente', 1, '2023-12-18 14:52:03', '2023-12-20 07:55:15'),
(3, 'Besoin d\'ordinateur portatif', 'Assurez-vous que le champ caché rapportId est correctement mis à jour avec l\'ID du rapport dont vous souhaitez modifier le statut lorsque vous affichez le modal dans votre application.\n\nCette approche vous permettra de récupérer l\'ID du rapport sélectionné et de mettre à jour son statut en fonction de la valeur sélectionnée par l\'utilisateur.\n\n\n\n\n\n', NULL, 'Validé', 1, '2023-12-18 14:53:36', '2023-12-20 07:33:35'),
(4, 'Besoin d\'ordinateur portatif pour la comptabilité', 'Assurez-vous que le champ caché rapportId est correctement mis à jour avec l\'ID du rapport dont vous souhaitez modifier le statut lorsque vous affichez le modal dans votre application.\n\nCette approche vous permettra de récupérer l\'ID du rapport sélectionné et de mettre à jour son statut en fonction de la valeur sélectionnée par l\'utilisateur.', NULL, 'en attente', 1, '2023-12-18 14:56:41', '2023-12-23 10:22:53');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `adresse`, `email`, `contact`, `created_at`, `updated_at`) VALUES
(1, 'Waliou', 'Cotonou/Agla', 'waliou@gmail.com', '96554448', '2023-12-16 12:53:59', '2023-12-16 12:53:59'),
(2, 'Djamiou FADEBI', 'Cotonou/Agla', 'djamioufade@gmail.com', '69154434', '2023-12-18 15:23:41', '2023-12-18 15:23:41');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `intervenants`
--

CREATE TABLE `intervenants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `intervenants`
--

INSERT INTO `intervenants` (`id`, `nom`, `prenom`, `contact`, `email`, `adresse`, `created_at`, `updated_at`) VALUES
(1, 'FADEBI', 'Djamiou', '69145688', 'djamioufadebi1@gmail.com', 'Cotonou/Agla', '2023-12-18 15:23:59', '2023-12-18 15:23:59');

-- --------------------------------------------------------

--
-- Structure de la table `intervenants_projets`
--

CREATE TABLE `intervenants_projets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `intervenant_id` int(11) NOT NULL,
  `projet_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_11_163928_create_profils_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2023_11_24_164014_create_roles_table', 1),
(8, '2023_11_24_164311_create_clients_table', 1),
(9, '2023_11_24_164330_create_intervenants_table', 1),
(10, '2023_11_24_223241_create_projets_table', 1),
(11, '2023_11_24_223442_create_activites_table', 1),
(12, '2023_11_24_223615_create_rapports_table', 1),
(13, '2023_11_24_223806_create_besoins_table', 1),
(14, '2023_11_30_094201_create_users_profils_table', 1),
(15, '2023_11_30_094315_create_intervenants_projets_table', 1),
(16, '2023_12_03_205825_create_notifications_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `titre`, `message`, `read`, `created_at`, `updated_at`) VALUES
(1, 31, 'Rejet d\'un besoin', 'Le besoin : Besoin d\'ordinateur portatif pour la comptabilité viens d\'etre rejeter par :admin@gmail.com', 0, '2023-12-22 13:49:01', '2023-12-22 13:49:01'),
(2, 31, 'Validation d\'un besoin', 'Le besoin : Besoin d\'ordinateur portatif pour la comptabilité viens d\'etre valider par :admin@gmail.com', 0, '2023-12-22 13:49:07', '2023-12-22 13:49:07'),
(3, 31, 'Suppression d\'un rapport', 'Le rapport : Sixième rapport du projet A3 viens d\'etre supprimer par :admin@gmail.com', 0, '2023-12-22 16:32:13', '2023-12-22 16:32:13'),
(4, 36, 'Validation d\'un rapport', 'Le rapport : Rapport du projet en cours viens d\'etre valider par :manager@gmail.com', 0, '2023-12-23 08:28:27', '2023-12-23 08:28:27'),
(5, 36, 'Rejet d\'un rapport', 'Le rapport : Rapport 21 viens d\'etre rejeter par :manager@gmail.com', 0, '2023-12-23 08:28:45', '2023-12-23 08:28:45'),
(6, 36, 'Finition d\'un Projet', 'La finition du Projet : Projet WASSANOU viens d\'etre valider par :manager@gmail.com', 0, '2023-12-23 08:29:05', '2023-12-23 08:29:05'),
(7, 36, 'Finition d\'un Projet', 'La finition du Projet : Projet WASSANOU viens d\'etre valider par :manager@gmail.com', 0, '2023-12-23 08:29:30', '2023-12-23 08:29:30'),
(8, 36, 'Arrestation de Projet', 'Le Projet : Projet WASSANOU viens d\'etre arrêter par :manager@gmail.com', 0, '2023-12-23 08:31:05', '2023-12-23 08:31:05'),
(9, 36, 'Arrestation de Projet', 'Le Projet : Projet WASSANOU viens d\'etre arrêter par :manager@gmail.com', 0, '2023-12-23 08:35:07', '2023-12-23 08:35:07'),
(10, 36, 'Arrestation de Projet', 'Le Projet : Projet WASSANOU viens d\'etre arrêter par :manager@gmail.com', 0, '2023-12-23 08:35:20', '2023-12-23 08:35:20'),
(11, 36, 'Finition d\'un Projet', 'La finition du Projet : Projet WASSANOU viens d\'etre valider par :manager@gmail.com', 0, '2023-12-23 08:35:27', '2023-12-23 08:35:27'),
(12, 36, 'Finition d\'un Projet', 'La finition du Projet : Projet WASSANOU viens d\'etre valider par :manager@gmail.com', 0, '2023-12-23 08:38:02', '2023-12-23 08:38:02'),
(13, 36, 'Arrestation d\'une activite', 'L\'activite :  viens d\'etre arrêter par :manager@gmail.com', 0, '2023-12-23 08:40:47', '2023-12-23 08:40:47'),
(14, 31, 'Creation d\'un rapport', 'Le rapport : Rapport du projet demarré le 12 Décembre viens d\'etre creer pour le projet :Projet d\'inventaire de fin d\'année', 0, '2023-12-23 10:16:37', '2023-12-23 10:16:37'),
(15, 31, 'Suppression d\'un rapport', 'Le rapport : Rapport du projet demarré le 12 Décembre viens d\'etre supprimer par :admin@gmail.com', 0, '2023-12-23 10:17:03', '2023-12-23 10:17:03'),
(16, 31, 'Rejet d\'un rapport', 'Le rapport : Rapport du projet en cours viens d\'etre rejeter par :admin@gmail.com', 0, '2023-12-23 10:22:02', '2023-12-23 10:22:02'),
(17, 31, 'Validation d\'un rapport', 'Le rapport : Rapport du projet en cours viens d\'etre valider par :admin@gmail.com', 0, '2023-12-23 10:22:17', '2023-12-23 10:22:17');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `profils`
--

CREATE TABLE `profils` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `profils`
--

INSERT INTO `profils` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'Administrateur', '2023-12-22 14:32:21', '2023-12-22 14:32:21'),
(2, 'Manager', '2023-12-22 14:32:21', '2023-12-22 14:32:21'),
(3, 'Gestionnaire', '2023-12-22 14:32:21', '2023-12-22 14:32:21'),
(4, 'Chef chantier', '2023-12-22 14:32:21', '2023-12-22 14:32:21'),
(5, 'Utilisateur simple', '2023-12-22 14:32:21', '2023-12-22 14:32:21'),
(6, 'Magasinier', '2023-12-22 14:32:21', '2023-12-22 14:32:21');

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

CREATE TABLE `projets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `date_debut` date NOT NULL,
  `date_fin_prevue` date NOT NULL,
  `fichier` varchar(255) DEFAULT NULL,
  `statut` enum('en cours','terminé','arrêté') NOT NULL DEFAULT 'en cours',
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_client` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `projets`
--

INSERT INTO `projets` (`id`, `libelle`, `description`, `date_debut`, `date_fin_prevue`, `fichier`, `statut`, `id_user`, `id_client`, `created_at`, `updated_at`) VALUES
(1, 'Renouvellement de Bureau de la secrétaire', 'Nous sommes à la recherche de mobilier de bureau de qualité comprenant :\n\nBureaux et Chaises Ergonomiques : X bureaux ajustables en hauteur et chaises ergonomiques confortables.\nArmoires et Rangement : Y armoires de rangement pour documents et accessoires.\nTables de Réunion : Z tables de réunion pour les espaces de collaboration.', '2023-12-17', '2023-12-31', NULL, 'arrêté', 17, 1, '2023-12-16 12:56:03', '2023-12-20 11:16:13'),
(2, 'Projet d\'inventaire de fin d\'année', 'Assurez-vous d\'adapter cette méthode selon la structure de votre modèle Rapport, notamment les noms des attributs et la logique de gestion des rapports dans votre application Laravel.\n\nCe code suppose que vous avez un attribut $rapportId dans votre composant pour stocker l\'ID du rapport en cours d\'édition ou de modification dans le modal. Vous devez également vérifier que l\'ID du rapport est correct et que le rapport est récupéré avec succès avant de modifier et d\'enregistrer le statut.', '2023-12-16', '2023-12-30', NULL, 'en cours', 17, 1, '2023-12-18 15:30:23', '2023-12-18 15:30:23'),
(3, 'Projet WASSANOU', '-	Maintenance des ordinateurs,\n-	Assistance technique et résolutions de problèmes techniques (installation d’office 2007 et résolution des problèmes de connexion au réseau\n-	Analyse d’un projet de gestion de gestion de rapport journalier\n', '2023-12-22', '2024-01-07', NULL, 'terminé', 17, 2, '2023-12-20 14:08:49', '2023-12-23 08:35:27');

-- --------------------------------------------------------

--
-- Structure de la table `rapports`
--

CREATE TABLE `rapports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `fichier` varchar(255) DEFAULT NULL,
  `statut` enum('en attente','Validé','rejeté') NOT NULL DEFAULT 'en attente',
  `id_projet` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `rapports`
--

INSERT INTO `rapports` (`id`, `libelle`, `contenu`, `fichier`, `statut`, `id_projet`, `created_at`, `updated_at`) VALUES
(1, 'Rapport 21', '            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Saepe quos reiciendis libero a perspiciatis minus, esse ut, ullam et earum facilis eius inventore, fuga mollitia iusto veritatis. Adipisci, iste delectus?\n            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Saepe quos reiciendis libero a perspiciatis minus, esse ut, ullam et earum facilis eius inventore, fuga mollitia iusto veritatis. Adipisci, iste delectus?\n            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Saepe quos reiciendis libero a perspiciatis minus, esse ut, ullam et earum facilis eius inventore, fuga mollitia iusto veritatis. Adipisci, iste delectus?\n            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Saepe quos reiciendis libero a perspiciatis minus, esse ut, ullam et earum facilis eius inventore, fuga mollitia iusto veritatis. Adipisci, iste delectus?\n            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Saepe quos reiciendis libero a perspiciatis minus, esse ut, ullam et earum facilis eius inventore, fuga mollitia iusto veritatis. Adipisci, iste delectus?\n\n', NULL, 'rejeté', 1, '2023-12-18 08:53:51', '2023-12-23 08:28:45'),
(2, 'Rapport du projet en cours', '\nBien sûr, voici comment vous pourriez définir la méthode saveStatut() dans votre composant Livewire pour récupérer l\'ancien statut d\'un rapport, le mettre à jour avec la valeur sélectionnée et enregistrer les modifications :\n\nphp\nCopy code\nuse Livewire\\Component;\nuse App\\Models\\Rapport; // Assurez-vous d\'importer votre modèle Rapport\n\nclass VotreComposantLivewire extends Component\n{\n    public $statut;\n    public $rapportId; // Supposons que vous avez un attribut pour stocker l\'ID du rapport en cours\n\n    protected $rules = [\n        \'statut\' => \'required|in:Validé,Rejeté\',\n    ];\n\n    public function saveStatut()\n    {\n        $this->validate();\n\n        // Récupérer le rapport en fonction de l\'ID\n        $rapport = Rapport::find($this->rapportId);\n\n        if ($rapport) {\n            // Enregistrer l\'ancien statut avant la mise à jour\n            $ancienStatut = $rapport->statut;\n\n            // Mettre à jour le statut avec la nouvelle valeur\n            $rapport->statut = $this->statut;\n            $rapport->save();\n\n            // Vous pouvez faire d\'autres actions ici, par exemple, rediriger ou émettre un message de succès\n\n            // Émettre un message de succès ou un événement de réussite (ceci est un exemple, à adapter selon vos besoins)\n            if ($this->statut == \'Validé\') {\n                $this->emit(\'successMessage\', \'Le rapport a été validé!\');\n            } else {\n                $this->emit(\'successMessage\', \'Le rapport a été rejeté!\');\n            }\n\n            // Émettre un événement pour cacher le modal\n            $this->emit(\'hideConfirmationModal\');\n        } else {\n            // Gérer le cas où le rapport n\'est pas trouvé\n            // Vous pouvez émettre un message d\'erreur ou prendre d\'autres mesures appropriées\n        }\n    }\n\n    // ... autres méthodes ou fonctions dans votre composant Livewire\n}\nAssurez-vous d\'adapter cette méthode selon la structure de votre modèle Rapport, notamment les noms des attributs et la logique de gestion des rapports dans votre application Laravel.\n\nCe code suppose que vous avez un attribut $rapportId dans votre composant pour stocker l\'ID du rapport en cours d\'édition ou de modification dans le modal. Vous devez également vérifier que l\'ID du rapport est correct et que le rapport est récupéré avec succès avant de modifier et d\'enregistrer le statut.\n\nN\'oubliez pas d\'importer le modèle Rapport au début du fichier si vous ne l\'avez pas déjà fait (use App\\Models\\Rapport).', NULL, 'en attente', 1, '2023-12-18 15:10:48', '2023-12-23 10:22:32');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2023-12-18 07:52:41', '2023-12-18 07:52:41'),
(2, 'chef chantier', '2023-12-18 07:52:56', '2023-12-18 07:52:56'),
(3, 'manager', '2023-12-18 07:53:15', '2023-12-18 07:53:15'),
(4, 'utilisateur simple', '2023-12-18 07:53:36', '2023-12-18 07:53:36'),
(5, 'gestionnaire', '2023-12-18 07:53:50', '2023-12-18 07:53:50'),
(6, 'magasinier', '2023-12-18 13:15:52', '2023-12-18 13:15:52');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL DEFAULT '$2y$12$xYRw6xZpO0Yj47u9LEkoierI8oLxNN9FV4KdfjAoasjpX4YOF4DX.',
  `remember_token` varchar(100) DEFAULT NULL,
  `id_profil` bigint(20) UNSIGNED NOT NULL DEFAULT 5,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `contact`, `email`, `email_verified_at`, `password`, `remember_token`, `id_profil`, `created_at`, `updated_at`) VALUES
(1, 'Treutel', 'Alycia', '+16822977562', 'elisabeth.hahn@example.net', '2023-12-22 14:32:32', '$2y$12$dN/xSVCQWtQyY47WFLkfceDYY8iW95RmPnXn0WOwVe7DN37VWVmYy', '9emuGlxeQc', 1, '2023-12-22 14:32:36', '2023-12-22 14:32:36'),
(2, 'Littel', 'Santiago', '+1 (240) 458-1769', 'wblanda@example.com', '2023-12-22 14:32:32', '$2y$12$66tTSqHkcA1Rv9wBT8ESmeV/rWi95y.IL11jfrX7aAFnA0lGFXfMu', 'GQrIy1ggw2', 1, '2023-12-22 14:32:36', '2023-12-22 14:32:36'),
(3, 'Rau', 'Noemy', '1-330-971-9919', 'bosco.kane@example.net', '2023-12-22 14:32:32', '$2y$12$Fv3lhlMZ85/N2BP1MJvEj.AfGpOPbwufmNAKzfZ1lohwKmLCyH2Hy', 'QhOPjgSFdp', 3, '2023-12-22 14:32:36', '2023-12-22 14:32:36'),
(4, 'Farrell', 'Kenneth', '+1 (606) 962-8429', 'damon19@example.com', '2023-12-22 14:32:33', '$2y$12$eHJJrP/ZMnCfEqU5I75dBOW74RiiMzIMm.ZwC1nSeWLMPJrm.BEyq', 'HJyl3hzD2z', 5, '2023-12-22 14:32:36', '2023-12-22 14:32:36'),
(5, 'Leuschke', 'Maeve', '351.927.7561', 'vprohaska@example.com', '2023-12-22 14:32:33', '$2y$12$sJqh9TkLtMFKUH3xCu/tROrIJ1jhaTZW0nLkgqL1PDUyxifbqV1nm', '9kc7tAoRye', 3, '2023-12-22 14:32:36', '2023-12-22 14:32:36'),
(6, 'Ziemann', 'Noble', '+15077659796', 'rolfson.miller@example.com', '2023-12-22 14:32:34', '$2y$12$9Dgcbmz5q9cbCQkZIqQloeZxKiW5vwEayCU2.5Mz8oyw26k3/G24C', 'tRlPrQADYi', 6, '2023-12-22 14:32:36', '2023-12-22 14:32:36'),
(7, 'Lynch', 'Maude', '1-254-292-1216', 'imorar@example.net', '2023-12-22 14:32:34', '$2y$12$jNCCPo8DSzGBMAinDs.VseOfQwUzgyVw/dF/whmA5cKpZC6iQmbf.', 'sMEehtlKx8', 2, '2023-12-22 14:32:36', '2023-12-22 14:32:36'),
(8, 'Mosciski', 'Betsy', '+1-678-517-9026', 'rowe.ruthie@example.com', '2023-12-22 14:32:34', '$2y$12$tJ5E4XdPv3GpOqXnDik8h.QYKTIybtVz.QT6hVxq0wRn9VuTzYfuu', 'bymp881mQu', 5, '2023-12-22 14:32:36', '2023-12-22 14:32:36'),
(9, 'Ernser', 'Aaron', '+1-539-463-3756', 'daugherty.zion@example.org', '2023-12-22 14:32:35', '$2y$12$Rl01qw8rrsWmGn4UnfWz..9b//jNVBQM9oOs/XdEI9KjFfyywdbtq', 'WzM3ku7caU', 3, '2023-12-22 14:32:36', '2023-12-22 14:32:36'),
(10, 'Kulas', 'Garnett', '(502) 527-4108', 'dstrosin@example.net', '2023-12-22 14:32:35', '$2y$12$YpIsupBMyXy9zBws7n8Quej0t1lMP6G8dBb/AH28yJMa1JDS8M4Su', 'kJMKs8AIsL', 5, '2023-12-22 14:32:36', '2023-12-22 14:32:36'),
(11, 'Swaniawski', 'Lillian', '+1 (779) 722-6097', 'gbartell@example.com', '2023-12-22 14:32:41', '$2y$12$iYXkkOwGjvagDdqZYt..qed4kEbpqYmmtmFowf3TRaui5mGl26yRW', 'VfFzYLYtPQ', 1, '2023-12-22 14:32:45', '2023-12-22 14:32:45'),
(12, 'Mohr', 'Alexandria', '279-482-4412', 'keegan.reichert@example.org', '2023-12-22 14:32:42', '$2y$12$7qs7auPZoTbp6I3XWcLIJupbUlipwcWXePNl.sKIktlGYQwevFxU2', 'Y2TbjjoIAc', 3, '2023-12-22 14:32:45', '2023-12-22 14:32:45'),
(13, 'Brown', 'Sammie', '+1 (650) 335-8646', 'layla.stehr@example.com', '2023-12-22 14:32:42', '$2y$12$iYIYJj4HOmfBhqtc5p5wc.EdeVxue8Rw4iCvbhmheOJSA3u6O4jYK', 'GQw7sUvNbr', 2, '2023-12-22 14:32:46', '2023-12-22 14:32:46'),
(14, 'Funk', 'Stephanie', '208-957-4749', 'deontae.dooley@example.org', '2023-12-22 14:32:43', '$2y$12$sFZdb4a.MGirRh6XXjphJ.LaMYALN4IyfMWRq/I0eWk6i4yAEO3fq', 'Bi92ScLrqo', 6, '2023-12-22 14:32:46', '2023-12-22 14:32:46'),
(15, 'Borer', 'Noah', '+1-806-267-1913', 'scarlett34@example.net', '2023-12-22 14:32:43', '$2y$12$uVcek4WiluAHtKZA06YokulWpnyvEOk8MV4zyqaLiXNMLoAgQYYdS', 'DTQg0YhxBS', 5, '2023-12-22 14:32:46', '2023-12-22 14:32:46'),
(16, 'Kemmer', 'Marian', '919-342-4457', 'destinee.berge@example.net', '2023-12-22 14:32:43', '$2y$12$nQbVuu5OYSUjN3NVgAx1K.iLXOvh2Yyg12Z6mVRlWBKlTc5HpVcru', '5HzRFsZe4v', 5, '2023-12-22 14:32:46', '2023-12-22 14:32:46'),
(17, 'Lueilwitz', 'Stefanie', '1-857-294-1780', 'wuckert.lance@example.net', '2023-12-22 14:32:44', '$2y$12$YKCss7C/j.KO7j9.qBQL4u2sVfE/vMh7sYSaiA3ovURFZmY0KRfMi', 'e50guTHHJU', 6, '2023-12-22 14:32:46', '2023-12-22 14:32:46'),
(18, 'Emmerich', 'Cale', '1-651-703-7167', 'kelsi35@example.org', '2023-12-22 14:32:44', '$2y$12$BnPdh2QT0.fmf/6ArGvzReM.l.HA9llRHOKfyOqyV9zuMGJQcS6K.', 'TcuMIxyouH', 2, '2023-12-22 14:32:46', '2023-12-22 14:32:46'),
(19, 'Kozey', 'Leann', '947.209.9677', 'osvaldo88@example.net', '2023-12-22 14:32:45', '$2y$12$P7Mv1OqpShSVL0qls5bs7uj5qX2p3kIJJAX84dIHUDSkawdGPT5t2', 'TcvqWT18uZ', 3, '2023-12-22 14:32:46', '2023-12-22 14:32:46'),
(20, 'Schaden', 'Dallin', '+1 (307) 815-1732', 'imaggio@example.net', '2023-12-22 14:32:45', '$2y$12$6J1QeIDvpvS8S68MkSjxlO9U1BPfrmBKhfSQucCvryxw72wgRRzoi', '8JAuu5PHrl', 3, '2023-12-22 14:32:46', '2023-12-22 14:32:46'),
(21, 'Grady', 'Wilmer', '+1-352-741-9007', 'reynolds.demetris@example.com', '2023-12-22 14:32:49', '$2y$12$cRNvMH0PqRp.WyU46ZWtUus5q70JR2Z1gYHqePgIUuyVATPPrsi4q', 'kYmR9xFpSF', 3, '2023-12-22 14:32:53', '2023-12-22 14:32:53'),
(22, 'Rippin', 'Ilene', '1-928-492-1024', 'dprosacco@example.org', '2023-12-22 14:32:49', '$2y$12$3uoq35dxFy/kFaNdpQMvO.oKyMqCrieBAYLqTZOwD8gEtyMLGordO', 'Ig3q5RZ2a0', 1, '2023-12-22 14:32:53', '2023-12-22 14:32:53'),
(23, 'Ledner', 'Harmon', '1-831-525-5367', 'awisoky@example.com', '2023-12-22 14:32:50', '$2y$12$8EWO4xBTw2ErQwb9Z.JJv.dMTlXyfn6JXROcKjwOYzMWQESn8h8LK', 'uZrb5GHfNT', 1, '2023-12-22 14:32:53', '2023-12-22 14:32:53'),
(24, 'Pacocha', 'Karl', '1-629-712-6933', 'zbahringer@example.net', '2023-12-22 14:32:50', '$2y$12$tjCO/WTz6iMiWgXCvomNFO3RSy5VHPsnUyNnq1CsF8fvMhuzXOsmC', 'Ta5X5mE2wh', 3, '2023-12-22 14:32:53', '2023-12-22 14:32:53'),
(25, 'Harris', 'Hailey', '1-978-901-2347', 'yemmerich@example.org', '2023-12-22 14:32:50', '$2y$12$x.1KFiM5aTH1Z767dt1sT.EGvBaeu/kTuky0pgr61xCf4rS2byfZa', 'tJ7Bx1XRa9', 2, '2023-12-22 14:32:53', '2023-12-22 14:32:53'),
(26, 'Walsh', 'Sanford', '320.897.0993', 'xschulist@example.net', '2023-12-22 14:32:51', '$2y$12$GUfu1Va9uCydpvEBF1xB5eRzLckwQ4IXpQu6v.3/Dh.6JMSeh8QF6', 'osqR5VIRsM', 1, '2023-12-22 14:32:53', '2023-12-22 14:32:53'),
(27, 'Yundt', 'Corrine', '+1 (720) 730-7938', 'sullrich@example.net', '2023-12-22 14:32:51', '$2y$12$PAX6qdxwQ3Iu3ErBiTm8dOX7hUN/ZSalo.tshQaPF1AnuXJWVYAmy', 'ujSM0hqRzY', 6, '2023-12-22 14:32:53', '2023-12-22 14:32:53'),
(28, 'Wyman', 'Bertram', '(951) 914-9393', 'millie.parker@example.net', '2023-12-22 14:32:52', '$2y$12$iImWZzFmH5t/8Dv91wqQceqDv1Cijpe5b8087Bz0yGck1dFtinPLm', 'p7Yn6YqSvN', 5, '2023-12-22 14:32:53', '2023-12-22 14:32:53'),
(29, 'Sipes', 'Henriette', '+1-903-870-5352', 'zward@example.com', '2023-12-22 14:32:52', '$2y$12$mzI8rT3AbERLI4zAEvtHb.ftz9zdiffQ.4pVn70tJbRcgdf0EZmdC', '7Xd1lUo7ls', 1, '2023-12-22 14:32:53', '2023-12-22 14:32:53'),
(30, 'Kertzmann', 'Raquel', '(959) 834-4771', 'sim.rohan@example.net', '2023-12-22 14:32:53', '$2y$12$4dJFq/VNDFDVK2EFSHBzy.yFnZZU7neI/3oZ8qYWLEYcHsDihzUZi', 'E1OfAWlL13', 2, '2023-12-22 14:32:53', '2023-12-22 14:32:53'),
(31, 'Administrateur', 'Admin1', '673455698', 'admin@gmail.com', NULL, '$2y$12$uTZub.CSGWOA.iRrsONlL.GkyaLfSbz4gFNeoLuHtvrt7.a.0c3N2', NULL, 1, '2023-12-22 14:34:40', '2023-12-22 14:34:40'),
(32, 'Chef', 'Chantier', '678899996', 'chefchantier@gmail.com', NULL, '$2y$12$XgL5jXlN2bi4nUXEhQ8vquBOV.wWmbhC6eH5LPPCDKoOUvvpP.ZRu', NULL, 4, '2023-12-22 14:35:59', '2023-12-22 14:35:59'),
(33, 'manager', 'central', '65443389', 'managercentral@gmail.com', NULL, '$2y$12$NbjToTOcPsZH8qTpSa/7vuM24dLdspZRk.Z/HEpR5xPVnp0XxFNxG', NULL, 5, '2023-12-22 14:37:41', '2023-12-22 14:37:41'),
(34, 'magasinier', '1', '90778354', 'magasinier1@gmail.com', NULL, '$2y$12$4ESn8DDFEoAY/RJIr9Lc5exPTNPokxDyyCiCko6ri7Lvv.Q373HFu', NULL, 6, '2023-12-22 14:45:17', '2023-12-22 14:45:17'),
(35, 'gestionnaire', '1', '654442876', 'gestionnaire@gmail.com', NULL, '$2y$12$25BfdIfBrgbS.6k.Fcsr.ON9.c4JLjGmZ8yD6qbDMNNMhK1y/ZFI2', NULL, 3, '2023-12-22 15:00:44', '2023-12-22 15:00:44'),
(36, 'manager', '1', '5677789999', 'manager@gmail.com', NULL, '$2y$12$1jU2Oy3wB50/JdYZUNZTreDJUkZLE5eqY2eFYA3V3p/pmIae7Bpqu', NULL, 2, '2023-12-22 16:17:59', '2023-12-22 16:17:59'),
(40, 'FADEBI', 'Amouda', '673344325', 'fadebiamouda@gmail.com', NULL, '$2y$12$EqfGY8Va/lcxCJev3e8vc.k9mz6l0AGQ1hJqTG/bOT8TQfwe9.TFi', NULL, 5, '2023-12-24 09:17:02', '2023-12-24 09:17:02');

-- --------------------------------------------------------

--
-- Structure de la table `users_profils`
--

CREATE TABLE `users_profils` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `profil_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activites`
--
ALTER TABLE `activites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activites_id_projet_foreign` (`id_projet`);

--
-- Index pour la table `besoins`
--
ALTER TABLE `besoins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `besoins_id_projet_foreign` (`id_projet`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `intervenants`
--
ALTER TABLE `intervenants`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `intervenants_projets`
--
ALTER TABLE `intervenants_projets`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `profils`
--
ALTER TABLE `profils`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projets_id_user_foreign` (`id_user`),
  ADD KEY `projets_id_client_foreign` (`id_client`);

--
-- Index pour la table `rapports`
--
ALTER TABLE `rapports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rapports_id_projet_foreign` (`id_projet`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id_profil_foreign` (`id_profil`);

--
-- Index pour la table `users_profils`
--
ALTER TABLE `users_profils`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activites`
--
ALTER TABLE `activites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `besoins`
--
ALTER TABLE `besoins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `intervenants`
--
ALTER TABLE `intervenants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `intervenants_projets`
--
ALTER TABLE `intervenants_projets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `profils`
--
ALTER TABLE `profils`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `projets`
--
ALTER TABLE `projets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `rapports`
--
ALTER TABLE `rapports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `users_profils`
--
ALTER TABLE `users_profils`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `activites`
--
ALTER TABLE `activites`
  ADD CONSTRAINT `activites_id_projet_foreign` FOREIGN KEY (`id_projet`) REFERENCES `projets` (`id`);

--
-- Contraintes pour la table `besoins`
--
ALTER TABLE `besoins`
  ADD CONSTRAINT `besoins_id_projet_foreign` FOREIGN KEY (`id_projet`) REFERENCES `projets` (`id`);

--
-- Contraintes pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `projets`
--
ALTER TABLE `projets`
  ADD CONSTRAINT `projets_id_client_foreign` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `projets_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `rapports`
--
ALTER TABLE `rapports`
  ADD CONSTRAINT `rapports_id_projet_foreign` FOREIGN KEY (`id_projet`) REFERENCES `projets` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_profil_foreign` FOREIGN KEY (`id_profil`) REFERENCES `profils` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
