<?php
$new_data[1] = ['options' => '1|0', 'title' => '快速登入[hide]', 'side' => '0', 'weight' => '0', 'visible' => '1'];

//select CONCAT('//',`name`,'\\n\$new_data[',`func_num`,'] = array(\'options\' => \'',`options`,'\', \'title\' => \'',`title`,'\', \'side\' => \'',`side`,'\', \'weight\' => \'',`weight`,'\', \'visible\' => \'',`visible`,'\');')from `xx_newblocks` where `dirname`='tad_login' and `block_type`!='D' order by `func_num`
