<?php
$bak_table            = array();
$bak_table[1]['name'] = "tad_gallery";
$bak_table[1]['sql']  = "
CREATE TABLE `" . $xoopsDB->prefix("tad_gallery_gbak") . "` (
  `sn` smallint(5) unsigned NOT NULL auto_increment,
  `csn` smallint(5) unsigned NOT NULL,
  `title` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  `filename` varchar(255) NOT NULL default '',
  `size` mediumint(8) unsigned NOT NULL,
  `type` varchar(255) NOT NULL default '',
  `width` smallint(5) unsigned NOT NULL,
  `height` smallint(5) unsigned NOT NULL,
  `dir` varchar(255) NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL,
  `post_date` varchar(255) NOT NULL default '',
  `counter` smallint(5) unsigned NOT NULL,
  `exif` text NOT NULL,
  `tag` varchar(255) NOT NULL default '',
  `good` enum('0','1') NOT NULL default '0',
  `photo_sort` smallint(5) unsigned NOT NULL,
  `is360` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`sn`),
  FULLTEXT KEY `tag` (`tag`)
) ENGINE=MyISAM;
";

$bak_table[2]['name'] = "tad_gallery_cate";
$bak_table[2]['sql']  = "
CREATE TABLE `" . $xoopsDB->prefix("tad_gallery_cate_gbak") . "` (
  `csn` smallint(5) unsigned NOT NULL auto_increment,
  `of_csn` smallint(5) unsigned NOT NULL,
  `title` varchar(255) NOT NULL default '',
  `content` text NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `enable_group` varchar(255) NOT NULL default '',
  `enable_upload_group` varchar(255) NOT NULL,
  `sort` smallint(5) unsigned NOT NULL,
  `mode` varchar(255) NOT NULL,
  `show_mode` varchar(255) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `no_hotlink` varchar(255) NOT NULL,
  `uid` mediumint(8) NOT NULL,
  `enable` enum('1','0') NOT NULL default '1',
  PRIMARY KEY  (`csn`)
) ENGINE=MyISAM;
";
