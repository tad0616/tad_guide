<?php
function tad_link_content($cate_sn=""){
  global $xoopsDB , $xoopsUser;

  // $sql="delete from `".$xoopsDB->prefix("tad_link")."`";
  // $xoopsDB->queryF($sql) or die($sql);

  uzip_file();

  $sql="select max(cate_sort) from `".$xoopsDB->prefix("tad_link_cate")."`";
  $result=$xoopsDB->query($sql);
  list($max_sort)=$xoopsDB->fetchRow($result);

  $max_sort++;
  $sql="INSERT INTO `".$xoopsDB->prefix("tad_link_cate")."`
  (`of_cate_sn`, `cate_title`, `cate_sort`)
  VALUES
  (0,'宣導網站', '{$max_sort}')";
  $xoopsDB->queryF($sql) or die($sql);
  $insert_id = $xoopsDB->getInsertId();

  $uid=$xoopsUser->uid();
  $now=date("Y-m-d H:i:s");


  import_mod_data(1 , "'{$insert_id}', '十二年國民基本教育', 'http://12basic.edu.tw', '', 1, 0, '0000-00-00', '{$uid}', '{$now}', '1'");
  import_mod_data(2 , "'{$insert_id}', '衛生福利部疾病管制署一般民眾版', 'http://www.cdc.gov.tw/', '衛生福利部疾病管制署一般民眾版', 3, 1, '0000-00-00', '{$uid}', '{$now}', '1'");
  import_mod_data(3 , "'{$insert_id}', '紫錐花運動', 'http://enc.moe.edu.tw/', '紫錐花運動的訴求：反毒總動員　從校內推向社會　由國內推向國際　全球一起來。響應聯合國國際反毒日　臺灣發起紫錐花運動　邀請您　共同推廣紫錐花標幟。提升國民尊榮感 打造國家道德形象 消除人類病態文化', 2, 0, '0000-00-00', '{$uid}', '{$now}', '1'");
  import_mod_data(4 , "'{$insert_id}', '全民資安素養自我評量首頁', 'https://isafe.moe.edu.tw/event/', '', 4, 0, '0000-00-00', '{$uid}', '{$now}', '1'");
  import_mod_data(5 , "'{$insert_id}', '遊戲軟體分級查詢網', 'http://www.gamerating.org.tw/', '', 5, 0, '0000-00-00', '{$uid}', '{$now}', '1'");
  import_mod_data(6 , "'{$insert_id}', '教育部 學校教育儲蓄戶', 'http://www.edusave.edu.tw/news.aspx', '', 6, 0, '0000-00-00', 1, '2014-01-21 22:02:44', '1'");


  $max_sort++;
  $sql="INSERT INTO `".$xoopsDB->prefix("tad_link_cate")."`
  (`of_cate_sn`, `cate_title`, `cate_sort`)
  VALUES
  (0,'常用網站', '{$max_sort}')";
  $xoopsDB->queryF($sql) or die($sql);
  $insert_id = $xoopsDB->getInsertId();

  import_mod_data(7 , "'{$insert_id}', 'Google', 'http://www.google.com.tw', '', 7, 1, '0000-00-00', '{$uid}', '{$now}', '1'");
  import_mod_data(8 , "'{$insert_id}', 'Yahoo奇摩', 'http://tw.yahoo.com', '提供最方便的網站搜尋、即時新聞、生活資訊和Yahoo奇摩服務入口。', 8, 0, '0000-00-00', '{$uid}', '{$now}', '1'");
  import_mod_data(11 , "'{$insert_id}', 'YouTube', 'http://youtube.com', '與好友、家人及世界分享您的影片', 9, 0, '0000-00-00', '{$uid}', '{$now}', '1'");

  $max_sort++;
  $sql="INSERT INTO `".$xoopsDB->prefix("tad_link_cate")."`
  (`of_cate_sn`, `cate_title`, `cate_sort`)
  VALUES
  (0,'教育網站', '{$max_sort}')";
  $xoopsDB->queryF($sql) or die($sql);
  $insert_id = $xoopsDB->getInsertId();
  import_mod_data(9 , "'{$insert_id}', '均一教育平台', 'http://www.junyiacademy.org/', '由財團法人誠致教育基金會創辦。我們的目標是透過雲端平台提供免費的『均等、一流』的教育機會給每一個人。網站初期將以小學高年級（五、六年級）的數學教學資源為先行建構的內容，未來將包含台灣一到九年級的數學課程。', 1, 0, '0000-00-00', '{$uid}', '{$now}', '1'");
  import_mod_data(10 , "'{$insert_id}', '微學習站台', 'http://stream.kh.edu.tw/', '', 2, 1, '0000-00-00', '{$uid}', '{$now}', '1'");
  import_mod_data(12 , "'{$insert_id}', '萌典 – 教育部國語、臺語、客語辭典民間版', 'https://www.moedict.tw/', '共收錄十六萬筆國語、兩萬筆臺語、一萬四千筆客語條目，每個字詞都可以輕按連到說明，並提供 Android 及 iOS 離線 App。來源為教育部「重編國語辭典修訂本」、「臺灣閩南語常用詞辭典」、「臺灣客家語常用詞辭典」，辭典本文的著作權仍為教育部所有。', 10, 0, '0000-00-00', '{$uid}', '{$now}', '1'");

}

//上傳壓縮圖檔
function uzip_file(){
  global $xoopsDB,$xoopsUser,$xoopsModule,$xoopsModuleConfig,$type_to_mime;
  mk_dir(XOOPS_ROOT_PATH."/uploads/tad_link/");
  //取消上傳時間限制
  set_time_limit(0);

  //設置上傳大小
  ini_set('memory_limit', '100M');

  require_once XOOPS_ROOT_PATH."/modules/tad_guide/class/dunzip2/dUnzip2.inc.php";
  require_once XOOPS_ROOT_PATH."/modules/tad_guide/class/dunzip2/dZip.inc.php";
  copy(XOOPS_ROOT_PATH."/modules/tad_guide/admin/setup/tad_link/tad_link.zip", XOOPS_ROOT_PATH."/uploads/tad_link/tad_link.zip");
  $zip = new dUnzip2(XOOPS_ROOT_PATH."/uploads/tad_link/tad_link.zip");
  $zip->getList();
  $zip->unzipAll(XOOPS_ROOT_PATH."/uploads/tad_link/");
}

//寫入資料
function import_mod_data($i,$data){
  global $xoopsDB;
  $sql="INSERT INTO `".$xoopsDB->prefix("tad_link")."`(`cate_sn`, `link_title`, `link_url`, `link_desc`, `link_sort`, `link_counter`, `unable_date`, `uid`, `post_date`, `enable`) VALUES
  ($data)";
  $xoopsDB->queryF($sql) or die($sql);
  $file_id = $xoopsDB->getInsertId();
  rename(XOOPS_ROOT_PATH."/uploads/tad_link/f{$i}.jpg", XOOPS_ROOT_PATH."/uploads/tad_link/{$file_id}.jpg");
  rename(XOOPS_ROOT_PATH."/uploads/tad_link/thumbs/f{$i}.jpg", XOOPS_ROOT_PATH."/uploads/tad_link/thumbs/{$file_id}.jpg");
}
?>