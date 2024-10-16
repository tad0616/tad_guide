<?php
use XoopsModules\Tadtools\Utility;

$prefix = '';
$suffix = '常見問題';
// $c1=mt_rand( 200, 255 );
// $c2=mt_rand( 200, 255 );
// $c3=mt_rand( 200, 255 );
// $b1=mt_rand( 50, 255 );
// $b2=mt_rand( 50, 255 );
// $b3=mt_rand( 50, 255 );

$sql = 'SELECT MAX(`sort`) FROM `' . $xoopsDB->prefix('tad_faq_cate') . '`';
$result = Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

list($max_sort) = $xoopsDB->fetchRow($result);

$read_perm_name = 'faq_read';
$post_perm_name = 'faq_edit';

foreach ($create_cate as $groupid => $cate_name) {
    $max_sort++;

    $sql = 'INSERT INTO `' . $xoopsDB->prefix('tad_faq_cate') . '`
    (`of_fcsn`, `title`, `description`, `sort`, `cate_pic`)
    VALUES
    (0, ?, ?, ?, ?)';
    $result = Utility::query($sql, 'ssis', ["{$prefix}{$cate_name}{$suffix}", "{$cate_name}的常見問題", $max_sort, '']) or Utility::web_error($sql, __FILE__, __LINE__);

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
