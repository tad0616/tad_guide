<?php
//待修通報
$new_data[1] = array('options' => '', 'title' => '待修通報', 'side' => '0', 'weight' => '20', 'visible' => '1');

//select CONCAT('//',`name`,'\\n\$new_data[',`func_num`,'] = array(\'options\' => \'',`options`,'\', \'title\' => \'',`title`,'\', \'side\' => \'',`side`,'\', \'weight\' => \'',`weight`,'\', \'visible\' => \'',`visible`,'\');')from `xx_newblocks` where `dirname`='tad_repair' and `block_type`!='D' order by `func_num`
