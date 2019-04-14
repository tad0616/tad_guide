<?php
function tad_rss_content($cate_sn = '')
{
    global $xoopsDB;

    // $sql="delete from `".$xoopsDB->prefix("tad_rss")."`";
    // $xoopsDB->queryF($sql) or web_error($sql,  __FILE__, __LINE__);

    $sql = 'INSERT INTO `' . $xoopsDB->prefix('tad_rss') . "` (`title`, `url`, `enable`) VALUES
  ('文教新聞 ',  'http://tw.news.yahoo.com/rss/art-edu', '1'),
  ('親子精選文',  'http://tw.parenting.feedsportal.com/c/34791/f/641276/index.rss', '1'),
  ('地球圖輯隊',  'http://world.yam.com/rss.php', '1'),
  ('教育部',  'http://www.edu.tw/rss.aspx?Node=1088', '1'),
  ('嘉義縣教育資訊網', 'http://www.cyc.edu.tw/backend.php',  '0')";

    $xoopsDB->queryF($sql) or web_error($sql, __FILE__, __LINE__);
}
