<?php
use XoopsModules\Tadtools\Utility;

function get_tad_uploader_cate($group_name)
{
    global $xoopsDB;
    //`cat_sn`, `cat_title`, `cat_desc`, `cat_enable`, `uid`, `of_cat_sn`, `cat_share`, `cat_sort`, `cat_count`

    $sql = 'SELECT `cat_sn`, `cat_title` FROM `' . $xoopsDB->prefix('tad_uploader') . '` WHERE `cat_title` LIKE ?';
    $result = Utility::query($sql, 's', ['%' . $group_name . '%']) or Utility::web_error($sql, __FILE__, __LINE__);

    list($cat_sn, $cat_title) = $xoopsDB->fetchRow($result);
    $cate['sn'] = $cat_sn;
    $cate['title'] = $cat_title;
    $cate['power'] = '';
    $cate['file'] = 'index.php';
    $cate['col'] = 'of_cat_sn';

    return $cate;
}
