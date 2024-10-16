<?php
use XoopsModules\Tadtools\Utility;

function get_tad_book3_cate($group_name)
{
    global $xoopsDB;
    //`tbcsn`, `of_tbsn`, `sort`, `title`, `description`

    $sql = 'SELECT `tbcsn`, `title` FROM `' . $xoopsDB->prefix('tad_book3_cate') . '` WHERE `title` LIKE ?';
    $result = Utility::query($sql, 's', ["%$group_name%"]) or Utility::web_error($sql, __FILE__, __LINE__);

    list($tbcsn, $title) = $xoopsDB->fetchRow($result);
    $cate['sn'] = $tbcsn;
    $cate['title'] = $title;
    $cate['power'] = '';
    $cate['file'] = 'index.php';
    $cate['col'] = 'tbcsn';

    return $cate;
}
