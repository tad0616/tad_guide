<?php
function get_tad_discuss_cate($group_name){
  global $xoopsDB;
  //`BoardID`, `ofBoardID`, `BoardTitle`, `BoardDesc`, `BoardManager`, `BoardSort`, `BoardEnable`

  $sql="select BoardID , BoardTitle from ".$xoopsDB->prefix("tad_discuss_board")." where BoardTitle like '%{$group_name}%'";
  $result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
  list($BoardID , $BoardTitle )=$xoopsDB->fetchRow($result);
  $cate['sn']=$BoardID;
  $cate['title']=$BoardTitle;
  $cate['power']="";
  $cate['file']="discuss.php";
  $cate['col']="BoardID";

  return $cate;
}
?>