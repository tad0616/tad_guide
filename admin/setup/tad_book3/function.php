<?php
function get_tad_book3_cate($group_name)
{
    global $xoopsDB;
    //`tbcsn`, `of_tbsn`, `sort`, `title`, `description`

    $sql                 = "select tbcsn , title  from " . $xoopsDB->prefix("tad_book3_cate") . " where title like '%{$group_name}%'";
    $result              = $xoopsDB->query($sql) or web_error($sql, __FILE__, __LINE__);
    list($tbcsn, $title) = $xoopsDB->fetchRow($result);
    $cate['sn']          = $tbcsn;
    $cate['title']       = $title;
    $cate['power']       = "";
    $cate['file']        = "index.php";
    $cate['col']         = "tbcsn";

    return $cate;
}
