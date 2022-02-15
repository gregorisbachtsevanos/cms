-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 14 Φεβ 2022 στις 12:21:39
-- Έκδοση διακομιστή: 10.4.21-MariaDB
-- Έκδοση PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `global_crm`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `actions_log`
--

CREATE TABLE `actions_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` datetime DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'create,edit,delete',
  `target_id` int(11) DEFAULT NULL,
  `old_value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `actions_log`
--

INSERT INTO `actions_log` (`id`, `date`, `user`, `controller`, `action`, `target_id`, `old_value`, `new_value`) VALUES
(1, '2020-02-25 16:48:07', 1, 'contacts', 'create', 18398, '', 'Anto Nikos'),
(2, '2020-03-03 07:23:19', 1, 'customers', 'create', 18399, '', 'Αντωνιάδης Νίκος'),
(3, '2020-05-12 12:47:28', 1, 'contacts', 'create', 18399, '', 'Παπανδρέου Ελένη'),
(4, '2020-05-12 12:53:37', 1, 'contacts', 'delete', 18398, 'Anto Nikos', ''),
(5, '2020-05-12 13:39:50', 1, 'contacts', 'create', 18400, '', 'ΣΑΡΑΦΗΣ ΙΩΑΝΝΗΣ'),
(6, '2020-05-12 14:02:42', 1, 'contacts', 'create', 18401, '', 'Κυριαζάκου Γεωργία'),
(7, '2020-05-13 09:47:09', 1, 'contacts', 'create', 18402, '', 'Στράντζας Άκης'),
(8, '2020-05-13 09:53:38', 1, 'contacts', 'create', 18403, '', 'Καρατζάς Αριστοτέλης '),
(9, '2020-05-13 13:55:27', 1, 'contacts', 'create', 18404, '', 'ΠΑΠΑΔΑΤΟΣ ΒΑΣΙΛΗΣ'),
(10, '2020-05-13 15:27:05', 1, 'contacts', 'create', 18405, '', 'Παπασωτηρίου Βασίλης'),
(11, '2020-05-13 15:28:58', 1, 'contacts', 'create', 18406, '', 'Σγουρίδου Άννα'),
(12, '2020-05-13 15:29:01', 1, 'contacts', 'create', 18407, '', 'Σγουρίδου Άννα'),
(13, '2020-05-13 15:29:02', 1, 'contacts', 'create', 18408, '', 'Σγουρίδου Άννα'),
(14, '2020-05-13 15:29:02', 1, 'contacts', 'create', 18409, '', 'Σγουρίδου Άννα'),
(15, '2020-05-13 15:29:09', 1, 'contacts', 'create', 18410, '', 'Σγουρίδου Άννα'),
(16, '2020-05-13 15:29:10', 1, 'contacts', 'create', 18411, '', 'Σγουρίδου Άννα'),
(17, '2020-05-13 15:29:28', 1, 'contacts', 'delete', 18411, 'Σγουρίδου Άννα', ''),
(18, '2020-05-13 15:29:41', 1, 'contacts', 'delete', 18410, 'Σγουρίδου Άννα', ''),
(19, '2020-05-13 15:29:49', 1, 'contacts', 'delete', 18409, 'Σγουρίδου Άννα', ''),
(20, '2020-05-13 15:29:54', 1, 'contacts', 'delete', 18408, 'Σγουρίδου Άννα', ''),
(21, '2020-05-13 15:29:59', 1, 'contacts', 'delete', 18407, 'Σγουρίδου Άννα', ''),
(22, '2020-05-13 15:31:50', 1, 'contacts', 'create', 18412, '', 'Σαββίδης Χρήστος'),
(23, '2020-05-14 10:26:57', 1, 'contacts', 'create', 18413, '', 'Κεφαλά Πέννη '),
(24, '2020-05-14 10:34:29', 1, 'contacts', 'create', 18414, '', 'Χατζηγεωργίου Θέκλα'),
(25, '2020-05-14 10:38:52', 1, 'contacts', 'create', 18415, '', 'Καραμούζας Αθανάσιος'),
(26, '2020-05-14 10:42:17', 1, 'contacts', 'create', 18416, '', 'Σαρίπαπας Δημήτρης'),
(27, '2020-05-14 10:46:34', 1, 'contacts', 'create', 18417, '', 'Μέτση Μαρτίνα'),
(28, '2020-05-14 10:51:39', 1, 'contacts', 'create', 18418, '', 'Γεωργιάδη  Ανδρεάδη'),
(29, '2020-05-14 10:54:26', 1, 'contacts', 'create', 18419, '', '? Δήμητρα'),
(30, '2020-05-14 11:02:47', 1, 'contacts', 'create', 18420, '', 'Καλτζίδης Κωνσταντίνος'),
(31, '2020-05-14 11:07:04', 1, 'contacts', 'create', 18421, '', 'Κερασιά Ζάγκα '),
(32, '2020-05-14 11:58:54', 1, 'contacts', 'create', 18422, '', 'Πραγαλή Αγγελική '),
(33, '2020-05-14 12:00:22', 1, 'contacts', 'create', 18423, '', 'Γιαννούσης Κωνσταντίνος'),
(34, '2020-05-14 12:02:04', 1, 'contacts', 'create', 18424, '', 'Καζάζης Γιώργος'),
(35, '2020-05-14 12:03:07', 1, 'contacts', 'create', 18425, '', 'Παπαδάκη Φρανκ'),
(36, '2020-05-14 12:04:39', 1, 'contacts', 'create', 18426, '', 'Χατζηιωάννου Πέτρος'),
(37, '2020-05-14 12:04:48', 1, 'contacts', 'create', 18427, '', 'Χατζηιωάννου Πέτρος'),
(38, '2020-05-14 12:05:45', 1, 'contacts', 'create', 18428, '', 'Γιάμαλη Μαρία '),
(39, '2020-05-14 12:06:34', 1, 'contacts', 'create', 18429, '', 'Κάτσιου Βασιλική '),
(40, '2020-05-14 12:07:34', 1, 'contacts', 'create', 18430, '', 'Παπαγεώργος Δημήτρης'),
(41, '2020-05-14 12:08:26', 1, 'contacts', 'create', 18431, '', 'Κάππα Αγγελική'),
(42, '2020-05-14 12:09:38', 1, 'contacts', 'create', 18432, '', 'Χαραλαμπίδης Μίλτος'),
(43, '2020-05-14 12:09:47', 1, 'contacts', 'create', 18433, '', 'Χαραλαμπίδης Μίλτος'),
(44, '2020-05-14 12:10:43', 1, 'contacts', 'create', 18434, '', 'Λιάζος Χρήστος'),
(45, '2020-05-14 12:12:11', 1, 'contacts', 'create', 18435, '', 'Μπουλογεώργος Ευάγγελος'),
(46, '2020-05-14 12:13:05', 1, 'contacts', 'create', 18436, '', 'Αντωνιάδης Νικόλαος'),
(47, '2020-05-14 12:14:00', 1, 'contacts', 'create', 18437, '', 'Δήμου Νίκος '),
(48, '2020-05-14 12:15:19', 1, 'contacts', 'create', 18438, '', 'Ραφτόπουλος Βασίλειος'),
(49, '2020-05-14 12:16:21', 1, 'contacts', 'create', 18439, '', 'Βυζουκάκης Βαγγέλης'),
(50, '2020-05-14 12:17:22', 1, 'contacts', 'create', 18440, '', 'Δαμίγου Μαρία'),
(51, '2020-05-14 12:18:12', 1, 'contacts', 'create', 18441, '', 'Γκίνη Καλομοίρα'),
(52, '2020-05-14 12:19:06', 1, 'contacts', 'create', 18442, '', 'Παπαγιάννης Γιάννης'),
(53, '2020-05-14 12:19:59', 1, 'contacts', 'create', 18443, '', 'Καλογεροπούλου Έλενα'),
(54, '2020-05-14 12:20:52', 1, 'contacts', 'create', 18444, '', 'Μποκάρης Γιώργος'),
(55, '2020-05-14 12:23:06', 1, 'contacts', 'create', 18445, '', 'Αϊδίνη Λένα'),
(56, '2020-05-14 12:24:38', 1, 'contacts', 'create', 18446, '', 'Γρίβας Βασίλης'),
(57, '2020-05-14 12:30:51', 1, 'contacts', 'create', 18447, '', 'Κάππα Αγγελική '),
(58, '2020-05-14 12:30:55', 1, 'contacts', 'create', 18448, '', 'Κάππα Αγγελική '),
(59, '2020-05-14 12:31:10', 1, 'contacts', 'delete', 18448, 'Κάππα Αγγελική ', ''),
(60, '2020-05-14 12:32:45', 1, 'contacts', 'delete', 18447, 'Κάππα Αγγελική ', ''),
(61, '2020-05-14 12:36:15', 1, 'contacts', 'create', 18449, '', 'ΠΑΠΑΒΑΣΙΛΗ ΖΩΗ'),
(62, '2020-05-14 12:38:33', 1, 'contacts', 'create', 18450, '', 'Ευαγγέλου  Δημητρα'),
(63, '2020-05-14 12:40:05', 1, 'contacts', 'create', 18451, '', 'ΤΡΙΑΝΤΑΦΥΛΛΟΥ	 ΕΛΕΥΘΕΡΙΑ'),
(64, '2020-05-14 12:41:00', 1, 'contacts', 'create', 18452, '', 'Ντουφεξή Άννα'),
(65, '2020-05-14 12:41:55', 1, 'contacts', 'create', 18453, '', 'Δαλιάνης Γιώργος'),
(66, '2020-05-14 12:42:59', 1, 'contacts', 'create', 18454, '', 'Ξινού Νεφελη'),
(67, '2020-05-14 12:44:38', 1, 'contacts', 'create', 18455, '', 'Καριώτη Ελίζα'),
(68, '2020-05-14 12:45:37', 1, 'contacts', 'create', 18456, '', 'Καρβούνη Ζωή'),
(69, '2020-05-14 12:47:26', 1, 'contacts', 'create', 18457, '', 'Καρρά  Θεοδώρα'),
(70, '2020-05-14 12:48:28', 1, 'contacts', 'create', 18458, '', 'Σακελλαρης '),
(71, '2020-05-14 12:49:14', 1, 'contacts', 'create', 18459, '', 'Κόλλια Ζέφη '),
(72, '2020-05-14 12:50:03', 1, 'contacts', 'create', 18460, '', 'ΤΣΑΚΑΛΑΚΗΣ  ΔΙΟΝΥΣΗΣ'),
(73, '2020-05-14 12:50:39', 1, 'contacts', 'create', 18461, '', 'Ζέρβας Αντώνης '),
(74, '2020-05-14 12:51:31', 1, 'contacts', 'create', 18462, '', 'Ζακόπουλος  Θανάσης'),
(75, '2020-05-14 12:52:11', 1, 'contacts', 'create', 18463, '', 'Φιλη Αναστασία '),
(76, '2020-05-14 12:53:02', 1, 'contacts', 'create', 18464, '', 'Αναστασιάδου  Θεοδώρα'),
(77, '2020-05-14 12:54:40', 1, 'contacts', 'create', 18465, '', 'Κούρτης Κωνσταντίνος'),
(78, '2020-05-14 12:55:40', 1, 'contacts', 'create', 18466, '', 'Χρυσσου Ευαγγελία'),
(79, '2020-05-14 12:56:27', 1, 'contacts', 'create', 18467, '', 'Ζαρδαβα Αναστασία'),
(80, '2020-05-14 12:57:14', 1, 'contacts', 'create', 18468, '', 'ΚΑΛΟΥΤΑΣ ΓΕΩΡΓΙΟΣ '),
(81, '2020-05-14 12:58:14', 1, 'contacts', 'create', 18469, '', 'ΣΩΤΗΡΙΟΥ ΔΗΜΗΤΡΑ '),
(82, '2020-05-14 12:58:56', 1, 'contacts', 'create', 18470, '', 'Μαργουδη  Πασχαλια'),
(83, '2020-05-14 13:00:04', 1, 'contacts', 'create', 18471, '', 'Δαρκαδακης Γιαννης '),
(84, '2020-05-14 13:01:14', 1, 'contacts', 'create', 18472, '', 'Σουσαμίδου Αικατερίνη '),
(85, '2020-05-14 13:02:26', 1, 'contacts', 'create', 18473, '', 'Μαυρογεώργος  Λεωνίδας'),
(86, '2020-05-18 10:28:13', 1, 'contacts', 'create', 18474, '', 'Κιουπουρογλου Αναστασία'),
(87, '2020-05-18 10:30:15', 1, 'contacts', 'create', 18475, '', 'ΓΙΑΝΝΑΚΟΠΟΥΛΟΥ ΚΩΝΣΤΑΝΤΙΝΑ '),
(88, '2020-05-18 10:31:14', 1, 'contacts', 'create', 18476, '', 'Ρήγου Άννα'),
(89, '2020-05-18 10:31:57', 1, 'contacts', 'create', 18477, '', 'Στεφανίδης Τάσος'),
(90, '2020-05-26 09:41:12', 1, 'contacts', 'create', 18478, '', 'Μάρκου Βαγγέλης'),
(91, '2020-06-01 13:46:10', 1, 'contacts', 'create', 18479, '', 'Ρίζου Αναστασία'),
(92, '2020-06-01 14:31:37', 1, 'contacts', 'create', 18480, '', 'Λαζαρινός Δημήτρης'),
(93, '2020-06-01 14:31:38', 1, 'contacts', 'create', 18481, '', 'Λαζαρινός Δημήτρης'),
(94, '2020-06-01 14:31:46', 1, 'contacts', 'delete', 18481, 'Λαζαρινός Δημήτρης', ''),
(95, '2020-06-01 14:33:05', 1, 'contacts', 'create', 18482, '', 'Βέργαδος Αθανάσιος '),
(96, '2020-06-03 10:29:43', 1, 'contacts', 'create', 18483, '', 'Μπούρα  Γκέλυ'),
(97, '2020-06-03 10:29:45', 1, 'contacts', 'create', 18484, '', 'Μπούρα  Γκέλυ'),
(98, '2020-06-03 10:31:09', 1, 'contacts', 'delete', 18484, 'Μπούρα  Γκέλυ', ''),
(99, '2020-06-03 10:42:36', 1, 'contacts', 'create', 18485, '', 'Μακρή Σοφία'),
(100, '2020-06-15 14:36:41', 1, 'contacts', 'create', 18486, '', 'Θεοδωρόπουλος P.G.'),
(101, '2020-06-15 14:38:23', 1, 'contacts', 'create', 18487, '', 'Tottewitz Κυριακή'),
(102, '2020-06-18 10:15:32', 1, 'contacts', 'create', 18488, '', 'Ρίζος Δημήτρης '),
(103, '2020-06-18 13:20:06', 1, 'contacts', 'create', 18489, '', 'Παπατέρπος Παντελής'),
(104, '2020-06-19 13:29:00', 2, 'contacts', 'create', 18490, '', 'Μιχαλάκη Ελένη'),
(105, '2020-06-19 13:32:02', 2, 'contacts', 'delete', 18490, 'Μιχαλάκη Ελένη', ''),
(106, '2020-06-19 13:34:02', 2, 'contacts', 'create', 18491, '', 'Μιχαλάκη Ελένη'),
(107, '2020-06-19 14:28:13', 2, 'contacts', 'delete', 18491, 'Μιχαλάκη Ελένη', ''),
(108, '2020-06-19 15:12:15', 2, 'contacts', 'create', 18492, '', 'Τσαβλίδης Θοδωρής'),
(109, '2020-06-19 15:18:35', 2, 'contacts', 'create', 18493, '', 'Μιχαλάκη Ελένη'),
(110, '2020-06-23 09:25:55', 2, 'contacts', 'create', 18494, '', 'Δεσύπρης Γιώργος'),
(111, '2020-06-23 10:44:44', 1, 'customers', 'delete', 18399, 'Αντωνιάδης Νίκος2', ''),
(112, '2020-06-26 11:43:58', 1, 'customers', 'create', 18400, '', 'test test'),
(113, '2020-06-29 09:27:32', 1, 'customers', 'create', 18401, '', ' Νικόλαος Αντωνιάδης'),
(114, '2020-06-29 09:27:39', 1, 'customers', 'create', 18402, '', ' Νικόλαος Αντωνιάδης'),
(115, '2020-06-29 09:27:50', 1, 'customers', 'delete', 18401, ' Νικόλαος Αντωνιάδης', ''),
(116, '2020-06-29 09:27:54', 1, 'customers', 'delete', 18402, ' Νικόλαος Αντωνιάδης', ''),
(117, '2020-06-29 09:41:19', 1, 'customers', 'delete', 18400, 'test test', ''),
(118, '2020-06-29 11:12:40', 2, 'customers', 'create', 18403, '', 'Hawila Ali '),
(119, '2020-06-29 11:16:28', 2, 'customers', 'delete', 18403, 'Hawila Ali ', ''),
(120, '2020-06-29 11:20:02', 2, 'customers', 'create', 18404, '', 'Huawila Ali'),
(121, '2020-06-29 11:57:42', 2, 'contacts', 'create', 18495, '', 'Μούρνου Εύη'),
(122, '2020-07-01 09:34:34', 2, 'customers', 'create', 18405, '', 'Κοντός Γιάννης '),
(123, '2020-07-01 09:39:44', 2, 'customers', 'create', 18406, '', 'Βλασακούδη Σοφία'),
(124, '2020-07-01 09:41:05', 2, 'customers', 'create', 18407, '', 'Ναούμ Γιώργος'),
(125, '2020-07-01 09:51:49', 2, 'customers', 'create', 18408, '', 'Κονοσίδη Μαρία'),
(126, '2020-07-02 11:10:13', 2, 'contacts', 'create', 18496, '', 'Αθανασιάδης Αντώνης'),
(127, '2020-07-02 12:17:48', 3, 'customers', 'create', 18409, '', ' group of 8'),
(128, '2020-07-02 12:21:04', 3, 'customers', 'create', 18410, '', ' Γιαννακοπούλου'),
(129, '2020-07-02 12:23:02', 3, 'customers', 'create', 18411, '', 'Παπαποστόλου Λίλια '),
(130, '2020-07-02 12:24:26', 3, 'customers', 'create', 18412, '', 'Carlier Mathilde '),
(131, '2020-07-02 12:26:29', 3, 'customers', 'create', 18413, '', 'Kirov Geno'),
(132, '2020-07-02 12:27:11', 3, 'customers', 'create', 18414, '', 'Μαργαρίτη Μαρία'),
(133, '2020-07-02 12:28:51', 3, 'customers', 'create', 18415, '', 'Σαρίδης Χρήστος '),
(134, '2020-07-06 11:51:10', 2, 'contacts', 'create', 18497, '', 'Αμπελας Αγαπητός'),
(135, '2020-07-06 11:51:59', 2, 'contacts', 'create', 18498, '', 'Δίκαρος Βασίλειος'),
(136, '2020-07-06 11:53:25', 2, 'contacts', 'create', 18499, '', 'Παπαβασιλείου Μαίρη'),
(137, '2020-07-06 11:54:07', 2, 'contacts', 'create', 18500, '', 'Πεντάρη Φλώρα'),
(138, '2020-07-06 11:55:23', 2, 'contacts', 'create', 18501, '', 'Κοκκινάκη Άρτεμις'),
(139, '2020-07-06 11:57:43', 2, 'contacts', 'create', 18502, '', 'Καραμπέλια Κατερίνα'),
(140, '2020-07-06 11:58:18', 2, 'contacts', 'create', 18503, '', 'Καραμπέλιας Μιχάλης '),
(141, '2020-07-06 15:44:15', 1, 'customers', 'create', 18416, '', 'Ταχτσίδου Λουκία'),
(142, '2020-07-07 13:52:56', 2, 'contacts', 'create', 18504, '', 'Καρράς Πάνος'),
(143, '2020-07-08 12:07:43', 2, 'contacts', 'create', 18505, '', 'Σταυρόπουλος Άγνωστο'),
(144, '2020-07-08 12:14:23', 3, 'customers', 'create', 18417, '', 'Ταχτσίδου Λουκία'),
(145, '2020-07-08 12:14:36', 3, 'customers', 'delete', 18417, 'Ταχτσίδου Λουκία', ''),
(146, '2020-07-08 12:15:11', 3, 'customers', 'create', 18418, '', 'Phoenix Νestor'),
(147, '2020-07-08 13:06:40', 3, 'contacts', 'create', 18506, '', 'Αχινιώτου Χριστίνα'),
(148, '2020-07-13 10:01:17', 2, 'contacts', 'create', 18507, '', 'Λάγιος Δημήτρης '),
(149, '2020-07-14 10:33:05', 2, 'customers', 'create', 18419, '', 'Καρτσέβα Μαρία'),
(150, '2020-07-14 10:35:08', 2, 'customers', 'create', 18420, '', 'Ανγγελίδης Βασίλειος'),
(151, '2020-07-14 10:36:22', 2, 'customers', 'create', 18421, '', 'Ζέρβα Αναστασία'),
(152, '2020-07-14 10:37:00', 2, 'customers', 'create', 18422, '', 'Salonia Sergio'),
(153, '2020-07-14 12:06:56', 2, 'contacts', 'create', 18508, '', 'Στεργιοπούλου Βάγια '),
(154, '2020-07-17 12:32:35', 2, 'contacts', 'create', 18509, '', 'Δημοπούλου Μαίρη'),
(155, '2020-07-20 11:40:38', 2, 'customers', 'create', 18423, '', 'Παυλίδου Μαρία'),
(156, '2020-07-20 12:01:05', 2, 'customers', 'create', 18424, '', 'Ματέου Ανδρέας'),
(157, '2020-07-20 12:05:09', 2, 'contacts', 'create', 18510, '', 'Κατζάρη Κατερίνα'),
(158, '2020-07-20 12:08:05', 2, 'contacts', 'create', 18511, '', 'Θεοδώση Διονυσία'),
(159, '2020-07-20 12:09:06', 2, 'contacts', 'create', 18512, '', 'Άγνωστο; Χρήστος'),
(160, '2020-07-20 12:09:59', 2, 'contacts', 'create', 18513, '', 'Μαύρης Βασίλειος'),
(161, '2020-07-20 12:11:04', 2, 'contacts', 'create', 18514, '', 'Λιβέρη Ράνια'),
(162, '2020-07-24 11:13:09', 2, 'calendar', 'create', 1, '', 'Χατζηγεωργίου Θέκλα (27/07/2020 10:00)'),
(163, '2020-07-24 11:14:34', 2, 'calendar', 'delete', 1, 'Χατζηγεωργίου Θέκλα (27/07/2020 10:00)', ''),
(164, '2020-07-27 11:34:06', 2, 'contacts', 'create', 18515, '', 'Ιωαννίδου Χρύσα'),
(165, '2020-07-27 11:38:23', 2, 'contacts', 'create', 18516, '', 'Διαμαντόπουλος Ηρακλής '),
(166, '2020-07-27 11:43:07', 2, 'contacts', 'create', 18517, '', 'Μπάλλας Μάριος'),
(167, '2020-07-27 11:47:34', 2, 'contacts', 'create', 18518, '', 'Γκάσιου Χριστίνα'),
(168, '2020-07-27 11:58:18', 2, 'contacts', 'create', 18519, '', 'Τριφωνίδης Άγνωστο'),
(169, '2020-07-29 12:05:25', 3, 'customers', 'create', 18425, '', 'Θανατόπουλος '),
(170, '2020-07-29 12:12:25', 3, 'customers', 'create', 18426, '', 'Velichkov  Velizar '),
(171, '2020-08-03 13:28:03', 2, 'contacts', 'create', 18520, '', 'Σαραπάνης Ιωάννης'),
(172, '2020-08-10 13:42:12', 2, 'customers', 'create', 18427, '', 'Σάμιος Πολύκαρπος'),
(173, '2020-08-10 13:44:13', 2, 'customers', 'create', 18428, '', 'Τζεμετζής Χρήατος'),
(174, '2020-08-10 13:46:45', 2, 'customers', 'create', 18429, '', 'Marinides Juliana'),
(175, '2020-08-10 13:48:44', 2, 'customers', 'create', 18430, '', 'Κεχαγιάς Καλλινίκος'),
(176, '2020-08-10 13:50:31', 2, 'customers', 'create', 18431, '', 'Καραγιαννίδης Νίκος'),
(177, '2020-08-10 13:53:24', 2, 'customers', 'create', 18432, '', 'Ματσιόζης Δημήτρης'),
(178, '2020-08-10 13:54:56', 2, 'customers', 'create', 18433, '', 'Τσάκαλη Χριστίνα'),
(179, '2020-08-10 13:56:41', 2, 'customers', 'create', 18434, '', 'Δερβίσης Σάκης'),
(180, '2020-08-10 13:58:31', 2, 'customers', 'create', 18435, '', 'Ζαρμπούτης Θοδωρής'),
(181, '2020-08-10 14:00:24', 2, 'customers', 'create', 18436, '', 'Σκανδάλης Αλέξανδρος'),
(182, '2020-08-10 14:02:13', 2, 'customers', 'create', 18437, '', 'Rodriguez Ορέστης'),
(183, '2020-08-10 14:03:45', 2, 'customers', 'create', 18438, '', 'Κούκας Γιώργος'),
(184, '2020-08-10 14:05:38', 2, 'customers', 'create', 18439, '', ' Επαφή της Vesta'),
(185, '2020-08-18 12:01:23', 2, 'customers', 'create', 18440, '', 'Ξανθόπουλος Θεολόγος'),
(186, '2020-08-18 12:03:29', 2, 'customers', 'create', 18441, '', 'Αιγυπτιάδης Άρης'),
(187, '2020-08-18 12:06:05', 2, 'customers', 'create', 18442, '', 'Γιαντζές Κωνσταντίος'),
(188, '2020-08-18 12:09:59', 2, 'customers', 'create', 18443, '', 'Γ. Νίκος'),
(189, '2020-09-07 12:23:50', 2, 'contacts', 'create', 18521, '', 'Βογιατζιδάκης Παναγιώτης'),
(190, '2020-09-07 12:28:08', 2, 'contacts', 'create', 18522, '', 'Μπάκα Πωλίνα'),
(191, '2020-09-07 12:29:12', 2, 'contacts', 'create', 18523, '', 'Μαντινός Θεόφιλος'),
(192, '2020-09-09 12:05:28', 2, 'contacts', 'create', 18524, '', 'Ρόκος Άγνωστο'),
(193, '2020-09-09 12:06:45', 2, 'contacts', 'create', 18525, '', 'Νικολάκης Γιώργος'),
(194, '2020-09-09 12:07:41', 2, 'contacts', 'create', 18526, '', 'Ξένος Γιώργος'),
(195, '2020-09-09 12:08:35', 2, 'contacts', 'create', 18527, '', 'Δημητριάδης Άγνωστο'),
(196, '2020-09-09 12:09:42', 2, 'contacts', 'create', 18528, '', 'Οικονομίδου Ελένη'),
(197, '2020-09-09 12:10:37', 2, 'contacts', 'create', 18529, '', 'Κανδύλα Κασιανή'),
(198, '2020-09-09 12:11:19', 2, 'contacts', 'create', 18530, '', 'Κωφού  Κωνσταντίνα'),
(199, '2020-09-09 12:12:20', 2, 'contacts', 'create', 18531, '', 'Παπαμωρού Ευγενία'),
(200, '2020-09-09 12:13:08', 2, 'contacts', 'create', 18532, '', 'Ρομανός Σωτήρης'),
(201, '2020-09-09 12:14:14', 2, 'contacts', 'create', 18533, '', 'Γιαννακάκου Γ.'),
(202, '2020-09-22 10:43:12', 2, 'contacts', 'create', 18534, '', 'Σέντοβα Ελισάβετ'),
(203, '2020-09-29 11:59:42', 2, 'contacts', 'create', 18535, '', 'Χουτζιούμη  Μαρία'),
(204, '2020-10-12 09:12:51', 2, 'contacts', 'create', 18536, '', 'Σουσκάκη Βενετία'),
(205, '2020-10-12 09:14:24', 2, 'contacts', 'create', 18537, '', 'Μπετσίδης Δημήτρης'),
(206, '2020-10-12 09:15:25', 2, 'contacts', 'create', 18538, '', 'Αναλυτής Βασίλειος'),
(207, '2020-10-12 09:16:27', 2, 'contacts', 'create', 18539, '', 'Νεόφυτος Χρήστος'),
(208, '2020-10-12 09:17:10', 2, 'contacts', 'create', 18540, '', 'Μαυρούδης Γιώργος'),
(209, '2020-10-12 09:18:00', 2, 'contacts', 'create', 18541, '', 'Πρωτόπαπα Εμανουέλα'),
(210, '2021-05-06 12:45:16', 2, 'customers', 'create', 18444, '', 'Ευσταθιάδου '),
(211, '2021-05-10 12:20:27', 2, 'contacts', 'create', 18542, '', 'Κύρτσιος Δημήτρης'),
(212, '2021-05-12 10:17:58', 2, 'customers', 'create', 18445, '', 'Αγγελέσκου Γιώργος'),
(213, '2021-05-12 10:20:39', 2, 'customers', 'create', 18446, '', 'Γκρίσιν Βασίλης'),
(214, '2021-05-12 10:23:50', 2, 'customers', 'create', 18447, '', 'Πιτσικίδης Βασίλης'),
(215, '2021-05-12 10:34:29', 2, 'customers', 'create', 18448, '', 'Διάφα Ζωή'),
(216, '2021-05-12 12:36:03', 2, 'contacts', 'create', 18543, '', 'Στογιάννος '),
(217, '2021-05-12 13:17:33', 2, 'contacts', 'create', 18544, '', 'Μεταξάς Γεώργιος'),
(218, '2021-05-12 13:21:47', 2, 'contacts', 'create', 18545, '', 'Πέτκου Αθηνά'),
(219, '2021-05-19 13:12:48', 2, 'contacts', 'create', 18546, '', 'Κάτση Γιορίντα'),
(220, '2021-05-19 13:14:38', 2, 'contacts', 'create', 18547, '', 'Χαρίση Μαρία'),
(221, '2021-05-19 13:16:17', 2, 'contacts', 'create', 18548, '', 'Τσιγκόπουλος Ανδρέας'),
(222, '2021-05-19 13:17:34', 2, 'contacts', 'create', 18549, '', 'Κυριαζή Μαρία'),
(223, '2021-05-19 13:19:16', 2, 'contacts', 'create', 18550, '', 'Ηλιοπούλου Χαρούλα'),
(224, '2021-05-19 13:20:09', 2, 'contacts', 'create', 18551, '', 'Μπεντήλ Ειρήνη'),
(225, '2021-05-19 13:21:10', 2, 'contacts', 'create', 18552, '', 'Καραγεώργα Γωγώ'),
(226, '2021-05-19 13:22:02', 2, 'contacts', 'create', 18553, '', 'Οικονομοπούλου Μάρθα'),
(227, '2021-05-19 13:25:10', 2, 'contacts', 'create', 18554, '', 'Νεοφύτου Βασίλης'),
(228, '2021-05-19 13:26:35', 2, 'contacts', 'create', 18555, '', 'Διονύση Λουίτζη'),
(229, '2021-05-19 13:27:20', 2, 'contacts', 'create', 18556, '', 'Σπυράκης Γιώργος'),
(230, '2021-05-19 13:28:16', 2, 'contacts', 'create', 18557, '', 'Χριστοδούλου Κατερίνα'),
(231, '2021-05-19 13:29:13', 2, 'contacts', 'create', 18558, '', 'Σέγκος Δημήτριος'),
(232, '2021-05-19 13:30:16', 2, 'contacts', 'create', 18559, '', 'Χαρτοφύλλης Ευάγγελος'),
(233, '2021-05-19 13:31:36', 2, 'contacts', 'create', 18560, '', 'Δαλαμβέλας Ευστράτιος'),
(234, '2021-05-19 13:33:28', 2, 'contacts', 'create', 18561, '', 'Παπαβασιλόπουλος Θανάσης'),
(235, '2021-05-20 12:22:59', 2, 'contacts', 'create', 18562, '', 'Μαράντου Δήμητρα'),
(236, '2021-05-20 12:24:11', 2, 'contacts', 'create', 18563, '', 'Καρέλα-Μιανιάκη Χαρά'),
(237, '2021-05-20 12:28:30', 2, 'contacts', 'create', 18564, '', '? Πόπη'),
(238, '2021-05-24 13:21:08', 2, 'contacts', 'create', 18565, '', 'Μακρής '),
(239, '2021-05-27 13:57:05', 2, 'contacts', 'create', 18566, '', 'Svinarchyk Galina'),
(240, '2021-05-28 10:23:27', 2, 'contacts', 'create', 18567, '', 'Poting Denis'),
(241, '2021-06-03 09:33:15', 2, 'contacts', 'create', 18568, '', 'Σιδηροπουλος Αλεξανδρος '),
(242, '2021-06-09 12:09:19', 2, 'contacts', 'create', 18569, '', 'ΠΑΡΑΦΕΣΤΑ  ΔΟΜΝΑ'),
(243, '2021-06-09 14:38:28', 2, 'contacts', 'create', 18570, '', 'ΘΕΟΔΩΡΟΠΟΥΛΟΣ ΠΑΝΑΓΙΩΤΗΣ'),
(244, '2021-06-09 14:47:42', 2, 'contacts', 'create', 18571, '', 'ΧΡΗΣΤΙΔΟΥ ΕΙΡΗΝΗ'),
(245, '2021-06-10 09:10:42', 2, 'contacts', 'create', 18572, '', 'ΣΑΒΒΙΔΗΣ ΚΩΣΤΑΣ'),
(246, '2021-06-10 09:16:09', 2, 'contacts', 'create', 18573, '', 'ΣΕΝΤΣΙΚΗΣ ΤΕΠΕΛΙΔΟΥ ΔΗΜΗΤΡΗΣ ΣΟΦΙΑ'),
(247, '2021-06-10 09:21:48', 2, 'contacts', 'create', 18574, '', ' ΒΑΣΙΛΗΣ ΜΑΡΙΑ'),
(248, '2021-06-10 09:26:33', 2, 'contacts', 'create', 18575, '', 'ΤΡΑΪΝΟΣ '),
(249, '2021-06-10 09:38:34', 2, 'contacts', 'create', 18576, '', 'ΚΑΛΦΟΠΟΥΛΟΣ ΑΡΗΣ'),
(250, '2021-06-10 09:43:07', 2, 'contacts', 'create', 18577, '', 'ΚΥΡΙΑΚΙΔΗΣ ΜΙΧΑΛΗΣ'),
(251, '2021-06-10 10:00:12', 2, 'contacts', 'create', 18578, '', 'ΠΑΠΑΓΙΑΝΝΗ ΠΕΤΡΟΥ ΜΑΡΙΑ'),
(252, '2021-06-10 10:05:31', 2, 'contacts', 'create', 18579, '', 'ΑΧΙΝΙΩΤΟΥ ΠΑΠΑΙΩΑΝΝΟΥ '),
(253, '2021-06-10 10:21:59', 2, 'contacts', 'create', 18580, '', 'ΑΧΙΝΙΩΤΟΥ ΠΑΠΑΙΩΑΝΝΟΥ '),
(254, '2021-06-10 10:22:08', 2, 'contacts', 'create', 18581, '', 'ΑΧΙΝΙΩΤΟΥ ΠΑΠΑΙΩΑΝΝΟΥ '),
(255, '2021-06-10 10:24:04', 2, 'contacts', 'create', 18582, '', 'ΑΙΣΙΟΠΟΥΛΟΥ ΚΑΛΛΙΟΠΗ'),
(256, '2021-06-25 12:00:04', 2, 'contacts', 'create', 18583, '', 'ΑΝΑΣΤΑΣΙΑΔΗΣ ΑΓΙΣ'),
(257, '2021-06-25 12:06:07', 2, 'contacts', 'delete', 18583, 'ΑΝΑΣΤΑΣΙΑΔΗΣ ΑΓΙΣ', ''),
(258, '2021-06-25 12:07:28', 2, 'contacts', 'create', 18584, '', 'ΑΝΑΣΤΑΣΙΑΔΗΣ ΑΓΙΣ'),
(259, '2021-06-25 14:58:18', 2, 'contacts', 'create', 18585, '', 'ΠΑΛΑΤΙΑΝΟΥ ΦΩΤΕΙΝΗ'),
(260, '2021-07-23 12:18:31', 2, 'contacts', 'create', 18586, '', 'ΤΣΑΛΤΑΜΠΑΣΗ ΑΘΑΝΑΣΙΑ'),
(261, '2021-07-23 12:21:34', 2, 'contacts', 'create', 18587, '', 'ΑΞΙΑΣ ΠΡΟΤΑΣΗ'),
(262, '2021-07-23 12:27:45', 2, 'contacts', 'delete', 18581, 'ΑΧΙΝΙΩΤΟΥ ΠΑΠΑΙΩΑΝΝΟΥ ', ''),
(263, '2021-07-23 12:28:25', 2, 'contacts', 'delete', 18579, 'ΑΧΙΝΙΩΤΟΥ ΠΑΠΑΙΩΑΝΝΟΥ ', ''),
(264, '2021-08-17 12:04:48', 2, 'contacts', 'create', 18588, '', 'INOZEMTSEV GERMAN'),
(265, '2021-11-08 12:40:07', 2, 'contacts', 'create', 18589, '', 'ΚΥΡΟΥ ΝΕΚΤΑΡΙΟΣ'),
(266, '2021-11-16 11:21:55', 2, 'contacts', 'create', 18590, '', 'ΚΟΥΤΣΙΜΠΕΛΑ ΑΓΓΕΛΙΚΗ'),
(267, '2021-11-18 12:10:09', 2, 'contacts', 'create', 18591, '', 'ΛΗΜΝΙΔΟΥ ΠΟΛΥΞΕΝΗ'),
(268, '2021-11-18 12:13:33', 2, 'contacts', 'create', 18592, '', 'ΛΗΜΝΙΔΟΥ ΠΟΛΥΞΕΝΗ'),
(269, '2022-02-04 12:19:40', 6, 'contacts', 'create', 18593, '', 'BACHTS GREG');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `bookings`
--

CREATE TABLE `bookings` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer` int(10) UNSIGNED DEFAULT NULL,
  `property` int(10) UNSIGNED DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_starting` date DEFAULT NULL,
  `date_ending` date DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `paid` decimal(10,2) DEFAULT 0.00,
  `status` int(10) UNSIGNED DEFAULT NULL,
  `source` int(10) UNSIGNED DEFAULT NULL,
  `date_booked` date DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `synergatis` int(10) UNSIGNED DEFAULT NULL,
  `cleaning_fee` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `bookings_sources`
--

CREATE TABLE `bookings_sources` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `bookings_sources`
--

INSERT INTO `bookings_sources` (`id`, `name`) VALUES
(1, 'Airbnb'),
(2, 'Booking'),
(3, 'Ιστοσελίδα'),
(4, 'Σύσταση πελάτη'),
(5, 'Σύσταση γνωστού'),
(6, 'Google');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `bookings_statuses`
--

CREATE TABLE `bookings_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `bookings_statuses`
--

