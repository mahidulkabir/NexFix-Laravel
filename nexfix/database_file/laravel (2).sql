-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2025 at 08:11 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_service_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` enum('pending','accepted','completed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `vendor_service_id`, `date`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2025-10-20', 'Dhanmondi, Dhaka', 'accepted', '2025-10-22 22:34:57', '2025-10-25 22:05:46');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_19_002939_create_service_categories_table', 1),
(5, '2025_10_19_003004_create_services_table', 1),
(6, '2025_10_19_003017_create_vendors_table', 1),
(7, '2025_10_19_003429_create_vendor_services_table', 1),
(8, '2025_10_19_003558_create_bookings_table', 1),
(9, '2025_10_19_003618_create_payments_table', 1),
(10, '2025_10_19_003646_create_reviews_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `method` enum('cash','card','online') NOT NULL DEFAULT 'cash',
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `booking_id`, `amount`, `method`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 600.00, 'cash', 'completed', '2025-10-22 22:34:57', '2025-10-25 22:05:25');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL COMMENT '1–5',
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `booking_id`, `user_id`, `vendor_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 5, 'Excellent service!', '2025-10-22 22:34:57', '2025-10-22 22:34:57');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `details` longtext DEFAULT NULL,
  `base_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `image` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_category_id`, `name`, `description`, `details`, `base_price`, `image`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bathroom Cleaning', 'Comprehensive bathroom cleaning service.', 'Service Overview\n\nYour bathroom deserves to sparkle! NexFix’s Professional Bathroom Cleaning Service ensures every corner of your bathroom — from tiles to taps — is deeply sanitized, deodorized, and left spotless. Our expert cleaners use eco-friendly cleaning agents and modern tools to eliminate germs, hard water stains, mold, and unpleasant odors. Whether it’s your home, office, or commercial space, we make your bathroom look and feel brand new.\n\nWhat’s Included\n\nOur Full Bathroom Cleaning Package covers all essential cleaning tasks:\n\n🚿 General Cleaning\n\nSweeping and mopping the floor\n\nDusting windows, mirrors, shelves, and fittings\n\nRemoving cobwebs and surface dust\n\nDeep cleaning of doors and handles\n\n🧴 Deep Surface Cleaning\n\nScrubbing and disinfecting floor and wall tiles\n\nRemoving hard water stains and soap scum\n\nCleaning washbasins, taps, and counter areas\n\nPolishing metal fixtures for shine\n\n🚽 Toilet & Sanitary Cleaning\n\nFull disinfection of toilet bowl, seat, and flush handle\n\nRemoval of lime scale, yellow stains, and odor-causing bacteria\n\nDeep cleaning of urinals (for commercial bathrooms)\n\nSanitization using anti-bacterial chemicals\n\n🛁 Bathtub, Shower & Drain Area\n\nScrubbing and disinfecting bathtubs and shower cabins\n\nCleaning showerheads, faucets, and glass doors\n\nClearing drainage openings and floor traps\n\n🌸 Final Touch\n\nAir freshener application for long-lasting freshness\n\nQuick drying and final inspection for spotless results\n\nWhy Choose NexFix Bathroom Cleaning Service?\n\n✅ Trained Professionals – Background-verified and skilled cleaners with proper hygiene practices.\n✅ Safe Chemicals – We use non-toxic, eco-friendly cleaning materials suitable for all bathroom types.\n✅ Hygienic & Hassle-free – We bring our own cleaning tools and equipment.\n✅ Time-saving – A complete bathroom deep clean within 45–90 minutes (depending on size).\n✅ Affordable Packages – Transparent pricing, no hidden charges.\n\nService Duration\n\nSmall Bathroom: ~45 minutes\n\nMedium Bathroom: ~60 minutes\n\nLarge Bathroom: ~90 minutes\n\n(Time may vary based on dirt level and condition.)\n\nRecommended Frequency\n\nDeep Cleaning: Every 2–3 weeks\n\nMaintenance Cleaning: Weekly\n\nWhat You Should Know Before Booking\n\nEnsure electricity and water supply are available during the service.\n\nPlease remove personal items (toothbrush, cosmetics, towels, etc.) before cleaning starts.\n\nNexFix is not responsible for pre-existing damage to tiles, fittings, or pipes.\n\nPricing (Example)\nBathroom Size	Price (BDT)	Description\nSmall (up to 50 sq. ft.)	350৳	Ideal for small household bathrooms\nMedium (50–100 sq. ft.)	500৳	Standard residential bathroom\nLarge (above 100 sq. ft.)	700৳	Spacious or commercial bathrooms\n\n(Prices may vary by city or vendor.)\n\nService Guarantee\n\nAll NexFix partner cleaners are verified, trained, and quality-checked.\nIf you’re not satisfied, we’ll provide a free re-clean within 24 hours.\n\nKeywords (for SEO / admin data entry)\n\nbathroom cleaning, deep cleaning, toilet cleaning, washroom sanitization, bathroom hygiene, floor cleaning, eco-friendly cleaning, NexFix home services', 500.00, 'services/WWfHhX53aZZMMKCMk3WC6XYiCYQGQR22bGieaKTS.jpg', 0, '2025-10-22 22:34:57', '2025-10-22 22:48:44'),
