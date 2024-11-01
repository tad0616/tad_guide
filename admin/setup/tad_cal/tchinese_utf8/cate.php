<?php
use XoopsModules\Tadtools\Utility;

$prefix = '';
$suffix = '行事曆';
$c1 = mt_rand(200, 255);
$c2 = mt_rand(200, 255);
$c3 = mt_rand(200, 255);
$b1 = mt_rand(50, 255);
$b2 = mt_rand(50, 255);
$b3 = mt_rand(50, 255);

$sql = 'SELECT MAX(`cate_sort`) FROM `' . $xoopsDB->prefix('tad_cal_cate') . '`';
$result = Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

list($max_sort) = $xoopsDB->fetchRow($result);

$read_perm_name = '';
$post_perm_name = '';

foreach ($create_cate as $groupid => $cate_name) {
    $max_sort++;

    $sql = 'INSERT INTO `' . $xoopsDB->prefix('tad_cal_cate') . '`
    (`cate_title`, `cate_sort`, `cate_enable`, `cate_handle`, `enable_group`, `enable_upload_group`, `google_id`, `google_pass`, `cate_bgcolor`, `cate_color`)
    VALUES
    (?, ?, 1, ?, ?, ?, ?, ?, ?, ?, ?)';
    $result = Utility::query($sql, 'sisssssssss', ["{$prefix}{$cate_name}{$suffix}", $max_sort, '', '', "1,{$groupid}", '', '', "rgb($b1, $b2, $b3)", "rgb($c1, $c2, $c3)"]) or Utility::web_error($sql, __FILE__, __LINE__);

    $insert_id = $xoopsDB->getInsertId();

    if (!empty($read_perm_name)) {
        add_perm(1, $insert_id, $mid, $read_perm_name);
        add_perm(2, $insert_id, $mid, $read_perm_name);
        add_perm(3, $insert_id, $mid, $read_perm_name);
        add_perm($groupid, $insert_id, $mid, $read_perm_name);
    }

    if (!empty($post_perm_name)) {
        add_perm(1, $insert_id, $mid, $post_perm_name);
        add_perm($groupid, $insert_id, $mid, $post_perm_name);
    }
}