INSERT INTO `bookings_statuses` (`id`, `name`, `color`, `background`) VALUES
(1, 'Σε αναμονή', '#ffffff', '#303641'),
(2, 'Επιβεβαιώθηκε', '#000000', '#cccccc'),
(3, 'Check-in', '#ffffff', '#21a9e1'),
(4, 'Ολοκληρώθηκε', '#ffffff', '#00a651'),
(5, 'Ακυρώθηκε', '#ffffff', '#cc2424');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `calendar`
--

CREATE TABLE `calendar` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED DEFAULT NULL,
  `contact` int(10) UNSIGNED DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_notified` datetime DEFAULT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT 0 COMMENT '0=awaiting,1=completed, 2=cancelled',
  `assign_to` int(10) UNSIGNED NOT NULL,
  `all_day` tinyint(4) NOT NULL DEFAULT 0,
  `store` int(10) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `date_created` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `iban` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `contacts`
--

INSERT INTO `contacts` (`id`, `user`, `name`, `surname`, `phone`, `mobile`, `email`, `address`, `info`, `country`, `date_created`, `status`, `iban`) VALUES
(18593, 6, 'GREG', 'BACHTS', '697251455', '', 'mail@gmail.com', 'ADDRESS', '', 'GR', '2022-02-04 12:19:40', 0, NULL);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `contacts_notes`
--

CREATE TABLE `contacts_notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED DEFAULT NULL,
  `contact` int(10) UNSIGNED DEFAULT NULL,
  `info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `code` varchar(2) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CK', 'Cook Islands'),
(51, 'CR', 'Costa Rica'),
(52, 'HR', 'Croatia (Hrvatska)'),
(53, 'CU', 'Cuba'),
(54, 'CY', 'Cyprus'),
(55, 'CZ', 'Czech Republic'),
(56, 'DK', 'Denmark'),
(57, 'DJ', 'Djibouti'),
(58, 'DM', 'Dominica'),
(59, 'DO', 'Dominican Republic'),
(60, 'TP', 'East Timor'),
(61, 'EC', 'Ecuador'),
(62, 'EG', 'Egypt'),
(63, 'SV', 'El Salvador'),
(64, 'GQ', 'Equatorial Guinea'),
(65, 'ER', 'Eritrea'),
(66, 'EE', 'Estonia'),
(67, 'ET', 'Ethiopia'),
(68, 'FK', 'Falkland Islands (Malvinas)'),
(69, 'FO', 'Faroe Islands'),
(70, 'FJ', 'Fiji'),
(71, 'FI', 'Finland'),
(72, 'FR', 'France'),
(73, 'FX', 'France, Metropolitan'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GK', 'Guernsey'),
(84, 'GR', 'Ελλάδα'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'IM', 'Isle of Man'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran (Islamic Republic of)'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'CI', 'Ivory Coast'),
(108, 'JE', 'Jersey'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People\'s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People\'s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macau'),
(130, 'MK', 'Macedonia'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'TY', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States of'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestine'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'KN', 'Saint Kitts and Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'VC', 'Saint Vincent and the Grenadines'),
(187, 'WS', 'Samoa'),
(188, 'SM', 'San Marino'),
(189, 'ST', 'Sao Tome and Principe'),
(190, 'SA', 'Saudi Arabia'),
(191, 'SN', 'Senegal'),
(192, 'RS', 'Serbia'),
(193, 'SC', 'Seychelles'),
(194, 'SL', 'Sierra Leone'),
(195, 'SG', 'Singapore'),
(196, 'SK', 'Slovakia'),
(197, 'SI', 'Slovenia'),
(198, 'SB', 'Solomon Islands'),
(199, 'SO', 'Somalia'),
(200, 'ZA', 'South Africa'),
(201, 'GS', 'South Georgia South Sandwich Islands'),
(202, 'ES', 'Spain'),
(203, 'LK', 'Sri Lanka'),
(204, 'SH', 'St. Helena'),
(205, 'PM', 'St. Pierre and Miquelon'),
(206, 'SD', 'Sudan'),
(207, 'SR', 'Suriname'),
(208, 'SJ', 'Svalbard and Jan Mayen Islands'),
(209, 'SZ', 'Swaziland'),
(210, 'SE', 'Sweden'),
(211, 'CH', 'Switzerland'),
(212, 'SY', 'Syrian Arab Republic'),
(213, 'TW', 'Taiwan'),
(214, 'TJ', 'Tajikistan'),
(215, 'TZ', 'Tanzania, United Republic of'),
(216, 'TH', 'Thailand'),
(217, 'TG', 'Togo'),
(218, 'TK', 'Tokelau'),
(219, 'TO', 'Tonga'),
(220, 'TT', 'Trinidad and Tobago'),
(221, 'TN', 'Tunisia'),
(222, 'TR', 'Turkey'),
(223, 'TM', 'Turkmenistan'),
(224, 'TC', 'Turks and Caicos Islands'),
(225, 'TV', 'Tuvalu'),
(226, 'UG', 'Uganda'),
(227, 'UA', 'Ukraine'),
(228, 'AE', 'United Arab Emirates'),
(229, 'GB', 'United Kingdom'),
(230, 'US', 'United States'),
(231, 'UM', 'United States minor outlying islands'),
(232, 'UY', 'Uruguay'),
(233, 'UZ', 'Uzbekistan'),
(234, 'VU', 'Vanuatu'),
(235, 'VA', 'Vatican City State'),
(236, 'VE', 'Venezuela'),
(237, 'VN', 'Vietnam'),
(238, 'VG', 'Virgin Islands (British)'),
(239, 'VI', 'Virgin Islands (U.S.)'),
(240, 'WF', 'Wallis and Futuna Islands'),
(241, 'EH', 'Western Sahara'),
(242, 'YE', 'Yemen'),
(243, 'ZR', 'Zaire'),
(244, 'ZM', 'Zambia'),
(245, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `date_created` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `iban` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `customers_notes`
--

CREATE TABLE `customers_notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED DEFAULT NULL,
  `contact` int(10) UNSIGNED DEFAULT NULL,
  `info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `property` int(10) UNSIGNED DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ordernum` smallint(5) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `login_history`
