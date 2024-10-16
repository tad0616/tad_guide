<?php
use XoopsModules\Tadtools\Utility;

function get_tadgallery_cate($group_name)
{
    global $xoopsDB;
    //`csn`, `of_csn`, `title`, `passwd`, `enable_group`, `enable_upload_group`, `sort`, `mode`, `show_mode`, `cover`, `no_hotlink`, `uid`

    $sql = 'SELECT `csn`, `title`, `enable_upload_group` FROM `' . $xoopsDB->prefix('tad_gallery_cate') . '` WHERE `title` LIKE ?';
    $result = Utility::query($sql, 's', ['%' . $group_name . '%']) or Utility::web_error($sql, __FILE__, __LINE__);

    list($csn, $title, $enable_upload_group) = $xoopsDB->fetchRow($result);
    $cate['sn'] = $csn;
    $cate['title'] = $title;
    $cate['power'] = $enable_upload_group;
    $cate['file'] = 'index.php';
    $cate['col'] = 'csn';

    return $cate;
}
