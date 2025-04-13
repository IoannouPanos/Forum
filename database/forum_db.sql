-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 13 Απρ 2025 στις 21:32:59
-- Έκδοση διακομιστή: 10.4.32-MariaDB
-- Έκδοση PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `forum_db`
--
CREATE DATABASE forum_db;
USE forum_db;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(14, 'johnn', 'john@24.com', '1234', 'user', '2025-04-12 18:24:38'),
(15, 'alex', 'alex@14.com', '1234', 'user', '2025-04-12 18:27:15'),
(17, 'panais', 'panais@14.com', '12345', 'admin', '2025-04-12 18:37:02'),
(18, 'john', 'john@example.com', '1234', 'user', '2025-04-13 18:40:47'),
(19, 'jane_smith', 'jane@example.com', '9999', 'user', '2025-04-13 18:40:47'),
(20, 'michael_brown', 'brown@example.com', 'pass', 'user', '2025-04-13 18:40:47'),
(21, 'admin_clark', 'clark@example.com', 'admin', 'admin', '2025-04-13 18:40:47');


CREATE TABLE `threads` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `threads` (`id`, `user_id`, `title`, `content`, `created_at`) VALUES
(45, 14, 'Samsung Galaxy S26 Ultra: Θα έρθει χωρίς under-display κάμερα', 'H Samsung χρησιμοποιεί κάμερες κάτω από την οθόνη για μερικές γενιές της σειράς Galaxy Z Fold, τοποθετημένες κάτω από την αναδιπλούμενη οθόνη, αλλά αυτές δεν λαμβάνουν εξαιρετικές κριτικές.\r\nΈτσι, ίσως είναι καλό νέο ότι το Galaxy S26 Ultra δεν θα έχει τέτοια κάμερα και θα επιλέξει τη δοκιμασμένη και δοκιμασμένη εγκατάσταση διάτρησης. Αυτές οι πληροφορίες έρχονται από την Κορέα και είναι αντίθετες από μια άλλη φήμη που κυκλοφόρησε τον Φεβρουάριο.\r\n\r\n\r\nΗ Samsung φέρεται να σκόπευε να χρησιμοποιήσει μια κάμερα κάτω από την οθόνη στο S26 Ultra για να δώσει αυτή την απρόσκοπτη εμφάνιση σε όλη την οθόνη, αλλά αντιμετώπισε ανυπέρβλητα προβλήματα με την τεχνολογία, τόσο σχετικά με το κόστος όσο και άλλα προβλήματα που δεν αναφέρονται, τα οποία, ωστόσο μπορεί να έχουν να κάνουν με την ποιότητα.\r\n\r\n\r\nΚαλό είναι η εταιρεία να περιμένει έως ότου η ποιότητα της κάμερας είναι εξίσου καλή με αυτήν της υπάρχουσας τεχνολογίας και στη συνέχεια να την ενσωματώσει στη ναυαρχίδα της.', '2025-04-13 15:11:07'),
(47, 17, 'To AI ρομπότ συντροφιάς Ballie της Samsung έρχεται αυτό το καλοκαίρι με το Google Gemini', 'Αυτό το καλοκαίρι, η Samsung σχεδιάζει να λανσάρει το Ballie, ένα ΑΙ ρομπότ συντροφιάς, πάνω στο οποίο εργάζεται από το 2020. Η Samsung παρουσίασε τον Ballie στην CES τον Ιανουάριο του 2020, όπου είδαμε μια μικροσκοπική ρομποτική μπάλα που μπορούσε να κυλήσει, να εγγράψει βίντεο, να ανταποκριθεί σε φωνητικές εντολές και πολλά άλλα. Με τα χρόνια, ο Ballie έγινε πιο ικανός και τώρα η Samsung συνεργάζεται με την Google για να προσθέσει λειτουργίες AI. Η Ballie υιοθετεί τη γενετική τεχνολογία AI του Google Cloud και η Samsung λέει ότι θα είναι σε θέση να συμμετέχει σε φυσικές, συνομιλητικές αλληλεπιδράσεις, παρέχοντας βοήθεια στο σπίτι προβλέποντας προσωπικές ανάγκες. Ο Ballie θα μπορεί να προσαρμόζει τον φωτισμό και να ελέγχει έξυπνα προϊόντα σπιτιού, να χαιρετάει ανθρώπους στην πόρτα, να μαθαίνει εξατομικευμένα προγράμματα, να ορίζει υπενθυμίσεις και πολλά άλλα. Σε ένα κινούμενο βίντεο που δείχνει τον Ballie, το ρομπότ απεικονίζεται να βρίσκει ένα διασκεδαστικό βίντεο για να παρακολουθήσει ένα παιδί, να προσφέρει συμβουλές στυλ, να λέει σε έναν άντρα να φορέσει παλτό γιατί έξω κάνει κρύο και να πηγαίνει τους ανθρώπους στην ώρα τους στη δουλειά και στο σχολείο. Χρησιμοποιώντας το Gemini AI της Google, το Ballie θα μπορεί να ερμηνεύει ήχο και φωνή, οπτικά δεδομένα από την κάμερά του και δεδομένα αισθητήρων από το περιβάλλον, καθώς και να παρέχει συστάσεις για τη βελτίωση της υγείας και της ευημερίας των χρηστών. Η Samsung δεν έχει ανακοινώσει την τιμή για το Ballie, ούτε μια συγκεκριμένη ημερομηνία κυκλοφορίας, αλλά η εταιρεία λέει ότι θα έρθει το καλοκαίρι αρχικά στις ΗΠΑ και τη Νότια Κορέα. Οι πελάτες μπορούν να προεγγραφούν για να παραγγείλουν το Ballie στον ιστότοπο της Samsung.', '2025-04-13 19:20:34'),
(48, 14, 'Reconnect 2025: Το κορυφαίο συνέδριο τεχνολογίας στη Μύκονο που δεν πρέπει να χάσετε!', 'Κλειστές Συναντήσεις &amp; Workshops: Το συνέδριο δίνει έμφαση στην ποιότητα των συζητήσεων, προσφέροντας στοχευμένα εργαστήρια και κλειστές συναντήσεις για ανταλλαγή ιδεών και συζήτηση των προκλήσεων του κλάδου. ​Techblog\r\nNetworking Υψηλού Επιπέδου: Από ανεπίσημες συγκεντρώσεις μέχρι επίσημα δείπνα, το Reconnect 2025 διευκολύνει τη δημιουργία ουσιαστικών επαγγελματικών σχέσεων με άτομα που μπορούν να επηρεάσουν θετικά την καριέρα ή την επιχείρησή σας. ​Techblog\r\nΕνημέρωση για τις Τελευταίες Τάσεις: Παρακολουθήστε παρουσιάσεις από κορυφαίους ομιλητές για θέματα αιχμής, όπως τεχνητή νοημοσύνη, κυβερνοασφάλεια, fintech και βιώσιμη τεχνολογία. ​Techblog\r\nΗ Μαγεία της Μυκόνου: Συνδυάστε την επαγγελματική ανάπτυξη με την απόλαυση του μοναδικού περιβάλλοντος της Μυκόνου, εξερευνώντας τις παραλίες, τα γραφικά σοκάκια και τη νυχτερινή ζωή του νησιού. ​Techblog\r\nΓιατί να Συμμετάσχετε:\r\nΔημιουργία Νέων Συνεργασιών: Γνωρίστε πιθανούς συνεργάτες, πελάτες ή επενδυτές. ​Techblog\r\nΈμπνευση &amp; Καινοτόμες Ιδέες: Ακούστε από κορυφαίους ομιλητές και ανακαλύψτε νέες προσεγγίσεις για τις προκλήσεις του κλάδου σας. ​Techblog\r\nΕνίσχυση της Προβολής σας: Βελτιώστε την προσωπική σας επωνυμία και την αναγνωρισιμότητα της εταιρείας σας. ​Techblog\r\nΑξέχαστες Εμπειρίες: Συνδυάστε επαγγελματική ανάπτυξη με διασκέδαση σε ένα μοναδικό περιβάλλον. ​Techblog\r\nΟι θέσεις για το Reconnect 2025 είναι περιορισμένες. Επισκεφθείτε την επίσημη ιστοσελίδα www.zreconnect.com για να μάθετε περισσότερα και να εξασφαλίσετε τη συμμετοχή σας. Μείνετε συντονισμένοι στο Techblog.gr για περισσότερες ενημερώσεις, συνεντεύξεις και αποκλειστικό περιεχόμενο σχετικά με το επερχόμενο Reconnect 2025!', '2025-04-13 19:22:38'),
(49, 15, 'Αυτό το chipset φοράει το Honor Power με την μπαταρία των 8.000 mAh', 'Η Honor λανσάρει το πρώτο smartphone με την επωνυμία Power στις 15 Απριλίου και φημολογείται ότι θα συνοδεύεται από μια τεράστια μπαταρία 8.000 mAh και ένα chipset της σειράς Snapdragon 7, αλλά μέχρι τώρα δεν είχε ακουστεί πιο μοντέλο θα φοράει.\r\nΑυτό αλλάζει τώρα, καθώς ο κινέζος leaker Digital Chat Station αποκάλυψε στο Weibo ότι το Honor Power θα ενσωματώνει το Snapdragon 7 Gen 3 SoC.\r\n\r\n \r\n\r\n  \r\nΚαι αυτή τη φορά, η εξωφρενικά τεράστια χωρητικότητα της μπαταρίας των 8.000 mAh «επιβεβαιώθηκε» και αυτή φέρεται να συνδυάζεται με υποστήριξη για γρήγορη ενσύρματη φόρτιση 80 W.\r\nΣε αυτή τη χωρητικότητα, ακόμη και με 80 W, θα χρειαστεί ακόμα περισσότερο από μία ώρα για να πάει από το μηδέν στο πλήρες, αλλά αυτό δεν θα ενοχλήσει κανέναν, καθώς υποθέτουμε ότι οι περισσότεροι άνθρωποι θα το φορτίσουν σίγουρα μόνο κατά τη διάρκεια της νύχτας, καθώς πιθανότατα δεν χρειάζεται να φορτιστεί το μεσημέρι με τόσο μεγάλη μπαταρία.', '2025-04-13 19:25:12');


CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `posts` (`id`, `thread_id`, `user_id`, `content`, `created_at`) VALUES
(18, 45, 15, 'Δεν το πιστεύω. Πόσο θα στοιχίζει??', '2025-04-13 15:14:24'),
(20, 47, 17, 'Καλώς τα δεχτήκαμε...!!!!', '2025-04-13 19:21:12'),
(21, 45, 14, '...!!!!', '2025-04-13 19:22:57'),
(22, 47, 14, 'Σε τι τιμές????', '2025-04-13 19:23:20'),
(23, 47, 15, 'Να δούμε τι άλλο θα φτιάξουν....!!!', '2025-04-13 19:25:43'),
(24, 48, 15, 'Φύγαμε για Μύκονο....!!!', '2025-04-13 19:26:10');





-- Ευρετήρια για πίνακα `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thread_id` (`thread_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Ευρετήρια για πίνακα `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);


--
-- AUTO_INCREMENT για πίνακα `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT για πίνακα `threads`
--
ALTER TABLE `threads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`thread_id`) REFERENCES `threads` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Περιορισμοί για πίνακα `threads`
--
ALTER TABLE `threads`
  ADD CONSTRAINT `threads_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