--

CREATE TABLE `login_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `date_logged` datetime NOT NULL COMMENT 'The date and time the user logged in.',
  `browser` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The browser that he used.',
  `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'His IP address.',
  `user` int(10) UNSIGNED NOT NULL COMMENT 'The id of the user',
  `type` int(11) NOT NULL COMMENT 'The type of login. 0 = failed, 1 = success',
  `last_online` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Logs of user logins';

--
-- Άδειασμα δεδομένων του πίνακα `login_history`
--

INSERT INTO `login_history` (`id`, `date_logged`, `browser`, `ip`, `user`, `type`, `last_online`) VALUES
(550, '2022-01-28 13:11:43', 'Opera on Windows 10', '91.140.91.129', 1, 1, '2022-01-28 13:27:40'),
(551, '2022-01-28 13:22:38', 'Google Chrome on Windows 10', '91.140.91.129', 1, 1, '2022-01-28 13:22:39'),
(552, '2022-02-02 14:28:26', 'Opera on Windows 10', '91.140.91.9', 1, 1, '2022-02-02 15:01:03'),
(553, '2022-02-02 14:31:46', 'Google Chrome on Windows 10', '188.117.228.132', 6, 1, '2022-02-02 15:08:47'),
(554, '2022-02-02 14:50:47', 'Google Chrome on Windows 10', '79.166.194.106', 6, 1, '2022-02-02 14:56:22'),
(555, '2022-02-03 09:19:38', 'Google Chrome on Windows 10', '::1', 6, 1, '2022-02-03 17:02:08'),
(556, '2022-02-03 09:38:12', 'Google Chrome on Windows 10', '::1', 6, 1, '2022-02-03 09:38:14'),
(557, '2022-02-03 11:05:29', 'Google Chrome on Windows 10', '192.168.100.129', 6, 1, '2022-02-03 11:38:04'),
(558, '2022-02-04 09:44:10', 'Google Chrome on Windows 10', '::1', 6, 1, '2022-02-04 17:01:16'),
(559, '2022-02-04 12:52:52', 'Google Chrome on Windows 10', '::1', 6, 1, '2022-02-04 12:54:32'),
(560, '2022-02-07 10:11:14', 'Google Chrome on Windows 10', '::1', 6, 1, '2022-02-07 10:46:38'),
(561, '2022-02-07 10:46:43', 'Google Chrome on Windows 10', '::1', 6, 1, '2022-02-07 10:49:13'),
(562, '2022-02-07 10:49:18', 'Google Chrome on Windows 10', '::1', 6, 1, '2022-02-07 10:50:48'),
(563, '2022-02-07 10:51:05', 'Google Chrome on Windows 10', '::1', 6, 1, '2022-02-07 10:53:33'),
(564, '2022-02-07 10:53:45', 'Google Chrome on Windows 10', '::1', 6, 1, '2022-02-07 15:53:01'),
(565, '2022-02-07 16:56:02', 'Google Chrome on Windows 10', '::1', 6, 1, '2022-02-07 16:59:20'),
(566, '2022-02-08 09:14:55', 'Google Chrome on Windows 10', '127.0.0.1', 6, 1, '2022-02-08 15:06:25'),
(567, '2022-02-09 09:20:31', 'Google Chrome on Windows 10', '127.0.0.1', 6, 1, '2022-02-09 13:04:34'),
(568, '2022-02-09 11:25:50', 'Google Chrome on Windows 10', '::1', 6, 1, '2022-02-09 11:25:52'),
(569, '2022-02-09 13:06:11', 'Google Chrome on Windows 10', '::1', 6, 1, '2022-02-09 17:00:19'),
(570, '2022-02-10 10:26:01', 'Google Chrome on Windows 10', '::1', 6, 1, '2022-02-10 11:40:54'),
(571, '2022-02-10 11:58:04', 'Google Chrome on Windows 10', '::1', 6, 1, '2022-02-10 15:11:19'),
(572, '2022-02-14 11:08:41', 'Google Chrome on Windows 10', '::1', 6, 1, '2022-02-14 11:31:01'),
(573, '2022-02-14 12:20:35', 'Google Chrome on Windows 10', '::1', 6, 1, '2022-02-14 13:07:01');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `privs`
--

