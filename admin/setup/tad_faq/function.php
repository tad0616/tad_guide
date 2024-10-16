<?php
use XoopsModules\Tadtools\Utility;

function get_tad_faq_cate($group_name)
{
    global $xoopsDB;
    //`fcsn`, `of_fcsn`, `title`, `description`, `sort`, `cate_pic`

    $sql = 'SELECT `fcsn`, `title` FROM `' . $xoopsDB->prefix('tad_faq_cate') . '` WHERE `title` LIKE ?';
    $result = Utility::query($sql, 's', ['%' . $group_name . '%']) or Utility::web_error($sql, __FILE__, __LINE__);

    list($fcsn, $title) = $xoopsDB->fetchRow($result);
    $cate['sn'] = $fcsn;
    $cate['title'] = $title;
    $cate['power'] = '';
    $cate['file'] = 'index.php';
    $cate['col'] = 'fcsn';

    return $cate;
}
