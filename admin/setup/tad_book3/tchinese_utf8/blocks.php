<?php
//隨機好書
$new_data[1] = ['options' => '1|1', 'title' => '隨機好書', 'side' => '0', 'weight' => '9', 'visible' => '1'];
//最新文章
$new_data[2] = ['options' => '5', 'title' => '最新文章', 'side' => '0', 'weight' => '10', 'visible' => '0'];
//書籍列表
$new_data[3] = ['options' => '5|create_date|desc', 'title' => '書籍列表', 'side' => '0', 'weight' => '11', 'visible' => '0'];
//書籍目錄
$new_data[4] = ['options' => '', 'title' => '書籍目錄', 'side' => '0', 'weight' => '4', 'visible' => '1'];

//select CONCAT('//',`name`,'\\n\$new_data[',`func_num`,'] = array(\'options\' => \'',`options`,'\', \'title\' => \'',`title`,'\', \'side\' => \'',`side`,'\', \'weight\' => \'',`weight`,'\', \'visible\' => \'',`visible`,'\');')from `xx_newblocks` where `dirname`='tad_book3' and `block_type`!='D' order by `func_num`