CREATE TABLE `privs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `privs`
--

INSERT INTO `privs` (`id`, `name`) VALUES
(1, 'add_contacts'),
(2, 'view_contacts'),
(3, 'edit_contacts'),
(4, 'delete_contacts'),
(5, 'add_users'),
(6, 'view_users'),
(7, 'edit_users'),
(8, 'view_notes'),
(9, 'add_notes'),
(10, 'edit_notes'),
(11, 'delete_notes'),
(12, 'view_properties'),
(13, 'edit_property'),
(14, 'view_metrics'),
(15, 'add_metrics'),
(16, 'edit_metrics'),
(17, 'delete_metrics'),
(18, 'view_calendar'),
(19, 'add_calendar'),
(20, 'edit_calendar'),
(21, 'delete_calendar'),
(22, 'view_tasks'),
(23, 'delete_tasks'),
(24, 'add_tasks'),
(25, 'edit_tasks'),
(26, 'view_notes'),
(27, 'add_notes'),
(28, 'edit_notes'),
(29, 'delete_notes');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `properties`
--

CREATE TABLE `properties` (
  `id` int(10) UNSIGNED NOT NULL,
  `contact` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) UNSIGNED NOT NULL,
  `init_price` decimal(10,2) UNSIGNED NOT NULL,
  `prev_price` decimal(10,2) UNSIGNED NOT NULL,
  `nights` int(10) UNSIGNED NOT NULL,
  `price_per_night` decimal(10,2) NOT NULL,
  `check_in` datetime DEFAULT NULL,
  `check_out` datetime DEFAULT NULL,
  `season_price` decimal(10,2) NOT NULL,
  `fee_label` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee_amount` decimal(10,2) NOT NULL,
  `fee_type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=fixed,1=percentage',
  `cal_price` decimal(3,2) NOT NULL,
  `taxis` decimal(3,2) NOT NULL,
  `service_fee` decimal(3,2) NOT NULL,
  `guests_capacity` int(10) NOT NULL,
  `extra_guests` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=yes,1=no',
  `price_per_extra_person` decimal(3,2) NOT NULL,
  `staying_nights` int(10) NOT NULL,
  `clild_as_adult` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=yes,1=no',
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `floor` int(255) UNSIGNED DEFAULT NULL,
  `type` int(10) UNSIGNED DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `double_beds` tinyint(3) UNSIGNED DEFAULT NULL,
  `single_beds` tinyint(3) UNSIGNED DEFAULT NULL,
  `sofa_beds` tinyint(3) UNSIGNED DEFAULT NULL,
  `udults` tinyint(3) UNSIGNED DEFAULT NULL,
  `children` tinyint(3) UNSIGNED DEFAULT NULL,
  `kitchen` tinyint(3) UNSIGNED DEFAULT NULL,
  `pets` tinyint(3) UNSIGNED DEFAULT 0,
  `info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pososto_diaxeirisis` decimal(10,2) DEFAULT 0.00,
  `epivarynsi_idioktiti` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `properties`
--

INSERT INTO `properties` (`id`, `contact`, `title`, `address`, `postal`, `country`, `city`, `price`, `init_price`, `prev_price`, `nights`, `price_per_night`, `check_in`, `check_out`, `season_price`, `fee_label`, `fee_amount`, `fee_type`, `cal_price`, `taxis`, `service_fee`, `guests_capacity`, `extra_guests`, `price_per_extra_person`, `staying_nights`, `clild_as_adult`, `latitude`, `longitude`, `date_created`, `status`, `floor`, `type`, `size`, `double_beds`, `single_beds`, `sofa_beds`, `udults`, `children`, `kitchen`, `pets`, `info`, `pososto_diaxeirisis`, `epivarynsi_idioktiti`) VALUES
(62, 0, 'title', 'Agou ', '54456', 'GR', 'Thessalonikh', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '15', '12.2', '2022-02-03 14:14:57', 1, 2, 1, 65, 2, 3, 1, 0, 0, 0, 1, '', '0.00', 0),
(63, 0, 'title', 'Agou ', '54456', 'GR', 'Thessalonikh', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '15', '12.2', '2022-02-03 14:15:27', 1, 2, 1, 65, 2, 3, 1, 0, 0, 0, 1, '', '0.00', 0),
(92, 0, 't', 'Ελλησπόντου 15', '63077', 'GR', 'Καλλιθέα', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '40.07272449999999', '23.4475175', '2022-02-03 16:57:14', 1, 1, 1, 0, 1, 0, 1, 1, 2, 1, 0, '', '0.00', 0),
(93, 18593, 'somw titile', 'address', '45664', 'GR', 'Thessalonikh', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '45', '452', '2022-02-04 12:20:22', 1, 2, 1, 45, 3, 2, 0, 2, 1, 0, 0, '', '0.00', 0),
(139, 18593, 'new home', 'StubičkaSlatina 139', 'HR', 'GR', 'Oroslavje', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '45.9770939', '15.8772417', '2022-02-07 12:29:53', 1, 25, 5, 120, 4, 5, 2, 3, 3, 1, 1, '', '0.00', 0),
(140, 18593, 'NEW TITLE', 'Σαντορίνη Θήρα', '45221', 'GR', 'GR', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '36.4166485', '25.432447', '2022-02-07 12:30:31', 1, 2, 3, 26, 1, 0, 3, 0, 0, 1, 1, '', '0.00', 0),
(141, 18593, 'NEW TITLE', 'Σαντορίνη Θήρα', '45221', 'GR', 'GR', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '36.4166485', '25.432447', '2022-02-07 12:31:00', 1, 2, 3, 26, 1, 0, 3, 0, 0, 1, 1, '', '0.00', 0),
(142, 18593, 'NEW TITLE', 'Σαντορίνη Θήρα', '45221', 'GR', 'GR', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '36.4166485', '25.432447', '2022-02-07 12:31:07', 1, 2, 3, 26, 1, 0, 3, 0, 0, 1, 1, '', '0.00', 0),
(143, 18593, 'again', 'ECherokeeSt 104', 'US', 'GR', 'Blacksburg', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '35.12130389999999', '-81.5150785', '2022-02-07 12:31:40', 1, 2, 3, 645, 4, 1, 2, 1, 2, 0, 1, '', '0.00', 0),
(144, 18593, 'again', 'ECherokeeSt 104', 'US', 'GR', 'Blacksburg', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '35.12130389999999', '-81.5150785', '2022-02-07 12:40:24', 1, 2, 3, 645, 4, 1, 2, 1, 2, 0, 1, '', '0.00', 0),
(145, 18593, 'again', 'ECherokeeSt 104', 'US', 'GR', 'Blacksburg', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '35.12130389999999', '-81.5150785', '2022-02-07 12:40:39', 1, 2, 3, 645, 4, 1, 2, 1, 2, 0, 1, '', '0.00', 0),
(146, 18593, 'test', 'RambladeCatalunya 45', 'ES', 'GR', 'Barcelona', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '41.3901814', '2.164188499999999', '2022-02-07 12:41:13', 1, 2, 1, 2, 1, 0, 1, 1, 1, 0, 1, '', '0.00', 0),
(147, 18593, 'test', 'RambladeCatalunya 45', 'ES', 'GR', 'Barcelona', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '41.3901814', '2.164188499999999', '2022-02-07 12:43:31', 1, 2, 1, 2, 1, 0, 1, 1, 1, 0, 1, '', '0.00', 0),
(148, 18593, 'test', 'RambladeCatalunya 45', 'ES', 'GR', 'Barcelona', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '41.3901814', '2.164188499999999', '2022-02-07 12:44:56', 1, 2, 1, 2, 1, 0, 1, 1, 1, 0, 1, '', '0.00', 0),
(149, 18593, 'test', 'RambladeCatalunya 45', 'ES', 'GR', 'Barcelona', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '41.3901814', '2.164188499999999', '2022-02-07 12:45:01', 1, 2, 1, 2, 1, 0, 1, 1, 1, 0, 1, '', '0.00', 0),
(150, 18593, 'test', 'RambladeCatalunya 45', 'ES', 'GR', 'Barcelona', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '41.3901814', '2.164188499999999', '2022-02-07 12:46:01', 1, 2, 1, 2, 1, 0, 1, 1, 1, 0, 1, '', '0.00', 0),
(151, 18593, 'test', 'RambladeCatalunya 45', 'ES', 'GR', 'Barcelona', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '41.3901814', '2.164188499999999', '2022-02-07 12:46:16', 1, 2, 1, 2, 1, 0, 1, 1, 1, 0, 1, '', '0.00', 0),
(152, 18593, 'test', 'RambladeCatalunya 45', 'ES', 'GR', 'Barcelona', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '41.3901814', '2.164188499999999', '2022-02-07 12:51:42', 1, 2, 1, 2, 1, 0, 1, 1, 1, 0, 1, '', '0.00', 0),
(153, 18593, 'test', 'RambladeCatalunya 45', 'ES', 'GR', 'Barcelona', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '41.3901814', '2.164188499999999', '2022-02-07 12:52:14', 1, 2, 1, 2, 1, 0, 1, 1, 1, 0, 1, '', '0.00', 0),
(154, 18593, 'test', 'RambladeCatalunya 45', 'ES', 'GR', 'Barcelona', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '41.3901814', '2.164188499999999', '2022-02-07 12:52:37', 1, 2, 1, 2, 1, 0, 1, 1, 1, 0, 1, '', '0.00', 0),
(155, 18593, 'test', 'RambladeCatalunya 45', 'ES', 'GR', 'Barcelona', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '41.3901814', '2.164188499999999', '2022-02-07 12:53:11', 1, 2, 1, 2, 1, 0, 1, 1, 1, 0, 1, '', '0.00', 0),
(156, 18593, 'test', 'RambladeCatalunya 45', 'ES', 'GR', 'Barcelona', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '41.3901814', '2.164188499999999', '2022-02-07 12:53:28', 1, 2, 1, 2, 1, 0, 1, 1, 1, 0, 1, '', '0.00', 0),
(157, 18593, 'test', 'RambladeCatalunya 45', 'ES', 'GR', 'Barcelona', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '41.3901814', '2.164188499999999', '2022-02-07 12:53:59', 1, 2, 1, 2, 1, 0, 1, 1, 1, 0, 1, '', '0.00', 0),
(158, 18593, 'test', 'RambladeCatalunya 45', 'ES', 'GR', 'Barcelona', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '41.3901814', '2.164188499999999', '2022-02-07 12:55:02', 1, 2, 1, 2, 1, 0, 1, 1, 1, 0, 1, '', '0.00', 0),
(159, 18593, 'test', 'RambladeCatalunya 45', 'ES', 'GR', 'Barcelona', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '41.3901814', '2.164188499999999', '2022-02-07 13:07:53', 1, 2, 1, 2, 1, 0, 1, 1, 1, 0, 1, '', '0.00', 0),
(160, 18593, 'vdf', 'Faisalabad Φαϊζαλαμπάντ', '56', 'GR', 'Παντζάμπ', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '31.45036619999999', '73.13496049999999', '2022-02-07 13:08:18', 1, 3, 1, 5, 1, 2, 4, 2, 1, 0, 0, '', '0.00', 0),
(161, 18593, 'dsfsa', 'ViaAnticaGrugliasco 7', 'Piemonte', 'GR', 'Rivoli', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '45.0712438', '7.5539701', '2022-02-07 13:08:50', 1, 3, 4, 546, 3, 3, 2, 1, 1, 0, 0, '', '0.00', 0),
(162, 18593, 'tqre', 'Ιλ-ε-Βιλαίν Ρεν', '63077', 'GR', 'Βρετάνη', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '48.117266', '-1.6777926', '2022-02-07 13:09:47', 1, 4, 4, 15263, 3, 1, 2, 2, 1, 0, 1, '', '0.00', 0),
(163, 18593, 'tqre', 'Ιλ-ε-Βιλαίν Ρεν', '63077', 'GR', 'Βρετάνη', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '48.117266', '-1.6777926', '2022-02-07 13:10:51', 1, 4, 4, 15263, 3, 1, 2, 2, 1, 0, 1, '', '0.00', 0),
(164, 18593, 'tqre', 'Ιλ-ε-Βιλαίν Ρεν', '63077', 'GR', 'Βρετάνη', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '48.117266', '-1.6777926', '2022-02-07 13:11:02', 1, 4, 4, 15263, 3, 1, 2, 2, 1, 0, 1, '', '0.00', 0),
(165, 18593, 'tqre', 'Ιλ-ε-Βιλαίν Ρεν', '63077', 'GR', 'Βρετάνη', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '48.117266', '-1.6777926', '2022-02-07 13:11:06', 1, 4, 4, 15263, 3, 1, 2, 2, 1, 0, 1, '', '0.00', 0),
(166, 18593, 'test 1', 'Laval-Pradel vfd', '30110', 'GR', 'Gard', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '44.1968319', '4.0721007', '2022-02-07 13:13:42', 1, 3, 1, 45, 3, 1, 1, 1, 0, 0, 0, '', '0.00', 0),
(167, 18593, 'test 1', 'Laval-Pradel vfd', '30110', 'GR', 'Gard', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '44.1968319', '4.0721007', '2022-02-07 13:16:23', 1, 3, 1, 45, 3, 1, 1, 1, 0, 0, 0, '', '0.00', 0),
(168, 18593, 'test', 'Χαλκιδική Αγ.Νικόλαος', '17431`', 'GR', 'GR', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '40.2488839', '23.695265', '2022-02-07 15:52:59', 1, 2, 2, 17, 0, 0, 0, 0, 0, 1, 1, '', '0.00', 0),
(169, 18593, 'test', 'Ελλησπόντου 3', '63077', 'GR', 'Καλλιθέα', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '40.0737586', '23.4486092', '2022-02-08 09:36:26', 1, 2, 1, 56, 2, 0, 0, 0, 0, 1, 0, '', '0.00', 0),
(170, 18593, 'test', 'Ελλησπόντου 3', '63077', 'GR', 'Καλλιθέα', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '40.0737586', '23.4486092', '2022-02-08 09:39:04', 1, 2, 1, 56, 2, 0, 0, 0, 0, 1, 0, '', '0.00', 0),
(171, 18593, 'test', 'Ελλησπόντου 3', '63077', 'GR', 'Καλλιθέα', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '40.0737586', '23.4486092', '2022-02-08 09:40:09', 1, 2, 1, 56, 2, 0, 0, 0, 0, 1, 0, '', '0.00', 0),
(172, 18593, 'test', 'Ελλησπόντου 3', '63077', 'GR', 'Καλλιθέα', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '40.0737586', '23.4486092', '2022-02-08 09:42:15', 1, 2, 1, 56, 2, 0, 0, 0, 0, 1, 0, '', '0.00', 0),
(173, 18593, 'test', 'Ελλησπόντου 3', '63077', 'GR', 'Καλλιθέα', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '40.0737586', '23.4486092', '2022-02-08 09:43:33', 1, 2, 1, 56, 2, 0, 0, 0, 0, 1, 0, '', '0.00', 0),
(174, 18593, 'test', 'Ελλησπόντου 3', '63077', 'GR', 'Καλλιθέα', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '40.0737586', '23.4486092', '2022-02-08 09:43:37', 1, 2, 1, 56, 2, 0, 0, 0, 0, 1, 0, '', '0.00', 0),
(175, 18593, 'test', 'Ελλησπόντου 3', '63077', 'GR', 'Καλλιθέα', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '40.0737586', '23.4486092', '2022-02-08 09:44:19', 1, 2, 1, 56, 2, 0, 0, 0, 0, 1, 0, '', '0.00', 0),
(176, 18593, 'test', 'Ελλησπόντου 3', '63077', 'GR', 'Καλλιθέα', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '40.0737586', '23.4486092', '2022-02-08 09:44:45', 1, 2, 1, 56, 2, 0, 0, 0, 0, 1, 0, '', '0.00', 0),
(177, 18593, 'test', 'Ομήρου 6', '63077', 'GR', 'Καλλιθέα', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '40.0734757', '23.4477743', '2022-02-08 09:46:28', 1, 1, 2, 56, 0, 0, 0, 0, 2, 0, 0, '', '0.00', 0),
(178, 18593, 'test', 'Ομήρου 6', '63077', 'GR', 'Καλλιθέα', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '40.0734757', '23.4477743', '2022-02-08 09:48:29', 1, 1, 2, 56, 0, 0, 0, 0, 2, 0, 0, '', '0.00', 0),
(180, 18593, NULL, 'Agou Dimitriou', '54635', 'GR', 'Thessalonikh', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '4', '456', '2022-02-08 09:50:23', 1, 1, 1, 45, 2, 0, 1, 0, 1, 0, 0, '', '0.00', 0),
(181, 18593, NULL, 'Πειραιώς 254', '17778', 'GR', 'ΤαύροςΑττικής', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '37.96247829999999', '23.6909809', '2022-02-08 09:51:15', 1, 2, 1, 5, 0, 1, 0, 1, 1, 0, 0, '', '0.00', 0),
(182, 18593, NULL, 'Πειραιώς 254', '17778', 'GR', 'ΤαύροςΑττικής', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '37.96247829999999', '23.6909809', '2022-02-08 09:51:31', 1, 2, 1, 5, 0, 1, 0, 1, 1, 0, 0, '', '0.00', 0),
(183, 18593, NULL, 'Πειραιώς 254', '17778', 'GR', 'ΤαύροςΑττικής', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '37.96247829999999', '23.6909809', '2022-02-08 09:52:34', 1, 2, 1, 5, 0, 1, 0, 1, 1, 0, 0, '', '0.00', 0),
(184, 18593, NULL, 'Πειραιώς 254', '17778', 'GR', 'ΤαύροςΑττικής', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '37.96247829999999', '23.6909809', '2022-02-08 09:52:42', 1, 2, 1, 5, 0, 1, 0, 1, 1, 0, 0, '', '0.00', 0),
(185, 18593, NULL, 'Πειραιώς 254', '17778', 'GR', 'ΤαύροςΑττικής', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '37.96247829999999', '23.6909809', '2022-02-08 09:55:19', 1, 2, 1, 5, 0, 1, 0, 1, 1, 0, 0, '', '0.00', 0),
(186, 18593, NULL, 'Κόνωνος 54-56', '11633', 'GR', 'Αθήνα', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '37.9675001', '23.7529695', '2022-02-08 09:55:53', 1, 3, 2, 547, 1, 0, 0, 1, 1, 0, 1, '', '0.00', 0),
(187, 18593, NULL, 'Κόνωνος 54-56', '11633', 'GR', 'Αθήνα', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '37.9675001', '23.7529695', '2022-02-08 09:57:18', 1, 3, 2, 547, 1, 0, 0, 1, 1, 0, 1, '', '0.00', 0),
(188, 18593, NULL, 'Κόνωνος 54-56', '11633', 'GR', 'Αθήνα', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '37.9675001', '23.7529695', '2022-02-08 09:57:24', 1, 3, 2, 547, 1, 0, 0, 1, 1, 0, 1, '', '0.00', 0),
(189, 18593, NULL, 'Κόνωνος 54-56', '11633', 'GR', 'Αθήνα', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '37.9675001', '23.7529695', '2022-02-08 09:57:39', 1, 3, 2, 547, 1, 0, 0, 1, 1, 0, 1, '', '0.00', 0),
(190, 18593, NULL, 'Κόνωνος 54-56', '11633', 'GR', 'Αθήνα', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '37.9675001', '23.7529695', '2022-02-08 09:57:51', 1, 3, 2, 547, 1, 0, 0, 1, 1, 0, 1, '', '0.00', 0),
(191, 18593, NULL, 'Neunkirchen 57290', 'DE', 'GR', 'Siegen-Wittgenstein', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '50.78995', '8.0053568', '2022-02-08 09:58:20', 1, 2, 2, 54, 1, 1, 2, 1, 2, 1, 0, '', '0.00', 0),
(192, 18593, NULL, 'Neunkirchen 57290', 'DE', 'GR', 'Siegen-Wittgenstein', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '50.78995', '8.0053568', '2022-02-08 09:59:34', 1, 2, 2, 54, 1, 1, 2, 1, 2, 1, 0, '', '0.00', 0),
(193, 18593, NULL, 'Agou Dimitriou', '54635', 'GR', 'Thessalonikh', '0.00', '0.00', '0.00', 0, '0.00', NULL, NULL, '0.00', '', '0.00', 0, '0.00', '0.00', '0.00', 0, 0, '0.00', 0, 0, '5', '5', '2022-02-08 10:00:07', 1, 2, 1, 5, 0, 0, 1, 0, 0, 0, 0, '', '0.00', 0),
(194, 18593, 'FAS', 'Τζακάρτα Τζακάρτα', '78545', 'GR', 'ID', '78.00', '78.00', '89.00', 7878, '78.00', '2022-02-14 00:00:00', '2022-02-14 00:00:00', '78.00', '89', '89.00', 0, '7.00', '9.99', '9.99', 456, 0, '9.99', 564, 0, '-6.2087634', '106.845599', '2022-02-14 12:25:58', 1, 1, 1, 78, 0, 0, 0, 0, 0, 0, 0, '', '0.00', 0),
(195, 18593, 'FAS', 'Τζακάρτα Τζακάρτα', '78545', 'GR', 'ID', '78.00', '78.00', '89.00', 7878, '78.00', '2022-02-14 00:00:00', '2022-02-14 00:00:00', '78.00', '89', '89.00', 0, '7.00', '9.99', '9.99', 456, 0, '9.99', 564, 0, '-6.2087634', '106.845599', '2022-02-14 12:49:40', 1, 1, 1, 78, 0, 0, 0, 0, 0, 0, 0, '', '0.00', 0);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `properties_notes`
--

