-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017 年 6 月 23 日 08:29
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
  `sender` int(12) DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `indate` datetime NOT NULL,
  `display` tinyint(1) NOT NULL DEFAULT '1',
  `img_url` text COLLATE utf8_unicode_ci NOT NULL,
  `point` int(12) DEFAULT '0',
  `other_comment` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_bm_table`
--

INSERT INTO `gs_bm_table` (`id`, `title`, `url`, `sender`, `comment`, `indate`, `display`, `img_url`, `point`, `other_comment`) VALUES
(1, 'BLAME!', 'https://www.amazon.co.jp/gp/product/B010CQ4GRY/ref=series_rw_dp_sw', 1, '弐瓶勉さんの作品は昔から好きでした。荒廃的な雰囲気と共通する世界観で過去の作品から続けて楽しめます。（そんなに共通してないかもですが・・・）最近映画にもなりましたが、とりあえず、シボかわいい。', '2017-06-05 19:45:05', 1, 'https://images-fe.ssl-images-amazon.com/images/I/C1vVhO1x4WS._SL250_FMpng_.png', 3, '＜みんなのコメント＞<br>私はシドニアの騎士から入りましたが、こちらの方が説明が少なく好みです。コツはわかんなくても受け入れることw( takeさん )<br>>takeさん　確かに正直なんなのかよくわかんないとこありますよねw読めばそのうちわかるだろう・と読み進めてましたがw( iwaiwaさん )'),
(2, 'メイドインアビス', 'https://www.amazon.co.jp/gp/product/B01N0UJXO4/ref=series_rw_dp_sw', 1, '絵だけ見るとほんわかな作品かと思いきや、なかなか怖いシーンも多い。モフモフ。', '2017-06-05 20:40:45', 1, 'https://images-fe.ssl-images-amazon.com/images/I/D1MDSoNTKsS._SL250_FMpng_.png', 2, '＜みんなのコメント＞'),
(3, 'ヒナまつり', 'https://www.amazon.co.jp/gp/product/B06XDPPLMV/ref=series_rw_dp_sw', 1, 'とても笑えます。電車で読んでて思いっきり吹き出して恥ずかしかった。', '2017-06-05 20:46:48', 1, 'https://images-fe.ssl-images-amazon.com/images/I/C1D8Dq59pkS._SL250_FMpng_.png', 1, '＜みんなのコメント＞<br>腹筋壊れるかと思ったw( kacchanさん )'),
(4, 'エリア51', 'https://www.amazon.co.jp/gp/product/B06X3R7568/ref=series_rw_dp_sw', 1, '久正人さんの絵がかっこよくて好き。また、神話・怪談・UMAなど色々なジャンルのキャラが登場するが、巧みに組み合わされていて物語としても面白い。これが好きなら過去の作品も是非。', '2017-06-05 20:54:57', 1, 'https://images-fe.ssl-images-amazon.com/images/I/B1FyHjLVNHS._SL250_FMpng_.png', 3, '＜みんなのコメント＞'),
(5, '月影ベイベ', 'https://www.amazon.co.jp/gp/product/B072FRKLD9/ref=series_rw_dp_sw', 1, '全然読んでないけど、自分の出身地の祭りが取り上げられていたので気になった。今度読んでみよう。', '2017-06-05 21:04:00', 1, 'https://images-fe.ssl-images-amazon.com/images/I/B1OH0Iu5g0S._SL250_FMpng_.png', 0, '＜みんなのコメント＞'),
(6, '僕らのヒーローアカデミア', 'https://www.amazon.co.jp/gp/product/B071FT7TPQ/ref=series_rw_dp_sw', 1, '努力・友情・勝利の三拍子揃った王道バトルもの。純粋に楽しめる感じがいい。', '2017-06-05 22:59:24', 1, 'https://images-fe.ssl-images-amazon.com/images/I/C1uRsIUzzfS._SL250_FMpng_.png', 2, '＜みんなのコメント＞<br>主人公より強い奴がゴロゴロいる感じがいいよね。クラスメイトの成長もきになるところ。( kacchanさん )'),
(7, '闇金ウシジマくん', 'https://www.amazon.co.jp/gp/product/B072PSXX73/ref=series_rw_dp_sw', 3, '人間て面白いなぁと。', '2017-06-06 21:54:00', 1, 'https://images-fe.ssl-images-amazon.com/images/I/B19gAQCKIpS._SL250_FMpng_.png', 2, '＜みんなのコメント＞'),
(8, 'キングダム', 'https://www.amazon.co.jp/gp/product/B071CG819L/ref=series_rw_dp_sw', 3, 'アニメ面白かったよ。', '2017-06-06 21:57:30', 1, 'https://images-fe.ssl-images-amazon.com/images/I/C1a3Jkfd2BS._SL250_FMpng_.png', 1, '＜みんなのコメント＞'),
(9, '鋼の錬金術師', 'https://www.amazon.co.jp/gp/product/B01GO0PZU4/ref=series_rw_dp_sw', 3, '登場人物がそれぞれの物語がちゃんと描かれていて好感が持てる。\r\n使い回しがうまいともいう。', '2017-06-13 14:29:06', 1, 'https://images-fe.ssl-images-amazon.com/images/I/D1KiYII7VlS._SL250_FMpng_.png', 2, '＜みんなのコメント＞'),
(10, '亜人ちゃんは語りたい', 'https://www.amazon.co.jp/gp/product/B071YGSSFD/ref=series_rw_dp_sw', 4, '僕らと少しだけ違う「亜人」、最近では「デミ」と呼ばれています。（demi-humanから来てるらしい）。キュートな悩みがあるのです。規格外新人ペトスが描く、とびきりカワイイハイスクール亜人コメディ!', '2017-06-14 00:05:56', 1, 'https://images-fe.ssl-images-amazon.com/images/I/C1M9UfxzjjS._SL250_FMpng_.png', 1, '＜みんなのコメント＞<br>いいよねー( iwaiwaさん )'),
(11, 'ドラゴンボール', 'https://www.amazon.co.jp/gp/product/B01GO0WVHE/ref=series_rw_dp_sw', 1, 'かめはめ波ーーー', '2017-06-17 14:24:24', 1, 'https://images-fe.ssl-images-amazon.com/images/I/B16PfhJQzTS._SL250_FMpng_.png', 1, '＜みんなのコメント＞');

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
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
