<?php
//影音特區
$new_data[1] = ['options' => '0|0|true', 'title' => '影音特區[hide]', 'side' => '8', 'weight' => '2', 'visible' => '1'];
//新進影音檔
$new_data[2] = ['options' => '10|1', 'title' => '新進影音檔', 'side' => '7', 'weight' => '0', 'visible' => '1'];
//熱門影音檔
$new_data[3] = ['options' => '10|1', 'title' => '熱門影音檔', 'side' => '8', 'weight' => '1', 'visible' => '0'];
//影音清單播放
$new_data[4] = ['options' => '1|0|160|true', 'title' => '影音清單播放', 'side' => '0', 'weight' => '22', 'visible' => '0'];

//select CONCAT('//',`name`,'\\n\$new_data[',`func_num`,'] = array(\'options\' => \'',`options`,'\', \'title\' => \'',`title`,'\', \'side\' => \'',`side`,'\', \'weight\' => \'',`weight`,'\', \'visible\' => \'',`visible`,'\');')from `xx_newblocks` where `dirname`='tad_player' and `block_type`!='D' order by `func_num`
