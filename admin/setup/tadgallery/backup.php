<?php

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
  PRIMARY KEY  (`sn`),
  FULLTEXT KEY `tag` (`tag`)
) ENGINE=MyISAM;
";
