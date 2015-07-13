<?php
$new_data[1] = array('options' => '', 'title' => '選單', 'side' => '0', 'weight' => '6', 'visible' => '1');
$new_data[2] = array('options' => '', 'title' => '網頁列表選單', 'side' => '0', 'weight' => '15', 'visible' => '0');
$new_data[3] = array('options' => '', 'title' => '活動剪影', 'side' => '0', 'weight' => '16', 'visible' => '0');

//select CONCAT('//',`name`,'\\n\$new_data[',`func_num`,'] = array(\'options\' => \'',`options`,'\', \'title\' => \'',`title`,'\', \'side\' => \'',`side`,'\', \'weight\' => \'',`weight`,'\', \'visible\' => \'',`visible`,'\');')from `xx_newblocks` where `dirname`='tad_web' and `block_type`!='D' order by `func_num`
