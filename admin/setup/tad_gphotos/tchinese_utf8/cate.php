<?php
use XoopsModules\Tadtools\Utility;

$sql = 'select max(sort) from `' . $xoopsDB->prefix('tad_gphotos_cate') . '`';
$result = $xoopsDB->query($sql);
list($max_sort) = $xoopsDB->fetchRow($result);

foreach ($create_cate as $groupid => $cate_name) {
    $max_sort++;

    $sql = 'INSERT INTO `' . $xoopsDB->prefix('tad_gphotos_cate') . "`
    (`of_csn`, `sort`, `title`, `description`)
    VALUES
    (0, '{$max_sort}', '{$cate_name}相簿',  '{$cate_name}的 Google 相簿')";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
}
