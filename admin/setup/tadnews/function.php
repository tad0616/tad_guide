<?php
use XoopsModules\Tadtools\Utility;

function get_tadnews_cate($group_name)
{
    global $xoopsDB;
    //`ncsn`, `of_ncsn`, `nc_title`, `enable_group`, `enable_post_group`, `sort`, `cate_pic`, `not_news`, `setup`

    $sql = 'SELECT `ncsn`, `nc_title`, `enable_post_group` FROM `' . $xoopsDB->prefix('tad_news_cate') . '` WHERE `nc_title` LIKE ?';
    $result = Utility::query($sql, 's', ["%$group_name%"]) or Utility::web_error($sql, __FILE__, __LINE__);

    list($ncsn, $nc_title, $enable_post_group) = $xoopsDB->fetchRow($result);
    $cate['sn'] = $ncsn;
    $cate['title'] = $nc_title;
    $cate['power'] = $enable_post_group;
    $cate['file'] = 'index.php';
    $cate['col'] = 'ncsn';

    return $cate;
}
