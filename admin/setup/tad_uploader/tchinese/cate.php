<?php
$prefix = "";
$suffix = "相關檔案";
// $c1=mt_rand( 200, 255 );
// $c2=mt_rand( 200, 255 );
// $c3=mt_rand( 200, 255 );
// $b1=mt_rand( 50, 255 );
// $b2=mt_rand( 50, 255 );
// $b3=mt_rand( 50, 255 );

$sql            = "select max(cat_sort) from `" . $xoopsDB->prefix("tad_uploader") . "`";
$result         = $xoopsDB->query($sql);
list($max_sort) = $xoopsDB->fetchRow($result);

$read_perm_name = 'catalog';
$post_perm_name = 'catalog_up';

foreach ($create_cate as $groupid => $cate_name) {

    $max_sort++;

    $sql = "INSERT INTO `" . $xoopsDB->prefix("tad_uploader") . "`
  (`cat_title`, `cat_desc`, `cat_enable`, `uid`, `of_cat_sn`, `cat_share`, `cat_sort`, `cat_count`)
  VALUES
  ('{$prefix}{$cate_name}{$suffix}', '{$cate_name}的常用檔案及文件下載', '1', '1' , '0', '1', '{$max_sort}', '0')";
    $xoopsDB->queryF($sql) or die($sql);
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
