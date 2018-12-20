<?php
//文章類別
$new_data[1] = array('options' => '', 'title' => '文章類別', 'side' => '0', 'weight' => '0', 'visible' => '0');
//本站最新消息
$new_data[2] = array('options' => '5|99|color:gray; font-size:12px; margin-top:3px; line-height:180%;|0|1|width:80px;height:60px;float:left;border:0px solid #9999CC;margin:0px 4px 4px 0px;overflow:hidden;background-size:cover;|0|', 'title' => '本站最新消息[pic]images/newstitle.png', 'side' => '5', 'weight' => '14', 'visible' => '0');
//最新回應
$new_data[3] = array('options' => '10|160', 'title' => '最新回應', 'side' => '9', 'weight' => '1', 'visible' => '0');
//訂閱 / 取消電子報
$new_data[4] = array('options' => '', 'title' => '訂閱 / 取消電子報', 'side' => '0', 'weight' => '2', 'visible' => '0');
//電子報一覽
$new_data[5] = array('options' => '10', 'title' => '電子報一覽', 'side' => '0', 'weight' => '3', 'visible' => '0');
//分類新聞區塊
$new_data[6] = array('options' => '|5|1|1|99|color: gray; font-size: 12px; margin: 6px 0px; line-height: 180%;', 'title' => '分類新聞區塊[pic]images/newstitle.png', 'side' => '5', 'weight' => '9', 'visible' => '0');
//自訂頁面
$new_data[7] = array('options' => '0|160|11pt', 'title' => '自訂頁面-學校簡介[hide]', 'side' => '0', 'weight' => '1', 'visible' => '0');
//焦點新聞
$new_data[8] = array('options' => '|full', 'title' => '焦點新聞', 'side' => '5', 'weight' => '10', 'visible' => '0');
//自選文章
$new_data[9] = array('options' => '', 'title' => '自選文章', 'side' => '9', 'weight' => '0', 'visible' => '0');
//條列式新聞
$new_data[10] = array('options' => '5|0|color:gray;font-size:12px;margin-top:6px;line-height:180%;|0|1|width:60px;height:30px;float:left;border:0px solid #9999CC;margin:0px 4px 4px 0px;overflow:hidden;background-size:cover;|0|list|table|1|0', 'title' => '條列式新聞[pic]images/newstitle.png', 'side' => '5', 'weight' => '12', 'visible' => '0');
//表格式新聞
$new_data[11] = array('options' => '6|1|start_day|news_title|uid|ncsn|counter|0||0', 'title' => '表格式新聞[pic]images/newstitle.png', 'side' => '5', 'weight' => '13', 'visible' => '0');
//滑動新聞
$new_data[12] = array('options' => '670|250|5|90|', 'title' => '滑動新聞[hide]', 'side' => '5', 'weight' => '7', 'visible' => '0');
//自動縮放的滑動新聞
$new_data[13] = array('options' => '5|90|ResponsiveSlides|', 'title' => '自動縮放的滑動新聞[hide]', 'side' => '5', 'weight' => '5', 'visible' => '0');
//跑馬燈區塊
$new_data[14] = array('options' => '5|0|up|5000|height:10em;|', 'title' => '跑馬燈區塊[hide]', 'side' => '0', 'weight' => '4', 'visible' => '1');
//圖文集區塊
$new_data[15] = array('options' => '3|2|66|font-size:13px ;color: gray; line-height: 1.5; font-family:新細明體;|', 'title' => '圖文集區塊[pic]images/newstitle.png', 'side' => '5', 'weight' => '3', 'visible' => '1');
//自訂頁面選單
$new_data[16] = array('options' => '|info|1', 'title' => '學校簡介[hide]', 'side' => '0', 'weight' => '1', 'visible' => '1');
//頁籤新聞區塊
$new_data[17] = array('options' => '|10|default|#FFFFFF|#E0D9D9|#9C905C|#9C905C|1', 'title' => '頁籤新聞[hide]', 'side' => '5', 'weight' => '3', 'visible' => '1');
//標籤新聞區塊
$new_data[18] = array('options' => '|10|default|#FFFFFF|#E0D9D9|#9C905C|#9C905C|0', 'title' => '標籤新聞[hide]', 'side' => '5', 'weight' => '3', 'visible' => '0');

//select CONCAT('//',`name`,'\\n\$new_data[',`func_num`,'] = array(\'options\' => \'',`options`,'\', \'title\' => \'',`title`,'\', \'side\' => \'',`side`,'\', \'weight\' => \'',`weight`,'\', \'visible\' => \'',`visible`,'\');')from `xx_newblocks` where `dirname`='tadnews' and `block_type`!='D' order by `func_num`
