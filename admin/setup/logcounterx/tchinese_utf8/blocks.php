<?php
$new_data[1] = ['options' => '', 'title' => '計數器', 'side' => '1', 'weight' => '6', 'visible' => '1'];
$new_data[2] = ['options' => '', 'title' => '紀錄區塊', 'side' => '5', 'weight' => '9', 'visible' => '1'];

//select CONCAT('//',`name`,'\\n\$new_data[',`func_num`,'] = array(\'options\' => \'',`options`,'\', \'title\' => \'',`title`,'\', \'side\' => \'',`side`,'\', \'weight\' => \'',`weight`,'\', \'visible\' => \'',`visible`,'\');')from `xx_newblocks` where `dirname`='logcounterx' and `block_type`!='D' order by `func_num`
