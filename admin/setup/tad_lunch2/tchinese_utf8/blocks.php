<?php
//營養午餐公告
$new_data[0] = array('options' => '1|horizontal|main_food,main_dish,side_dish1,side_dish2,side_dish3,fruit,soup,calorie', 'title' => '營養午餐公告', 'side' => '5', 'weight' => '7', 'visible' => '1');

//select CONCAT('//',`name`,'\\n\$new_data[',`func_num`,'] = array(\'options\' => \'',`options`,'\', \'title\' => \'',`title`,'\', \'side\' => \'',`side`,'\', \'weight\' => \'',`weight`,'\', \'visible\' => \'',`visible`,'\');')from `xx_newblocks` where `dirname`='tad_lunch2' and `block_type`!='D' order by `func_num`
