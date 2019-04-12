<?php
//最新好站連結
$new_data[1] = ['options' => '8|1|1|0|sort|1|1|0|3', 'title' => '宣導網站[pic]images/weblinks.png', 'side' => '5', 'weight' => '5', 'visible' => '1'];
//好站推薦快速連結
$new_data[2] = ['options' => '1||dropdown', 'title' => '好站推薦快速連結[hide]', 'side' => '0', 'weight' => '12', 'visible' => '0'];

//select CONCAT('//',`name`,'\\n\$new_data[',`func_num`,'] = array(\'options\' => \'',`options`,'\', \'title\' => \'',`title`,'\', \'side\' => \'',`side`,'\', \'weight\' => \'',`weight`,'\', \'visible\' => \'',`visible`,'\');')from `xx_newblocks` where `dirname`='tad_link' and `block_type`!='D' order by `func_num`
