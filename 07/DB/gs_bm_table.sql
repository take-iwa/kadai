-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017 年 6 月 06 日 00:08
-- サーバのバージョン： 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gs_db08`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_bm_table`
--

CREATE TABLE `gs_bm_table` (
  `id` int(12) NOT NULL,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `indate` datetime NOT NULL,
  `display` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_bm_table`
--

INSERT INTO `gs_bm_table` (`id`, `title`, `url`, `comment`, `indate`, `display`) VALUES
(1, 'BLAME!', 'https://www.amazon.co.jp/gp/product/B010CQ4GRY/ref=series_rw_dp_sw', '弐瓶勉さんの漫画は、昔っから好き。\r\n映画公開中。', '2017-06-05 19:45:05', 1),
(2, 'メイドインアビス', 'https://www.amazon.co.jp/gp/product/B01N0UJXO4/ref=series_rw_dp_sw', '絵だけ見るとほんわかな作品かと思いきや、なかなか怖いシーンも多い。モフモフ。', '2017-06-05 20:40:45', 1),
(3, 'ヒナまつり', 'https://www.amazon.co.jp/gp/product/B06XDPPLMV/ref=series_rw_dp_sw', 'とても笑えます。電車で読んでて思いっきり吹き出して恥ずかしかった。', '2017-06-05 20:46:48', 1),
(4, 'エリア51', 'https://www.amazon.co.jp/gp/product/B06X3R7568/ref=series_rw_dp_sw', '久正人さんの絵がかっこよくて好き。また、神話・怪談・UMAなど色々なジャンルのキャラが登場するが、巧みに組み合わされていて物語としても面白い。これが好きなら過去の作品も是非。', '2017-06-05 20:54:57', 1),
(5, '月影ベイベ', 'https://www.amazon.co.jp/gp/product/B072FRKLD9/ref=series_rw_dp_sw', '全然読んでないけど、自分の出身地の祭りが取り上げられていたので気になった。今度読んでみよう。', '2017-06-05 21:04:00', 1),
(6, '僕らのヒーローアカデミア', 'https://www.amazon.co.jp/gp/product/B071FT7TPQ/ref=series_rw_dp_sw', '努力・友情・勝利の三拍子揃った王道バトルもの。純粋に楽しめる感じがいい。', '2017-06-05 22:59:24', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