CREATE TABLE `properties_notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED DEFAULT NULL,
  `info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `property` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `property_floors`
--

CREATE TABLE `property_floors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `property_floors`
--

INSERT INTO `property_floors` (`id`, `name`) VALUES
(1, 'Υπόγειο'),
(2, 'Ημιυπόγειο'),
(3, 'Ισόγειο'),
(4, 'Ημιόροφος'),
(5, '1ος'),
(6, '1ος υπερυψωμένος'),
(7, '2ος'),
(8, '3ος'),
(9, '4ος'),
(10, '5ος'),
(11, '6ος'),
(12, '7ος'),
(13, '8ος'),
(14, '9ος'),
(15, '10ος'),
(16, '11ος'),
(17, '12ος'),
(18, '13ος'),
(19, '14ος'),
(20, '15ος'),
(21, '16ος'),
(22, '17ος'),
(23, '18ος'),
(24, '19ος'),
(25, '20ος');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `property_types`
--

CREATE TABLE `property_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `property_types`
--

INSERT INTO `property_types` (`id`, `name`) VALUES
(1, 'Διαμέρισμα'),
(2, 'Στούντιο'),
(3, 'Γκαρσονιέρα'),
(4, 'Βίλα'),
(5, 'Μεζονέτα'),
(6, 'Σοφίτα');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `stores`
--

