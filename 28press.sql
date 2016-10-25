-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2011 年 07 月 02 日 13:37
-- 服务器版本: 5.1.41
-- PHP 版本: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `28`
--

-- --------------------------------------------------------

--
-- 表的结构 `lf_about`
--

CREATE TABLE IF NOT EXISTS `lf_about` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext,
  `sort` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=FIXED AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `lf_about`
--


-- --------------------------------------------------------

--
-- 表的结构 `lf_activities`
--

CREATE TABLE IF NOT EXISTS `lf_activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '活动名称',
  `pic` varchar(255) DEFAULT NULL COMMENT '活动图片',
  `url` varchar(255) DEFAULT NULL COMMENT '活动地址',
  `time` varchar(255) DEFAULT NULL COMMENT '活动时间',
  `dx` varchar(255) DEFAULT NULL COMMENT '活动对象',
  `zt` int(11) DEFAULT '0' COMMENT '活动状态(是否结束)',
  PRIMARY KEY (`id`),
  KEY `zt` (`zt`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lf_activities`
--

INSERT INTO `lf_activities` (`id`, `name`, `pic`, `url`, `time`, `dx`, `zt`) VALUES
(1, '推广大比拼', '20110530155504.gif', 'http://localhost/', '2011年6月1日', '全体会员', 0);

-- --------------------------------------------------------

--
-- 表的结构 `lf_adip`
--

