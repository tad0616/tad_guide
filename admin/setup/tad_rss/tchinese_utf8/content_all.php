<?php
use XoopsModules\Tadtools\Utility;

function tad_rss_content($cate_sn = '')
{
    global $xoopsDB;

    $sql = 'INSERT INTO `' . $xoopsDB->prefix('tad_rss') . "` (`title`, `url`, `enable`) VALUES
    ('文教新聞 ',  'https://tw.news.yahoo.com/rss/art-edu', '1'),
    ('地球圖輯隊',  'https://dq-api.azurewebsites.net/f-system/get-rss', '1'),
    ('教育部即時新聞',  ' 	https://www.edu.tw/Rss_News.aspx?n=9E7AC85F1954DDA8', '1'),
    ('ETtoday 親子', 'https://feeds.feedburner.com/ettoday/family',  '1')";

    Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
}