CREATE TABLE `stores` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `stores`
--

INSERT INTO `stores` (`id`, `name`) VALUES
(1, 'Thessaloniki'),
(2, 'Athens');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `deadline` datetime DEFAULT NULL,
  `date_completed` datetime DEFAULT NULL,
  `recipients` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contacts` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `transaction`
--

CREATE TABLE `transaction` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` int(10) NOT NULL DEFAULT 0 COMMENT '0=income, 1=expenses',
  `category` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `amount` float UNSIGNED NOT NULL,
  `payed_amount` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `transaction`
--

INSERT INTO `transaction` (`id`, `type`, `category`, `description`, `amount`, `payed_amount`) VALUES
(21, 0, '2', 'description', 500, 50),
(22, 0, '3', 'description', 123, 0),
(23, 0, '2', 'des', 50, 0),
(24, 1, '1', 'des', 456, 0),
(25, 1, '2', 'description', 456, 0),
(26, 1, '1', 'description', 5, 0),
(27, 1, '3', 'description1', 1, 0),
(40, 0, '2', 'income', 555, 0),
(41, 0, '1', 'income', 222, 0),
(56, 1, '1', 'description12112', 12, 0),
(57, 1, '1', 'gsfd', 45, 555),
(58, 0, '3', 'description', 15, 15),
(59, 0, '2', 'description', 4, 0),
(60, 0, '2', 'description', 4, 0),
(61, 0, '1', '15', 15, 0),
(62, 0, '1', 'description123', 50, 0),
(63, 1, '1', 'description1236', 50, 0);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `usergroups`
--

