<?php
function tadgallery_content($cate_sn=""){
  global $xoopsDB,$xoopsUser;

  // $sql="delete from `".$xoopsDB->prefix("tad_gallery")."`";
  // $xoopsDB->queryF($sql) or die($sql);

  $now=date("Y-m-d H:i:s");

  $sql="select max(sort) from `".$xoopsDB->prefix("tad_gallery_cate")."`";
  $result=$xoopsDB->query($sql);
  list($max_sort)=$xoopsDB->fetchRow($result);

  $max_sort++;
  $sql="INSERT INTO `".$xoopsDB->prefix("tad_gallery_cate")."`
  (`of_csn`, `title`, `content`, `passwd`, `enable_group`, `enable_upload_group`, `sort`, `mode`, `show_mode`, `cover`, `no_hotlink`, `uid`)
  VALUES
  (0,'戶外教學', '土耳其共和國（土耳其語：Türkiye Cumhuriyeti）是一個橫跨歐亞兩洲的國家，國土包括西亞的安納托利亞半島、以及巴爾幹半島的東色雷斯地區。北臨黑海，南臨地中海，東南與敘利亞、伊拉克接壤，西臨愛琴海，並與希臘以及保加利亞接壤，東部與喬治亞、亞美尼亞、亞塞拜然和伊朗接壤。在安納托利亞半島和東色雷斯地區之間的，是博斯普魯斯海峽、馬爾馬拉海和達達尼爾海峽，屬黑海海峽，別稱土耳其海峽，是連接黑海以及地中海的唯一航道。其首都是位處安納托利亞高原正中央的安卡拉。國民有98%是穆斯林，但法律規定實施政教分離。目前正申請加入歐盟，但是歐盟因北賽普勒斯及亞美尼亞種族大屠殺等問題暫時拒絕土耳其加入。土耳其由2009年起為突厥議會成員國。 其氣候屬地中海氣候，南部和西部氣候溫和，夏季乾熱，冬季多雨：黑海沿岸，涼爽濕潤；內陸、東北、東南則冬季寒冷，夏季乾熱。', '', '', '1', '{$max_sort}', '', '', '', '', '1')";
  $xoopsDB->queryF($sql) or die($sql);
  $insert_id = $xoopsDB->getInsertId();

  $uid=$xoopsUser->uid();

  uzip_file();


  import_mod_data(1 , "'{$insert_id}', '凌晨時分', '為了乘坐熱氣球，必須4:30就起床', 'photo1.jpg', 149187, 'image/jpeg', 768, 1024, '2013_07_17', '{$uid}', '{$now}' , 2, '[FILE][FileName]=phpMAqwID||[FILE][FileType]=2||[FILE][MimeType]=image/jpeg||[FILE][FileSize]=149187||[COMPUTED][Width]=768||[COMPUTED][Height]=1024||[IFD0][Make]=                               ||[IFD0][Model]=                               ||[IFD0][DateTime]=2013:07:17 05:06:30||[IFD0][Orientation]=1||[EXIF][ExposureTime]=140000/1000000||[EXIF][ISOSpeedRatings]=592||[COMPUTED][ApertureFNumber]=f/2.4||[EXIF][Flash]=0||[EXIF][FocalLength]=350/100mm||[EXIF][ExposureBiasValue]=0/10EV||[GPS][latitude]=38.714344||[GPS][longitude]=34.830398555556', '', '0', 0");



  import_mod_data(2 , "'{$insert_id}', '日出', '第一次在國外看日出，別有一番風味', 'photo2.jpg', 110159, 'image/jpeg', 768, 1024, '2013_07_17','{$uid}', '{$now}', 2, '[FILE][FileName]=php8qYSmm||[FILE][FileType]=2||[FILE][MimeType]=image/jpeg||[FILE][FileSize]=110159||[COMPUTED][Width]=768||[COMPUTED][Height]=1024||[IFD0][Make]=                               ||[IFD0][Model]=                               ||[IFD0][DateTime]=2013:07:17 05:42:59||[IFD0][Orientation]=1||[EXIF][ExposureTime]=2380/1000000||[EXIF][ISOSpeedRatings]=117||[COMPUTED][ApertureFNumber]=f/2.4||[EXIF][Flash]=0||[EXIF][FocalLength]=350/100mm||[EXIF][ExposureBiasValue]=0/10EV||[GPS][latitude]=38.714347833333||[GPS][longitude]=34.830413805556', '', '0', 0");

  import_mod_data(3 , "'{$insert_id}', '', '', 'photo3.jpg', 162230, 'image/jpeg', 768, 1024, '2013_07_17', '{$uid}', '{$now}', 0, '[FILE][FileName]=php0pi8Jk||[FILE][FileType]=2||[FILE][MimeType]=image/jpeg||[FILE][FileSize]=162230||[COMPUTED][Width]=768||[COMPUTED][Height]=1024||[IFD0][Make]=                               ||[IFD0][Model]=                               ||[IFD0][DateTime]=2013:07:17 05:43:43||[IFD0][Orientation]=1||[EXIF][ExposureTime]=5488/1000000||[EXIF][ISOSpeedRatings]=116||[COMPUTED][ApertureFNumber]=f/2.4||[EXIF][Flash]=0||[EXIF][FocalLength]=350/100mm||[EXIF][ExposureBiasValue]=0/10EV||[GPS][latitude]=38.714439388889||[GPS][longitude]=34.830455777778', '', '0', 0");

  import_mod_data(4 , "'{$insert_id}', '好想游泳', '可是清晨的水很冰...', 'photo4.jpg', 154225, 'image/jpeg', 768, 1024, '2013_07_17', '{$uid}', '{$now}', 0, '[FILE][FileName]=phpreKMyt||[FILE][FileType]=2||[FILE][MimeType]=image/jpeg||[FILE][FileSize]=154225||[COMPUTED][Width]=768||[COMPUTED][Height]=1024||[IFD0][Make]=                               ||[IFD0][Model]=                               ||[IFD0][DateTime]=2013:07:17 05:44:06||[IFD0][Orientation]=1||[EXIF][ExposureTime]=9996/1000000||[EXIF][ISOSpeedRatings]=147||[COMPUTED][ApertureFNumber]=f/2.4||[EXIF][Flash]=0||[EXIF][FocalLength]=350/100mm||[EXIF][ExposureBiasValue]=0/10EV||[GPS][latitude]=38.714473722222||[GPS][longitude]=34.830398555556', '', '0', 0");

  import_mod_data(5 , "'{$insert_id}', '好大的熱氣球！', '', 'photo5.jpg', 162416, 'image/jpeg', 1024, 768, '2013_07_17', '{$uid}', '{$now}', 0, '[FILE][FileName]=phpewljlV||[FILE][FileType]=2||[FILE][MimeType]=image/jpeg||[FILE][FileSize]=162416||[COMPUTED][Width]=1024||[COMPUTED][Height]=768||[IFD0][Make]=                               ||[IFD0][Model]=                               ||[IFD0][DateTime]=2013:07:17 06:33:04||[IFD0][Orientation]=1||[EXIF][ExposureTime]=1568/1000000||[EXIF][ISOSpeedRatings]=117||[COMPUTED][ApertureFNumber]=f/2.4||[EXIF][Flash]=0||[EXIF][FocalLength]=350/100mm||[EXIF][ExposureBiasValue]=0/10EV||[GPS][latitude]=38.706829055556||[GPS][longitude]=34.842933638889', '', '0', 0");

  import_mod_data(6 , "'{$insert_id}', '充氣', '已經有其他的熱氣球升空了！\r\n好感動！', 'photo6.jpg', 90454, 'image/jpeg', 768, 1024, '2013_07_17', '{$uid}', '{$now}', 0, '[FILE][FileName]=phpDTtqKE||[FILE][FileType]=2||[FILE][MimeType]=image/jpeg||[FILE][FileSize]=90454||[COMPUTED][Width]=768||[COMPUTED][Height]=1024||[IFD0][Make]=                               ||[IFD0][Model]=                               ||[IFD0][DateTime]=2013:07:17 06:35:55||[IFD0][Orientation]=1||[EXIF][ExposureTime]=308/1000000||[EXIF][ISOSpeedRatings]=121||[COMPUTED][ApertureFNumber]=f/2.4||[EXIF][Flash]=0||[EXIF][FocalLength]=350/100mm||[EXIF][ExposureBiasValue]=0/10EV||[GPS][latitude]=38.706829055556||[GPS][longitude]=34.842933638889', '', '0', 0");

  import_mod_data(7 , "'{$insert_id}', '終於充好了！', '只是這是別人家的～', 'photo7.jpg', 153140, 'image/jpeg', 768, 1024, '2013_07_17', '{$uid}', '{$now}', 0, '[FILE][FileName]=phpMydI6y||[FILE][FileType]=2||[FILE][MimeType]=image/jpeg||[FILE][FileSize]=153140||[COMPUTED][Width]=768||[COMPUTED][Height]=1024||[IFD0][Make]=                               ||[IFD0][Model]=                               ||[IFD0][DateTime]=2013:07:17 06:39:18||[IFD0][Orientation]=1||[EXIF][ExposureTime]=1456/1000000||[EXIF][ISOSpeedRatings]=118||[COMPUTED][ApertureFNumber]=f/2.4||[EXIF][Flash]=0||[EXIF][FocalLength]=350/100mm||[EXIF][ExposureBiasValue]=0/10EV||[GPS][latitude]=38.706829055556||[GPS][longitude]=34.842933638889', '', '0', 0");

  import_mod_data(8 , "'{$insert_id}', '', '越來越多的熱氣求升空，滿天飛舞。', 'photo8.jpg', 104479, 'image/jpeg', 768, 1024, '2013_07_17', '{$uid}', '{$now}', 0, '[FILE][FileName]=phpuBM00E||[FILE][FileType]=2||[FILE][MimeType]=image/jpeg||[FILE][FileSize]=104479||[COMPUTED][Width]=768||[COMPUTED][Height]=1024||[IFD0][Make]=                               ||[IFD0][Model]=                               ||[IFD0][DateTime]=2013:07:17 06:40:24||[IFD0][Orientation]=1||[EXIF][ExposureTime]=504/1000000||[EXIF][ISOSpeedRatings]=120||[COMPUTED][ApertureFNumber]=f/2.4||[EXIF][Flash]=0||[EXIF][FocalLength]=350/100mm||[EXIF][ExposureBiasValue]=0/10EV||[GPS][latitude]=38.706829055556||[GPS][longitude]=34.842933638889', '', '0', 0");

  import_mod_data(9 , "'{$insert_id}', '別人的漂亮熱氣球', '自己坐的熱氣球不用太漂亮，因為自己看不到。\r\n所以，祈禱別人的熱氣球漂亮一點比較重要！哈哈～', 'photo9.jpg', 158989, 'image/jpeg', 1024, 768, '2013_07_17', '{$uid}', '{$now}', 0, '[FILE][FileName]=phpWhGFrV||[FILE][FileType]=2||[FILE][MimeType]=image/jpeg||[FILE][FileSize]=158989||[COMPUTED][Width]=1024||[COMPUTED][Height]=768||[IFD0][Make]=                               ||[IFD0][Model]=                               ||[IFD0][DateTime]=2013:07:17 06:42:35||[IFD0][Orientation]=1||[EXIF][ExposureTime]=1372/1000000||[EXIF][ISOSpeedRatings]=116||[COMPUTED][ApertureFNumber]=f/2.4||[EXIF][Flash]=0||[EXIF][FocalLength]=350/100mm||[EXIF][ExposureBiasValue]=0/10EV||[GPS][latitude]=38.706829055556||[GPS][longitude]=34.842933638889', '', '0', 0");

  import_mod_data(10 , "'{$insert_id}', '升空', '', 'photo10.jpg', 154760, 'image/jpeg', 768, 1024, '2013_07_17', '{$uid}', '{$now}', 0, '[FILE][FileName]=php4HW9hv||[FILE][FileType]=2||[FILE][MimeType]=image/jpeg||[FILE][FileSize]=154760||[COMPUTED][Width]=768||[COMPUTED][Height]=1024||[IFD0][Make]=                               ||[IFD0][Model]=                               ||[IFD0][DateTime]=2013:07:17 06:49:22||[IFD0][Orientation]=1||[EXIF][ExposureTime]=1176/1000000||[EXIF][ISOSpeedRatings]=119||[COMPUTED][ApertureFNumber]=f/2.4||[EXIF][Flash]=0||[EXIF][FocalLength]=350/100mm||[EXIF][ExposureBiasValue]=0/10EV||[GPS][latitude]=38.706829055556||[GPS][longitude]=34.842933638889', '', '0', 0");

  import_mod_data(11 , "'{$insert_id}', '很舒服的熱氣球', '', 'photo11.jpg', 166529, 'image/jpeg', 1024, 768, '2013_07_17', '{$uid}', '{$now}', 0, '[FILE][FileName]=phpEqN30q||[FILE][FileType]=2||[FILE][MimeType]=image/jpeg||[FILE][FileSize]=166529||[COMPUTED][Width]=1024||[COMPUTED][Height]=768||[IFD0][Make]=                               ||[IFD0][Model]=                               ||[IFD0][DateTime]=2013:07:17 07:10:57||[IFD0][Orientation]=1||[EXIF][ExposureTime]=1036/1000000||[EXIF][ISOSpeedRatings]=117||[COMPUTED][ApertureFNumber]=f/2.4||[EXIF][Flash]=0||[EXIF][FocalLength]=350/100mm||[EXIF][ExposureBiasValue]=0/10EV||[GPS][latitude]=38.706829055556||[GPS][longitude]=34.842933638889', '', '0', 0");

  import_mod_data(12 , "'{$insert_id}', '', '', 'photo12.jpg', 169222, 'image/jpeg', 1024, 768, '2013_07_17', '{$uid}', '{$now}', 0, '[FILE][FileName]=phprjiX5w||[FILE][FileType]=2||[FILE][MimeType]=image/jpeg||[FILE][FileSize]=169222||[COMPUTED][Width]=1024||[COMPUTED][Height]=768||[IFD0][Make]=                               ||[IFD0][Model]=                               ||[IFD0][DateTime]=2013:07:17 07:12:26||[IFD0][Orientation]=1||[EXIF][ExposureTime]=896/1000000||[EXIF][ISOSpeedRatings]=118||[COMPUTED][ApertureFNumber]=f/2.4||[EXIF][Flash]=0||[EXIF][FocalLength]=350/100mm||[EXIF][ExposureBiasValue]=0/10EV||[GPS][latitude]=38.706829055556||[GPS][longitude]=34.842933638889', '', '0', 0");

  import_mod_data(13 , "'{$insert_id}', '居高臨下', '', 'photo13.jpg', 184122, 'image/jpeg', 1024, 768, '2013_07_17', '{$uid}', '{$now}', 0, '[FILE][FileName]=phpWwYasY||[FILE][FileType]=2||[FILE][MimeType]=image/jpeg||[FILE][FileSize]=184122||[COMPUTED][Width]=1024||[COMPUTED][Height]=768||[IFD0][Make]=                               ||[IFD0][Model]=                               ||[IFD0][DateTime]=2013:07:17 07:13:11||[IFD0][Orientation]=1||[EXIF][ExposureTime]=728/1000000||[EXIF][ISOSpeedRatings]=118||[COMPUTED][ApertureFNumber]=f/2.4||[EXIF][Flash]=0||[EXIF][FocalLength]=350/100mm||[EXIF][ExposureBiasValue]=0/10EV||[GPS][latitude]=38.706829055556||[GPS][longitude]=34.842933638889', '', '0', 0");

  import_mod_data(14 , "'{$insert_id}', '難得一見的地形', '豐富的地形景觀，令人目不暇給', 'photo14.jpg', 233691, 'image/jpeg', 768, 1024, '2013_07_17', '{$uid}', '{$now}', 0, '[FILE][FileName]=phpbK8XRJ||[FILE][FileType]=2||[FILE][MimeType]=image/jpeg||[FILE][FileSize]=233691||[COMPUTED][Width]=768||[COMPUTED][Height]=1024||[IFD0][Make]=                               ||[IFD0][Model]=                               ||[IFD0][DateTime]=2013:07:17 07:15:48||[IFD0][Orientation]=1||[EXIF][ExposureTime]=1176/1000000||[EXIF][ISOSpeedRatings]=119||[COMPUTED][ApertureFNumber]=f/2.4||[EXIF][Flash]=0||[EXIF][FocalLength]=350/100mm||[EXIF][ExposureBiasValue]=0/10EV||[GPS][latitude]=38.706829055556||[GPS][longitude]=34.842933638889', '', '0', 0");

  import_mod_data(15 , "'{$insert_id}', '', '', 'photo15.jpg', 149966, 'image/jpeg', 768, 1024, '2013_07_17', '{$uid}', '{$now}', 0, '[FILE][FileName]=phpNGmKKQ||[FILE][FileType]=2||[FILE][MimeType]=image/jpeg||[FILE][FileSize]=149966||[COMPUTED][Width]=768||[COMPUTED][Height]=1024||[IFD0][Make]=                               ||[IFD0][Model]=                               ||[IFD0][DateTime]=2013:07:17 07:31:07||[IFD0][Orientation]=1||[EXIF][ExposureTime]=420/1000000||[EXIF][ISOSpeedRatings]=117||[COMPUTED][ApertureFNumber]=f/2.4||[EXIF][Flash]=0||[EXIF][FocalLength]=350/100mm||[EXIF][ExposureBiasValue]=0/10EV||[GPS][latitude]=38.706829055556||[GPS][longitude]=34.842933638889', '', '0', 0");

  import_mod_data(16 , "'{$insert_id}', '', '', 'photo16.jpg', 187147, 'image/jpeg', 768, 1024, '2013_07_17', '{$uid}', '{$now}', 0, '[FILE][FileName]=php799nvf||[FILE][FileType]=2||[FILE][MimeType]=image/jpeg||[FILE][FileSize]=187147||[COMPUTED][Width]=768||[COMPUTED][Height]=1024||[IFD0][Make]=                               ||[IFD0][Model]=                               ||[IFD0][DateTime]=2013:07:17 07:32:10||[IFD0][Orientation]=1||[EXIF][ExposureTime]=952/1000000||[EXIF][ISOSpeedRatings]=119||[COMPUTED][ApertureFNumber]=f/2.4||[EXIF][Flash]=0||[EXIF][FocalLength]=350/100mm||[EXIF][ExposureBiasValue]=0/10EV||[GPS][latitude]=38.706829055556||[GPS][longitude]=34.842933638889', '', '0', 0");

  import_mod_data(17 , "'{$insert_id}', '', '', 'photo17.jpg', 144781, 'image/jpeg', 1024, 768, '2013_07_17', '{$uid}', '{$now}', 0, '[FILE][FileName]=phpJ0eFJY||[FILE][FileType]=2||[FILE][MimeType]=image/jpeg||[FILE][FileSize]=144781||[COMPUTED][Width]=1024||[COMPUTED][Height]=768||[IFD0][Make]=                               ||[IFD0][Model]=                               ||[IFD0][DateTime]=2013:07:17 07:32:25||[IFD0][Orientation]=1||[EXIF][ExposureTime]=504/1000000||[EXIF][ISOSpeedRatings]=120||[COMPUTED][ApertureFNumber]=f/2.4||[EXIF][Flash]=0||[EXIF][FocalLength]=350/100mm||[EXIF][ExposureBiasValue]=0/10EV||[GPS][latitude]=38.706829055556||[GPS][longitude]=34.842933638889', '', '0', 0");

}

