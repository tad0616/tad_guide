<?php
function tadnews_content($cate_sn = "")
{
    global $xoopsDB, $xoopsUser;

    $uid = $xoopsUser->uid();
    $now = date("Y-m-d H:i:s");

    $sql            = "select `nc_title` from `" . $xoopsDB->prefix("tad_news_cate") . "` where ncsn='$cate_sn'";
    $result         = $xoopsDB->queryF($sql);
    list($nc_title) = $xoopsDB->fetchRow($result);

    $sql = "INSERT INTO `" . $xoopsDB->prefix("tad_news") . "` (`ncsn`, `news_title`, `news_content`, `start_day`, `end_day`, `enable`, `uid`, `passwd`, `enable_group`, `counter`, `prefix_tag`, `always_top`, `always_top_date`, `have_read_group`, `page_sort`) VALUES
  ('{$cate_sn}',  '{$nc_title}內容建置中',  '<p>歡迎蒞臨本網站，網站目前尚在建置中，資料會陸續上線，若有找不到的資料，歡迎留言或跟網站管理者聯繫，也歡迎您提供建議，讓本網站更為完整並符合需求。</p>\r\n',  '{$now}',  '0000-00-00 00:00:00',  '1',  '{$uid}',  '', '', 1, '1',  '0',  '0000-00-00 00:00:00',  '', 0);
";
    $xoopsDB->queryF($sql) or web_error($sql,  __FILE__, __LINE__);
}
