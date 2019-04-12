<?php
$bak_table            = [];
$bak_table[1]['name'] = "tad_rss";
$bak_table[1]['sql']  = "
CREATE TABLE `" . $xoopsDB->prefix("tad_rss_gbak") . "` (
  `rss_sn` smallint(5) unsigned NOT NULL  auto_increment,
  `title` varchar(255) NOT NULL default '' ,
  `url` varchar(255) NOT NULL  default '' ,
  `enable` enum('1','0') NOT NULL default '1' ,
  PRIMARY KEY  (`rss_sn`)
) ENGINE=MyISAM;
";
