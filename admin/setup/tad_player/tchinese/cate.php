<?php
$prefix="";
$suffix="¼v¤ù";
// $c1=mt_rand( 200, 255 );
// $c2=mt_rand( 200, 255 );
// $c3=mt_rand( 200, 255 );
// $b1=mt_rand( 50, 255 );
// $b2=mt_rand( 50, 255 );
// $b3=mt_rand( 50, 255 );

$sql="select max(sort) from `".$xoopsDB->prefix("tad_player_cate")."`";
$result=$xoopsDB->query($sql);
list($max_sort)=$xoopsDB->fetchRow($result);

$read_perm_name = '';
$post_perm_name = '';


foreach($create_cate as $groupid=>$cate_name){

  $max_sort++;

  $sql="INSERT INTO `".$xoopsDB->prefix("tad_player_cate")."`
  (`of_csn`, `title`, `enable_group`, `enable_upload_group`, `sort`, `width`, `height`)
  VALUES
  (0,'{$prefix}{$cate_name}{$suffix}', '', '1,$groupid', '{$max_sort}', '640', '480')";
  $xoopsDB->queryF($sql) or die($sql);
  $insert_id = $xoopsDB->getInsertId();


  if(!empty($read_perm_name)){
    add_perm(1, $insert_id, $mid, $read_perm_name);
    add_perm(2, $insert_id, $mid, $read_perm_name);
    add_perm(3, $insert_id, $mid, $read_perm_name);
    add_perm($groupid, $insert_id, $mid, $read_perm_name);
  }

  if(!empty($post_perm_name)){
    add_perm(1, $insert_id, $mid, $post_perm_name);
    add_perm($groupid, $insert_id, $mid, $post_perm_name);
  }
}


?>