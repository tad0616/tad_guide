<?php
use XoopsModules\Tadtools\Utility;

function get_tad_discuss_cate($group_name)
{
    global $xoopsDB;
    //`BoardID`, `ofBoardID`, `BoardTitle`, `BoardDesc`, `BoardManager`, `BoardSort`, `BoardEnable`

    $sql = 'SELECT `BoardID`, `BoardTitle` FROM `' . $xoopsDB->prefix('tad_discuss_board') . '` WHERE `BoardTitle` LIKE ?';
    $result = Utility::query($sql, 's', ['%' . $group_name . '%']) or Utility::web_error($sql, __FILE__, __LINE__);

    list($BoardID, $BoardTitle) = $xoopsDB->fetchRow($result);
    $cate['sn'] = $BoardID;
    $cate['title'] = $BoardTitle;
    $cate['power'] = '';
    $cate['file'] = 'discuss.php';
    $cate['col'] = 'BoardID';

    return $cate;
}