(2, 2, 'Ac Cleaning', 'description', 'Service Overview\n\nBeat the heat with NexFix’s Professional AC Cleaning Service — designed to keep your air conditioning system running at top performance while improving air quality and reducing energy bills. Our trained technicians use modern tools and eco-safe cleaning agents to thoroughly clean and sanitize every component of your AC — ensuring cool, fresh, and healthy air for your home or office.\n\nWhether it’s a split AC, window AC, or cassette unit, NexFix ensures a deep and detailed clean that extends the lifespan of your machine.\n\nWhat’s Included\n\nOur comprehensive AC Cleaning Package covers both indoor and outdoor unit cleaning:\n\n🧰 Indoor Unit Cleaning\n\nCleaning and sanitizing air filters\n\nDeep cleaning of cooling coils and evaporator fins\n\nRemoving dust buildup from blower and fan\n\nCleaning front panel and drain tray\n\nFlushing the drainage line to prevent water leakage\n\nChecking electrical connections and overall performance\n\n🌬️ Outdoor Unit Cleaning\n\nCleaning condenser coil and fan\n\nRemoving debris, dirt, and leaves from the outer body\n\nChecking refrigerant pipe insulation condition\n\nBasic performance check of compressor and condenser motor\n\n🧴 Disinfection & Air Quality Care\n\nUse of anti-bacterial and anti-fungal cleaning agents\n\nDeodorization of filters to ensure odor-free air\n\nWiping of all visible AC surfaces for a clean finish\n\nWhy Choose NexFix AC Cleaning Service?\n\n✅ Trained Technicians – Certified experts trained in handling all AC brands and models\n✅ Improved Cooling Performance – Removes dirt buildup that reduces cooling efficiency\n✅ Energy Saving – A clean AC consumes up to 30% less electricity\n✅ Healthy Indoor Air – Removes allergens, bacteria, and mold spores\n✅ Full Equipment Support – Technicians bring their own cleaning tools and protective gear\n\nService Duration\nType of AC	Approx. Time\nSplit AC	45–60 minutes\nWindow AC	30–45 minutes\nCassette / Ceiling AC	60–90 minutes\n\n(Time may vary depending on condition and accessibility.)\n\nRecommended Frequency\n\nHome Use: Every 3–4 months\n\nOffice/Commercial: Every 2 months\n\nBefore summer season: Highly recommended for maximum cooling\n\nWhat You Should Know Before Booking\n\nEnsure electricity and running water are available during the service.\n\nNexFix does not include gas refilling, repair, or parts replacement in cleaning service.\n\nHeavy dirt or mold may require an additional deep-cleaning charge (discussed before work begins).\n\nPricing (Example)\nAC Type	Price (BDT)	Description\nSplit AC	600৳	Standard indoor + outdoor cleaning\nWindow AC	500৳	Full cleaning and deodorization\nCassette / Ceiling AC	900৳	Commercial or large area units\n\n(Prices may vary depending on city or vendor.)\n\nService Guarantee\n\nEvery NexFix AC cleaning is performed by trained, verified, and experienced technicians.\nIf you face any issues within 24 hours, we offer a free re-check or touch-up cleaning.', 1200.00, 'services/Fa6MjrzaO5ER5XuyeKSkO9TpmLmrThpDEEsfl8qx.jpg', 1, '2025-10-22 22:49:37', '2025-10-22 22:49:37'),
(3, 1, 'Tank Cleaning', 'description', 'Service Overview\n\nClean water starts with a clean tank. NexFix’s Professional Water Tank Cleaning Service ensures your storage tanks — overhead, underground, or household — are thoroughly cleaned, disinfected, and safe for daily use. Over time, dirt, algae, rust, and bacteria build up inside tanks, contaminating your water supply. Our trained technicians use modern tools, non-toxic cleaning agents, and hygienic methods to restore your tank’s purity and ensure healthy water for your family or business.\n\nWhat’s Included\n\nOur 6-Step Tank Cleaning Process:\n\nDraining: Pumping out all water from the tank safely.\n\nSludge Removal: Removing sediment, mud, and debris manually.\n\nHigh-Pressure Jet Cleaning: Washing tank walls and floors to remove scaling and algae.\n\nAnti-Bacterial Spray: Disinfecting interior surfaces using food-grade sanitizer.\n\nUV or Chlorination Treatment: Killing bacteria and germs to ensure safety.\n\nFinal Rinse & Drying: Flushing and drying for clean, odor-free tanks.\n\nWhy Choose NexFix\n\n✅ Trained, background-verified professionals\n✅ Safe and eco-friendly chemicals\n✅ Suitable for all types of tanks — plastic, cement, or metal\n✅ Reduces waterborne diseases\n✅ Affordable, fast, and hygienic\n\nService Duration\nTank Capacity	Time Required\nUp to 1000 Liters	~45 minutes\n1000–5000 Liters	~60–90 minutes\n5000–10,000 Liters	~2–3 hours\nRecommended Frequency\n\nResidential: Every 3–6 months\n\nCommercial / Industrial: Every 2–3 months\n\nPricing (Example)\nTank Size	Price (BDT)	Description\nUp to 1000L	500৳	Suitable for small household tanks\n1000–5000L	800৳	Medium-sized building tanks\nAbove 5000L	1200৳	Large or commercial water tanks\n\n(Prices may vary by city or vendor.)\n\nService Guarantee\n\nAll NexFix technicians follow strict safety and hygiene protocols.\nWe ensure 100% satisfaction or free re-clean within 24 hours.', 6000.00, 'services/6jzzlkDuBxXLsRGGRAPR70kKvFFpBB6uuOotNZRS.jpg', 0, '2025-10-22 23:00:18', '2025-10-22 23:00:32'),
(4, 3, 'Face Wash', 'Both Male and Female face cleaning', 'Service Overview\n\nPamper your skin with NexFix’s Professional Face Cleaning Service — a deep cleansing treatment designed to remove dirt, excess oil, blackheads, and dead skin cells for fresh, glowing skin. Our expert beauticians use premium, dermatologically tested products tailored to your skin type to ensure the best results.\n\nWhether you’re preparing for a special occasion or simply want to refresh your face after a long week, NexFix brings spa-quality facial care right to your home or at a nearby verified salon partner.\n\nWhat’s Included\n\nOur Complete Face Cleaning Process includes:\n\n🧴 Cleansing: Removes surface dirt, makeup, and pollutants.\n\n🌿 Scrubbing / Exfoliation: Gently eliminates dead skin cells.\n\n💨 Steaming: Opens up pores for deep purification.\n\n🧼 Blackhead & Whitehead Removal: Clears clogged pores for smoother skin.\n\n💆 Soothing Massage: Enhances blood circulation and skin elasticity.\n\n🧖 Face Pack / Mask: Hydrates and revitalizes your skin.\n\n💧 Toner & Moisturizer: Closes pores and locks in freshness.\n\nWhy Choose NexFix Face Cleaning Service\n\n✅ Professional Beauticians – Certified, trained, and hygiene-focused.\n✅ Safe for All Skin Types – Sensitive, oily, dry, or combination.\n✅ High-Quality Products – Branded and dermatologically approved.\n✅ Instant Glow & Freshness – Noticeable improvement in one session.\n✅ At-Home or Salon Option – Flexibility to suit your comfort.\n\nService Duration\nType	Duration\nBasic Face Cleaning	25–30 minutes\nDeep Face Cleaning	45–60 minutes\nRecommended Frequency\n\nBasic Cleaning: Every 1–2 weeks\n\nDeep Cleaning: Every 3–4 weeks\n\nPricing (Example)\nService Type	Price (BDT)	Description\nBasic Face Cleaning	400৳	Cleansing + scrubbing + mask\nDeep Face Cleaning	700৳	Includes steam, extraction, and massage\n\n(Prices may vary depending on vendor or city.)\n\nService Guarantee\n\nAll NexFix beauticians are verified, trained, and use sanitized tools.\nWe ensure a safe, relaxing, and glowing experience — or get a free re-session within 24 hours.', 8000.00, 'services/lcNvxZyLkDrbyUKfDC495omsewRB1mJfwhrrAjEn.jpg', 1, '2025-11-01 00:48:26', '2025-11-01 00:48:26');

