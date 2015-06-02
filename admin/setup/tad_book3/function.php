<?php
function get_tad_book3_cate($group_name){
  global $xoopsDB;
  //`tbcsn`, `of_tbsn`, `sort`, `title`, `description`

  $sql="select tbcsn , title  from ".$xoopsDB->prefix("tad_book3_cate")." where title like '%{$group_name}%'";
  $result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
  list($tbcsn , $title)=$xoopsDB->fetchRow($result);
  $cate['sn']=$tbcsn;
  $cate['title']=$title;
  $cate['power']="";
  $cate['file']="index.php";
  $cate['col']="tbcsn";

  return $cate;
}
?>