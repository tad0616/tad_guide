<?php
$bak_table = [];
$bak_table[1]['name'] = 'tad_player';
$bak_table[1]['sql'] = '
CREATE TABLE `' . $xoopsDB->prefix('tad_player_gbak') . "` (
  `psn` smallint(5) unsigned NOT NULL auto_increment,
  `pcsn` smallint(5) unsigned NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `creator` varchar(255) NOT NULL default '',
  `location` varchar(255) NOT NULL default '',
  `image` varchar(255) NOT NULL default '',
  `info` varchar(255) NOT NULL default '',
  `uid` mediumint(8) unsigned NOT NULL default '0',
  `post_date` varchar(255) NOT NULL default '',
  `enable_group` varchar(255) NOT NULL default '',
  `counter` smallint(5) unsigned NOT NULL default '0',
  `width` smallint(5) unsigned NOT NULL default '0',
  `height` smallint(5) unsigned NOT NULL default '0',
  `sort` smallint(5) unsigned NOT NULL default '0',
  `content` text NOT NULL,
  `youtube` varchar(255) NOT NULL default '',
  `logo` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`psn`)
) ENGINE=MyISAM;
";