CREATE TABLE `usergroups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `usergroups`
--

INSERT INTO `usergroups` (`id`, `name`) VALUES
(1, 'Administrators'),
(2, 'Users');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `usergroups_access`
--

CREATE TABLE `usergroups_access` (
  `id` int(10) UNSIGNED NOT NULL,
  `usergroup` int(10) UNSIGNED NOT NULL,
  `privs` int(10) UNSIGNED NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `usergroups_access`
--

INSERT INTO `usergroups_access` (`id`, `usergroup`, `privs`, `value`) VALUES
(1, 1, 1, 1),
(3, 1, 2, 1),
(4, 1, 3, 1),
(5, 1, 4, 1),
(7, 1, 5, 1),
(8, 1, 6, 1),
(9, 1, 7, 1),
(10, 1, 8, 1),
(11, 1, 9, 1),
(12, 1, 10, 1),
(13, 1, 11, 1),
(14, 1, 12, 1),
(15, 1, 13, 1),
(16, 1, 14, 1),
(17, 1, 15, 1),
(18, 1, 16, 1),
(19, 1, 17, 1),
(20, 1, 18, 1),
(21, 1, 19, 1),
(22, 1, 20, 1),
(23, 1, 21, 1),
(24, 1, 22, 1),
(25, 1, 23, 1),
(27, 1, 24, 1),
(28, 1, 25, 1),
(29, 1, 26, 1),
(30, 1, 27, 1),
(31, 1, 28, 1),
(32, 1, 29, 1),
(33, 2, 1, 1),
(34, 2, 2, 1),
(35, 2, 3, 1),
(36, 2, 4, 1),
(37, 2, 5, 0),
(38, 2, 6, 0),
(39, 2, 7, 0),
(40, 2, 8, 1),
(41, 2, 9, 1),
(42, 2, 10, 1),
(43, 2, 11, 1),
(44, 2, 12, 1),
(45, 2, 13, 1),
(46, 2, 14, 1),
(47, 2, 15, 1),
(48, 2, 16, 1),
(49, 2, 17, 1),
(50, 2, 18, 1),
(51, 2, 19, 1),
(52, 2, 20, 1),
(53, 2, 21, 1),
(54, 2, 22, 1),
(55, 2, 23, 1),
(56, 2, 24, 1),
(57, 2, 25, 1),
(58, 2, 26, 1),
(59, 2, 27, 1),
(60, 2, 28, 1),
(61, 2, 29, 1);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `auth_hash` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Used for login and session authentication.',
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'The name of the user',
  `surname` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'The surname of the user',
  `date_created` datetime NOT NULL COMMENT 'The date and time that the user was created.',
  `email` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The email of the user.',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The password of the user.',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT 9,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usergroup` int(10) UNSIGNED DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store` int(10) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='The users table.';

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id`, `auth_hash`, `name`, `surname`, `date_created`, `email`, `password`, `avatar`, `status`, `username`, `mobile`, `reset_code`, `lang`, `usergroup`, `color`, `store`) VALUES
(1, '4FJOEJHADOXW4MW7YQAW35PALI5YQLDN', 'Aris', 'Kesidis', '2018-06-23 07:30:13', 'kesidis.aris@gmail.com\r\n', '$2y$10$2IaZkVSSbhsGNAF3ny.UxuttSG0.tuTYQJ7itSTqM/0Mode6Stemy', 'thumb-1@2x.png', 1, 'kesidisaris', '6988612132', '36113', 'el', 1, '#8080ff', 1),
(5, '7ONDEJWJKKNQK6AAE55HREF6C4UQ5RVD', 'sakis', 'Kourtis', '2022-01-28 10:57:21', 'kourtis.s@gmail.com', '$2y$10$cQWUIjThJcsgz5Lex6PkC.yGh2aouq9xpLrugPiVa4YJ6n4hOOPw2', NULL, 1, 'sakis', '69848318000', NULL, 'el', 1, NULL, 1),
(6, 'ERY5ANPPRUUKABD5JN6O4ERCWRM6WKFG', 'greg', 'sur', '2022-02-02 14:31:31', 'baxtsevanosg@gmail.com', '123123', NULL, 1, 'gregoris', '6988488850', '72317', 'el', 1, NULL, 1);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users_verification`
--

CREATE TABLE `users_verification` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `authenticator` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Used for users 2_step authentication or for email verification at each signup.';

--
-- Άδειασμα δεδομένων του πίνακα `users_verification`
--

INSERT INTO `users_verification` (`id`, `user`, `authenticator`, `email`) VALUES
(1, 1, 'PEHMPSDNLXIOG65U', 93120);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `wall`
--

CREATE TABLE `wall` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` int(11) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `actions_log`
--
ALTER TABLE `actions_log`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `bookings_sources`
--
ALTER TABLE `bookings_sources`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `bookings_statuses`
--
ALTER TABLE `bookings_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cal_contact` (`contact`),
  ADD KEY `cal_user` (`user`);

