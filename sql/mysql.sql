CREATE TABLE `tad_guide` (
  `act_kind` varchar(100)  NOT NULL COMMENT '執行對象',
  `kind_title` varchar(100)  NOT NULL COMMENT '對象名稱',
  `act_name` varchar(255) NOT NULL COMMENT '執行動作',
  `act_date` datetime NOT NULL COMMENT '執行時間',
  `cate_sn` smallint(5) UNSIGNED NOT NULL COMMENT '分類編號',
PRIMARY KEY (`act_kind`,`kind_title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `tad_guide_backup` (
  `act_kind` varchar(100) NOT NULL COMMENT '執行對象',
  `kind_title` varchar(100) NOT NULL COMMENT '對象名稱',
  `act_date` datetime NOT NULL COMMENT '執行時間',
  `backup_content` text NOT NULL COMMENT '備份內容',
  PRIMARY KEY (`act_kind`,`kind_title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;