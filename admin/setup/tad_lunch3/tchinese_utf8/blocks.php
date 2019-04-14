<?php
//今日午餐資訊[hide]
$new_data[1] = ['options' => '150px|150px|font-size:1em;|font-size:1.1em|0|#fab333|#009688|64736421', 'title' => '今日午餐資訊[hide]', 'side' => '5', 'weight' => '3', 'visible' => '1'];

//select CONCAT('//',`name`,'\\n\$new_data[',`func_num`,'] = array(\'options\' => \'',`options`,'\', \'title\' => \'',`title`,'\', \'side\' => \'',`side`,'\', \'weight\' => \'',`weight`,'\', \'visible\' => \'',`visible`,'\');')from `xx_newblocks` where `dirname`='tad_lunch3' and `block_type`!='D' order by `func_num`
