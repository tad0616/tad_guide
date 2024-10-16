<?php
use XoopsModules\Tadtools\Utility;

$prefix = '';
$suffix = '討論區';
// $c1=mt_rand( 200, 255 );
// $c2=mt_rand( 200, 255 );
// $c3=mt_rand( 200, 255 );
// $b1=mt_rand( 50, 255 );
// $b2=mt_rand( 50, 255 );
// $b3=mt_rand( 50, 255 );

$sql = 'SELECT MAX(`BoardSort`) FROM `' . $xoopsDB->prefix('tad_discuss_board') . '`';
$result = Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

list($max_sort) = $xoopsDB->fetchRow($result);

$read_perm_name = 'forum_read';
$post_perm_name = 'forum_post';

foreach ($create_cate as $groupid => $cate_name) {
    $max_sort++;

    $sql = 'INSERT INTO `' . $xoopsDB->prefix('tad_discuss_board') . '`
    (`ofBoardID`, `BoardTitle`, `BoardDesc`, `BoardManager`, `BoardSort`, `BoardEnable`)
    VALUES
    (0, ?, ?, ?, ?, ?, 1)';
    $result = Utility::query($sql, 'ssssi', ["{$prefix}{$cate_name}{$suffix}", "給{$cate_name}用的討論專區", '1', $max_sort]) or Utility::web_error($sql, __FILE__, __LINE__);

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
