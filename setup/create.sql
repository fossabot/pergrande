--
-- テーブルの構造 `kam_kategori`
--

CREATE TABLE IF NOT EXISTS `kam_kategori` (
  `kategori` int(2) NOT NULL,
  `kategori_name` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `inoutflg` int(1) NOT NULL,
  `order_no` int(3) NOT NULL default '0',
  PRIMARY KEY  (`kategori`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- テーブルの構造 `kam_user`
--

CREATE TABLE IF NOT EXISTS `kam_user` (
  `user_id` varchar(10) NOT NULL,
  `login_id` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `user_pass` text,
  `user_name` text character set utf8 collate utf8_unicode_ci,
  `user_grade` int(1) NOT NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- テーブルの構造 `kat_inoutdata`
--

CREATE TABLE IF NOT EXISTS `kat_inoutdata` (
  `user_id` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `indexnumber` int(10) NOT NULL,
  `money` int(10) NOT NULL,
  `kategori` varchar(2) NOT NULL,
  `detail` text character set utf8 collate utf8_unicode_ci,
  `inoutflg` varchar(1) NOT NULL,
  `del_flg` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`user_id`,`date`,`indexnumber`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
