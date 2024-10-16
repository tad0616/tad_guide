<?php
use XoopsModules\Tadtools\Utility;

$prefix = '';
$suffix = '相關電子書';

$sql = 'SELECT MAX(`sort`) FROM `' . $xoopsDB->prefix('tad_book3_cate') . '`';
$result = Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

list($max_sort) = $xoopsDB->fetchRow($result);

foreach ($create_cate as $groupid => $cate_name) {
    $max_sort++;

    $sql = 'INSERT INTO `' . $xoopsDB->prefix('tad_book3_cate') . '`
    (`sort`, `title`, `description`)
    VALUES
    (?, ?, ?)';
    Utility::query($sql, 'iss', [$max_sort, $prefix . $cate_name . $suffix, $prefix . $cate_name . $suffix]) or Utility::web_error($sql, __FILE__, __LINE__);

    $insert_id = $xoopsDB->getInsertId();

}
