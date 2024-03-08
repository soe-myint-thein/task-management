-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 08, 2024 at 12:11 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `assigned_tasks`
--

CREATE TABLE `assigned_tasks` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `task_desc` text DEFAULT NULL,
  `task_doc` varchar(200) DEFAULT NULL,
  `assign_to` int(11) NOT NULL,
  `task_status` enum('pending','in progress','done','rejected') NOT NULL DEFAULT 'pending',
  `is_supervisor` tinyint(1) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assigned_tasks`
--

INSERT INTO `assigned_tasks` (`id`, `task_id`, `task_desc`, `task_doc`, `assign_to`, `task_status`, `is_supervisor`, `date`) VALUES
(1, 1, 'Task 1 Description', NULL, 11, 'pending', 0, '2024-03-08 12:48:11'),
(2, 2, 'Task 2 Description', NULL, 5, 'pending', 0, '2024-03-08 12:48:24'),
(3, 3, 'Task 3 Description', NULL, 3, 'pending', 0, '2024-03-08 12:48:37');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `title`, `description`, `photo`, `phone`, `address`, `email`, `facebook`, `twitter`, `instagram`, `linkedin`, `created_at`, `updated_at`) VALUES
(1, 'MAS EDUCATION CENTER', 'THE ACCCOUNTANCY SCHOOL PROVIDING QUALITY ACCOUNTING QULIFICATIONS WITH PREMIUM LEARNING EXPERIENCE AND BEST CUSTOMER SERVICE', 'logo.png', '09779922387', 'No. 526, 2nd Floor, Corner of Lower Kyeemyindaing Road and Daw Hla Streets, Kyeemyindaing Township, Yangon.', 'info@mas-education.com', 'https://www.facebook.com/mas.educa/', '', 'https://instagram.com/maseducationcenter?igshid=YmMyMTA2M2Y=', '', '2022-11-29 20:01:48', '2022-11-29 20:02:09');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `no` tinyint(4) NOT NULL,
  `english` tinytext NOT NULL,
  `header_menu` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `icon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `no`, `english`, `header_menu`, `status`, `icon`) VALUES
(3, 1, 'Tasks', 1, 1, 'fa fa-outdent'),
(6, 2, 'Paments', 1, 1, 'fa fa-outdent'),
(25, 12, 'User', 1, 1, 'fa fa-cogs');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `payment_ref` varchar(20) DEFAULT NULL,
  `payment_type` enum('cash','bank') NOT NULL DEFAULT 'cash',
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `task_id`, `amount`, `payment_ref`, `payment_type`, `date`) VALUES
(1, 1, 500000, 'dfsfds', 'cash', '2024-03-08 13:04:13'),
(2, 2, 500000, 'dfsfds', 'cash', '2024-03-08 13:04:34'),
(3, 3, 500000, 'dfsfds', 'cash', '2024-03-08 13:04:34'),
(4, 4, 500000, 'dfsfds', 'cash', '2024-03-08 13:04:34'),
(5, 5, 500000, 'dfsfds', 'cash', '2024-03-08 13:04:34');

-- --------------------------------------------------------

--
-- Table structure for table `payouts`
--

CREATE TABLE `payouts` (
  `assign_task_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_ref` varchar(50) DEFAULT NULL,
  `paid_by` varchar(50) DEFAULT NULL,
  `payment_type` enum('cash','bank') NOT NULL DEFAULT 'cash',
  `received_by` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payouts`
--

INSERT INTO `payouts` (`assign_task_id`, `amount`, `payment_ref`, `paid_by`, `payment_type`, `received_by`, `date`) VALUES
(1, 20000, 'ddddd', 'ffffff', 'cash', 1, '2024-03-08 13:47:11'),
(2, 20000, 'ddddd', 'ffffff', 'cash', 3, '2024-03-08 13:48:18'),
(3, 20000, 'ddddd', 'ffffff', 'cash', 5, '2024-03-08 13:48:18'),
(4, 20000, 'ddddd', 'ffffff', 'cash', 10, '2024-03-08 13:48:18');

-- --------------------------------------------------------

--
-- Table structure for table `submenu`
--

CREATE TABLE `submenu` (
  `id` int(11) NOT NULL,
  `terms` varchar(50) NOT NULL,
  `english` tinytext NOT NULL,
  `header_menu` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `child` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `submenu`
--

INSERT INTO `submenu` (`id`, `terms`, `english`, `header_menu`, `status`, `child`) VALUES
(41, 'Payments', 'Payments Lists', 6, 1, ''),
(42, 'Payouts', 'Payout Lists', 6, 1, ''),
(265, 'Users', 'User Lists', 25, 1, ''),
(266, 'User_role', 'User Permissions', 25, 1, ''),
(289, 'Assigned_tasks', 'Assigned Tasks', 3, 1, ''),
(290, 'Tasks', 'Task Lists', 3, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `task_name` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `requested_by` int(11) NOT NULL,
  `task_docs` text DEFAULT NULL,
  `task_type` enum('periodic','one-time') NOT NULL DEFAULT 'one-time',
  `payment_status` enum('pending','done') NOT NULL DEFAULT 'pending',
  `task_status` enum('pending','in progress','done','rejected') NOT NULL DEFAULT 'pending',
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task_name`, `description`, `requested_by`, `task_docs`, `task_type`, `payment_status`, `task_status`, `date`) VALUES
(1, 'Task 1', 'Task 1 Description', 12, NULL, 'one-time', 'pending', 'pending', '2024-03-08 12:45:18'),
(2, 'Task 2', 'Task 2 Description', 12, NULL, 'one-time', 'pending', 'pending', '2024-03-08 12:45:50'),
(3, 'Task 3', 'Task 3 Description', 12, NULL, 'one-time', 'pending', 'pending', '2024-03-08 12:45:50'),
(4, 'Task 4', 'Task 4 Description', 12, NULL, 'one-time', 'pending', 'pending', '2024-03-08 12:45:50'),
(5, 'Task 5', 'Task 5 Description', 12, NULL, 'one-time', 'pending', 'pending', '2024-03-08 12:45:50');

