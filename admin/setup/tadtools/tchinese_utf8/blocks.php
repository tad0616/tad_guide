<?php
//QR Code 區塊
$new_data[0] = ['options' => '', 'title' => 'QR Code 區塊[hide]', 'side' => '0', 'weight' => '99', 'visible' => '1'];

//select CONCAT('//',`name`,'\\n\$new_data[',`func_num`,'] = array(\'options\' => \'',`options`,'\', \'title\' => \'',`title`,'\', \'side\' => \'',`side`,'\', \'weight\' => \'',`weight`,'\', \'visible\' => \'',`visible`,'\');')from `xx_newblocks` where `dirname`='tadtools' and `block_type`!='D' order by `func_num`
