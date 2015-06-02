<?php
function get_tad_faq_cate($group_name){
  global $xoopsDB;
  //`fcsn`, `of_fcsn`, `title`, `description`, `sort`, `cate_pic`

  $sql="select fcsn , title  from ".$xoopsDB->prefix("tad_faq_cate")." where title like '%{$group_name}%'";
  $result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
  list($fcsn , $title )=$xoopsDB->fetchRow($result);
  $cate['sn']=$fcsn;
  $cate['title']=$title;
  $cate['power']="";
  $cate['file']="index.php";
  $cate['col']="fcsn";

  return $cate;
}
?>