-- --------------------------------------------------------

--
-- Table structure for table `service_categories`
--

CREATE TABLE `service_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_categories`
--

INSERT INTO `service_categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Home Cleaning', 'All types of cleaning services.', '2025-10-22 22:34:57', '2025-10-22 22:34:57'),
(2, 'Electrical', 'Description', '2025-10-22 22:49:12', '2025-10-22 22:49:12'),
(3, 'Beauty & Wellness', 'All your beauty service in one place.', '2025-11-01 00:13:19', '2025-11-01 00:13:19'),
(4, 'Shifting', 'Home and Office shifting with skilled professionals.', '2025-11-01 00:25:11', '2025-11-01 00:25:11');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3uVWGL2Ac56ytVQsioxwdBfPe0EWTg0diJREJBUB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoienNEdUJEY0J4aHc5Y3p4ek9HcUVYa2RMbUd2elBFVGxLUndxcmRnMCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZWdpc3RlciI7fX0=', 1761980971),
('cNWTLFJAOTxrLkdBnotY7BL7FlZR2Kwp7xmu7Xet', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZWFNUHBLUnBVbEthbzhMN1BaeWF2U0g2QU0yekdZWGpwc3lreDY5ZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1761980758);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Mahidul', 'admin@nexfix.com', NULL, '$2y$12$RalJbRrAGxHe9/YoaFnbY.NOqsVDgFI.hmHdHvAZCdkI8egWF2vQ6', 'admin', NULL, '2025-10-22 22:34:57', '2025-10-22 22:34:57'),
(2, 'Mrs. Kaela Cartwright', 'littel.libby@example.net', '2025-10-22 22:34:57', '$2y$12$OpT6IaAYpryCSwybs5wlgeTYW4abH6SWZxhUGiNL4sYKcFWwdgO12', 'user', '6me59wZspi', '2025-10-22 22:34:57', '2025-10-22 22:34:57'),
(3, 'Delpha Stanton', 'jacklyn.leffler@example.org', '2025-10-22 22:34:57', '$2y$12$OpT6IaAYpryCSwybs5wlgeTYW4abH6SWZxhUGiNL4sYKcFWwdgO12', 'user', 'hf4OYNT9hT', '2025-10-22 22:34:57', '2025-10-22 22:34:57'),
(4, 'Miss Margarete Gislason', 'ttremblay@example.net', '2025-10-22 22:34:57', '$2y$12$OpT6IaAYpryCSwybs5wlgeTYW4abH6SWZxhUGiNL4sYKcFWwdgO12', 'user', 'OBwHJGGZ4V', '2025-10-22 22:34:57', '2025-10-22 22:34:57'),
(5, 'Dr. Leora Hammes', 'rpacocha@example.org', '2025-10-22 22:34:57', '$2y$12$OpT6IaAYpryCSwybs5wlgeTYW4abH6SWZxhUGiNL4sYKcFWwdgO12', 'user', 'GUIGt3kdYV', '2025-10-22 22:34:57', '2025-10-22 22:34:57'),
(6, 'Wilton Grimes', 'barton.parker@example.com', '2025-10-22 22:34:57', '$2y$12$OpT6IaAYpryCSwybs5wlgeTYW4abH6SWZxhUGiNL4sYKcFWwdgO12', 'user', 'Dfnve4D2GP', '2025-10-22 22:34:57', '2025-10-22 22:34:57'),
(7, 'vendor', 'vendor@nexfix.com', NULL, '$2y$12$6s0PC1SLeOCfQdh.wBdeMe51ug3A6WEyKBey9V9cBtwGfEvgnOMMm', 'vendor', NULL, '2025-10-31 23:46:30', '2025-10-31 23:46:30'),
(8, 'user', 'user@nexfix.com', NULL, '$2y$12$V8f71FBJZU/IGOMTgFBx7.Vo85XVVtk.SBcjtQr.2LTy9G4LEC/JO', 'user', NULL, '2025-10-31 23:47:16', '2025-10-31 23:47:16');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `user_id`, `company_name`, `phone`, `address`, `verified`, `created_at`, `updated_at`) VALUES
(1, 1, 'CleanCo', '01700000000', 'Dhaka', 1, '2025-10-22 22:34:57', '2025-10-22 22:34:57');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_services`
--

CREATE TABLE `vendor_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `custom_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_services`
--

INSERT INTO `vendor_services` (`id`, `vendor_id`, `service_id`, `custom_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 600.00, 'active', '2025-10-22 22:34:57', '2025-10-22 22:34:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `bookings_vendor_service_id_foreign` (`vendor_service_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_booking_id_foreign` (`booking_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_booking_id_foreign` (`booking_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_service_category_id_foreign` (`service_category_id`);

--
-- Indexes for table `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendors_user_id_foreign` (`user_id`);

--
-- Indexes for table `vendor_services`
--
ALTER TABLE `vendor_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_services_vendor_id_foreign` (`vendor_id`),
  ADD KEY `vendor_services_service_id_foreign` (`service_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendor_services`
--
ALTER TABLE `vendor_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_vendor_service_id_foreign` FOREIGN KEY (`vendor_service_id`) REFERENCES `vendor_services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_service_category_id_foreign` FOREIGN KEY (`service_category_id`) REFERENCES `service_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vendors`
--
ALTER TABLE `vendors`
  ADD CONSTRAINT `vendors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vendor_services`
--
ALTER TABLE `vendor_services`
  ADD CONSTRAINT `vendor_services_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vendor_services_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
