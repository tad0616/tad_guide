<?php
use XoopsModules\Tadtools\Utility;

function get_tad_link_cate($group_name)
{
    global $xoopsDB;

    $sql = 'SELECT `cate_sn`, `cate_title` FROM `' . $xoopsDB->prefix('tad_link_cate') . '` WHERE `cate_title` LIKE ?';
    $result = Utility::query($sql, 's', ["%$group_name%"]) or Utility::web_error($sql, __FILE__, __LINE__);

    list($cate_sn, $cate_title) = $xoopsDB->fetchRow($result);
    $cate['sn'] = $cate_sn;
    $cate['title'] = $cate_title;
    $cate['power'] = '';
    $cate['file'] = 'index.php';
    $cate['col'] = 'cate_sn';

    return $cate;
}
