<?php
use XoopsModules\Tadtools\Utility;

function get_tad_gphotos_cate($group_name)
{
    global $xoopsDB;
    //`fcsn`, `of_fcsn`, `title`, `description`, `sort`, `cate_pic`

    $sql = 'SELECT `csn`, `title` FROM `' . $xoopsDB->prefix('tad_gphotos_cate') . '` WHERE `title` LIKE ?';
    $result = Utility::query($sql, 's', ['%' . $group_name . '%']) or Utility::web_error($sql, __FILE__, __LINE__);

    list($csn, $title) = $xoopsDB->fetchRow($result);
    $cate['sn'] = $csn;
    $cate['title'] = $title;
    $cate['power'] = '';
    $cate['file'] = 'index.php';
    $cate['col'] = 'csn';

    return $cate;
}
