<?php
function tad_player_content($cate_sn=""){
  global $xoopsDB , $xoopsUser;

  // $sql="delete from `".$xoopsDB->prefix("tad_player")."`";
  // $xoopsDB->queryF($sql) or die($sql);


  $sql="select max(sort) from `".$xoopsDB->prefix("tad_player_cate")."`";
  $result=$xoopsDB->query($sql);
  list($max_sort)=$xoopsDB->fetchRow($result);
  $max_sort++;

  $sql="INSERT INTO `".$xoopsDB->prefix("tad_player_cate")."`
  (`of_csn`, `title`, `enable_group`, `enable_upload_group`, `sort`, `width`, `height`)
  VALUES
  (0,'翻轉教育', '', '1', '{$max_sort}', '640', '480')";
  $xoopsDB->queryF($sql) or die($sql);
  $insert_id = $xoopsDB->getInsertId();

  uzip_file($insert_id);

  $uid=$xoopsUser->uid();
  $now=date("Y-m-d H:i:s");


  import_mod_data(1,"$insert_id,  '均一教育平台介紹', '曲智鑛',  '', 'http://i1.ytimg.com/vi/gIkIjASVPeE/hqdefault.jpg', '', '{$uid}',  '{$now}',  '', 2,  0,  0,  0,  '<p>欲看更完整的教學影片內容請到 均一教育平台http://www.junyiacademy.org</p>\r\n',  'http://youtu.be/gIkIjASVPeE',  ''");
  import_mod_data(2,"$insert_id,  '「均一教育平台」實例操作', '詹曼玉',  '', 'http://i1.ytimg.com/vi/W9Lbm1YKmCI/hqdefault.jpg', '', '{$uid}',  '{$now}',  '', 2,  0,  0,  0,  '<p>這是我第一次這樣錄，若有不好，再請大家多包涵。 影片內只是初步介紹有心想導入均一可以起步方法，可以參照的，其他困境部份，我無法在我錄製影片當中說盡。 但至少提供一些簡單小方法。 請大家不吝指教。</p>\r\n', 'http://youtu.be/W9Lbm1YKmCI',  ''");
  import_mod_data(3,"$insert_id,  '可汗學院創辦人薩曼‧可汗：創造不用怕丟臉的學習世界 - YouTube',  'CWTV', '', 'http://i1.ytimg.com/vi/AyNTTit4Gt4/hqdefault.jpg', '', '{$uid}',  '{$now}',  '', 2,  0,  0,  0,  '<p>或許你以前沒有聽過可汗學院（Khan Academy）。但從此刻起，你必須認識這所「學校」，並且準備好擁抱這所世界最大的學校持續帶來的學習革命。 可汗學院，是一個免費的教育資源網站，是目前全世界使用率最高的二十四小時「網路家教」。比爾‧蓋茲（Bill Gates）和Google員工的孩子都曾受惠。可汗學院網站最著...</p>\r\n',  'http://youtu.be/AyNTTit4Gt4',  ''");
  import_mod_data(4,"$insert_id,  'TEDTalks 》Sir Ken Robinson 推動學習革命',  'DesignSourceTAIWAN', '', 'http://i1.ytimg.com/vi/1ZbF6wryyh0/hqdefault.jpg', '', '{$uid}',  '{$now}',  '', 2,  0,  0,  0,  '<p>Sir Ken Robinson: Bring on the learning revolution! 肯‧羅賓森爵士於2006年曾發表「學校扼殺創意」這場著名演講，他如今再度以尖銳又有趣的口吻，主張教育應徹底轉型，從學校的標準化教育轉變為個人化學習，並營造良好的學習環境，讓孩子發揮自己的長才。 In this ...</p>\r\n',  'http://youtu.be/1ZbF6wryyh0',  ''");

}

//上傳壓縮圖檔
function uzip_file($csn){
  global $xoopsDB,$xoopsUser,$xoopsModule,$xoopsModuleConfig,$type_to_mime;
  mk_dir(XOOPS_ROOT_PATH."/uploads/tad_player/");
  //取消上傳時間限制
  set_time_limit(0);

  //設置上傳大小
  ini_set('memory_limit', '100M');

  require_once XOOPS_ROOT_PATH."/modules/tad_guide/class/dunzip2/dUnzip2.inc.php";
  require_once XOOPS_ROOT_PATH."/modules/tad_guide/class/dunzip2/dZip.inc.php";
  copy(XOOPS_ROOT_PATH."/modules/tad_guide/admin/setup/tad_player/tad_player.zip", XOOPS_ROOT_PATH."/uploads/tad_player/tad_player.zip");
  $zip = new dUnzip2(XOOPS_ROOT_PATH."/uploads/tad_player/tad_player.zip");
  $zip->getList();
  $zip->unzipAll(XOOPS_ROOT_PATH."/uploads/tad_player/");

  rename(XOOPS_ROOT_PATH."/uploads/tad_player/csn_list.xml", XOOPS_ROOT_PATH."/uploads/tad_player/{$csn}_list.xml");
}

//寫入資料
function import_mod_data($i,$data){
  global $xoopsDB;
  $sql="INSERT INTO `".$xoopsDB->prefix("tad_player")."` (`pcsn`, `title`, `creator`, `location`, `image`, `info`, `uid`, `post_date`, `enable_group`, `counter`, `width`, `height`, `sort`, `content`, `youtube`, `logo`) VALUES
  ($data)";
  $xoopsDB->queryF($sql) or die($sql);
  $file_id = $xoopsDB->getInsertId();
  rename(XOOPS_ROOT_PATH."/uploads/tad_player/img/s_f{$i}.png", XOOPS_ROOT_PATH."/uploads/tad_player/img/s_{$file_id}.png");
}
?>