<?php
//評鑑列表
$new_data[0] = array('options' => '', 'title' => '評鑑列表', 'side' => '0', 'weight' => '21', 'visible' => '1');

//select CONCAT('//',`name`,'\\n\$new_data[',`func_num`,'] = array(\'options\' => \'',`options`,'\', \'title\' => \'',`title`,'\', \'side\' => \'',`side`,'\', \'weight\' => \'',`weight`,'\', \'visible\' => \'',`visible`,'\');')from `xx_newblocks` where `dirname`='tad_evaluation' and `block_type`!='D' order by `func_num`
