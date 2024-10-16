<?php
use XoopsModules\Tadtools\Utility;

$sql = 'SELECT MAX(`sort`) FROM `' . $xoopsDB->prefix('tad_gphotos_cate') . '`';
$result = Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

list($max_sort) = $xoopsDB->fetchRow($result);

foreach ($create_cate as $groupid => $cate_name) {
    $max_sort++;

    $sql = 'INSERT INTO `' . $xoopsDB->prefix('tad_gphotos_cate') . '`
    (`of_csn`, `sort`, `title`, `description`)
    VALUES
    (0, ?, ?, ?)';
    $result = Utility::query($sql, 'iss', [$max_sort, "{$cate_name}相簿", "{$cate_name}的 Google 相簿"]) or Utility::web_error($sql, __FILE__, __LINE__);

}
