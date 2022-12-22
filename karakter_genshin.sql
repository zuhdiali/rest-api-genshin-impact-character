-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2022 at 12:53 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `karakter_genshin`
--

-- --------------------------------------------------------

--
-- Table structure for table `karakter`
--

CREATE TABLE `karakter` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `asal` varchar(10) NOT NULL,
  `vision` varchar(10) NOT NULL,
  `senjata` varchar(10) NOT NULL,
  `rarity` varchar(10) NOT NULL,
  `deskripsi` text NOT NULL,
  `avatar_url` varchar(255) NOT NULL,
  `card_url` varchar(255) NOT NULL,
  `avatar_img` varchar(255) NOT NULL,
  `card_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karakter`
--

INSERT INTO `karakter` (`id`, `nama`, `slug`, `asal`, `vision`, `senjata`, `rarity`, `deskripsi`, `avatar_url`, `card_url`, `avatar_img`, `card_img`) VALUES
(7, 'Zhongli', 'zhongli', 'Liyue', 'Geo', 'Polearm', '5 stars', 'A consultant of the Wangsheng Funeral Parlor, he is later revealed to be the current vessel of the Geo Archon, Morax, who has decided to experience the world from the perspective of a mortal.', 'https://avatarfiles.alphacoders.com/280/thumb-280958.png', 'https://i.pinimg.com/originals/d0/02/54/d00254e9f2df6be1ceb78c4d0a3f3c1f.jpg', 'zhongli_avatar.png', 'zhongli_card.png'),
(22, 'Raiden Shogun', 'raiden-shogun', 'Inazuma', 'Electro', 'Polearm', '5 stars', 'The Raiden Shogun is unique as she is comprised of two beings in one body: Ei, the current Electro Archon of Inazuma; and the Shogun, the puppet created by Ei to act as the ruler of Inazuma in her stead, which also serves as her vessel.', '', '', '1000000048.jpg', '1000000046_1.jpg'),
(25, 'Shenhe', 'shenhe', 'Liyue', 'Cryo', 'Polearm', '5 stars', 'The daughter of an unnamed exorcist couple, Shenhe was taken in and raised by Cloud Retainer as a disciple following a traumatic incident by Shenhe\'s father during her childhood.', '', '', '1000025653.jpg', '1000025654.jpg'),
(28, 'Tartaglia', 'tartaglia', 'Snezhnaya', 'Hydro', 'Bow', '5 stars', 'He is the Eleventh of the Eleven Fatui Harbingers. Following danger wherever he goes, Childe is always eager for a challenge, making him extremely dangerous despite being the youngest member.', '', '', '1000025664.jpg', '1000025667.jpg'),
(29, 'Nahida', 'nahida', 'Sumeru', 'Dendro', 'Catalyst', '5 stars', 'She is the vessel of Buer, as Lesser Lord Kusanali, the current Dendro Archon. Having been freed from her extensive confinement in the Sanctuary of Surasthana, she now strives to have a stronger presence in Sumeru.', '', '', '1000025669.jpg', '1000025670.jpg'),
(31, 'Kaedehara Kazuha', 'kaedehara-kazuha', 'Inazuma', 'Anemo', 'Sword', '5 stars', 'A wandering samurai of the once-famed Kaedehara Clan with an ability to read the sounds of nature, Kazuha is a temporary crewmember of The Crux. Despite being burdened by the many happenings of his past, Kazuha still maintains an easygoing disposition.', '', '', '1000025678.jpg', '1000025679.jpg'),
(32, 'Ningguang', 'ningguang', 'Liyue', 'Geo', 'Catalyst', '4 stars', 'The Tianquan of the Liyue Qixing and owner of the floating Jade Chamber in the skies of Liyue, Ningguang is a mogul who shakes the very foundations of business circles. Even grabbing a few scraps from the documents she shreds from the Jade Chamber will gift one an invaluable fragment of her wisdom, enough to stay a step or two from one\'s peers.', '', '', '1000025658.jpg', '1000025662.jpg'),
(33, 'Hu Tao', 'hu-tao', 'Liyue', 'Pyro', 'Polearm', '5 stars', 'Hu Tao\'s antics and eccentricity belies her role as the 77th Director of the Wangsheng Funeral Parlor and her talent as a poet. Nevertheless, she treats the parlor\'s operations with utmost importance, and holds funeral ceremonies with the highest dignity and solemnity.', '', '', '1000025675.jpg', '1000025676.jpg'),
(36, 'Kujou Sara', 'kujou-sara', 'Inazuma', 'Electro', 'Bow', '4 stars', 'A tengu, Sara is the adopted daughter of the Kujou Clan of the Tenryou Commission. Loyal to both her clan and the Shogun, Sara carries out her orders by the Shogun\'s will.', '', '', '1000025687.jpg', '1000025688.jpg'),
(37, 'Kamisato Ayaka', 'kamisato-ayaka', 'Inazuma', 'Cryo', 'Sword', '5 stars', 'She is the oldest daughter of the Kamisato Clan and younger sister of Kamisato Ayato, in charge of the clan\'s internal and external affairs. Being beautiful, dignified, and noble, Ayaka has earned the title Shirasagi Himegimi from those close to her, and is considered a model of perfection in Inazuma. Having more interactions with the common people, Ayaka\'s reputation exceeds that of her brother.', '', '', '1000025690.jpg', '1000025691.jpg'),
(38, 'Alhaitham', 'alhaitham', 'Sumeru', 'Dendro', 'Sword', '5 stars', 'Alhaitham is a member of the Haravatat of the Sumeru Akademiya and the Akademiya\'s Scribe, responsible for documenting their findings and drafting ordinances.', '', '', '1000025693.jpg', '1000025695.jpg'),
(40, 'Yelan', 'yelan', 'Liyue', 'Hydro', 'Bow', '5 stars', 'She is a mysterious person who claims to work for the Ministry of Civil Affairs, but comes out as a non-entity on their list. She also claims to work for the Yanshang Teahouse, but only uses it for her true job, an intelligence agent collaborating with Ningguang.', '', '', '1000025700.jpg', '1000025701.jpg'),
(41, 'Arataki Itto', 'arataki-itto', 'Inazuma', 'Geo', 'Claymore', '5 stars', 'A loud and proud descendant of the crimson oni, Itto is also the leader and founder of the Arataki Gang. While not a villain, his reputation within Inazuma City leaves something to be desired, due to him and his gang constantly getting into trouble. Nevertheless, Itto is beloved by the children, who are always excited to play street games with him.', '', '', '1000025703.jpg', '1000025704.jpg'),
(42, 'Wanderer', 'wanderer', 'Inazuma', 'Anemo', 'Catalyst', '5 stars', 'The Wanderer came into existence in place of his previous incarnation after the latter expunged his previous appellations and their respective histories from Irminsul. Harboring his former self\'s memories after willingly regaining them, \"Wanderer\" is now the only title he goes by, for he has no home, no kin, and no destination.', '', '', '1000025681.jpg', '1000025682.jpg'),
(48, 'Barbara ', 'barbara', 'Mondstadt', 'Hydro', 'Catalyst', '4 stars', 'She is the deaconess of the Church of Favonius and a prominent \"idol\" after learning about them from the intrepid adventurer Alice. She is also the younger sister of the Acting Grand Master Jean.', '', '', 'Character_Barbara_Thumb_1.png', 'IMG_20221222_160307.jpg'),
(51, 'Eula', 'eula', 'Mondstadt', 'Cryo', 'Claymore', '5 stars', 'Although a descendant of the infamous and tyrannical Lawrence Clan, Eula severed her ties with the clan and became the captain of the Reconnaissance Company with the Knights of Favonius.', '', '', 'Character_Eula_Thumb.png', 'IMG_20221222_182238.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `nama_lengkap`, `username`) VALUES
(1, '222011642@stis.ac.id', '$2y$10$75z4hHWETMMDZ0l0.DDEWexrRk7QPKSX8U1J32t69Tm7L8zLCj28S', 'admin', 'Zuhdi Ali Hisyam', 'zuhdiali'),
(2, 'zuhdialihisyam@gmail.com', '$2y$10$hS.5jbX624cOgsNvpDq6xOaO8LEE.sQe1Gwl1YsO778OKFX85NxAe', 'admin', 'Zuhdi Ali Hisyam', 'zuhdialihisyam'),
(3, 'yukinoshita@gmail.com', '$2y$10$X3WjX4ISMdn03ru98qofjOx0lHV5WOaeCUQyxeoA97j4GmnsByghq', 'admin', 'Yukinoshita Yukino', 'yukinon'),
(5, 'zuhdiali@gmail.com', '$2y$10$7r5uB2keFf9JFDSlQPlzqu0/My2hTjo8a51X57K5MH4XkNlNy8kVi', 'user', 'Akun Zuhdi Percobaan 2', 'zuhdialihisyam1'),
(6, 'dummy2@gmail.com', '$2y$10$c89Prt9aO3viT77Hwca/EupFaeGq6p/eQSZ6BR8/M.NLVw4/vaJyy', 'user', 'dummy2 dummmy2', 'dummy2'),
(7, 'dummy@gmail.com', '$2y$10$YOel3966e0X7/Cws52EVFuQRaabthVLc1ZUXV8dJWszUI4PZfL4.6', 'user', 'Akun Percobaan Zuhdi edit', 'dummyyyy'),
(9, 'testing@gmail.com', '$2y$10$7EjREyO3PO6WfTKD6Ez8aeflSCE6IS4tFOvKkUHBSzZXVN90Pttty', 'user', 'Zuhdi Ali (edit)', 'testing');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `karakter`
--
ALTER TABLE `karakter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `karakter`
--
ALTER TABLE `karakter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
