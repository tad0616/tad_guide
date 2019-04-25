<?php
use XoopsModules\Tadtools\Utility;

function get_tad_uploader_cate($group_name)
{
    global $xoopsDB;
    //`cat_sn`, `cat_title`, `cat_desc`, `cat_enable`, `uid`, `of_cat_sn`, `cat_share`, `cat_sort`, `cat_count`

    $sql = 'select cat_sn , cat_title from ' . $xoopsDB->prefix('tad_uploader') . " where cat_title like '%{$group_name}%'";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    list($cat_sn, $cat_title) = $xoopsDB->fetchRow($result);
    $cate['sn'] = $cat_sn;
    $cate['title'] = $cat_title;
    $cate['power'] = '';
    $cate['file'] = 'index.php';
    $cate['col'] = 'of_cat_sn';

    return $cate;
}