//上傳壓縮圖檔
function uzip_file(){
  global $xoopsDB,$xoopsUser,$xoopsModule,$xoopsModuleConfig,$type_to_mime;
  mk_dir(XOOPS_ROOT_PATH."/uploads/tadgallery/");
  //取消上傳時間限制
  set_time_limit(0);

  //設置上傳大小
  ini_set('memory_limit', '100M');

  require_once XOOPS_ROOT_PATH."/modules/tad_guide/class/dunzip2/dUnzip2.inc.php";
  require_once XOOPS_ROOT_PATH."/modules/tad_guide/class/dunzip2/dZip.inc.php";
  copy(XOOPS_ROOT_PATH."/modules/tad_guide/admin/setup/tadgallery/tadgallery.zip", XOOPS_ROOT_PATH."/uploads/tadgallery/tadgallery.zip");
  $zip = new dUnzip2(XOOPS_ROOT_PATH."/uploads/tadgallery/tadgallery.zip");
  $zip->getList();
  $zip->unzipAll(XOOPS_ROOT_PATH."/uploads/tadgallery/");

}

//寫入資料
function import_mod_data($i,$data){
  global $xoopsDB;

  $sql="INSERT INTO `".$xoopsDB->prefix("tad_gallery")."` (`csn`, `title`, `description`, `filename`, `size`, `type`, `width`, `height`, `dir`, `uid`, `post_date`, `counter`, `exif`, `tag`, `good`, `photo_sort`) VALUES
  ($data)";
  $xoopsDB->queryF($sql) or die($sql);
  $file_id = $xoopsDB->getInsertId();
  rename(XOOPS_ROOT_PATH."/uploads/tadgallery/2013_07_17/f{$file_id}_photo{$i}.jpg", XOOPS_ROOT_PATH."/uploads/tadgallery/2013_07_17/{$file_id}_photo{$i}.jpg");
  rename(XOOPS_ROOT_PATH."/uploads/tadgallery/small/2013_07_17/f{$file_id}_s_photo{$i}.jpg", XOOPS_ROOT_PATH."/uploads/tadgallery/small/2013_07_17/{$file_id}_s_photo{$i}.jpg");
}
?>