-- --------------------------------------------------------

--
-- Table structure for table `task_requirements`
--

CREATE TABLE `task_requirements` (
  `id` int(11) NOT NULL,
  `assign_tasks_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `submit_by` int(11) NOT NULL,
  `docs` varchar(200) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `remember_token` varchar(100) DEFAULT NULL,
  `user_type` varchar(100) NOT NULL,
  `user_role` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `user_type`, `user_role`, `photo`, `created_at`, `updated_at`) VALUES
(3, 'Admin', 'admin@gmail.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, 'Administrator', 1, 'unnamed.jpg', '2022-12-04 17:38:09', '2022-12-04 17:38:09'),
(5, 'kkk', 'kaungkhunkyaw@gmail.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, 'Administrator', 1, 'k_img.png', '2022-12-22 09:12:13', '2022-12-22 09:12:13'),
(10, 'yyyy', 'trainer@gmail.com', NULL, 'e290405a3fb6b5e8c0122a7943e02f5c', NULL, 'Trainer', 4, '', '2023-04-10 09:37:25', '2023-04-10 09:37:25'),
(11, 'ttt', 'lecturer@gmail.com', NULL, '8d82fc7053b04cdddf39ab3302a98bb3', NULL, 'teacher', 3, '', '2023-06-27 08:15:11', '2023-06-27 08:15:11'),
(12, 'mgmg', 'mgmg@gmail.com', NULL, 'daa4bf1b4d0978fa034ada89161a23c4', NULL, 'client', 0, '', '2024-03-08 03:45:21', '2024-03-08 03:45:21'),
(17, 'ggg', 'gg@gmail.com', NULL, 'daa4bf1b4d0978fa034ada89161a23c4', NULL, 'client', 0, '', '2024-03-08 04:07:38', '2024-03-08 04:07:38'),
(18, 'aaa', 'aa@gmail.com', NULL, '47bce5c74f589f4867dbd57e9ca9f808', NULL, 'client', 0, '', '2024-03-08 04:08:34', '2024-03-08 04:08:34'),
(19, 'ttt', 'ttt@gmail.com', NULL, '9990775155c3518a0d7917f7780b24aa', NULL, 'client', 0, '', '2024-03-08 04:10:28', '2024-03-08 04:10:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `edallow` varchar(255) NOT NULL,
  `permission` text NOT NULL,
  `submenu` text NOT NULL,
  `template` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `role`, `edallow`, `permission`, `submenu`, `template`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Yes', '3,6,25', '289,290,41,42,265,266', 'Admin', NULL, NULL),
(3, 'Staff', 'Yes', '3,6', '289,290,42', 'Staff', NULL, NULL),
(4, 'Client', 'Yes', '3,6', '290,41', 'Client', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assigned_tasks`
--
ALTER TABLE `assigned_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payouts`
--
ALTER TABLE `payouts`
  ADD PRIMARY KEY (`assign_task_id`);

--
-- Indexes for table `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_requirements`
--
ALTER TABLE `task_requirements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assigned_tasks`
--
ALTER TABLE `assigned_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `submenu`
--
ALTER TABLE `submenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `task_requirements`
--
ALTER TABLE `task_requirements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
