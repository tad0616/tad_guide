<?php
function get_tad_discuss_cate($group_name)
{
    global $xoopsDB;
    //`BoardID`, `ofBoardID`, `BoardTitle`, `BoardDesc`, `BoardManager`, `BoardSort`, `BoardEnable`

    $sql                        = "select BoardID , BoardTitle from " . $xoopsDB->prefix("tad_discuss_board") . " where BoardTitle like '%{$group_name}%'";
    $result                     = $xoopsDB->query($sql) or web_error($sql, __FILE__, __LINE__);
    list($BoardID, $BoardTitle) = $xoopsDB->fetchRow($result);
    $cate['sn']                 = $BoardID;
    $cate['title']              = $BoardTitle;
    $cate['power']              = "";
    $cate['file']               = "discuss.php";
    $cate['col']                = "BoardID";

    return $cate;
}
