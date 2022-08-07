<?php
use XoopsModules\Tadtools\Utility;

$prefix = '';
$suffix = '相關電子書';

$sql = 'select max(sort) from `' . $xoopsDB->prefix('tad_book3_cate') . '`';
$result = $xoopsDB->query($sql);
list($max_sort) = $xoopsDB->fetchRow($result);

foreach ($create_cate as $groupid => $cate_name) {
    $max_sort++;

    $sql = 'INSERT INTO `' . $xoopsDB->prefix('tad_book3_cate') . "`
    (`sort`, `title`, `description`)
    VALUES
    ('$max_sort', '{$prefix}{$cate_name}{$suffix}',  '{$prefix}{$cate_name}{$suffix}');
    ";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    $insert_id = $xoopsDB->getInsertId();

}