--
-- Ευρετήρια για πίνακα `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_user` (`user`);

--
-- Ευρετήρια για πίνακα `contacts_notes`
--
ALTER TABLE `contacts_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notes_user` (`user`),
  ADD KEY `notes_contact` (`contact`);

--
-- Ευρετήρια για πίνακα `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_user` (`user`);

--
-- Ευρετήρια για πίνακα `customers_notes`
--
ALTER TABLE `customers_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notes_user` (`user`),
  ADD KEY `notes_contact` (`contact`);

--
-- Ευρετήρια για πίνακα `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_prop` (`property`);

--
-- Ευρετήρια για πίνακα `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Ind_114` (`type`) COMMENT 'Index the type of login.',
  ADD KEY `fkIdx_107` (`user`) USING BTREE;

--
-- Ευρετήρια για πίνακα `privs`
--
ALTER TABLE `privs`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `properties_notes`
--
ALTER TABLE `properties_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notes_user` (`user`),
  ADD KEY `properties_property` (`property`);

--
-- Ευρετήρια για πίνακα `property_floors`
--
ALTER TABLE `property_floors`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `property_types`
--
ALTER TABLE `property_types`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `usergroups`
--
ALTER TABLE `usergroups`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `usergroups_access`
--
ALTER TABLE `usergroups_access`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkIdx_237` (`usergroup`),
  ADD KEY `fkIdx_241` (`privs`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`auth_hash`),
  ADD KEY `id` (`id`),
  ADD KEY `Ind_103` (`username`(191)) USING BTREE COMMENT 'The index of the user emails used for login.';

--
-- Ευρετήρια για πίνακα `users_verification`
--
ALTER TABLE `users_verification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkIdx_251` (`user`) USING BTREE;

--
-- Ευρετήρια για πίνακα `wall`
--
ALTER TABLE `wall`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `actions_log`
--
ALTER TABLE `actions_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;

--
-- AUTO_INCREMENT για πίνακα `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT για πίνακα `bookings_sources`
--
ALTER TABLE `bookings_sources`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT για πίνακα `bookings_statuses`
--
ALTER TABLE `bookings_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT για πίνακα `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT για πίνακα `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18594;

--
-- AUTO_INCREMENT για πίνακα `contacts_notes`
--
ALTER TABLE `contacts_notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT για πίνακα `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT για πίνακα `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18449;

--
-- AUTO_INCREMENT για πίνακα `customers_notes`
--
ALTER TABLE `customers_notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT για πίνακα `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT για πίνακα `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=574;

--
-- AUTO_INCREMENT για πίνακα `privs`
--
ALTER TABLE `privs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT για πίνακα `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT για πίνακα `properties_notes`
--
ALTER TABLE `properties_notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT για πίνακα `property_floors`
--
ALTER TABLE `property_floors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT για πίνακα `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT για πίνακα `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT για πίνακα `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT για πίνακα `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT για πίνακα `usergroups`
--
ALTER TABLE `usergroups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT για πίνακα `usergroups_access`
--
ALTER TABLE `usergroups_access`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT για πίνακα `users_verification`
--
ALTER TABLE `users_verification`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT για πίνακα `wall`
--
ALTER TABLE `wall`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `calendar`
--
ALTER TABLE `calendar`
  ADD CONSTRAINT `cal_contact` FOREIGN KEY (`contact`) REFERENCES `contacts` (`id`),
  ADD CONSTRAINT `cal_user` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Περιορισμοί για πίνακα `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_user` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Περιορισμοί για πίνακα `contacts_notes`
--
ALTER TABLE `contacts_notes`
  ADD CONSTRAINT `contacts_notes_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `notes_contact` FOREIGN KEY (`contact`) REFERENCES `contacts` (`id`);

--
-- Περιορισμοί για πίνακα `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Περιορισμοί για πίνακα `customers_notes`
--
ALTER TABLE `customers_notes`
  ADD CONSTRAINT `customers_notes_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `customers_notes_ibfk_2` FOREIGN KEY (`contact`) REFERENCES `customers` (`id`);

--
-- Περιορισμοί για πίνακα `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_prop` FOREIGN KEY (`property`) REFERENCES `properties` (`id`);

--
-- Περιορισμοί για πίνακα `login_history`
--
ALTER TABLE `login_history`
  ADD CONSTRAINT `FK_107` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Περιορισμοί για πίνακα `properties_notes`
--
ALTER TABLE `properties_notes`
  ADD CONSTRAINT `properties_notes_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `properties_property` FOREIGN KEY (`property`) REFERENCES `properties` (`id`);

--
-- Περιορισμοί για πίνακα `usergroups_access`
--
ALTER TABLE `usergroups_access`
  ADD CONSTRAINT `FK_237` FOREIGN KEY (`usergroup`) REFERENCES `usergroups` (`id`),
  ADD CONSTRAINT `FK_241` FOREIGN KEY (`privs`) REFERENCES `privs` (`id`);

--
-- Περιορισμοί για πίνακα `users_verification`
--
ALTER TABLE `users_verification`
  ADD CONSTRAINT `FK_251` FOREIGN KEY (`user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
