<?php
function get_tad_link_cate($group_name)
{
    global $xoopsDB;
    //`cate_sn`, `of_cate_sn`, `cate_title`, `cate_sort`

    $sql = 'select cate_sn , cate_title  from ' . $xoopsDB->prefix('tad_link_cate') . " where cate_title like '%{$group_name}%'";
    $result = $xoopsDB->query($sql) or web_error($sql, __FILE__, __LINE__);
    list($cate_sn, $cate_title) = $xoopsDB->fetchRow($result);
    $cate['sn'] = $cate_sn;
    $cate['title'] = $cate_title;
    $cate['power'] = '';
    $cate['file'] = 'index.php';
    $cate['col'] = 'cate_sn';

    return $cate;
}
