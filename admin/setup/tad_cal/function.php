<?php
use XoopsModules\Tadtools\Utility;

function get_tad_cal_cate($group_name)
{
    global $xoopsDB;
    //`cate_sn`, `cate_title`, `cate_sort`, `cate_enable`, `cate_handle`, `enable_group`, `enable_upload_group`, `google_id`, `google_pass`, `cate_bgcolor`, `cate_color`

    $sql = 'SELECT `cate_sn`, `cate_title`, `enable_upload_group` FROM `' . $xoopsDB->prefix('tad_cal_cate') . '` WHERE `cate_title` LIKE ?';
    $result = Utility::query($sql, 's', ["%$group_name%"]) or Utility::web_error($sql, __FILE__, __LINE__);

    list($cate_sn, $cate_title, $enable_upload_group) = $xoopsDB->fetchRow($result);
    $cate['sn'] = $cate_sn;
    $cate['title'] = $cate_title;
    $cate['power'] = $enable_upload_group;
    $cate['file'] = 'index.php';
    $cate['col'] = 'cate_sn';

    return $cate;
}
