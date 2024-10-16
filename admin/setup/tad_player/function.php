<?php
use XoopsModules\Tadtools\Utility;

function get_tad_player_cate($group_name)
{
    global $xoopsDB;
    //`pcsn`, `of_csn`, `title`, `enable_group`, `enable_upload_group`, `sort`, `width`, `height`

    $sql = 'SELECT `pcsn`, `title`, `enable_upload_group` FROM `' . $xoopsDB->prefix('tad_player_cate') . '` WHERE `title` LIKE ?';
    $result = Utility::query($sql, 's', ["%$group_name%"]) or Utility::web_error($sql, __FILE__, __LINE__);

    list($pcsn, $title, $enable_upload_group) = $xoopsDB->fetchRow($result);
    $cate['sn'] = $pcsn;
    $cate['title'] = $title;
    $cate['power'] = $enable_upload_group;
    $cate['file'] = 'index.php';
    $cate['col'] = 'pcsn';

    return $cate;
}
