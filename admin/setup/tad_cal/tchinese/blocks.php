<?php
//小行事曆
$new_data[1] = array('options' => '', 'title' => '小行事曆[hide]', 'side' => '1', 'weight' => '3', 'visible' => '1');
//近期事項
$new_data[2] = array('options' => '7', 'title' => '近期事項', 'side' => '1', 'weight' => '4', 'visible' => '1');
//大行事曆
$new_data[3] = array('options' => '', 'title' => '大行事曆[hide]', 'side' => '9', 'weight' => '0', 'visible' => '0');

//select CONCAT('//',`name`,'\\n\$new_data[',`func_num`,'] = array(\'options\' => \'',`options`,'\', \'title\' => \'',`title`,'\', \'side\' => \'',`side`,'\', \'weight\' => \'',`weight`,'\', \'visible\' => \'',`visible`,'\');')from `xx_newblocks` where `dirname`='tad_cal' and `block_type`!='D' order by `func_num`
