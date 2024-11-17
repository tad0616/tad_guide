<?php
$bak_table = [];
$bak_table[1]['name'] = 'tad_news_tags';
$bak_table[1]['sql'] = '
CREATE TABLE `' . $xoopsDB->prefix('tad_news_tags_gbak') . "` (
  `tag_sn` smallint(5) UNSIGNED NOT NULL auto_increment,
  `tag` varchar(255) NOT NULL default '',
  `font_color` varchar(255) NOT NULL default '',
  `color` varchar(255) NOT NULL default '',
  `enable` enum('0','1') NOT NULL default '1',
  PRIMARY KEY  (`tag_sn`)
) ENGINE=MyISAM;
";

$bak_table[2]['name'] = 'tad_news';
$bak_table[2]['sql'] = '
CREATE TABLE `' . $xoopsDB->prefix('tad_news_gbak') . "` (
  `nsn` smallint(5) unsigned NOT NULL auto_increment,
  `ncsn` smallint(5) unsigned NOT NULL default 0,
  `news_title` varchar(255) NOT NULL default '',
  `news_content` longtext NOT NULL,
  `start_day` datetime NOT NULL,
  `end_day` datetime ,
  `enable` enum('1','0') NOT NULL default '1',
  `uid` mediumint(8) unsigned NOT NULL default 0,
  `passwd` varchar(255) NOT NULL default '',
  `enable_group` varchar(255) NOT NULL default '',
  `counter` smallint(5) unsigned NOT NULL default 0,
  `prefix_tag` varchar(255) NOT NULL default '',
  `always_top` enum('0','1') NOT NULL default '0',
  `always_top_date` datetime NOT NULL,
  `have_read_group` varchar(255) NOT NULL default '',
  `page_sort` SMALLINT(5) UNSIGNED NOT NULL default 0,
  PRIMARY KEY  (`nsn`)
) ENGINE=MyISAM;
";

$bak_table[3]['name'] = 'tad_news_cate';
$bak_table[3]['sql'] = '
CREATE TABLE  `' . $xoopsDB->prefix('tad_news_cate_gbak') . "` (
  `ncsn` smallint(5) unsigned NOT NULL auto_increment,
  `of_ncsn` smallint(5) unsigned NOT NULL default 0,
  `nc_title` varchar(255) NOT NULL default '',
  `enable_group` varchar(255) NOT NULL default '',
  `enable_post_group` varchar(255) NOT NULL default '',
  `sort` smallint(5) unsigned NOT NULL default 0,
  `cate_pic` varchar(255) NOT NULL default '',
  `not_news` enum('0','1') NOT NULL,
  `setup` TEXT NOT NULL,
  PRIMARY KEY  (`ncsn`)
) ENGINE=MyISAM;
";
