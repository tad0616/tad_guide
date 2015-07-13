<?php
$new_data[1] = array('options' => '', 'title' => '隨機小語', 'side' => '9', 'weight' => '4', 'visible' => '1');

//select CONCAT('//',`name`,'\\n\$new_data[',`func_num`,'] = array(\'options\' => \'',`options`,'\', \'title\' => \'',`title`,'\', \'side\' => \'',`side`,'\', \'weight\' => \'',`weight`,'\', \'visible\' => \'',`visible`,'\');')from `xx_newblocks` where `dirname`='randomquote' and `block_type`!='D' order by `func_num`