CREATE TABLE IF NOT EXISTS `lf_adip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '用户ID',
  `ip` varchar(255) DEFAULT NULL COMMENT '用户IP',
  `time` datetime DEFAULT NULL COMMENT '体验广告日期',
  `type` int(11) DEFAULT '0' COMMENT '体验广告类型',
  `adid` int(11) DEFAULT NULL COMMENT '广告ID',
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`),
  KEY `adid` (`adid`),
  KEY `uid` (`uid`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=FIXED AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `lf_adip`
--

INSERT INTO `lf_adip` (`id`, `uid`, `ip`, `time`, `type`, `adid`) VALUES
(1, 15888, '127.0.0.1', '2011-05-30 16:00:59', 11, 1),
(2, 15888, '127.0.0.1', '2011-05-30 16:01:08', 2, 2);

-- --------------------------------------------------------

--
-- 表的结构 `lf_adlogusers`
--

CREATE TABLE IF NOT EXISTS `lf_adlogusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adtitle` varchar(255) DEFAULT NULL COMMENT '广告名称',
  `type` int(11) DEFAULT '0' COMMENT '广告类型',
  `adpoints` int(11) DEFAULT '0' COMMENT '广告奖励豆豆',
  `uid` int(11) DEFAULT NULL COMMENT '体验用户ID',
  `uip` varchar(255) DEFAULT NULL COMMENT '用户IP',
  `time` datetime DEFAULT NULL COMMENT '体验时间',
  `fatime` datetime DEFAULT NULL COMMENT '发放时间',
  `zt` int(11) DEFAULT '0' COMMENT '发放状态',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `type` (`type`),
  KEY `zt` (`zt`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lf_adlogusers`
--

INSERT INTO `lf_adlogusers` (`id`, `adtitle`, `type`, `adpoints`, `uid`, `uip`, `time`, `fatime`, `zt`) VALUES
(1, '轻轻巧巧去', 2, 11111, 15888, '127.0.0.1', '2011-05-30 16:01:08', NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `lf_admin`
--

CREATE TABLE IF NOT EXISTS `lf_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT '名称',
  `password` varchar(100) DEFAULT NULL,
  `time` datetime DEFAULT NULL COMMENT '登陆时间',
  `ip` varchar(50) DEFAULT NULL COMMENT '登陆IP',
  `groupbox` varchar(255) DEFAULT NULL COMMENT '管理权限',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=FIXED AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lf_admin`
--

INSERT INTO `lf_admin` (`id`, `name`, `password`, `time`, `ip`, `groupbox`) VALUES
(1, 'admin', 'c3284d0f94606de1fd2af172aba15bf3', '2012-05-06 14:44:41', '127.0.0.1', 'system,gamegl,gametj,adgl,adff,adtj,jpgl,djgl,users,sms,hdgl,bbs,business,card,pay,dbgl,admingl');

-- --------------------------------------------------------

--
-- 表的结构 `lf_adquestions`
--

CREATE TABLE IF NOT EXISTS `lf_adquestions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '问卷名称',
  `points` int(11) DEFAULT '0' COMMENT '奖励豆豆',
  `dailynum` int(11) DEFAULT '0' COMMENT '每天体验数量',
  `adpic` varchar(255) DEFAULT NULL COMMENT '问卷图片',
  `questionsnum` int(11) DEFAULT '0' COMMENT '题目数量',
  `time` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lf_adquestions`
--

INSERT INTO `lf_adquestions` (`id`, `title`, `points`, `dailynum`, `adpic`, `questionsnum`, `time`) VALUES
(1, '如何测试俺的痘痘', 111, 1, '20110530061213.jpg', 1, '2011-05-30 06:12:14');

-- --------------------------------------------------------

--
-- 表的结构 `lf_adquestions_issue`
--

CREATE TABLE IF NOT EXISTS `lf_adquestions_issue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adtm` varchar(255) DEFAULT NULL,
  `adda1` varchar(255) DEFAULT NULL,
  `adzq1` int(11) DEFAULT '0',
  `adda2` varchar(255) DEFAULT NULL,
  `adzq2` int(11) DEFAULT '0',
  `adda3` varchar(255) DEFAULT NULL,
  `adzq3` int(11) DEFAULT '0',
  `adda4` varchar(255) DEFAULT NULL,
  `adzq4` int(11) DEFAULT '0',
  `addaurl` varchar(255) DEFAULT NULL COMMENT '寻找答案地址',
  `adid` int(11) DEFAULT NULL COMMENT '问卷ID',
  `adorder` int(11) DEFAULT '0' COMMENT '顺序',
  PRIMARY KEY (`id`),
  KEY `adid` (`adid`),
  KEY `adorder` (`adorder`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `lf_adquestions_issue`
--

INSERT INTO `lf_adquestions_issue` (`id`, `adtm`, `adda1`, `adzq1`, `adda2`, `adzq2`, `adda3`, `adzq3`, `adda4`, `adzq4`, `addaurl`, `adid`, `adorder`) VALUES
(2, '如何测试俺的痘痘', '如何测试俺的痘痘', 1, '如何测试俺的痘痘', 0, '如何测试俺的痘痘', 0, '如何测试俺的痘痘', 0, '11111111111111111', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `lf_adsp`
--

CREATE TABLE IF NOT EXISTS `lf_adsp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT NULL COMMENT '广告类型',
  `title` varchar(255) DEFAULT NULL COMMENT '广告名称',
  `isad` int(11) DEFAULT '0' COMMENT '是否即时广告',
  `cpaid` int(11) DEFAULT '0' COMMENT '广告主ID',
  `losttime` varchar(255) DEFAULT NULL COMMENT '有效时间',
  `backtime` int(11) DEFAULT '0' COMMENT '返豆时间',
  `points` int(11) DEFAULT '0' COMMENT '广告豆豆',
  `dailynum` int(11) DEFAULT '0' COMMENT '每天限制数量',
  `adpic` varchar(255) DEFAULT NULL COMMENT '广告图片',
  `adurl` varchar(255) DEFAULT NULL COMMENT '广告地址',
  `time` datetime DEFAULT NULL COMMENT '添加时间',
  `content` varchar(255) DEFAULT NULL COMMENT '广告内容',
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `lf_adsp`
--

INSERT INTO `lf_adsp` (`id`, `type`, `title`, `isad`, `cpaid`, `losttime`, `backtime`, `points`, `dailynum`, `adpic`, `adurl`, `time`, `content`) VALUES
(1, 1, 'sssssss', 0, 0, NULL, 0, 11111, 1, '20110530061636.jpg', 'http://localhost/', '2011-05-30 06:16:41', NULL),
(2, 2, '轻轻巧巧去', 0, 0, NULL, 0, 11111, 1, '20110530135632.gif', '111111111', '2011-05-30 13:56:36', NULL),
(3, 1, '33333', 0, 0, NULL, 0, 222, 2, '20110530164052.gif', '111111111', '2011-05-30 16:40:55', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `lf_adtj`
--

CREATE TABLE IF NOT EXISTS `lf_adtj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` date DEFAULT NULL COMMENT '时间',
  `num` int(11) DEFAULT '0' COMMENT '体验数量',
  `points` int(11) DEFAULT '0' COMMENT '合计豆豆',
  `type` int(11) DEFAULT '0' COMMENT '广告类型',
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lf_adtj`
--

INSERT INTO `lf_adtj` (`id`, `time`, `num`, `points`, `type`) VALUES
(1, '2011-05-30', 1, 111, 3);

-- --------------------------------------------------------

--
-- 表的结构 `lf_advice`
--

CREATE TABLE IF NOT EXISTS `lf_advice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `content` mediumtext COMMENT '意见内容',
  `time` datetime DEFAULT NULL,
  `usersid` int(11) DEFAULT NULL COMMENT '用户ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `lf_advice`
--


-- --------------------------------------------------------

--
-- 表的结构 `lf_backlog`
--

CREATE TABLE IF NOT EXISTS `lf_backlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` datetime DEFAULT NULL,
  `log` varchar(255) DEFAULT NULL,
  `points` int(11) DEFAULT '0',
  `back` int(11) DEFAULT '0',
  `usersid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `log` (`log`),
  KEY `usersid` (`usersid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lf_backlog`
--

INSERT INTO `lf_backlog` (`id`, `time`, `log`, `points`, `back`, `usersid`) VALUES
(1, '2011-05-30 16:08:48', '存', -100, 100, 56888);

-- --------------------------------------------------------

--
-- 表的结构 `lf_bbs_posts`
--

CREATE TABLE IF NOT EXISTS `lf_bbs_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section` int(11) DEFAULT NULL COMMENT '版块',
  `uid` int(11) DEFAULT NULL COMMENT '用户',
  `top` int(11) DEFAULT '0' COMMENT '置顶',
  `digest` int(11) DEFAULT '0' COMMENT '精华',
  `style` varchar(255) DEFAULT NULL COMMENT '高亮',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `content` text COMMENT '内容',
  `time` datetime DEFAULT NULL COMMENT '发帖时间',
  `dj` int(11) DEFAULT '0',
  `replytime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `replytime` (`replytime`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `lf_bbs_posts`
--

INSERT INTO `lf_bbs_posts` (`id`, `section`, `uid`, `top`, `digest`, `style`, `title`, `content`, `time`, `dj`, `replytime`) VALUES
(1, 1, 15888, 0, 0, NULL, '33333', '333333333333333333333333333', '2011-05-30 14:16:51', 8, '2011-05-30 14:18:09'),
(2, 1, 15888, 0, 0, NULL, 'eeeeeeeee', 'eeeeeeeeeeeeeeeeeeeeeeeeee', '2011-05-30 14:19:07', 8, '2011-05-30 16:06:57'),
(3, 5, 15888, 0, 0, NULL, 'df', 'fffffffffffff', '2011-05-30 16:12:17', 1, '2011-05-30 16:12:17');

-- --------------------------------------------------------

--
-- 表的结构 `lf_bbs_reply`
--

CREATE TABLE IF NOT EXISTS `lf_bbs_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL COMMENT '帖子id',
  `uid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `content` text COMMENT '内容',
  `time` datetime DEFAULT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `lf_bbs_reply`
--

INSERT INTO `lf_bbs_reply` (`id`, `pid`, `uid`, `title`, `content`, `time`) VALUES
(1, 1, 15888, 'ddddddddd', 'ddddddddddddddddddddddd', '2011-05-30 14:18:09'),
(2, 2, 15888, 'ddddddddddddddddd', 'dddddddddddddddddddddd', '2011-05-30 16:06:45'),
(3, 2, 56888, 'sssssssssssssssssssssssssssss', 'ssssssssssssssssssssssssssssssssssssssss', '2011-05-30 16:06:57');

-- --------------------------------------------------------

--
-- 表的结构 `lf_bbs_section`
--

CREATE TABLE IF NOT EXISTS `lf_bbs_section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `moderators` varchar(255) DEFAULT NULL COMMENT '版主',
  `pic` varchar(255) DEFAULT NULL COMMENT '版块图标',
  `introduction` varchar(255) DEFAULT NULL COMMENT '介绍',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lf_bbs_section`
--

INSERT INTO `lf_bbs_section` (`id`, `name`, `moderators`, `pic`, `introduction`, `sort`) VALUES
(1, '11111111', '', 'images/topic_new.gif', '11111111', 0);

-- --------------------------------------------------------

--
-- 表的结构 `lf_business`
--

CREATE TABLE IF NOT EXISTS `lf_business` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `qq` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `time` date DEFAULT NULL,
  `discount` float(12,1) DEFAULT '0.0' COMMENT '进货折扣',
  `sales` float(12,2) DEFAULT '0.00' COMMENT '进货总价',
  `content` mediumtext,
  `pic` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `tj` int(11) DEFAULT '0',
  `auto` int(11) DEFAULT '0' COMMENT '自动发货',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lf_business`
--

INSERT INTO `lf_business` (`id`, `name`, `qq`, `tel`, `uid`, `time`, `discount`, `sales`, `content`, `pic`, `url`, `tj`, `auto`) VALUES
(1, '4444', '1111', '111111', 15888, '2011-05-30', 0.0, 0.00, '1', '20110530142336.jpg', '111111', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `lf_businessnews`
--

CREATE TABLE IF NOT EXISTS `lf_businessnews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext,
  `time` date DEFAULT NULL,
  `top` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=FIXED AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lf_businessnews`
--

INSERT INTO `lf_businessnews` (`id`, `title`, `content`, `time`, `top`) VALUES
(1, '商户公告测试', '商户公告测试商户公告测试商户公告测试', '2011-05-30', 0);

-- --------------------------------------------------------

--
-- 表的结构 `lf_captionaward`
--

CREATE TABLE IF NOT EXISTS `lf_captionaward` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=FIXED AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lf_captionaward`
--

INSERT INTO `lf_captionaward` (`id`, `content`) VALUES
(1, '1、奖品价格已经包含邮寄费用在内，您无须另行支付。兑奖前请确认您的帐户中有足够数量的豆豆！<BR>2、在您要兑奖的奖品页面点击“立即兑换”按钮，提交您的兑奖申请！<BR>3、确认您的奖品邮寄地址，联系电话正确无误后提交兑奖申请 ！<BR>4、实物奖品将在您的兑奖确认后的2-5工作日内发出(奖品状态您可在兑奖名单查询)！<BR>5、兑奖中心所有实物奖品颜色均为随机发送, 敬请谅解！');

-- --------------------------------------------------------

--
-- 表的结构 `lf_card`
--

CREATE TABLE IF NOT EXISTS `lf_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cardtype` int(11) DEFAULT NULL COMMENT '卡类型',
  `cardid` varchar(255) DEFAULT NULL COMMENT '卡号',
  `cardpaw` varchar(255) DEFAULT NULL COMMENT '密码',
  `uid` int(11) DEFAULT NULL COMMENT '使用用户ID',
  `to_card` int(11) DEFAULT '0' COMMENT '是否在抢卡风暴',
  `utime` datetime DEFAULT NULL COMMENT '使用时间',
  `time` datetime DEFAULT NULL COMMENT '生成时间',
  `businessid` int(11) DEFAULT NULL COMMENT '所属商户',
  `state` int(11) DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `state` (`state`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=24 ;

--
-- 转存表中的数据 `lf_card`
--

INSERT INTO `lf_card` (`id`, `cardtype`, `cardid`, `cardpaw`, `uid`, `to_card`, `utime`, `time`, `businessid`, `state`) VALUES
(1, 1, '44VWKFW42', 'QTNYJJ4', 15888, 1, '2011-05-30 15:05:23', '2011-05-30 15:05:00', 1, 1),
(2, 1, '44O2R8FEH', '2E5GXLO', 15888, 0, '2011-05-30 16:13:14', '2011-05-30 15:06:43', 1, 2),
(3, 1, '44HSH8ZDS', '4K8FNS0', 56888, 0, '2011-05-30 16:05:23', '2011-05-30 15:06:43', 1, 1),
(4, 1, '445MPCQTW', 'I5H42N9', 15888, 0, '2011-05-30 15:46:04', '2011-05-30 15:06:43', 1, 1),
(5, 1, '44UHUMBIT', '86R6U14', 15888, 0, '2011-05-30 15:23:01', '2011-05-30 15:06:43', 1, 1),
(6, 1, '44NZ30XDJ', '95E9U4V', 15888, 0, '2011-05-30 15:42:21', '2011-05-30 15:06:43', 1, 1),
(7, 1, '44TCMPOA3', '322PZH5', 15888, 0, '2011-05-30 15:32:32', '2011-05-30 15:06:43', 1, 1),
(8, 1, '44AJ6X80X', 'TYUJZF6', 15888, 0, '2011-05-30 15:20:32', '2011-05-30 15:06:43', 1, 1),
(9, 1, '44NKHSJ09', 'W4KJA25', 15888, 0, '2011-05-30 15:17:10', '2011-05-30 15:06:43', 1, 1),
(10, 1, '44WN422UF', 'K9ZFHZA', 15888, 0, '2011-05-30 15:16:41', '2011-05-30 15:06:43', 1, 1),
(11, 1, '445KB99MK', 'D3GXUXE', 56888, 0, '2011-05-30 16:05:23', '2011-05-30 15:06:43', 1112, 1),
(13, 1, '444N381O1', 'TOEUFL1', NULL, 0, NULL, '2011-05-30 16:15:56', 1, 0),
(14, 1, '449NHG4TP', 'SX9ZROO', NULL, 0, NULL, '2011-05-30 16:15:56', 1, 0),
(15, 1, '446PYTG7S', 'SCRFFEC', NULL, 0, NULL, '2011-05-30 16:15:56', 1, 0),
(16, 1, '44DDQVPD5', 'L142S6P', NULL, 0, NULL, '2011-05-30 16:15:56', 1, 0),
(17, 1, '4404W2G4K', 'Q934TQD', NULL, 0, NULL, '2011-05-30 16:15:56', 1, 0),
(18, 1, '44OPCVY1G', '97ERYG1', NULL, 0, NULL, '2011-05-30 16:15:56', 1, 0),
(19, 1, '441954YFA', 'NUJURZX', NULL, 0, NULL, '2011-05-30 16:15:56', 1, 0),
(20, 1, '445W1CGWJ', 'LUR2SZ0', NULL, 0, NULL, '2011-05-30 16:15:56', 1, 0),
(21, 1, '44SZSM1U3', 'TR03KI8', NULL, 0, NULL, '2011-05-30 16:15:56', 1, 0),
(22, 1, '44GLLNRS7', 'AS55QN1', NULL, 0, NULL, '2011-05-30 16:15:56', 1, 0),
(23, 1, '44MNIATS4', 'TA6X8ZM', 56888, 0, '2011-05-30 16:16:34', '2011-05-30 16:15:56', 1, 2);

-- --------------------------------------------------------

--
-- 表的结构 `lf_cardtype`
--

CREATE TABLE IF NOT EXISTS `lf_cardtype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cardname` varchar(255) DEFAULT NULL COMMENT '卡类型名称',
  `cardpic` varchar(255) DEFAULT NULL,
  `cardprice` float(12,1) DEFAULT NULL COMMENT '卡价格',
  `cardtop` varchar(255) DEFAULT NULL COMMENT '生成卡头',
  `cardlen` int(11) DEFAULT NULL COMMENT '卡号长度',
  `cardtype` int(11) DEFAULT NULL COMMENT '生成卡号类型',
  `ueid` int(11) DEFAULT '0' COMMENT '是否容许修改ID',
  `uevip` int(11) DEFAULT '0' COMMENT '是否vip',
  `to_card` int(11) DEFAULT '0' COMMENT '是否在抢卡风暴',
  `viplength` int(11) DEFAULT '0' COMMENT 'VIP时长',
  `uapoints` int(11) DEFAULT '0' COMMENT '卡面值',
  `uaexperience` int(11) DEFAULT '0' COMMENT '经验',
  `udapoints` int(11) DEFAULT '0' COMMENT '每日领取豆豆',
  `udaexperience` int(11) DEFAULT '0' COMMENT '每日领取经验',
  `length` int(11) DEFAULT '0' COMMENT '领取时长',
  `content` mediumtext COMMENT '卡介绍',
  `show` int(11) DEFAULT '0',
  `shopurl` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `show` (`show`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lf_cardtype`
--

INSERT INTO `lf_cardtype` (`id`, `cardname`, `cardpic`, `cardprice`, `cardtop`, `cardlen`, `cardtype`, `ueid`, `uevip`, `to_card`, `viplength`, `uapoints`, `uaexperience`, `udapoints`, `udaexperience`, `length`, `content`, `show`, `shopurl`) VALUES
(1, '测试充值卡效果', '20110530145655.gif', 100.0, '44', 7, 1, 1, 1, 0, 10, 1000, 1000, 100, 100, 10, '问我wwwwwwwwwwwwwww', 1, 'http://www.9cao.info');

-- --------------------------------------------------------

--
-- 表的结构 `lf_comments`
--

CREATE TABLE IF NOT EXISTS `lf_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentsusers` int(11) DEFAULT NULL COMMENT '评论用户',
  `commentscontent` longtext COMMENT '评论内容',
  `commentstime` date DEFAULT NULL COMMENT '评论时间',
  `commoditiesid` int(11) DEFAULT NULL COMMENT '商品ID',
  PRIMARY KEY (`id`),
  KEY `commoditiesid` (`commoditiesid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=FIXED AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lf_comments`
--

INSERT INTO `lf_comments` (`id`, `commentsusers`, `commentscontent`, `commentstime`, `commoditiesid`) VALUES
(1, 56888, 'sssssssssssssssssss', '2011-05-30', 1);

-- --------------------------------------------------------

--
-- 表的结构 `lf_commodities`
--

CREATE TABLE IF NOT EXISTS `lf_commodities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeid` int(11) DEFAULT NULL COMMENT '商品类型',
  `name` varchar(255) DEFAULT NULL COMMENT '商品名称',
  `price` float(12,1) DEFAULT NULL COMMENT '商品价格',
  `link` varchar(255) DEFAULT NULL COMMENT '商家连接',
  `pic` varchar(255) DEFAULT NULL COMMENT '商品图片',
  `points` int(11) DEFAULT '0' COMMENT '兑换豆豆',
  `discount` int(11) DEFAULT '0' COMMENT '是否打折',
  `autocard` int(11) DEFAULT '0' COMMENT '自动发卡',
  `cardtype` int(11) DEFAULT NULL COMMENT '对应卡类型',
  `shoptype` int(11) DEFAULT NULL COMMENT '商品类型 （实物，虚拟）',
  `convertnum` int(11) DEFAULT '0' COMMENT '兑换数量',
  `content` mediumtext COMMENT '商品介绍',
  `hot` int(11) DEFAULT '0' COMMENT '热门商品',
  `tj` int(11) DEFAULT '0' COMMENT '推荐商品',
  `hits` int(11) DEFAULT '0' COMMENT '人气',
  PRIMARY KEY (`id`),
  KEY `typeid` (`typeid`),
  KEY `tj` (`tj`),
  KEY `hot` (`hot`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lf_commodities`
--

INSERT INTO `lf_commodities` (`id`, `typeid`, `name`, `price`, `link`, `pic`, `points`, `discount`, `autocard`, `cardtype`, `shoptype`, `convertnum`, `content`, `hot`, `tj`, `hits`) VALUES
(1, 1, '移动话费卡100面额', 1000.0, 'http://localhost', '20110530155123.gif', 1, 1, 0, NULL, 0, 1, '移动话费卡100面额', 1, 1, 8);

-- --------------------------------------------------------

--
-- 表的结构 `lf_ctype`
--

CREATE TABLE IF NOT EXISTS `lf_ctype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `typeid` int(11) DEFAULT '0',
  `sort` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sort` (`sort`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lf_ctype`
--

INSERT INTO `lf_ctype` (`id`, `name`, `typeid`, `sort`) VALUES
(1, '移动话费卡', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `lf_editid`
--

CREATE TABLE IF NOT EXISTS `lf_editid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext,
  `ksid` int(11) DEFAULT '0' COMMENT '起始ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=FIXED AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lf_editid`
--

INSERT INTO `lf_editid` (`id`, `content`, `ksid`) VALUES
(1, '1-4000\r\n8888', 10001);

-- --------------------------------------------------------

--
-- 表的结构 `lf_exchange`
--

CREATE TABLE IF NOT EXISTS `lf_exchange` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '用户ID',
  `rname` varchar(255) DEFAULT NULL COMMENT '真实姓名',
  `card` varchar(255) DEFAULT NULL COMMENT '身份证号',
  `commoditiesid` varchar(255) DEFAULT NULL COMMENT '奖品ID',
  `num` int(11) DEFAULT NULL COMMENT '兑换数量',
  `points` int(11) DEFAULT '0' COMMENT '所需豆豆',
  `qq` varchar(255) DEFAULT '' COMMENT '联系QQ',
  `tel` varchar(255) DEFAULT NULL COMMENT '联系电话',
  `address` varchar(255) DEFAULT NULL COMMENT '邮寄地址',
  `zip` varchar(255) DEFAULT NULL COMMENT '邮政编码',
  `remarks` mediumtext COMMENT '备注说明',
  `mode` int(11) DEFAULT '0' COMMENT '兑换状态',
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `commoditiesid` (`commoditiesid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lf_exchange`
--

INSERT INTO `lf_exchange` (`id`, `uid`, `rname`, `card`, `commoditiesid`, `num`, `points`, `qq`, `tel`, `address`, `zip`, `remarks`, `mode`, `time`) VALUES
(1, 56888, '我爱罗', '2147483647', '1', 1, 1, '0', '', '', '', '', 1, '2011-05-30 16:09:35');

-- --------------------------------------------------------

--
-- 表的结构 `lf_game11`
--

CREATE TABLE IF NOT EXISTS `lf_game11` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kgtime` datetime DEFAULT NULL,
  `kgjg` varchar(255) DEFAULT NULL,
  `kj` int(11) DEFAULT '0',
  `tznum` int(11) DEFAULT '0',
  `tzpoints` int(11) DEFAULT '0',
  `zjpl` varchar(255) DEFAULT NULL,
  `zjrnum` int(11) DEFAULT '0',
  `zdtz` int(11) DEFAULT '0',
  `sdtz` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `kj` (`kj`),
  KEY `zjpl` (`zjpl`),
  KEY `zjrnum` (`zjrnum`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=143 ;

--
-- 转存表中的数据 `lf_game11`
--

INSERT INTO `lf_game11` (`id`, `kgtime`, `kgjg`, `kj`, `tznum`, `tzpoints`, `zjpl`, `zjrnum`, `zdtz`, `sdtz`) VALUES
(1, '2012-02-01 22:42:00', '1|1|2', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(2, '2012-02-01 22:44:00', '2|1|3', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(3, '2012-02-01 22:46:00', '5|5|10', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(4, '2012-02-01 22:48:00', '4|5|9', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(5, '2012-02-01 22:50:00', '4|5|9', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(6, '2012-02-01 22:52:00', '3|1|4', 1, 11, 36, '36|18|12|9|7.2|6|7.2|9|12|18|36', 1, 0, 1),
(7, '2012-02-01 22:52:00', '4|6|10', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(8, '2012-02-01 22:56:00', '6|3|9', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(9, '2012-02-01 22:58:00', '3|4|7', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(10, '2012-02-01 22:58:00', '4|1|5', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(11, '2012-02-01 22:58:00', '5|2|7', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(12, '2012-02-01 23:04:00', '4|3|7', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(13, '2012-02-01 23:04:00', '3|3|6', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(14, '2012-02-01 23:08:00', '2|4|6', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(15, '2012-02-01 23:10:00', '4|6|10', 1, 6, 28, '36|14|12|7|7.2|4.67|2.8|7|12|14|36', 0, 0, 2),
(16, '2012-02-01 23:10:00', '6|4|10', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(17, '2012-02-01 23:10:00', '3|4|7', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(18, '2012-02-01 23:16:00', '2|1|3', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(19, '2012-02-01 23:16:00', '6|1|7', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(20, '2012-02-01 23:20:00', '5|2|7', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(21, '2012-02-01 23:22:00', '5|5|10', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(22, '2012-02-01 23:22:00', '5|1|6', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(23, '2012-02-01 23:22:00', '6|5|11', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(44, '2012-02-04 14:57:00', '6|4|10', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(43, '2012-02-04 14:55:00', '1|6|7', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(42, '2012-02-04 14:53:00', '2|5|7', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(32, '2012-02-02 21:49:00', '5|4|9', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(31, '2012-02-02 21:47:00', '2|1|3', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(30, '2012-02-02 21:45:00', '3|1|4', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(41, '2012-02-04 14:51:00', '3|3|6', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(40, '2012-02-04 14:49:00', '1|5|6', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(39, '2012-02-04 14:47:00', '4|2|6', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(45, '2012-02-04 14:59:00', '5|1|6', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(46, '2012-02-04 15:01:00', '5|2|7', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(47, '2012-02-04 15:03:00', '5|3|8', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(48, '2012-02-04 15:05:00', '4|5|9', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(49, '2012-02-04 15:07:00', '2|5|7', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(50, '2012-02-04 15:09:00', '3|1|4', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(51, '2012-02-04 15:11:00', '6|2|8', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(63, '2012-02-11 21:49:00', '3|3|6', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(62, '2012-02-11 21:47:00', '3|6|9', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(61, '2012-02-11 21:45:00', '2|2|4', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(60, '2012-02-11 21:43:00', '2|5|7', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(59, '2012-02-11 21:41:00', '1|2|3', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(58, '2012-02-11 21:39:00', '1|2|3', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(64, '2012-02-11 21:51:00', '2|4|6', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(65, '2012-02-11 21:53:00', '2|4|6', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(66, '2012-02-11 21:55:00', '3|3|6', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(67, '2012-02-11 21:57:00', '4|2|6', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(68, '2012-02-11 21:59:00', '4|1|5', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(69, '2012-02-11 22:01:00', '1|5|6', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(70, '2012-02-11 22:03:00', '3|4|7', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(71, '2012-02-11 22:05:00', '3|1|4', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(72, '2012-02-11 22:07:00', '6|2|8', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(73, '2012-02-11 22:09:00', '4|3|7', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(74, '2012-02-11 22:11:00', '6|1|7', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(75, '2012-02-11 22:13:00', '5|6|11', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(76, '2012-02-11 22:15:00', '3|3|6', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(77, '2012-02-11 22:17:00', '5|5|10', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(78, '2012-02-11 22:19:00', '1|2|3', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(79, '2012-02-11 22:21:00', '3|5|8', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(80, '2012-02-11 22:23:00', '5|2|7', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(81, '2012-02-11 22:25:00', '5|5|10', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(82, '2012-02-11 22:27:00', '5|4|9', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(83, '2012-02-11 22:29:00', '6|6|12', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(84, '2012-02-11 22:31:00', '3|6|9', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(85, '2012-02-11 22:33:00', '4|3|7', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(86, '2012-02-11 22:35:00', '2|5|7', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(87, '2012-02-11 22:37:00', '4|2|6', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(88, '2012-02-11 22:39:00', '6|1|7', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(89, '2012-02-11 22:41:00', '2|5|7', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(90, '2012-02-11 22:43:00', '3|6|9', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(91, '2012-02-11 22:45:00', '1|2|3', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(92, '2012-02-11 22:47:00', '1|4|5', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(93, '2012-02-11 22:49:00', '1|5|6', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(94, '2012-02-11 22:51:00', '5|4|9', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(95, '2012-02-11 22:53:00', '5|3|8', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(96, '2012-02-11 22:55:00', '3|5|8', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(97, '2012-02-11 22:57:00', '3|5|8', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(98, '2012-02-11 22:59:00', '2|1|3', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(99, '2012-02-11 23:01:00', '5|6|11', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(100, '2012-02-11 23:03:00', '6|2|8', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(101, '2012-02-11 23:05:00', '2|4|6', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(102, '2012-02-11 23:07:00', '4|2|6', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(103, '2012-02-11 23:09:00', '2|3|5', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(104, '2012-02-11 23:11:00', '3|1|4', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(105, '2012-02-11 23:13:00', '3|6|9', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(106, '2012-02-11 23:15:00', '3|4|7', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(107, '2012-02-11 23:17:00', '2|5|7', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(108, '2012-02-11 23:19:00', '4|1|5', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(109, '2012-02-11 23:21:00', '1|4|5', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(110, '2012-02-11 23:23:00', '6|3|9', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(111, '2012-02-11 23:25:00', '1|3|4', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(112, '2012-02-11 23:27:00', '3|3|6', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(113, '2012-02-11 23:29:00', '5|3|8', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(114, '2012-02-11 23:31:00', '4|6|10', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(115, '2012-02-11 23:33:00', '1|3|4', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(116, '2012-02-11 23:35:00', '1|5|6', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(117, '2012-02-11 23:37:00', '4|4|8', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(118, '2012-02-11 23:39:00', '1|2|3', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(119, '2012-02-11 23:41:00', '3|3|6', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(120, '2012-02-11 23:43:00', '3|3|6', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(121, '2012-02-11 23:45:00', '4|6|10', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(122, '2012-02-11 23:47:00', '1|6|7', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(123, '2012-02-11 23:49:00', '5|6|11', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(124, '2012-02-11 23:51:00', '3|6|9', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(125, '2012-02-11 23:53:00', '3|6|9', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(126, '2012-02-11 23:55:00', '1|4|5', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(127, '2012-02-11 23:57:00', '2|2|4', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(128, '2012-02-11 23:59:00', '2|1|3', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(129, '2012-02-12 00:01:00', '2|4|6', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(130, '2012-02-12 00:03:00', '3|4|7', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(131, '2012-02-12 00:05:00', '6|5|11', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(132, '2012-02-12 00:07:00', '3|6|9', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(133, '2012-02-12 00:09:00', '4|2|6', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(134, '2012-02-12 00:11:00', '4|2|6', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(135, '2012-02-12 00:13:00', '4|4|8', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(136, '2012-02-12 00:15:00', '4|4|8', 1, 0, 0, '36|18|12|9|7.2|6|7.2|9|12|18|36', 0, 0, 0),
(137, '2012-02-12 00:17:00', NULL, 0, 0, 0, NULL, 0, 0, 0),
(138, '2012-02-12 00:19:00', NULL, 0, 0, 0, NULL, 0, 0, 0),
(139, '2012-02-12 00:21:00', NULL, 0, 0, 0, NULL, 0, 0, 0),
(140, '2012-02-12 00:23:00', NULL, 0, 0, 0, NULL, 0, 0, 0),
(141, '2012-02-12 00:25:00', NULL, 0, 0, 0, NULL, 0, 0, 0),
(142, '2012-02-12 00:27:00', NULL, 0, 0, 0, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `lf_game11_auto`
--

CREATE TABLE IF NOT EXISTS `lf_game11_auto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startNO` int(11) DEFAULT '0',
  `endNO` int(11) DEFAULT '0',
  `minG` int(11) DEFAULT '0',
  `maxG` int(11) DEFAULT '0',
  `autoid` int(11) DEFAULT '0',
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `startNO` (`startNO`,`endNO`,`autoid`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `lf_game11_auto`
--


-- --------------------------------------------------------

--
-- 表的结构 `lf_game11_auto_tz`
--

CREATE TABLE IF NOT EXISTS `lf_game11_auto_tz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `tzname` varchar(255) DEFAULT NULL COMMENT '投注名称',
  `tzunm` varchar(255) DEFAULT '' COMMENT '投注号与豆豆',
  `tzpoints` int(11) DEFAULT '0',
  `tzid` int(11) DEFAULT NULL COMMENT '投注顺序',
  `winid` int(11) DEFAULT '0',
  `lossid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `lf_game11_auto_tz`
--


-- --------------------------------------------------------

--
-- 表的结构 `lf_game11_kg_users_tz`
--

CREATE TABLE IF NOT EXISTS `lf_game11_kg_users_tz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `NO` int(11) DEFAULT NULL,
  `tznum` int(11) DEFAULT '0',
  `tzpoints` int(11) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `hdpoints` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`NO`,`tznum`,`hdpoints`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `lf_game11_kg_users_tz`
--


-- --------------------------------------------------------

--
-- 表的结构 `lf_game11_users_tz`
--

CREATE TABLE IF NOT EXISTS `lf_game11_users_tz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `NO` int(11) DEFAULT NULL,
  `tznum` varchar(255) DEFAULT NULL,
  `tzpoints` varchar(255) DEFAULT NULL,
  `zjpoints` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `points` int(11) DEFAULT '0',
  `hdpoints` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`NO`,`hdpoints`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `lf_game11_users_tz`
--

INSERT INTO `lf_game11_users_tz` (`id`, `uid`, `NO`, `tznum`, `tzpoints`, `zjpoints`, `time`, `points`, `hdpoints`) VALUES
(1, 15888, 6, '2|3|4|5|6|7|8|9|10|11|12', '1|2|3|4|5|6|5|4|3|2|1', '0|0|36|0|0|0|0|0|0|0|0', '2012-02-01 22:47:33', 36, 36),
(2, 15888, 15, '3|5|7|9|11|8', '2|4|6|4|2|10', '0|0|0|0|0|0', '2012-02-01 23:09:47', 28, 0);

-- --------------------------------------------------------

--
-- 表的结构 `lf_game16`
--

CREATE TABLE IF NOT EXISTS `lf_game16` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kgtime` datetime DEFAULT NULL,
  `kgjg` varchar(255) DEFAULT NULL,
  `kj` int(11) DEFAULT '0',
  `tznum` int(11) DEFAULT '0',
  `tzpoints` int(11) DEFAULT '0',
  `zjpl` varchar(255) DEFAULT NULL,
  `zjrnum` int(11) DEFAULT '0',
  `zdtz` int(11) DEFAULT '0',
  `sdtz` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `kj` (`kj`),
  KEY `zjpl` (`zjpl`),
  KEY `zjrnum` (`zjrnum`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=104 ;

--
-- 转存表中的数据 `lf_game16`
--

INSERT INTO `lf_game16` (`id`, `kgtime`, `kgjg`, `kj`, `tznum`, `tzpoints`, `zjpl`, `zjrnum`, `zdtz`, `sdtz`) VALUES
(1, '2012-02-01 22:43:00', '4|3|3|10', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(2, '2012-02-01 22:46:00', '3|2|2|7', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(3, '2012-02-01 22:49:00', '2|4|2|8', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(4, '2012-02-01 22:52:00', '1|5|6|12', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(5, '2012-02-01 22:55:00', '5|2|5|12', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(6, '2012-02-01 22:58:00', '6|4|6|16', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(7, '2012-02-01 22:58:00', '6|2|4|12', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(8, '2012-02-01 23:04:00', '6|4|1|11', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(9, '2012-02-01 23:04:00', '4|1|1|6', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(10, '2012-02-01 23:10:00', '5|3|5|13', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(11, '2012-02-01 23:13:00', '4|1|1|6', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(12, '2012-02-01 23:16:00', '6|6|6|18', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(13, '2012-02-01 23:16:00', '6|1|1|8', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(14, '2012-02-01 23:22:00', '4|1|4|9', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(15, '2012-02-01 23:22:00', '1|3|1|5', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(35, '2012-02-04 15:03:00', '1|5|6|12', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(34, '2012-02-04 15:00:00', '6|2|4|12', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(33, '2012-02-04 14:57:00', '6|6|6|18', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(32, '2012-02-04 14:54:00', '6|4|2|12', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(23, '2012-02-02 21:49:00', '1|1|5|7', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(22, '2012-02-02 21:46:00', '4|4|5|13', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(31, '2012-02-04 14:51:00', '3|3|2|8', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(30, '2012-02-04 14:48:00', '4|6|5|15', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(36, '2012-02-04 15:06:00', '6|3|3|12', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(37, '2012-02-04 15:09:00', '1|5|5|11', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(38, '2012-02-04 15:12:00', '3|3|2|8', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(50, '2012-02-11 21:55:00', '1|6|4|11', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(49, '2012-02-11 21:52:00', '2|3|4|9', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(48, '2012-02-11 21:49:00', '5|5|1|11', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(47, '2012-02-11 21:46:00', '3|6|5|14', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(46, '2012-02-11 21:43:00', '2|1|4|7', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(45, '2012-02-11 21:40:00', '2|4|6|12', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(51, '2012-02-11 21:58:00', '1|2|6|9', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(52, '2012-02-11 22:01:00', '1|3|5|9', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(53, '2012-02-11 22:04:00', '4|5|1|10', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(54, '2012-02-11 22:07:00', '6|2|5|13', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(55, '2012-02-11 22:10:00', '2|3|2|7', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(56, '2012-02-11 22:13:00', '2|4|3|9', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(57, '2012-02-11 22:16:00', '2|6|1|9', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(58, '2012-02-11 22:19:00', '1|1|6|8', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(59, '2012-02-11 22:22:00', '5|2|5|12', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(60, '2012-02-11 22:25:00', '5|4|6|15', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(61, '2012-02-11 22:28:00', '5|4|1|10', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(62, '2012-02-11 22:31:00', '2|6|1|9', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(63, '2012-02-11 22:34:00', '5|5|6|16', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(64, '2012-02-11 22:37:00', '1|3|3|7', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(65, '2012-02-11 22:40:00', '5|1|6|12', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(66, '2012-02-11 22:43:00', '6|5|2|13', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(67, '2012-02-11 22:46:00', '2|5|4|11', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(68, '2012-02-11 22:49:00', '2|2|3|7', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(69, '2012-02-11 22:52:00', '5|4|3|12', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(70, '2012-02-11 22:55:00', '1|1|1|3', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(71, '2012-02-11 22:58:00', '6|2|5|13', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(72, '2012-02-11 23:01:00', '1|4|3|8', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(73, '2012-02-11 23:04:00', '1|4|3|8', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(74, '2012-02-11 23:07:00', '4|3|6|13', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(75, '2012-02-11 23:10:00', '1|1|2|4', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(76, '2012-02-11 23:13:00', '3|2|1|6', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(77, '2012-02-11 23:16:00', '4|4|1|9', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(78, '2012-02-11 23:19:00', '5|4|5|14', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(79, '2012-02-11 23:22:00', '6|2|2|10', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(80, '2012-02-11 23:25:00', '6|5|5|16', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(81, '2012-02-11 23:28:00', '6|3|3|12', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(82, '2012-02-11 23:31:00', '4|5|2|11', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(83, '2012-02-11 23:34:00', '2|4|4|10', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(84, '2012-02-11 23:37:00', '1|3|6|10', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(85, '2012-02-11 23:40:00', '4|3|1|8', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(86, '2012-02-11 23:43:00', '1|2|4|7', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(87, '2012-02-11 23:46:00', '2|6|3|11', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(88, '2012-02-11 23:49:00', '6|3|2|11', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(89, '2012-02-11 23:52:00', '4|1|6|11', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(90, '2012-02-11 23:55:00', '4|2|2|8', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(91, '2012-02-11 23:58:00', '3|1|4|8', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(92, '2012-02-12 00:01:00', '3|5|3|11', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(93, '2012-02-12 00:04:00', '4|4|5|13', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(94, '2012-02-12 00:07:00', '1|2|6|9', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(95, '2012-02-12 00:10:00', '2|6|4|12', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(96, '2012-02-12 00:13:00', '4|4|5|13', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(97, '2012-02-12 00:16:00', '2|4|2|8', 1, 0, 0, '216|72|36|21.6|14.4|10.29|8.64|8|8|8.64|10.29|14.4|21.6|36|72|216', 0, 0, 0),
(98, '2012-02-12 00:19:00', NULL, 0, 0, 0, NULL, 0, 0, 0),
(99, '2012-02-12 00:22:00', NULL, 0, 0, 0, NULL, 0, 0, 0),
(100, '2012-02-12 00:25:00', NULL, 0, 0, 0, NULL, 0, 0, 0),
(101, '2012-02-12 00:28:00', NULL, 0, 0, 0, NULL, 0, 0, 0),
(102, '2012-02-12 00:31:00', NULL, 0, 0, 0, NULL, 0, 0, 0),
(103, '2012-02-12 00:34:00', NULL, 0, 0, 0, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `lf_game16_auto`
--

CREATE TABLE IF NOT EXISTS `lf_game16_auto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startNO` int(11) DEFAULT '0',
  `endNO` int(11) DEFAULT '0',
  `minG` int(11) DEFAULT '0',
  `maxG` int(11) DEFAULT '0',
  `autoid` int(11) DEFAULT '0',
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `startNO` (`startNO`,`endNO`,`autoid`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `lf_game16_auto`
--


-- --------------------------------------------------------

--
-- 表的结构 `lf_game16_auto_tz`
--

CREATE TABLE IF NOT EXISTS `lf_game16_auto_tz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `tzname` varchar(255) DEFAULT NULL COMMENT '投注名称',
  `tzunm` varchar(255) DEFAULT '' COMMENT '投注号与豆豆',
  `tzpoints` int(11) DEFAULT '0',
  `tzid` int(11) DEFAULT NULL COMMENT '投注顺序',
  `winid` int(11) DEFAULT '0',
  `lossid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `lf_game16_auto_tz`
--


-- --------------------------------------------------------

--
-- 表的结构 `lf_game16_kg_users_tz`
--

CREATE TABLE IF NOT EXISTS `lf_game16_kg_users_tz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `NO` int(11) DEFAULT NULL,
  `tznum` int(11) DEFAULT '0',
  `tzpoints` int(11) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `hdpoints` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`NO`,`tznum`,`hdpoints`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `lf_game16_kg_users_tz`
--


-- --------------------------------------------------------

--
-- 表的结构 `lf_game16_users_tz`
--

CREATE TABLE IF NOT EXISTS `lf_game16_users_tz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `NO` int(11) DEFAULT NULL,
  `tznum` varchar(255) DEFAULT NULL,
  `tzpoints` varchar(255) DEFAULT NULL,
  `zjpoints` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `points` int(11) DEFAULT '0',
  `hdpoints` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`NO`,`hdpoints`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `lf_game16_users_tz`
--


-- --------------------------------------------------------

--
-- 表的结构 `lf_game28`
--

CREATE TABLE IF NOT EXISTS `lf_game28` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kgtime` datetime DEFAULT NULL,
  `kgjg` varchar(255) DEFAULT NULL,
  `kj` int(11) DEFAULT '0',
  `tznum` int(11) DEFAULT '0',
  `tzpoints` int(11) DEFAULT '0',
  `zjpl` varchar(255) DEFAULT NULL,
  `zjrnum` int(11) DEFAULT '0',
  `gfid` int(11) DEFAULT NULL,
  `kgwh` varchar(255) DEFAULT NULL,
  `zdtz` int(11) DEFAULT '0',
  `sdtz` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `kj` (`kj`),
  KEY `zjpl` (`zjpl`),
  KEY `zjrnum` (`zjrnum`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=74 ;

--
-- 转存表中的数据 `lf_game28`
--

INSERT INTO `lf_game28` (`id`, `kgtime`, `kgjg`, `kj`, `tznum`, `tzpoints`, `zjpl`, `zjrnum`, `gfid`, `kgwh`, `zdtz`, `sdtz`) VALUES
(1, '2012-02-01 22:45:00', '91|321|470|2', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 484461, '49 56 80', 0, 0),
(2, '2012-02-01 22:50:00', '74|248|404|16', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 484462, '14 42 11', 0, 0),
(3, '2012-02-01 22:55:00', '100|216|418|14', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 484462, '31 73 25', 0, 0),
(4, '2012-02-01 23:00:00', '161|167|340|8', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 484464, '71 8 44', 0, 0),
(5, '2012-02-01 23:05:00', '103|271|423|7', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 484465, '38 62 20', 0, 0),
(6, '2012-02-01 23:10:00', '169|311|420|10', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 484466, '78 61 20', 0, 0),
(7, '2012-02-01 23:10:00', '134|246|402|12', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 484466, '58 30 2', 0, 0),
(8, '2012-02-01 23:16:00', '114|192|348|14', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 484468, '63 14 65', 0, 0),
(9, '2012-02-01 23:16:00', '109|256|291|16', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 484468, '54 78 10', 0, 0),
(42, '2012-02-11 22:07:00', '89|190|347|16', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486244, '24 61 2', 0, 0),
(41, '2012-02-11 22:02:00', '125|288|436|19', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486243, '50 41 47', 0, 0),
(30, '2012-02-04 15:10:00', '64|261|308|13', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 484907, '29 29 6', 0, 0),
(17, '2012-02-02 21:53:00', '3|3|5|11', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 0, '', 0, 0),
(16, '2012-02-02 21:48:00', '0|4|2|6', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 0, '', 0, 0),
(29, '2012-02-04 15:05:00', '106|304|326|16', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 484906, '14 65 15', 0, 0),
(28, '2012-02-04 15:00:00', '87|171|393|11', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 484905, '2 12 20', 0, 0),
(27, '2012-02-04 14:55:00', '92|281|408|11', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 484904, '9 71 25', 0, 0),
(26, '2012-02-04 14:50:00', '169|274|466|19', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 484903, '71 5 64', 0, 0),
(40, '2012-02-11 21:57:00', '100|281|370|1', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486242, '63 74 52', 0, 0),
(39, '2012-02-11 21:52:00', '45|162|354|11', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486241, '20 26 57', 0, 0),
(38, '2012-02-11 21:47:00', '120|232|294|6', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486240, '60 23 69', 0, 0),
(37, '2012-02-11 21:42:00', '110|306|364|10', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486239, '9 25 40', 0, 0),
(43, '2012-02-11 22:12:00', '105|197|373|15', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486245, '30 29 22', 0, 0),
(44, '2012-02-11 22:17:00', '153|277|401|11', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486246, '69 52 79', 0, 0),
(45, '2012-02-11 22:22:00', '120|268|455|13', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486247, '56 55 65', 0, 0),
(46, '2012-02-11 22:27:00', '119|206|360|15', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486248, '33 4 32', 0, 0),
(47, '2012-02-11 22:32:00', '86|190|332|8', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486249, '36 8 67', 0, 0),
(48, '2012-02-11 22:37:00', '76|171|378|15', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486250, '36 7 13', 0, 0),
(49, '2012-02-11 22:42:00', '71|236|463|10', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486251, '35 70 73', 0, 0),
(50, '2012-02-11 22:47:00', '134|274|250|8', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486252, '25 15 32', 0, 0),
(51, '2012-02-11 22:52:00', '37|251|335|13', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486253, '1 58 28', 0, 0),
(52, '2012-02-11 22:57:00', '177|201|280|8', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486254, '76 1 13', 0, 0),
(53, '2012-02-11 23:02:00', '119|299|457|25', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486255, '46 52 75', 0, 0),
(54, '2012-02-11 23:07:00', '130|287|407|14', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486256, '69 56 56', 0, 0),
(55, '2012-02-11 23:12:00', '130|171|371|2', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486257, '62 50 7', 0, 0),
(56, '2012-02-11 23:17:00', '56|189|276|21', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486258, '4 4 32', 0, 0),
(57, '2012-02-11 23:22:00', '98|244|290|12', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486259, '8 8 61', 0, 0),
(58, '2012-02-11 23:27:00', '84|274|413|11', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486260, '24 72 69', 0, 0),
(59, '2012-02-11 23:32:00', '76|256|366|18', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486261, '10 20 57', 0, 0),
(60, '2012-02-11 23:37:00', '128|263|295|16', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486262, '74 77 63', 0, 0),
(61, '2012-02-11 23:42:00', '96|311|374|11', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486263, '7 62 78', 0, 0),
(62, '2012-02-11 23:47:00', '109|241|440|10', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486264, '48 48 51', 0, 0),
(63, '2012-02-11 23:52:00', '133|236|386|15', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486265, '21 3 1', 0, 0),
(64, '2012-02-11 23:57:00', '91|237|440|8', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 486266, '49 37 59', 0, 0),
(65, '2012-02-12 00:02:00', '7|6|1|14', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 0, '', 0, 0),
(66, '2012-02-12 00:07:00', '2|8|2|12', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 0, '', 0, 0),
(67, '2012-02-12 00:12:00', '4|6|2|12', 1, 0, 0, '1000|333.33|166.67|100|66.66|47.61|35.71|27.77|22.22|18.18|15.87|14.49|13.69|13.33|13.33|13.69|14.49|15.87|18.18|22.22|27.77|35.71|47.61|66.66|100|166.66|333.33|1000', 0, 0, '', 0, 0),
(68, '2012-02-12 00:17:00', NULL, 0, 0, 0, NULL, 0, NULL, NULL, 0, 0),
(69, '2012-02-12 00:22:00', NULL, 0, 0, 0, NULL, 0, NULL, NULL, 0, 0),
(70, '2012-02-12 00:27:00', NULL, 0, 0, 0, NULL, 0, NULL, NULL, 0, 0),
(71, '2012-02-12 00:32:00', NULL, 0, 0, 0, NULL, 0, NULL, NULL, 0, 0),
(72, '2012-02-12 00:37:00', NULL, 0, 0, 0, NULL, 0, NULL, NULL, 0, 0),
(73, '2012-02-12 00:42:00', NULL, 0, 0, 0, NULL, 0, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `lf_game28_auto`
--

CREATE TABLE IF NOT EXISTS `lf_game28_auto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startNO` int(11) DEFAULT '0',
  `endNO` int(11) DEFAULT '0',
  `minG` int(11) DEFAULT '0',
  `maxG` int(11) DEFAULT '0',
  `autoid` int(11) DEFAULT '0',
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `startNO` (`startNO`,`endNO`,`autoid`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `lf_game28_auto`
--


-- --------------------------------------------------------

--
-- 表的结构 `lf_game28_auto_tz`
--

CREATE TABLE IF NOT EXISTS `lf_game28_auto_tz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `tzname` varchar(255) DEFAULT NULL,
  `tzunm` varchar(255) DEFAULT '' COMMENT '投注号与豆豆',
  `tzpoints` int(11) DEFAULT '0',
  `tzid` int(11) DEFAULT NULL,
  `winid` int(11) DEFAULT '0',
  `lossid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `lf_game28_auto_tz`
--


-- --------------------------------------------------------

--
-- 表的结构 `lf_game28_kg_users_tz`
--

CREATE TABLE IF NOT EXISTS `lf_game28_kg_users_tz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `NO` int(11) DEFAULT NULL,
  `tznum` int(11) DEFAULT '0',
  `tzpoints` int(11) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `hdpoints` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`NO`,`tznum`,`hdpoints`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `lf_game28_kg_users_tz`
--


-- --------------------------------------------------------

--
-- 表的结构 `lf_game28_users_tz`
--

CREATE TABLE IF NOT EXISTS `lf_game28_users_tz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `NO` int(11) DEFAULT NULL,
  `tznum` varchar(255) DEFAULT NULL,
  `tzpoints` varchar(255) DEFAULT NULL,
  `zjpoints` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `points` int(11) DEFAULT '0',
  `hdpoints` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`NO`,`hdpoints`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `lf_game28_users_tz`
--


-- --------------------------------------------------------

--
-- 表的结构 `lf_gamebox`
--

CREATE TABLE IF NOT EXISTS `lf_gamebox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `box_1_1_j` int(11) DEFAULT '0',
  `box_1_2_j` int(11) DEFAULT '0',
  `box_1_3_j` int(11) DEFAULT '0',
  `box_1_4_j` int(11) DEFAULT '0',
  `box_1_5_j` int(11) DEFAULT '0',
  `box_1_6_j` int(11) DEFAULT '0',
  `box_1_7_j` int(11) DEFAULT '0',
  `box_1_8_j` int(11) DEFAULT '0',
  `box_2_1_j` int(11) DEFAULT '0',
  `box_2_2_j` int(11) DEFAULT '0',
  `box_2_3_j` int(11) DEFAULT '0',
  `box_2_4_j` int(11) DEFAULT '0',
  `box_2_5_j` int(11) DEFAULT '0',
  `box_2_6_j` int(11) DEFAULT '0',
  `box_2_7_j` int(11) DEFAULT '0',
  `box_2_8_j` int(11) DEFAULT '0',
  `box_3_1_j` int(11) DEFAULT '0',
  `box_3_2_j` int(11) DEFAULT '0',
  `box_3_3_j` int(11) DEFAULT '0',
  `box_3_4_j` int(11) DEFAULT '0',
  `box_3_5_j` int(11) DEFAULT '0',
  `box_3_6_j` int(11) DEFAULT '0',
  `box_3_7_j` int(11) DEFAULT '0',
  `box_3_8_j` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lf_gamebox`
--

INSERT INTO `lf_gamebox` (`id`, `box_1_1_j`, `box_1_2_j`, `box_1_3_j`, `box_1_4_j`, `box_1_5_j`, `box_1_6_j`, `box_1_7_j`, `box_1_8_j`, `box_2_1_j`, `box_2_2_j`, `box_2_3_j`, `box_2_4_j`, `box_2_5_j`, `box_2_6_j`, `box_2_7_j`, `box_2_8_j`, `box_3_1_j`, `box_3_2_j`, `box_3_3_j`, `box_3_4_j`, `box_3_5_j`, `box_3_6_j`, `box_3_7_j`, `box_3_8_j`) VALUES
(1, 300000, 100000, 80000, 50000, 10000, 5000, 500, 3, 150000, 50000, 20000, 10000, 30000, 1000, 100, 2, 3000, 1000, 800, 500, 100, 50, 20, 1);

-- --------------------------------------------------------

--
-- 表的结构 `lf_gamebox_log`
--

CREATE TABLE IF NOT EXISTS `lf_gamebox_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `boxtype` int(11) DEFAULT '0',
  `kjy` int(11) DEFAULT '0',
  `hjpp` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `lf_gamebox_log`
--


-- --------------------------------------------------------

--
-- 表的结构 `lf_gamedodge`
--

CREATE TABLE IF NOT EXISTS `lf_gamedodge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `tzid` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT '0',
  `password` varchar(255) DEFAULT NULL,
  `dodge` int(11) DEFAULT '0',
  `tzdodge` int(11) DEFAULT '0',
  `zt` int(11) DEFAULT '0',
  `nopassword` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lf_gamedodge`
--


-- --------------------------------------------------------

--
-- 表的结构 `lf_game_kg`
--

CREATE TABLE IF NOT EXISTS `lf_game_kg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NO` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `num1` int(11) DEFAULT '0',
  `num2` int(11) DEFAULT '0',
  `num3` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `NO` (`NO`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `lf_game_kg`
--


-- --------------------------------------------------------

--
-- 表的结构 `lf_game_log`
--

CREATE TABLE IF NOT EXISTS `lf_game_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_hd` int(11) DEFAULT '0',
  `sfyz_hd` int(11) DEFAULT '0',
  `game11_hd` int(11) DEFAULT '0',
  `game16_hd` int(11) DEFAULT '0',
  `game28_hd` int(11) DEFAULT '0',
  `gamebox_hd` int(11) DEFAULT '0',
  `gamedodge_hd` int(11) DEFAULT '0',
  `dj_hd` int(11) DEFAULT '0' COMMENT '道具',
  `ad_hd` int(11) DEFAULT '0' COMMENT '广告奖励',
  `jj_hd` int(11) DEFAULT '0' COMMENT '救济领取',
  `xx_hd` int(11) DEFAULT '0' COMMENT '下线奖励',
  `hd_hd` int(11) DEFAULT '0' COMMENT '活动奖励',
  `dj_doudou` int(11) DEFAULT '0' COMMENT '兑奖豆豆',
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `lf_game_log`
--

INSERT INTO `lf_game_log` (`id`, `reg_hd`, `sfyz_hd`, `game11_hd`, `game16_hd`, `game28_hd`, `gamebox_hd`, `gamedodge_hd`, `dj_hd`, `ad_hd`, `jj_hd`, `xx_hd`, `hd_hd`, `dj_doudou`, `uid`) VALUES
(1, 100, 0, -28, 0, 0, 0, 0, 10100, 111, 0, 7210, 0, 0, 15888),
(2, 100, 500, 0, 0, 0, 0, -100000, 1000, 0, 0, 0, 0, 1, 56888);

-- --------------------------------------------------------

--
-- 表的结构 `lf_game_system`
--

CREATE TABLE IF NOT EXISTS `lf_game_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game16_go_samples` int(11) DEFAULT '0',
  `game16_go_time` int(11) DEFAULT '0',
  `game16_tz_experience` int(11) DEFAULT '0',
  `game16_jl_experience` int(11) DEFAULT '0',
  `game16_jl_maxexperience` int(11) DEFAULT '0',
  `game16_jl_experience_vip` int(11) DEFAULT '0',
  `game16_jl_maxexperience_vip` int(11) DEFAULT '0',
  `game28_go_samples` int(11) DEFAULT '0',
  `game28_go_time` int(11) DEFAULT '0',
  `game28_tz_experience` int(11) DEFAULT '0',
  `game28_jl_experience` int(11) DEFAULT '0',
  `game28_jl_maxexperience` int(11) DEFAULT '0',
  `game28_jl_experience_vip` int(11) DEFAULT '0',
  `game28_jl_maxexperience_vip` int(11) DEFAULT '0',
  `gamedodge_tz_minpoints` int(11) DEFAULT '0',
  `gamedodge_tz_cl` int(11) DEFAULT '0',
  `gamedodge_jl_experience` int(11) DEFAULT '0',
  `gamedodge_jl_maxexperience` int(11) DEFAULT '0',
  `gamedodge_jl_experience_vip` int(11) DEFAULT '0',
  `gamedodge_jl_maxexperience_vip` int(11) DEFAULT '0',
  `game11_go_samples` int(11) DEFAULT '0',
  `game11_go_time` int(11) DEFAULT '0',
  `game11_tz_experience` int(11) DEFAULT '0',
  `game11_jl_experience` int(11) DEFAULT '0',
  `game11_jl_maxexperience` int(11) DEFAULT '0',
  `game11_jl_experience_vip` int(11) DEFAULT '0',
  `game11_jl_maxexperience_vip` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lf_game_system`
--

INSERT INTO `lf_game_system` (`id`, `game16_go_samples`, `game16_go_time`, `game16_tz_experience`, `game16_jl_experience`, `game16_jl_maxexperience`, `game16_jl_experience_vip`, `game16_jl_maxexperience_vip`, `game28_go_samples`, `game28_go_time`, `game28_tz_experience`, `game28_jl_experience`, `game28_jl_maxexperience`, `game28_jl_experience_vip`, `game28_jl_maxexperience_vip`, `gamedodge_tz_minpoints`, `gamedodge_tz_cl`, `gamedodge_jl_experience`, `gamedodge_jl_maxexperience`, `gamedodge_jl_experience_vip`, `gamedodge_jl_maxexperience_vip`, `game11_go_samples`, `game11_go_time`, `game11_tz_experience`, `game11_jl_experience`, `game11_jl_maxexperience`, `game11_jl_experience_vip`, `game11_jl_maxexperience_vip`) VALUES
(1, 0, 5, 100, 2, 120, 4, 240, 10, 25, 100, 2, 120, 4, 240, 10000, 5, 10, 120, 20, 240, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `lf_help`
--

CREATE TABLE IF NOT EXISTS `lf_help` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext,
  `time` date DEFAULT NULL,
  `top` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=FIXED AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `lf_help`
--

INSERT INTO `lf_help` (`id`, `title`, `content`, `time`, `top`) VALUES
(1, '帮助测试1', '帮助测试1帮助测试1帮助测试1', '2011-05-30', 0),
(2, '帮助测试1帮助测试1', '帮助测试1帮助测试1帮助测试1', '2011-05-30', 1),
(3, '帮助测试1帮助测试1', '帮助测试1帮助测试1帮助测试1帮助测试1', '2011-05-30', 0);

-- --------------------------------------------------------

--
-- 表的结构 `lf_link`
--

CREATE TABLE IF NOT EXISTS `lf_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webname` varchar(100) DEFAULT NULL,
  `weburl` varchar(255) DEFAULT NULL,
  `webcontent` longtext,
  `sort` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=FIXED AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lf_link`
--

INSERT INTO `lf_link` (`id`, `webname`, `weburl`, `webcontent`, `sort`) VALUES
(1, '合作商家1', 'http://localhost/', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `lf_log`
--

CREATE TABLE IF NOT EXISTS `lf_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logcontent` varchar(255) DEFAULT NULL,
  `logtime` datetime DEFAULT NULL,
  `logname` varchar(100) DEFAULT NULL,
  `logip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=FIXED AUTO_INCREMENT=45 ;

--
-- 转存表中的数据 `lf_log`
--

INSERT INTO `lf_log` (`id`, `logcontent`, `logtime`, `logname`, `logip`) VALUES
(1, '网站问卷广告添加成功', '2011-05-30 06:12:14', 'admin', '127.0.0.1'),
(2, '网站论坛版块添加成功', '2011-05-30 06:15:18', 'admin', '127.0.0.1'),
(3, '网站互动广告添加成功', '2011-05-30 06:16:41', 'admin', '127.0.0.1'),
(4, '登陆成功', '2011-05-30 13:55:45', 'admin', '127.0.0.1'),
(5, '修改网站设置', '2011-05-30 13:56:13', 'admin', '127.0.0.1'),
(6, '网站消费体验广告添加成功', '2011-05-30 13:56:36', 'admin', '127.0.0.1'),
(7, '网站论坛版块修改成功', '2011-05-30 14:19:38', 'admin', '127.0.0.1'),
(8, '网站商户添加成功', '2011-05-30 14:23:47', 'admin', '127.0.0.1'),
(9, '添加充值卡类型', '2011-05-30 14:57:21', 'admin', '127.0.0.1'),
(10, '生成充值卡', '2011-05-30 15:05:00', 'admin', '127.0.0.1'),
(11, '修改充值卡类型成功', '2011-05-30 15:06:24', 'admin', '127.0.0.1'),
(12, '生成充值卡', '2011-05-30 15:06:43', 'admin', '127.0.0.1'),
(13, '充值卡删除成功', '2011-05-30 15:23:29', 'admin', '127.0.0.1'),
(14, '网站公告添加成功', '2011-05-30 15:49:53', 'admin', '127.0.0.1'),
(15, '网站公告添加成功', '2011-05-30 15:50:11', 'admin', '127.0.0.1'),
(16, '网站公告添加成功', '2011-05-30 15:50:29', 'admin', '127.0.0.1'),
(17, '添加奖品分类', '2011-05-30 15:50:49', 'admin', '127.0.0.1'),
(18, '添加奖品', '2011-05-30 15:51:36', 'admin', '127.0.0.1'),
(19, '网站帮助添加成功', '2011-05-30 15:54:01', 'admin', '127.0.0.1'),
(20, '网站帮助添加成功', '2011-05-30 15:54:07', 'admin', '127.0.0.1'),
(21, '网站帮助添加成功', '2011-05-30 15:54:12', 'admin', '127.0.0.1'),
(22, '活动添加成功', '2011-05-30 15:55:29', 'admin', '127.0.0.1'),
(23, '网站幻灯添加成功', '2011-05-30 15:56:37', 'admin', '127.0.0.1'),
(24, '网站幻灯添加成功', '2011-05-30 15:56:51', 'admin', '127.0.0.1'),
(25, '友情链接添加成功', '2011-05-30 15:57:23', 'admin', '127.0.0.1'),
(26, '网站问卷广告修改成功', '2011-05-30 16:00:52', 'admin', '127.0.0.1'),
(27, '用户修改成功', '2011-05-30 16:09:25', 'admin', '127.0.0.1'),
(28, '兑换发货成功', '2011-05-30 16:10:12', 'admin', '127.0.0.1'),
(29, '网站商户公告添加成功', '2011-05-30 16:14:38', 'admin', '127.0.0.1'),
(30, '生成充值卡', '2011-05-30 16:15:56', 'admin', '127.0.0.1'),
(31, '网站支付接口添加成功', '2011-05-30 16:18:06', 'admin', '127.0.0.1'),
(32, '网站用户组添加成功', '2011-05-30 16:23:10', 'admin', '127.0.0.1'),
(33, '网站互动广告添加成功', '2011-05-30 16:40:55', 'admin', '127.0.0.1'),
(34, '修改网站设置', '2011-05-31 23:48:19', 'admin', '127.0.0.1'),
(35, '登陆成功', '2012-02-01 21:45:03', 'admin', '127.0.0.1'),
(36, '登陆成功', '2012-02-01 21:45:50', 'admin', '127.0.0.1'),
(37, '修改网站设置', '2012-02-01 21:49:42', 'admin', '127.0.0.1'),
(38, '登陆成功', '2012-02-01 21:49:48', 'admin', '127.0.0.1'),
(39, '修改网站设置', '2012-02-01 21:53:00', 'admin', '127.0.0.1'),
(40, '修改幸运28-游戏设置', '2012-02-01 22:27:13', 'admin', '127.0.0.1'),
(41, '用户修改成功', '2012-02-01 22:44:43', 'admin', '127.0.0.1'),
(42, '登陆成功', '2012-02-11 19:43:36', 'admin', '127.0.0.1'),
(43, '登陆成功', '2012-02-20 23:23:00', 'admin', '127.0.0.1'),
(44, '登陆成功', '2012-05-06 14:44:41', 'admin', '127.0.0.1');

-- --------------------------------------------------------

--
-- 表的结构 `lf_msg`
--

CREATE TABLE IF NOT EXISTS `lf_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usersid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `mag` mediumtext,
  `mid` int(11) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `del` int(11) DEFAULT '0',
  `look` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `usersid` (`usersid`),
  KEY `mid` (`mid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `lf_msg`
--

INSERT INTO `lf_msg` (`id`, `usersid`, `title`, `mag`, `mid`, `time`, `del`, `look`) VALUES
(1, 0, '兑奖发货通知', '您兑换的奖品移动话费卡100面额已经发货，谢谢您对我们的支持。', 56888, '2011-05-30 16:10:12', 0, 1),
(2, 15888, 'sss', 'ssssssssssssss', 56888, '2011-05-30 16:10:43', 0, 1),
(3, 0, '系统发卡通知', '您购买的 测试充值卡效果</br>卡号：44O2R8FEH</br>密码：2E5GXLO', 15888, '2011-05-30 16:13:14', 0, 1),
(4, 0, '系统发卡通知', '您购买的 测试充值卡效果</br>卡号：44MNIATS4</br>密码：TA6X8ZM', 56888, '2011-05-30 16:16:34', 0, 1),
(5, 0, '猜拳无人挑战退回', '您摆擂的第1期猜拳，因24小时无人挑战投注的100000金豆已经退回', 56888, '2012-02-01 21:53:22', 0, 0),
(6, 0, 'VIP到期通知', '您的VIP会员已于2012-02-01到期,请您续费。', 56888, '2012-02-01 22:40:41', 0, 0),
(7, 0, 'VIP到期通知', '您的VIP会员已于2012-02-01到期,请您续费。', 15888, '2012-02-01 22:40:41', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `lf_news`
--

CREATE TABLE IF NOT EXISTS `lf_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext,
  `time` date DEFAULT NULL,
  `top` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=FIXED AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `lf_news`
--

INSERT INTO `lf_news` (`id`, `title`, `content`, `time`, `top`) VALUES
(1, '公告牌测试1', '公告牌测试1公告牌测试1公告牌测试1公告牌测试1公告牌测试1', '2011-05-30', 0),
(2, '公告牌测试2', '公告牌测试2公告牌测试2公告牌测试2公告牌测试2公告牌测试2', '2011-05-30', 0),
(3, '公告牌测试3', '公告牌测试3公告牌测试3公告牌测试3公告牌测试3', '2011-05-30', 0);

-- --------------------------------------------------------

--
-- 表的结构 `lf_paylog`
--

CREATE TABLE IF NOT EXISTS `lf_paylog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` varchar(255) DEFAULT NULL,
  `price` float(12,2) DEFAULT NULL,
  `businessid` int(11) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `type` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `lf_paylog`
--

INSERT INTO `lf_paylog` (`id`, `orderid`, `price`, `businessid`, `time`, `type`) VALUES
(1, '0-20110530150500', 0.00, 1, '2011-05-30 15:05:00', 0),
(2, '0-20110530150643', 0.00, 1, '2011-05-30 15:06:43', 0),
(3, '0-20110530161556', 0.00, 1, '2011-05-30 16:15:56', 0);

-- --------------------------------------------------------

--
-- 表的结构 `lf_paylogc`
--

CREATE TABLE IF NOT EXISTS `lf_paylogc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cardname` varchar(255) DEFAULT NULL,
  `cardnum` int(11) DEFAULT '0',
  `price` float(12,2) DEFAULT '0.00',
  `orderid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `lf_paylogc`
--

INSERT INTO `lf_paylogc` (`id`, `cardname`, `cardnum`, `price`, `orderid`) VALUES
(1, '测试充值卡效果', 1, 0.00, '0-20110530150500'),
(2, '测试充值卡效果', 11, 0.00, '0-20110530150643'),
(3, '测试充值卡效果', 11, 0.00, '0-20110530161556');

-- --------------------------------------------------------

--
-- 表的结构 `lf_payset`
--

CREATE TABLE IF NOT EXISTS `lf_payset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paysetname` varchar(255) DEFAULT NULL,
  `paysetdocument` varchar(255) DEFAULT NULL,
  `pysetreceiver` varchar(255) DEFAULT NULL,
  `paysetid` varchar(255) DEFAULT NULL,
  `paysetpassword` varchar(255) DEFAULT NULL,
  `paysetremarks` mediumtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lf_payset`
--

INSERT INTO `lf_payset` (`id`, `paysetname`, `paysetdocument`, `pysetreceiver`, `paysetid`, `paysetpassword`, `paysetremarks`) VALUES
(1, '易宝支付接口', 'http://localhost', 'http://localhost', '12222', '1213123123', 'http://localhost');

-- --------------------------------------------------------

--
-- 表的结构 `lf_reg`
--

CREATE TABLE IF NOT EXISTS `lf_reg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=FIXED AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lf_reg`
--

INSERT INTO `lf_reg` (`id`, `content`) VALUES
(1, '<P align=left>注册协议：</P>\r\n<P align=left>重要须知： <BR>豆豆网在此特别提醒用户，请您认真阅读本《协议》，一旦您注册成为豆豆网会员，即视您已经接受本《协议》，您有义务履行本《协议》各项条款。 </P>\r\n<P align=left>1 知识产权声明</P>\r\n<P align=left>本站（网站—www.28jingyan.com)所登载发布的一切内容，包括但不限于文字、图片、音像、图表、标志、标识、广告、商标、域名、软件、程序、版面设计、专栏目录与名称、内容分类标准以及为使用者提供的任何信息，均受《中华人民共和国著作权法》、《中华人民共和国商标法》、《中华人民共和国专利法》等法律法规以及有关国际条约的保护! 未经豆豆网权利人书面授权，任何人不得将本站所登载、发布的内容及相关服务用于商业性目的，亦不得改动、转载、链接、复制、发行、传播等本站的部分或全部内容或服务，或将之在非本站所属的服务器上作镜像。否则，豆豆网将依法追究侵权者的法律责任。 </P>\r\n<P align=left>2 用户使用须知</P>\r\n<P align=left>2.1 用户应保证用户注册登记时提供的资料均为真实无误，必须严格遵守一人一账户的严格规定，不恶意注册、恶意刷新获得账户。</P>\r\n<P align=left>2.2. 豆豆网帐号的所有权归豆豆网站，用户注册成功后，获得豆豆网帐号的使用权。仅属于初始申请注册人，禁止转让或继受、售卖。如果豆豆网发现使用者并非帐号初始注册人，豆豆网有权回收该帐号而无需向该帐户使用人承担法律责任。豆豆网禁止用户私下有偿或无偿转让帐号，以免因帐号问题产生纠纷，用户因违反此要求遭致的任何损失自行承担。</P>\r\n<P align=left>2.3 用户不得制造虚假信息以误导、欺骗他人。</P>\r\n<P align=left>2.4 任何人不得进行任何危害计算机网络安全的行为，包括但不限于：使用未经许可的数据或进入未经许可的服务器/帐户；未经允许进入公众计算机网络或者他人计算机系统并删除、修改、增加存储信息；未经许可，企图探查、扫描、测试本网站系统或网络的弱点或其它实施破坏网络安全的行为； 企图干涉、破坏本网站的正常运行，故意传播恶意程序或病毒以及其他破坏干扰正常网络信息服务的行为。</P>\r\n<P align=left>2.4 使用豆豆网帐号必须遵守国家有关法律和政策等，维护国家利益，保护国家安全，并遵守本协议，对于用户违法或违反本协议的使用而引起的一切责任，由用户负全部责任，一概与豆豆网及合作单位无关，导致豆豆网及合作单位损失的，豆豆网及合作单位有权要求用户赔偿，并有权立即停止向其提供服务，保留相关记录，保留配合司法机关追究法律责任的权利。</P>\r\n<P align=left>2.5 未成年人上网应该在父母和老师的指导下，正确学习使用网络。未成年人避免沉迷虚拟的网络世界而影响了日常的学习生活。</P>\r\n<P align=left>2.6 尊重用户信息资源的私有性是豆豆网的一贯制度，豆豆网将会采取合理的措施保护用户的信息资源，除法律或政府要求或用户同意等原因外，豆豆网未经用户同意不向除合作单位以外的第三方公开、 透露用户信息资源。 但是用户在注册时选择或同意，或用户与豆豆网及合作单位之间就用户信息资源公开或使用另有约定的除外，同时用户应自行承担因此可能产生的任何风险，豆豆网对此不予负责。</P>\r\n<P align=left>3 法律责任与免责</P>\r\n<P align=left>3.1 利用的许可</P>\r\n<P align=left>3.1.1 许可利用您的计算机： 为了得到豆豆网所提供的利益，您在此许可豆豆网利用您计算机的处理器和宽带等一切必需的硬件设施。</P>\r\n<P align=left>3.1.2 保护您的计算机（资源）： 您认可豆豆网将会尽其商业上的合理努力以保护您的计算机资源及计算机通讯的隐私性和完整性，但是， 您承认和同意豆豆网不能就此事提供任何保证。</P>\r\n<P align=left>3.2 豆豆网特别提请用户注意，豆豆网为了保障公司业务发展和调整的自主权，豆豆网拥有随时自行修改或中断授权而不需通知用户的权利，如有必要，修改或中断会以通告形式公布于豆豆网网站重要页面上。</P>\r\n<P align=left>3.3 用户违反本协议或相关的服务条款的规定，导致或产生的任何第三方主张的任何索赔、要求或损失，包括合理的律师费，您同意赔偿豆豆网与合作公司、关联公司，并使之免受损害。对此，豆豆网有权视用户的行为性质，采取包括但不限于中断使用许可、停止提供服务、限制使用、回收用户豆豆网帐号、法律追究等措施。</P>\r\n<P align=left>3.4 使用豆豆网由用户自己承担风险，豆豆网及合作单位对此不作任何类型的担保，对在任何情况下因使用或不能使用所产生的直接、间接、偶然、特殊及后续的损害及风险，豆豆网及合作单位不承担任何责任。</P>\r\n<P align=left>3.5 使用豆豆网涉及到互联网服务，可能会受到各个环节不稳定因素的影响，存在因不可抗力、计算机病毒、黑客攻击、系统不稳定、用户所在位置、用户关机以及其他任何网络、技术、通信线路等原因造成的服务中断或不能满足用户要求的风险，用户须明白并自行承担以上风险，用户因此不能获得奖励的礼币，豆豆网及合作单位不承担任何责任。</P>\r\n<P align=left>3.6 用户因第叁方如电信部门的通讯线路故障、技术问题、网络、电脑故障、系统不稳定性及其他各种不可抗力原因而遭受的经济损失，豆豆网及合作单位不承担责任。</P>\r\n<P align=left>3.7 因技术故障等不可抗事件影响到服务的正常运行的，豆豆网及合作单位承诺在第一时间内与相关单位配合，及时处理进行修复，但用户因此而遭受的经济损失，豆豆网及合作单位不承担责任。</P>\r\n<P align=left>4 其他条款</P>\r\n<P align=left>4.1 本协议所定的任何条款的部分或全部无效者，不影响其它条款的效力。</P>\r\n<P align=left>4.2 本协议的解释、效力及纠纷的解决，适用于中华人民共和国法律。若用户和豆豆网之间发生任何纠纷或争议，首先应友好协商解决，协商不成的，用户在此完全同意将纠纷或争议提交豆豆网所在地法院管辖。</P>\r\n<P align=left>www.28jingyan.com版权所有，保留一切解释权利。<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;www.28jingyan.com 2008-3</P>');

-- --------------------------------------------------------

--
-- 表的结构 `lf_regip`
--

CREATE TABLE IF NOT EXISTS `lf_regip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=FIXED AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lf_regip`
--

INSERT INTO `lf_regip` (`id`, `ip`, `time`) VALUES
(1, '192.168.16.2', '2011-05-30 16:04:07');

-- --------------------------------------------------------

--
-- 表的结构 `lf_slide`
--

CREATE TABLE IF NOT EXISTS `lf_slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slidename` varchar(255) DEFAULT NULL,
  `slidepic` varchar(255) DEFAULT NULL,
  `slideurl` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `lf_slide`
--

INSERT INTO `lf_slide` (`id`, `slidename`, `slidepic`, `slideurl`, `sort`) VALUES
(1, '幻灯1', '20110530155634.jpg', 'http://localhost/', 0),
(2, '幻灯2', '20110530155646.jpg', 'http://localhost/', 1);

-- --------------------------------------------------------

--
-- 表的结构 `lf_tjlog`
--

CREATE TABLE IF NOT EXISTS `lf_tjlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) DEFAULT NULL,
  `xid` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `regtime` date DEFAULT NULL,
  `time` date DEFAULT NULL,
  `points` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `lf_tjlog`
--

INSERT INTO `lf_tjlog` (`id`, `uid`, `xid`, `type`, `regtime`, `time`, `points`) VALUES
(1, '15888', 16000, '注册推荐', '2011-05-30', '2011-05-30', 110),
(2, '15888', 56888, '注册推荐', '2011-05-30', '2012-02-01', 200),
(3, '15888', 56888, '注册推荐', '2011-05-30', '2012-02-01', 1000),
(4, '15888', 56888, '注册推荐', '2011-05-30', '2012-02-01', 2400),
(5, '15888', 56888, '注册推荐', '2011-05-30', '2012-02-01', 3500);

-- --------------------------------------------------------

--
-- 表的结构 `lf_usergroups`
--

CREATE TABLE IF NOT EXISTS `lf_usergroups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `creditshigher` int(11) DEFAULT '0',
  `creditslower` int(11) DEFAULT '0',
  `stars` int(11) DEFAULT '0',
  `kinddiscount` float(12,1) DEFAULT NULL,
  `virtualdiscount` float(12,1) DEFAULT NULL,
  `vipkinddiscount` float(12,1) DEFAULT NULL,
  `vipvirtualdiscount` float(12,1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lf_usergroups`
--

INSERT INTO `lf_usergroups` (`id`, `name`, `creditshigher`, `creditslower`, `stars`, `kinddiscount`, `virtualdiscount`, `vipkinddiscount`, `vipvirtualdiscount`) VALUES
(1, '黄金贵族', 1000, 100000, 2, 0.0, 0.0, 0.0, 0.0);

-- --------------------------------------------------------

--
-- 表的结构 `lf_users`
--

CREATE TABLE IF NOT EXISTS `lf_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `secques` varchar(255) DEFAULT NULL,
  `secans` varchar(255) DEFAULT NULL,
  `points` int(11) DEFAULT '0' COMMENT '豆豆',
  `maxpoints` int(11) DEFAULT '0' COMMENT '豆豆记录',
  `back` int(11) DEFAULT '0' COMMENT '豆豆银行',
  `experience` int(11) DEFAULT '0' COMMENT '经验',
  `maxexperience` int(11) DEFAULT '0' COMMENT '累计经验值',
  `time` datetime DEFAULT NULL,
  `vip` int(11) DEFAULT '0',
  `vipdate` date DEFAULT NULL COMMENT 'VIP到期时间',
  `sex` varchar(255) DEFAULT NULL,
  `head` varchar(255) DEFAULT NULL COMMENT '头像',
  `qq` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL COMMENT '生日',
  `tel` varchar(255) DEFAULT NULL COMMENT '电话',
  `address` varchar(255) DEFAULT NULL COMMENT '住址',
  `education` varchar(255) DEFAULT NULL COMMENT '学历',
  `job` varchar(255) DEFAULT NULL COMMENT '职业',
  `bent` varchar(255) DEFAULT NULL COMMENT '爱好',
  `caption` mediumtext COMMENT '个性说明',
  `authentication` int(11) DEFAULT '0' COMMENT '身份验证',
  `rname` varchar(255) DEFAULT NULL COMMENT '真实姓名',
  `card` varchar(255) DEFAULT NULL COMMENT '身份证号码',
  `cardpic` varchar(255) DEFAULT NULL COMMENT '身份证扫描件',
  `logintime` datetime DEFAULT NULL COMMENT '登陆时间',
  `loginip` varchar(255) DEFAULT NULL COMMENT '登陆IP',
  `djcs` int(11) DEFAULT '0' COMMENT '兑奖次数',
  `djpoints` int(11) DEFAULT '0' COMMENT '兑奖总积分',
  `tjid` int(11) DEFAULT '0' COMMENT '推荐id',
  `editid` int(11) DEFAULT '0' COMMENT '修改id',
  `cardtime` date DEFAULT NULL COMMENT '领豆时间',
  `udapoints` int(11) DEFAULT '0' COMMENT '领豆数量',
  `udaexperience` int(11) DEFAULT '0' COMMENT '领经验数量',
  `ldcardtime` date DEFAULT NULL COMMENT '领豆时间',
  `tgreglq` int(11) DEFAULT '0' COMMENT '推广领取次数',
  `dj` int(11) DEFAULT '0' COMMENT '冻结',
  `djly` mediumtext COMMENT '冻结原因',
  `isbz` int(11) DEFAULT '0' COMMENT '设为版主',
  `dailygame16experience` int(11) DEFAULT '0' COMMENT '16每日经验',
  `dailygame28experience` int(11) DEFAULT '0' COMMENT '28每日经验',
  `dailydodgeexperience` int(11) DEFAULT '0' COMMENT '每日猜拳经验',
  `dailygame11experience` int(11) DEFAULT '0' COMMENT '11每日经验',
  PRIMARY KEY (`id`),
  KEY `password` (`password`),
  KEY `email` (`email`),
  KEY `maxexperience` (`maxexperience`),
  KEY `djcs` (`djcs`),
  KEY `djpoints` (`djpoints`),
  KEY `points` (`points`),
  KEY `back` (`back`),
  KEY `name` (`name`),
  KEY `loginip` (`loginip`),
  KEY `vip` (`vip`),
  KEY `time` (`time`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=FIXED AUTO_INCREMENT=56889 ;

--
-- 转存表中的数据 `lf_users`
--

INSERT INTO `lf_users` (`id`, `email`, `name`, `password`, `secques`, `secans`, `points`, `maxpoints`, `back`, `experience`, `maxexperience`, `time`, `vip`, `vipdate`, `sex`, `head`, `qq`, `birthday`, `tel`, `address`, `education`, `job`, `bent`, `caption`, `authentication`, `rname`, `card`, `cardpic`, `logintime`, `loginip`, `djcs`, `djpoints`, `tjid`, `editid`, `cardtime`, `udapoints`, `udaexperience`, `ldcardtime`, `tgreglq`, `dj`, `djly`, `isbz`, `dailygame16experience`, `dailygame28experience`, `dailydodgeexperience`, `dailygame11experience`) VALUES
(15888, 'fjseo@yahoo.cn', '1111', 'e10adc3949ba59abbe56e057f20f883e', '你母亲的姓名是什么?', 'asdasd', 17493, 0, 0, 10150, 10150, '2011-05-30 14:12:53', 0, '2011-06-09', 'M', 'images/head/1_0.jpg', '', '1969-01-01', '', '0-0-', '0', '0', '', '', 0, NULL, NULL, NULL, '2012-02-12 13:34:43', '127.0.0.1', 0, 0, 0, 0, '2011-06-09', 100, 100, '2011-05-30', 0, 0, NULL, 0, 0, 0, 0, 0),
(56888, 'qqqq@qq.com', '1112', '4297f44b13955235245b2497399d7a93', '你父亲的姓名是什么?', 'ssss', 149999999, 0, 100, 1020, 1020, '2011-05-30 16:04:31', 0, '2011-06-09', 'F', 'images/head/1_0.jpg', '', '1969-01-01', '', '0-0-', '0', '0', '', '', 1, '我爱罗', '350823198808086741', 'card_56888.gif', '2011-05-31 23:47:54', '127.0.0.1', 1, 1, 15888, 0, '2011-06-09', 100, 100, NULL, 4, 0, NULL, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `lf_userslog`
--

CREATE TABLE IF NOT EXISTS `lf_userslog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` datetime DEFAULT NULL,
  `logtype` int(11) DEFAULT NULL,
  `log` varchar(255) DEFAULT NULL,
  `points` int(11) DEFAULT '0' COMMENT '豆豆',
  `experience` int(11) DEFAULT '0' COMMENT '经验',
  `usersid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usersid` (`usersid`),
  KEY `logtype` (`logtype`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `lf_userslog`
--

INSERT INTO `lf_userslog` (`id`, `time`, `logtype`, `log`, `points`, `experience`, `usersid`) VALUES
(1, '2011-05-30 14:16:06', 4, '登陆奖励10经验值', 0, 10, 1),
(2, '2011-05-30 15:20:32', 2, '使用体验卡', 1000, 1000, 1),
(3, '2011-05-30 15:23:01', 2, '使用体验卡', 1000, 1000, 1),
(4, '2011-05-30 15:31:52', 2, '种豆领取', 100, 100, 1),
(5, '2011-05-30 15:32:32', 2, '使用体验卡', 1000, 1000, 1),
(6, '2011-05-30 15:42:21', 2, '使用体验卡', 1000, 1000, 15888),
(7, '2011-05-30 15:46:04', 2, '使用体验卡', 1000, 1000, 15888),
(8, '2011-05-30 16:00:59', 1, '问卷广告体验', 111, 0, 15888),
(9, '2011-05-30 16:05:08', 4, '登陆奖励10经验值', 0, 10, 56888),
(10, '2011-05-30 16:05:23', 2, '使用体验卡', 1000, 1000, 56888),
(11, '2011-05-30 16:08:48', 4, '存取金豆', -100, 0, 56888),
(12, '2011-05-30 16:09:35', 4, '兑换奖品 移动话费卡100面额 数量 1', -1, 0, 56888),
(13, '2011-05-31 23:47:54', 4, '登陆奖励10经验值', 0, 10, 56888),
(14, '2012-02-01 22:45:02', 4, '登陆奖励10经验值', 0, 10, 15888),
(15, '2012-02-09 20:05:07', 4, '登陆奖励10经验值', 0, 10, 15888),
(16, '2012-02-11 21:02:54', 4, '登陆奖励10经验值', 0, 10, 15888),
(17, '2012-02-12 13:34:43', 4, '登陆奖励10经验值', 0, 10, 15888);

-- --------------------------------------------------------

--
-- 表的结构 `lf_webip`
--

CREATE TABLE IF NOT EXISTS `lf_webip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=FIXED AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `lf_webip`
--


-- --------------------------------------------------------

--
-- 表的结构 `lf_webtj`
--

CREATE TABLE IF NOT EXISTS `lf_webtj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regnum` int(11) DEFAULT '0',
  `regpoints` int(11) DEFAULT '0',
  `authenticationnum` int(11) DEFAULT '0',
  `authenticationpoints` int(11) DEFAULT '0',
  `jjpoints` int(11) DEFAULT '0',
  `indexpoints` int(11) DEFAULT '0',
  `adquestionspoints` int(11) DEFAULT '0',
  `adcpapoints` int(11) DEFAULT '0',
  `adcpspoints` int(11) DEFAULT '0',
  `exchangepoints` int(11) DEFAULT '0',
  `userspoints` int(11) DEFAULT '0',
  `time` date DEFAULT NULL,
  `boxpoints` int(11) DEFAULT '0',
  `tgpoints` int(11) DEFAULT '0',
  `game11` int(11) DEFAULT '0',
  `game16` int(11) DEFAULT '0',
  `game28` int(11) DEFAULT '0',
  `gamedodge` int(11) DEFAULT '0',
  `card` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=246 ;

--
-- 转存表中的数据 `lf_webtj`
--

INSERT INTO `lf_webtj` (`id`, `regnum`, `regpoints`, `authenticationnum`, `authenticationpoints`, `jjpoints`, `indexpoints`, `adquestionspoints`, `adcpapoints`, `adcpspoints`, `exchangepoints`, `userspoints`, `time`, `boxpoints`, `tgpoints`, `game11`, `game16`, `game28`, `gamedodge`, `card`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, '2011-05-30', 0, 110, 0, 0, 0, 0, 6100),
(2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(9, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(11, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(12, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(13, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(14, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(15, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(16, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(17, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(18, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(19, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(20, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(21, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(22, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(23, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(24, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(25, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(26, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(27, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(28, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(29, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(30, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(31, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(32, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(33, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 28, 0, 0, 0, 0),
(34, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 0, 0, 0, 0, 0),
(35, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 0, 0, 0, 0, 0),
(36, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 0, 0, 0, 0, 0),
(37, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 0, 0, 0, 0, 0),
(38, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 0, 0, 0, 0, 0),
(39, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 0, 0, 0, 0, 0),
(40, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 0, 0, 0, 0, 0),
(41, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 0, 0, 0, 0, 0),
(42, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 0, 0, 0, 0, 0),
(43, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 0, 0, 0, 0, 0),
(44, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 0, 0, 0, 0, 0),
(45, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 0, 0, 0, 0, 0),
(46, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 0, 0, 0, 0, 0),
(47, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 0, 0, 0, 0, 0),
(48, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 0, 0, 0, 0, 0),
(49, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 0, 0, 0, 0, 0),
(50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-01', 0, 0, 0, 0, 0, 0, 0),
(51, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-02', 0, 0, 0, 0, 0, 0, 0),
(52, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-02', 0, 0, 0, 0, 0, 0, 0),
(53, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-02', 0, 0, 0, 0, 0, 0, 0),
(54, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-02', 0, 0, 0, 0, 0, 0, 0),
(55, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-02', 0, 0, 0, 0, 0, 0, 0),
(56, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-02', 0, 0, 0, 0, 0, 0, 0),
(57, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-02', 0, 0, 0, 0, 0, 0, 0),
(58, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(59, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(60, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(61, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(62, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(63, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(64, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(66, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(68, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(69, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(71, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(72, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(73, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(74, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(76, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(77, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(78, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(79, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(80, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(81, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(82, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(83, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(84, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(85, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-04', 0, 0, 0, 0, 0, 0, 0),
(86, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(87, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(88, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(89, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(90, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(91, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(92, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(93, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(94, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(95, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(96, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(97, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(98, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(99, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(101, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(102, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(103, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(104, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(105, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(106, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(107, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(108, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(109, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(110, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(111, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(112, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(113, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(114, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(115, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(116, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(117, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(118, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(119, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(120, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(121, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(122, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(123, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(124, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(125, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(126, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(127, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(128, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(129, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(130, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(131, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(132, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(133, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(134, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(135, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(136, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(137, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(138, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(139, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(140, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(141, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(142, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(143, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(144, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(145, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(146, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(147, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(148, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(149, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(150, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(151, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(152, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(153, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(154, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(155, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(156, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(157, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(158, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(159, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(160, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(161, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(162, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(163, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(164, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(165, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(166, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(167, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(168, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(169, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(170, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(171, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(172, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(173, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(174, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(175, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(176, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(177, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(178, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(179, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(180, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(181, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(182, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(183, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(184, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(185, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(186, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(187, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(188, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(189, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(190, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(191, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(192, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(193, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(194, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(195, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(196, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(197, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(198, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(199, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(200, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(201, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(202, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(203, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(204, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(205, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(206, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(207, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(208, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(209, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(210, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(211, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(212, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(213, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(214, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(215, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(216, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(217, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(218, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(219, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(220, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(221, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(222, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(223, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(224, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(225, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(226, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(227, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(228, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150017592, '2012-02-11', 0, 0, 0, 0, 0, 0, 0),
(229, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-12', 0, 0, 0, 0, 0, 0, 0),
(230, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-12', 0, 0, 0, 0, 0, 0, 0),
(231, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-12', 0, 0, 0, 0, 0, 0, 0),
(232, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-12', 0, 0, 0, 0, 0, 0, 0),
(233, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-12', 0, 0, 0, 0, 0, 0, 0),
(234, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-12', 0, 0, 0, 0, 0, 0, 0),
(235, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-12', 0, 0, 0, 0, 0, 0, 0),
(236, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-12', 0, 0, 0, 0, 0, 0, 0),
(237, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-12', 0, 0, 0, 0, 0, 0, 0),
(238, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-12', 0, 0, 0, 0, 0, 0, 0),
(239, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-12', 0, 0, 0, 0, 0, 0, 0),
(240, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-12', 0, 0, 0, 0, 0, 0, 0),
(241, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-12', 0, 0, 0, 0, 0, 0, 0),
(242, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-12', 0, 0, 0, 0, 0, 0, 0),
(243, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-12', 0, 0, 0, 0, 0, 0, 0),
(244, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-12', 0, 0, 0, 0, 0, 0, 0),
(245, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-12', 0, 0, 0, 0, 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
