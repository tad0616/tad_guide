<?php
//相片捲軸
$new_data[0] = array('options' => '12|0|1|rand|desc|s|0|140|105|0|1000|3|0|5000', 'title' => '相片捲軸[hide]', 'side' => '9', 'weight' => '1', 'visible' => '0');
//抽取相片
$new_data[1] = array('options' => '12|0|1|post_date|desc|m|0|200|160', 'title' => '抽取相片[hide]', 'side' => '0', 'weight' => '1', 'visible' => '0');
//相片投影秀
$new_data[2] = array('options' => '12|0|1|post_date|desc|s|0|100%|240', 'title' => '相片投影秀[hide]', 'side' => '0', 'weight' => '3', 'visible' => '0');
//3D相片牆
$new_data[3] = array('options' => '0|1|100%|450', 'title' => '3D相片牆[hide]', 'side' => '9', 'weight' => '2', 'visible' => '0');
//圖片跑馬燈
$new_data[4] = array('options' => '12|0|1|post_date|desc|m|0|100%|240|jscroller2_up|40', 'title' => '圖片跑馬燈[hide]', 'side' => '0', 'weight' => '2', 'visible' => '0');
//相片最新回應
$new_data[5] = array('options' => '10|1|1', 'title' => '相片最新回應', 'side' => '9', 'weight' => '4', 'visible' => '0');
//縮圖列表
$new_data[6] = array('options' => '12|0|1|post_date|desc|m|0|130|130|0|0|font-size:11px;font-weight:normal;overflow:hidden;', 'title' => '縮圖列表[hide]', 'side' => '9', 'weight' => '0', 'visible' => '0');
//無縫跑馬燈
$new_data[7] = array('options' => '12|0|1|rand|desc|m|0|100%|150|20', 'title' => '無縫跑馬燈[hide]', 'side' => '9', 'weight' => '3', 'visible' => '1');
//相簿一覽
$new_data[8] = array('options' => '4|content|rand()||300|line-height:1.8;|0', 'title' => '相簿一覽[hide]', 'side' => '5', 'weight' => '4', 'visible' => '1');

//select CONCAT('//',`name`,'\\n\$new_data[',`func_num`,'] = array(\'options\' => \'',`options`,'\', \'title\' => \'',`title`,'\', \'side\' => \'',`side`,'\', \'weight\' => \'',`weight`,'\', \'visible\' => \'',`visible`,'\');')from `xx_newblocks` where `dirname`='tadgallery' and `block_type`!='D' order by `func_num`
