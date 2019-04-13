<?php
<<<<<<< HEAD
$new_data[1] = ['options' => '', 'title' => '線上填報', 'side' => '9', 'weight' => '3', 'visible' => '1'];
$new_data[2] = ['options' => '', 'title' => '線上表單', 'side' => '0', 'weight' => '14', 'visible' => '0'];
=======
$new_data[1] = array('options' => '', 'title' => '線上填報', 'side' => '9', 'weight' => '3', 'visible' => '1');
$new_data[2] = array('options' => '|0', 'title' => '線上表單', 'side' => '0', 'weight' => '14', 'visible' => '0');
>>>>>>> 9efe9d77d3550bf1bd9c86155f46a9f27d3fb77a

//select CONCAT('//',`name`,'\\n\$new_data[',`func_num`,'] = array(\'options\' => \'',`options`,'\', \'title\' => \'',`title`,'\', \'side\' => \'',`side`,'\', \'weight\' => \'',`weight`,'\', \'visible\' => \'',`visible`,'\');')from `xx_newblocks` where `dirname`='tad_form' and `block_type`!='D' order by `func_num`
