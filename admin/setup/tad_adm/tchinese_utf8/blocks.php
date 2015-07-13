<?php
//新的垃圾帳戶
$new_data[1] = array('options' => '10', 'title' => '新的垃圾帳戶', 'side' => '1', 'weight' => '2', 'visible' => '1');

//select CONCAT('//',`name`,'\\n\$new_data[',`func_num`,'] = array(\'options\' => \'',`options`,'\', \'title\' => \'',`title`,'\', \'side\' => \'',`side`,'\', \'weight\' => \'',`weight`,'\', \'visible\' => \'',`visible`,'\');')from `xx_newblocks` where `dirname`='tad_adm' and `block_type`!='D' order by `func_num`
