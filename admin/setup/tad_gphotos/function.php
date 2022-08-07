<?php
use XoopsModules\Tadtools\Utility;

function get_tad_gphotos_cate($group_name)
{
    global $xoopsDB;
    //`fcsn`, `of_fcsn`, `title`, `description`, `sort`, `cate_pic`

    $sql = 'select csn , title  from ' . $xoopsDB->prefix('tad_gphotos_cate') . " where title like '%{$group_name}%'";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    list($csn, $title) = $xoopsDB->fetchRow($result);
    $cate['sn'] = $csn;
    $cate['title'] = $title;
    $cate['power'] = '';
    $cate['file'] = 'index.php';
    $cate['col'] = 'csn';

    return $cate;
}
