<?php
$new_data[1] = array('options' => '6', 'title' => '最新上傳檔案', 'side' => '1', 'weight' => '5', 'visible' => '1');

//select CONCAT('//',`name`,'\\n\$new_data[',`func_num`,'] = array(\'options\' => \'',`options`,'\', \'title\' => \'',`title`,'\', \'side\' => \'',`side`,'\', \'weight\' => \'',`weight`,'\', \'visible\' => \'',`visible`,'\');')from `xx_newblocks` where `dirname`='tad_uploader' and `block_type`!='D' order by `func_num`
