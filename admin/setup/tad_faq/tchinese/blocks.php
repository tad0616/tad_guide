<?php
//本站常見問題
$new_data[1] = array('options' => '', 'title' => '本站常見問題', 'side' => '0', 'weight' => '0', 'visible' => '0');

//select CONCAT('//',`name`,'\\n\$new_data[',`func_num`,'] = array(\'options\' => \'',`options`,'\', \'title\' => \'',`title`,'\', \'side\' => \'',`side`,'\', \'weight\' => \'',`weight`,'\', \'visible\' => \'',`visible`,'\');')from `xx_newblocks` where `dirname`='tad_faq' and `block_type`!='D' order by `func_num`
