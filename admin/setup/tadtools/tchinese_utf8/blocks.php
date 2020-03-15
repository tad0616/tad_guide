<?php
//本頁面行動條碼
$new_data[0] = array('options' => '120', 'title' => '行動 QR Code', 'side' => '1', 'weight' => '99', 'visible' => '1');

//本站App下載設定
$new_data[1] = array('options' => '150|v', 'title' => '本站App下載設定', 'side' => '1', 'weight' => '98', 'visible' => '1');

//select CONCAT('//',`name`,'\\n\$new_data[',`func_num`,'] = array(\'options\' => \'',`options`,'\', \'title\' => \'',`title`,'\', \'side\' => \'',`side`,'\', \'weight\' => \'',`weight`,'\', \'visible\' => \'',`visible`,'\');')from `xx_newblocks` where `dirname`='tadtools' and `block_type`!='D' order by `func_num`
