<?php
/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = "tad_guide_adm_main.tpl";
include_once "header.php";
include_once "../function.php";

require_once XOOPS_ROOT_PATH . "/modules/tad_adm/admin/adm_function.php";
/*-----------功能函數區--------------*/

//可開群組的模組
$mod_arr = array('tadnews', 'tadgallery', 'tad_player', 'tad_uploader', 'tad_cal', 'tad_discuss', 'tad_faq', 'tad_link', 'tad_book3');

$school_mod_arr = array('tad_adm', 'tadtools', 'tad_themes', 'tadnews', 'tadgallery', 'tad_player', 'tad_login', 'tad_uploader', 'tad_cal', 'tad_discuss', 'tad_faq', 'tad_link', 'tad_repair', 'tad_assignment', 'tad_form', 'tad_lunch3', 'tad_book3', 'tad_idioms', 'tad_evaluation', 'tad_web', 'logcounterx', 'tad_rss', 'randomquote');

//步驟1，安裝模組
function list_all_modules()
{
    global $xoopsDB, $xoopsTpl, $mod_arr, $school_mod_arr, $xoopsConfig;

    //取得群組
    $group = get_group();
    $xoopsTpl->assign('group', $group);

    //取得遠端的模組資訊
    $mod = get_tad_modules_info();
    // die(var_export($mod['tadtools']['module']));
    //         $mod[$dirname]['module']['module_title']       = $module_title;
    //         $mod[$dirname]['module']['update_sn']          = $update_sn;
    //         $mod[$dirname]['module']['new_version']        = $new_version;
    //         $mod[$dirname]['module']['new_status']         = $new_status;
    //         $mod[$dirname]['module']['new_status_version'] = $new_status_version;
    //         $mod[$dirname]['module']['new_last_update']    = $new_last_update;
    //         $mod[$dirname]['module']['update_descript']    = str_replace("\n", "\\n", $update_descript);
    //         $mod[$dirname]['module']['module_sn']          = $module_sn;
    //         $mod[$dirname]['module']['module_descript']    = str_replace("\n", "\\n", $module_descript);
    //         $mod[$dirname]['module']['file_link']          = $file_link;
    //         $mod[$dirname]['module']['kind']               = $kind;
    //抓出現有模組
    $sql    = "SELECT * FROM " . $xoopsDB->prefix("modules") . " ORDER BY hasmain DESC, weight";
    $result = $xoopsDB->query($sql) or web_error($sql);

    //模組部份
    while ($data = $xoopsDB->fetchArray($result)) {
        foreach ($data as $k => $v) {
            $$k = $v;
        }
        if (!isset($mod[$dirname])) {
            continue;
        }
        if ($mod[$dirname]['module']['kind'] == "module") {
            $ok['module'][] = $dirname;
        } else {
            continue;
        }

        $version     = intval($version);
        $new_version = $mod[$dirname]['module']['new_version'] * 100;
        $new_version = intval($new_version);

        $last_update     = filemtime(XOOPS_ROOT_PATH . "/modules/{$dirname}/xoops_version.php");
        $new_last_update = $mod[$dirname]['module']['new_last_update'];

        $mod[$dirname]['module']['function'] = (($new_version > $version) or ($new_last_update > $last_update)) ? 'update' : 'last_mod';
        $mod[$dirname]['module']['mid']      = $mid;
    }

    //找出目前的更新紀錄
    $act_log = $log = array();
    $sql     = "select `act_kind`, `kind_title`, `act_name`, `act_date`, `cate_sn` from `" . $xoopsDB->prefix("tad_guide") . "` order by `kind_title`";
    $result  = $xoopsDB->queryF($sql) or web_error($sql);
    while (list($act_kind, $dirname, $act_name, $act_date, $cate_sn) = $xoopsDB->fetchRow($result)) {
        $act_log[$dirname][$act_kind] = $act_date;
    }

    // die(var_export($log));

    // $dir = XOOPS_ROOT_PATH."/modules/tad_guide/admin/setup/{$dirname}/{$xoopsConfig['language']}/";
    // $log[$dirname]['blocks_file_exists']=file_exists("{$dir}/blocks.php");
    // $log[$dirname]['blocks_all_file_exists']=file_exists("{$dir}/blocks_all.php");
    // $log[$dirname]['config_exists']=file_exists("{$dir}/config.php");
    // $log[$dirname]['content_exists']=file_exists("{$dir}/content.php");
    // $log[$dirname]['content_all_exists']=file_exists("{$dir}/content_all.php");
    // $log[$dirname]['cates']=group_cate($dirname,$mod['mid']);

    $all_data = array();
    foreach ($school_mod_arr as $dirname) {
        if (empty($mod[$dirname]['module']['function'])) {
            $mod[$dirname]['module']['function'] = 'install';
            $mod[$dirname]['module']['mid']      = 0;
        }
        $all_data[$dirname] = $mod[$dirname]['module'];

        //取得各個模組是否有相對應的設定檔
        $log[$dirname] = get_dir_log($dirname, $mod['mid']);
    }


    ksort($all_mod_data);

    $xoopsTpl->assign('all_data', $all_data);
    $xoopsTpl->assign('log', $log);
    $xoopsTpl->assign('act_log', $act_log);
    $xoopsTpl->assign('now_op', 'list_all_modules');
    $xoopsTpl->assign('school_mod_arr', $school_mod_arr);

    if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/fancybox.php")) {
        redirect_header("index.php", 3, _MA_NEED_TADTOOLS);
    }
    include_once XOOPS_ROOT_PATH . "/modules/tadtools/fancybox.php";

    $fancybox = new fancybox('.modulesadmin', '800px', null, false);
    $fancybox->render();

    $onekey_fancybox = new fancybox('.onekey', '90%', '100%', false, false);
    $onekey_fancybox->render(true);
    //加在連結中：class="edit_dropdown" rel="group"（圖） data-fancybox-type="iframe"（HTML）

    if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/stickytableheaders.php")) {
        redirect_header("index.php", 3, _MA_NEED_TADTOOLS);
    }
    include_once XOOPS_ROOT_PATH . "/modules/tadtools/stickytableheaders.php";
    $stickytableheaders = new stickytableheaders(false);
    $stickytableheaders->render('#list_modules');
}

//取得模組的安裝精靈設定檔
function get_dir_log($dirname, $mid)
{
    global $school_mod_arr, $xoopsConfig;
    if (!in_array($dirname, $school_mod_arr)) {
        return;
    }

    $dir                       = XOOPS_ROOT_PATH . "/modules/tad_guide/admin/setup/{$dirname}/{$xoopsConfig['language']}/";
    $log['blocks_file_exists'] = file_exists("{$dir}/blocks.php");
    //$log['blocks_all_file_exists']=file_exists("{$dir}/blocks_all.php");
    $log['config_exists']      = file_exists("{$dir}/config.php");
    $log['content_exists']     = file_exists("{$dir}/content.php");
    $log['content_all_exists'] = file_exists("{$dir}/content_all.php");
    $log['cates']              = group_cate($dirname, $mid);
    return $log;
}

//一鍵安裝
function one_key($dirname, $mid)
{
    global $xoopsConfig, $xoopsDB;
    $log    = get_dir_log($dirname, $mid);
    $jquery = get_jquery();
    $main   = "
      <!DOCTYPE html>
      <html lang='zh-TW'>
        <head>
          <meta charset='utf-8'>
          <title></title>
          <meta name='viewport' content='width=device-width, initial-scale=1.0'>
          $jquery
          <script type='text/javascript'>
            $().ready(function(){
              $('#clickAll').click(function() {
                if($('#clickAll').attr('checked')){
                  $('input.ok_blocks').each(function() {
                    $(this).attr('checked', true);
                  });
                }else{
                  $('input.ok_blocks').each(function() {
                    $(this).attr('checked', false);
                  });
                }
              });
            });
          </script>

        </head>
        <body>
        <link rel='stylesheet' type='text/css' media='screen' href='" . XOOPS_URL . "/modules/tadtools/bootstrap3/css/bootstrap.css' />

        <link rel='stylesheet' type='text/css' media='screen' href='" . XOOPS_URL . "/modules/tadtools/css/xoops_adm.css' />
        <form action='main.php' method='post'>
        <div class='container'>
          <h2 class='text-center'>{$dirname}" . _MA_GUIDE_ONE_KEY . "
          <input type='hidden' name='mid' value='$mid'>
          <input type='hidden' name='dirname' value='$dirname'>
          <input type='hidden' name='op' value='import_all_data'>
          <button type='submit' class='btn btn-primary'>" . _TAD_SAVE . "</button></h2>

          <div class='row'>";

    $import_content = "";
    if ($log['content_all_exists']) {
        $import_content = "
        <label class='checkbox'>
          <input type='checkbox' name='act_kind_arr[]' value='content_all' checked>
          <h4>" . _MA_GUIDE_CONTENT_COL . "</h4>
        </label>
        ";
    }

    if ($log['config_exists']) {
        $main .= "
        <div class='col-sm-4'>
          <label class='checkbox'>
            <input type='checkbox' name='act_kind_arr[]' value='config' checked>
            <h4>" . _MA_GUIDE_IMPORT_CONFIG . "</h4>
          </label>
          $import_content
        </div>";
    }

    //if($log['blocks_file_exists'] or $log['blocks_all_file_exists']){
    if ($log['blocks_file_exists']) {
        $sql = "select * from `" . $xoopsDB->prefix("newblocks") . "` where `dirname`='{$dirname}' and `block_type`!='D' order by `func_num`";
        //die($sql);
        $result         = $xoopsDB->queryF($sql) or die($sql);
        $backup_content = "";
        while ($col = $xoopsDB->fetchArray($result)) {
            foreach ($col as $k => $v) {
                $$k = $v;
            }
            $b[$func_num] = $col;
        }

        $main .= "
        <div class='col-sm-4'>
          <label class='checkbox'>
            <h4><input type='checkbox' id='clickAll'>" . _MA_GUIDE_BLOCKS_COL . "</h4>
            <input type='hidden' name='act_kind_arr[]' value='blocks'>
          </label>";

        $dir = XOOPS_ROOT_PATH . "/modules/tad_guide/admin/setup/{$dirname}/{$xoopsConfig['language']}/";
        include "{$dir}/blocks.php";
        //$new_data[1]=array('options'=>'0|0|true','title'=>'影音特區[hide]','side'=>'8','weight'=>'2','visible'=>'1');

        foreach ($new_data as $func_num => $block) {
            $checked = $block['visible'] == 1 ? "checked" : "";
            $place   = constant("_MA_GUIDE_BS_{$block['side']}");

            $visible = $b[$func_num]['visible'] == 1 ? "<span class='label label-warning'>" . _MA_GUIDE_BLOCK_INSTALLED . "</span>" : "";
            $main .= "
              <label class='checkbox'>
                <input type='checkbox' name='ok_blocks[]' value='{$func_num}' $checked class='ok_blocks'>
                {$block['title']}
                <span class='label label-info'>{$place}</span>
                {$visible}
              </label>";
        }
        $main .= "
            </div>";
    }

    if ($log['cates']) {
        $groups_setup = "";
        foreach ($log['cates'] as $groupid => $cate) {

            if ($cate['show_cate'] != '1' or $groupid <= 3) {
                continue;
            }

            $tt = sprintf(_MA_GUIDE_CREATE_CATE, $cate['groupname']);
            if (empty($cate['cate_sn'])) {
                $groups_setup .= "
                <label class='checkbox'>
                <input type='checkbox' name='groupid[]' value='{$groupid}' checked>
                {$tt}
                </label>";
            }
        }

        if (!empty($groups_setup)) {
            $main .= "
              <div class='col-sm-4'>
                <label class='checkbox'>
                  <h4>" . _MA_GUIDE_CREATE_GROUP . "</h4>
                  <input type='hidden' name='act_kind_arr[]' value='create_group'>
                </label>
                $groups_setup
              </div>";
        }
    }

    $main .= "</div>
    </div>
    </form>
  </body>
</html>";

    die($main);
}

//取得最後更新時間
function get_last_update($dirname = "")
{
    global $xoopsDB;
    $sql               = "select last_update from " . $xoopsDB->prefix("modules") . " where dirname='$dirname'";
    $result            = $xoopsDB->query($sql) or web_error($sql);
    list($last_update) = $xoopsDB->fetchRow($result);
    return $last_update;
}

//顯示群組的分類
function group_cate($dirname, $mid = 0)
{
    global $xoopsDB, $xoopsTpl, $mod_arr;

    $sql    = "select `groupid`, `name` from " . $xoopsDB->prefix("groups") . " order by groupid";
    $result = $xoopsDB->query($sql) or web_error($sql);

    while (list($groupid, $name) = $xoopsDB->fetchRow($result)) {
        //以下會產生這些變數： `groupid`, `name`, `description`, `group_type`
        $mod_cate[$groupid]['dirname']   = $dirname;
        $mod_cate[$groupid]['mid']       = $mid;
        $mod_cate[$groupid]['groupid']   = $groupid;
        $mod_cate[$groupid]['groupname'] = $name;
        $mod_cate[$groupid]['show_cate'] = in_array($dirname, $mod_arr);
        if ($mid and in_array($dirname, $mod_arr)) {
            $cate                             = get_mod_cate($dirname, $name);
            $mod_cate[$groupid]['cate_sn']    = $cate['sn'];
            $mod_cate[$groupid]['cate_title'] = $cate['title'];
            $mod_cate[$groupid]['cate_power'] = $cate['power'];
            $mod_cate[$groupid]['file']       = $cate['file'];
            $mod_cate[$groupid]['col']        = $cate['col'];
        } else {
            $mod_cate[$groupid]['cate_sn']    = '';
            $mod_cate[$groupid]['cate_title'] = '';
            $mod_cate[$groupid]['cate_power'] = '';
            $mod_cate[$groupid]['file']       = '';
            $mod_cate[$groupid]['col']        = '';
        }
        //if($groupid==4)die(var_export($mod_cate));

    }

    return $mod_cate;
}

//取得群組
function get_group()
{
    global $xoopsDB, $xoopsTpl, $mod_arr;

    $sql    = "select `groupid`, `name` from " . $xoopsDB->prefix("groups") . " order by groupid";
    $result = $xoopsDB->query($sql) or web_error($sql);
    $group  = array();
    $i      = 0;
    while (list($groupid, $name) = $xoopsDB->fetchRow($result)) {
        $group[$i]['groupid'] = $groupid;
        $group[$i]['name']    = $name;
        $i++;
    }

    return $group;
}

//快速建立群組
function to_create_group($create_group = "")
{
    global $xoopsDB, $xoopsTpl, $mod_arr;

    $new_group = explode(';', $create_group);

    // $sql = "select groupid,name from ".$xoopsDB->prefix("groups")." order by groupid";
    // $result = $xoopsDB->query($sql) or web_error($sql);
    // while(list($groupid,$name)=$xoopsDB->fetchRow($result)){
    //   $old_group[$groupid]=$name;
    // }

    foreach ($new_group as $group) {
        // if(!in_array($group,$old_group)){
        mk_group($group);
        // }
    }
}

//建立群組
function mk_group($name = "")
{
    global $xoopsDB;
    $sql           = "select groupid from " . $xoopsDB->prefix("groups") . " where `name`='$name'";
    $result        = $xoopsDB->query($sql) or web_error($sql);
    list($groupid) = $xoopsDB->fetchRow($result);

    if (empty($groupid)) {
        $sql = "insert into " . $xoopsDB->prefix("groups") . " (`name`) values('{$name}')";
        $xoopsDB->queryF($sql) or web_error($sql);

        //取得最後新增資料的流水編號
        $groupid = $xoopsDB->getInsertId();
    }
    return $groupid;
}

//取得模組現有分類
function get_mod_cate($dirname = "", $group_name = "")
{
    global $xoopsDB, $mod_arr;
    //$mod_arr=array('tadnews','tadgallery','tad_player','tad_uploader','tad_cal','tad_discuss','tad_faq','tad_link');
    if (!in_array($dirname, $mod_arr)) {
        return;
    }

    $cate['sn']    = "";
    $cate['title'] = "-";
    $cate['power'] = "";
    $cate['file']  = "";
    $cate['col']   = "";
    if (file_exists(XOOPS_ROOT_PATH . "/modules/tad_guide/admin/setup/{$dirname}/function.php")) {

        include_once XOOPS_ROOT_PATH . "/modules/tad_guide/admin/setup/{$dirname}/function.php";

        $cate = call_user_func("get_{$dirname}_cate", $group_name);
    }
    return $cate;
}

//備份偏好設定
function backup_config($dirname = "", $mid = "")
{
    global $xoopsDB, $xoopsConfig;

    $myts = MyTextSanitizer::getInstance();

    //檢查有無之前備份
    $sql            = "select `act_date` from `" . $xoopsDB->prefix("tad_guide_backup") . "` where `act_kind`='config' and `kind_title`='{$dirname}'";
    $result         = $xoopsDB->queryF($sql) or die($sql);
    list($act_date) = $xoopsDB->fetchRow($result);

    if (empty($act_date)) {
        //撈取預設偏好設定
        $sql            = "select * from `" . $xoopsDB->prefix("config") . "` where `conf_modid`='{$mid}'";
        $result         = $xoopsDB->queryF($sql) or die($sql);
        $backup_content = array();
        while ($col = $xoopsDB->fetchArray($result)) {
            $syntax = array();
            foreach ($col as $k => $v) {
                $syntax[] = "`{$k}`='{$v}'";
            }
            $all_syntax = implode(',', $syntax);

            $backup_content[] = "update `" . $xoopsDB->prefix("config") . "` set {$all_syntax} where `conf_id`='{$col['conf_id']}';";
        }

        //模組名稱部份
        $sql                 = "select name,weight from `" . $xoopsDB->prefix("modules") . "` where `mid`='{$mid}'";
        $result              = $xoopsDB->queryF($sql) or die($sql);
        list($name, $weight) = $xoopsDB->fetchRow($result);
        $backup_content[]    = "update `" . $xoopsDB->prefix("modules") . "` set `name`='$name',`weight`='$weight' where `mid`='{$mid}';";

        $backup_content = implode("##", $backup_content);

        //開始備份
        $time           = date("Y-m-d H:i:s");
        $backup_content = $myts->addSlashes($backup_content);
        $sql            = "replace into `" . $xoopsDB->prefix("tad_guide_backup") . "` (`act_kind`, `kind_title`, `act_date`, `backup_content`) values('config','{$dirname}','{$time}','{$backup_content}')";
        $xoopsDB->queryF($sql) or die($sql);
    }

}

//還原偏好設定
function restore_config($dirname = "", $mid = "")
{
    global $xoopsDB, $xoopsConfig;

    $myts = MyTextSanitizer::getInstance();
    //檢查有無之前備份
    $sql                  = "select `backup_content` from `" . $xoopsDB->prefix("tad_guide_backup") . "` where `act_kind`='config' and `kind_title`='{$dirname}'";
    $result               = $xoopsDB->queryF($sql) or die($sql);
    list($backup_content) = $xoopsDB->fetchRow($result);

    if (!empty($backup_content)) {
        $restroe_sql = explode("##", $backup_content);
        foreach ($restroe_sql as $sql) {
            if (!empty($sql)) {
                $xoopsDB->queryF($sql) or web_error($sql);
            }

        }
        $sql    = "delete from `" . $xoopsDB->prefix("tad_guide_backup") . "` where `act_kind`='config' and `kind_title`='{$dirname}'";
        $result = $xoopsDB->queryF($sql) or die($sql);
    }
}

//備份區塊設定
function backup_blocks($dirname = "", $mid = "")
{
    global $xoopsDB, $xoopsConfig;

    $myts = MyTextSanitizer::getInstance();

    //檢查有無之前備份
    $sql            = "select `act_date` from `" . $xoopsDB->prefix("tad_guide_backup") . "` where `act_kind`='blocks' and `kind_title`='{$dirname}'";
    $result         = $xoopsDB->queryF($sql) or die($sql);
    list($act_date) = $xoopsDB->fetchRow($result);

    if (empty($act_date)) {
        //撈取預設偏好設定
        $sql            = "select * from `" . $xoopsDB->prefix("newblocks") . "` where `dirname`='{$dirname}' and `block_type`!='D' order by `func_num`";
        $result         = $xoopsDB->queryF($sql) or die($sql);
        $backup_content = "";
        while ($col = $xoopsDB->fetchArray($result)) {
            $syntax = array();
            foreach ($col as $k => $v) {
                $syntax[] = "`{$k}`='{$v}'";
            }
            $all_syntax = implode(',', $syntax);

            $backup_content .= "update `" . $xoopsDB->prefix("newblocks") . "` set {$all_syntax} where `bid`='{$col['bid']}';\n";
        }

        //開始備份
        $time           = date("Y-m-d H:i:s");
        $backup_content = $myts->addSlashes($backup_content);
        $sql            = "replace into `" . $xoopsDB->prefix("tad_guide_backup") . "` (`act_kind`, `kind_title`, `act_date`, `backup_content`) values('blocks','{$dirname}','{$time}','{$backup_content}')";
        $xoopsDB->queryF($sql) or die($sql);
    }

}

//還原區塊設定
function restore_blocks($dirname = "", $mid = "")
{
    global $xoopsDB, $xoopsConfig;

    $myts = MyTextSanitizer::getInstance();

    //檢查有無之前備份
    $sql                  = "select `backup_content` from `" . $xoopsDB->prefix("tad_guide_backup") . "` where `act_kind`='blocks' and `kind_title`='{$dirname}'";
    $result               = $xoopsDB->queryF($sql) or die($sql);
    list($backup_content) = $xoopsDB->fetchRow($result);

    if (!empty($backup_content)) {
        //$backup_content=$myts->addSlashes($backup_content);
        $xoopsDB->queryF($backup_content) or die($backup_content);
        $sql    = "delete from `" . $xoopsDB->prefix("tad_guide_backup") . "` where `act_kind`='blocks' and `kind_title`='{$dirname}'";
        $result = $xoopsDB->queryF($sql) or die($sql);
    }
}

//內容還原
function restore_content($dirname = "", $bak_table = array())
{
    global $xoopsDB;
    if (is_dir(XOOPS_ROOT_PATH . "/uploads/{$dirname}")) {
        delete_directory(XOOPS_ROOT_PATH . "/uploads/{$dirname}");
        rename(XOOPS_ROOT_PATH . "/uploads/{$dirname}_gbak", XOOPS_ROOT_PATH . "/uploads/{$dirname}");
    }

    foreach ($bak_table as $bak) {
        $sql = "DROP TABLE " . $xoopsDB->prefix($bak['name']);
        $xoopsDB->queryF($sql);

        $sql = "RENAME TABLE `" . $xoopsDB->prefix("{$bak['name']}_gbak") . "` TO `" . $xoopsDB->prefix($bak['name']) . "` ";
        $xoopsDB->queryF($sql);
    }
    return false;
}

//一鍵匯入
function import_all_data($dirname, $act_kind_arr, $mid)
{
    foreach ($act_kind_arr as $act_kind) {
        import_data($dirname, $act_kind, $mid);
    }
}

//匯入資料
function import_data($dirname, $act_kind, $mid = "", $cate_sn = "")
{
    global $xoopsDB, $xoopsConfig;

    if ($act_kind == "blocks") {
        include "setup/{$dirname}/{$xoopsConfig['language']}/blocks.php";

        backup_blocks($dirname, $mid);

        //先找出該模組所有區塊資訊
        $sql = "select * from `" . $xoopsDB->prefix("newblocks") . "` where `dirname`='{$dirname}' and `block_type`!='D' order by `func_num`";

        $result = $xoopsDB->queryF($sql) or die($sql);
        while ($tad_guide_data = $xoopsDB->fetchArray($result)) {
            foreach ($tad_guide_data as $k => $v) {
                $$k = $v;
            }

            // if ($act_kind == "my_blocks") {
            //     $visible = in_array($func_num, $_POST['ok_blocks']) ? 1 : 0;
            // } else {
                $visible = $new_data[$func_num]['visible'];
            // }

            //更新區塊的資訊（匯入自訂值）
            $sql = "update `" . $xoopsDB->prefix("newblocks") . "` set `options`='{$new_data[$func_num]['options']}' , `title`='{$new_data[$func_num]['title']}' , `side`='{$new_data[$func_num]['side']}' , `weight`='{$new_data[$func_num]['weight']}' , `visible`='{$visible}' where `bid`='$bid'";
            $xoopsDB->queryF($sql) or die($sql);

            //更新該區塊的顯示頁面
            $module_id_val = $new_data[$func_num]['side'] <= 1 ? 0 : -1;
            $sql           = "update `" . $xoopsDB->prefix("block_module_link") . "` set `module_id`='{$module_id_val}' where `block_id`='$bid'";
            $xoopsDB->queryF($sql) or die($sql);

            //檢查群組可讀取權限
            for ($g = 1; $g <= 3; $g++) {
                $sql            = "select `gperm_id` from `" . $xoopsDB->prefix("group_permission") . "` where `gperm_groupid`='$g'  and `gperm_itemid`='{$bid}' and `gperm_modid`='1' and `gperm_name`='block_read'";
                $rr             = $xoopsDB->queryF($sql) or die($sql);
                list($gperm_id) = $xoopsDB->fetchRow($rr);
                if (empty($gperm_id)) {
                    $sql = "insert into `" . $xoopsDB->prefix("group_permission") . "` (`gperm_groupid`, `gperm_itemid`, `gperm_modid`, `gperm_name`) values('{$g}' , '{$bid}', '1', 'block_read')";
                    $xoopsDB->queryF($sql) or die($sql);
                }
            }

            //找出該區塊的樣板設定
            $sql = "select * from `" . $xoopsDB->prefix("tplfile") . "` where tpl_refid='$bid' and tpl_type='block'";
            $r   = $xoopsDB->queryF($sql) or die($sql);

            $blockTpl = $xoopsDB->fetchArray($r);

            //找出該區塊的樣板
            $sql              = "select `tpl_source` from `" . $xoopsDB->prefix("tplsource") . "` where tpl_id='{$blockTpl['tpl_id']}'";
            $r                = $xoopsDB->queryF($sql) or die($sql);
            list($tpl_source) = $xoopsDB->fetchRow($r);

            //假設有要匯入該區塊的複製區塊
            foreach ($copy_data[$func_num] as $bb) {
                if (!is_array($bb)) {
                    break;
                }

                //找出之前複製的區塊
                $sql = "select bid from `" . $xoopsDB->prefix("newblocks") . "` where `mid`='{$mid}' and `func_num`='{$func_num}' and `block_type`='D'";
                $r   = $xoopsDB->queryF($sql) or die($sql);

                while (list($copy_bid) = $xoopsDB->fetchRow($r)) {

                    //清除掉之前複製的區塊
                    $sql = " delete from `" . $xoopsDB->prefix("newblocks") . "` where `bid`='{$copy_bid}'";
                    $xoopsDB->queryF($sql) or die($sql);

                    //清除掉之前複製的區塊模組連結
                    $sql = " delete from `" . $xoopsDB->prefix("block_module_link") . "` where `block_id`='{$copy_bid}'";
                    $xoopsDB->queryF($sql) or die($sql);

                    //清除之前複製的區塊權限
                    $sql = "delete from  `" . $xoopsDB->prefix("group_permission") . "` where `gperm_itemid`='$copy_bid' and `gperm_name`='block_read'";
                    $xoopsDB->queryF($sql) or die($sql);

                    //清除之前複製的樣板設定
                    $sql = "delete from  `" . $xoopsDB->prefix("tplfile") . "` where `tpl_refid`='$copy_bid' and `tpl_module`='$dirname' and `tpl_type`='block'";
                    $xoopsDB->queryF($sql) or die($sql);

                }

                //複製區塊
                $sql = "insert into `" . $xoopsDB->prefix("newblocks") . "` (`mid`, `func_num`, `options`, `name`, `title`, `content`, `side`, `weight`, `visible`, `block_type`, `c_type`, `isactive`, `dirname`, `func_file`, `show_func`, `edit_func`, `template`, `bcachetime`, `last_modified`)
        values('{$mid}' , '{$func_num}' , '{$bb['options']}' , '{$name}' , '{$bb['title']}' , '{$content}' , '{$bb['side']}' , '{$bb['weight']}' , '{$bb['visible']}' , 'D' , '{$c_type}' , '{$isactive}' , '{$dirname}' , '{$func_file}' , '{$show_func}' , '{$edit_func}' , '{$template}' , '{$bcachetime}' , '{$last_modified}')";
                $xoopsDB->queryF($sql) or die($sql);

                $new_copy_bid = $xoopsDB->getInsertId();

                //複製區塊權限
                $sql = " INSERT INTO `" . $xoopsDB->prefix("group_permission") . "` (`gperm_groupid`, `gperm_itemid`, `gperm_modid`, `gperm_name`) VALUES
        (1,  $new_copy_bid,  1,  'block_read'), (2,  $new_copy_bid,  1,  'block_read'),   (3,  $new_copy_bid,  1,  'block_read');";
                $xoopsDB->queryF($sql) or die($sql);

                //設定區塊顯示位置
                $module_id_val = $bb['side'] <= 1 ? 0 : -1;
                $sql           = " INSERT INTO `" . $xoopsDB->prefix("block_module_link") . "` (`block_id`, `module_id`) VALUES
        ('{$new_copy_bid}', '{$module_id_val}');";
                $xoopsDB->queryF($sql) or die($sql);

                //複製區塊樣板設定
                $sql = " INSERT INTO `" . $xoopsDB->prefix("tplfile") . "` (`tpl_refid`, `tpl_module`, `tpl_tplset`, `tpl_file`, `tpl_desc`, `tpl_lastmodified`, `tpl_lastimported`, `tpl_type`) VALUES('{$new_copy_bid}' , '{$blockTpl['tpl_module']}' , '{$blockTpl['tpl_tplset']}' , '{$blockTpl['tpl_file']}' , '{$blockTpl['tpl_desc']}' , '{$blockTpl['tpl_lastmodified']}' , '{$blockTpl['tpl_lastimported']}' , '{$blockTpl['tpl_type']}')";
                $xoopsDB->queryF($sql) or die($sql);

                $tpl_id = $xoopsDB->getInsertId();

                //複製區塊樣板
                $sql = " INSERT INTO `" . $xoopsDB->prefix("tplsource") . "` (`tpl_id`,`tpl_source`) VALUES('{$tpl_id}','{$tpl_source}')";
                $xoopsDB->queryF($sql) or die($sql);

            }
        }

        $act_name = _MA_GUIDE_IMPORT_BLOCK;
    } elseif ($act_kind == "config") {
        include "setup/{$dirname}/{$xoopsConfig['language']}/config.php";

        backup_config($dirname, $mid);

        //更新模組偏好設定
        $sql    = "select `conf_name` from `" . $xoopsDB->prefix("config") . "` where `conf_modid`='{$mid}'";
        $result = $xoopsDB->queryF($sql) or die($sql);
        while (list($conf_name) = $xoopsDB->fetchRow($result)) {
            $update_sql = "update `" . $xoopsDB->prefix("config") . "` set `conf_value`='{$new_config[$conf_name]}' where `conf_name`='$conf_name' and conf_modid='{$mid}'";
            $xoopsDB->queryF($update_sql) or die($update_sql);
        }
        $act_name = _MA_GUIDE_IMPORT_CONFIG;

        //更新模組名稱及順序
        if ($mod_config['name']) {
            $sql = "update `" . $xoopsDB->prefix("modules") . "` set name='{$mod_config['name']}',weight='{$mod_config['weight']}' where `mid`='{$mid}'";
            $xoopsDB->queryF($sql) or die($sql);
        }
    } elseif ($act_kind == "content_all") {
        if (file_exists("setup/{$dirname}/backup.php")) {
            $bak_table = "";
            include "setup/{$dirname}/backup.php";
            content_backup($dirname, $bak_table);
        }

        include "setup/{$dirname}/{$xoopsConfig['language']}/content_all.php";
        $act_name = _MA_GUIDE_IMPORT_CONTENT;

        call_user_func("{$dirname}_content");
    } elseif ($act_kind == "content") {
        if (file_exists("setup/{$dirname}/backup.php")) {
            $bak_table = "";
            include "setup/{$dirname}/backup.php";
            content_backup($dirname, $bak_table);
        }

        include "setup/{$dirname}/{$xoopsConfig['language']}/content.php";
        $act_name = _MA_GUIDE_IMPORT_CONTENT;

        call_user_func("{$dirname}_content", $cate_sn);
    } elseif ($act_kind == "restore_config") {
        restore_config($dirname, $mid);
        $sql = "delete from `" . $xoopsDB->prefix("tad_guide") . "` where `kind_title`='{$dirname}' and `act_kind` like 'config'";
        $xoopsDB->queryF($sql) or die($sql);
    } elseif ($act_kind == "restore_blocks") {
        restore_blocks($dirname, $mid);
        $sql = "delete from `" . $xoopsDB->prefix("tad_guide") . "` where `kind_title`='{$dirname}' and `act_kind` like 'blocks%'";
        $xoopsDB->queryF($sql) or die($sql);
    } elseif ($act_kind == "restore") {
        if (file_exists("setup/{$dirname}/backup.php")) {
            $bak_table = "";
            include "setup/{$dirname}/backup.php";
            restore_content($dirname, $bak_table);
            $sql = "delete from `" . $xoopsDB->prefix("tad_guide") . "` where `kind_title`='{$dirname}' and `act_kind` like 'content%'";
            $xoopsDB->queryF($sql) or die($sql);
        }
    } elseif ($act_kind == "create_group") {
        foreach ($_POST['groupid'] as $groupid) {
            create_one_cate($mid, $groupid, $dirname);
        }
    }

    if ($act_name) {
        $time = date("Y-m-d H:i:s");
        $sql  = "replace into `" . $xoopsDB->prefix("tad_guide") . "` (`act_kind`, `kind_title`, `act_name`, `act_date`, `cate_sn`) values('{$act_kind}','{$dirname}','{$act_name}',now(),'{$cate_sn}')";
        $xoopsDB->queryF($sql) or die($sql);
    }

}

//建立分類
function create_one_cate($mid = "", $groupid = "", $dirname = "")
{
    global $xoopsDB, $xoopsConfig;
    if (file_exists(XOOPS_ROOT_PATH . "/modules/tad_guide/admin/setup/{$dirname}/{$xoopsConfig['language']}/cate.php")) {

        $sql        = "select `name` from " . $xoopsDB->prefix("groups") . " where groupid='{$groupid}'";
        $result     = $xoopsDB->query($sql) or web_error($sql);
        list($name) = $xoopsDB->fetchRow($result);

        $create_cate[$groupid] = $name;
        include XOOPS_ROOT_PATH . "/modules/tad_guide/admin/setup/{$dirname}/{$xoopsConfig['language']}/cate.php";
    }
}

//新增權限
function add_perm($groupid = '', $insert_id = '', $mid = '', $perm_name = '')
{
    global $xoopsDB;

    $sql            = "select gperm_id from `" . $xoopsDB->prefix("group_permission") . "` where `gperm_groupid`='{$groupid}' and `gperm_itemid`='{$insert_id}' and `gperm_modid`='{$mid}' and `gperm_name`='{$perm_name}'";
    $result         = $xoopsDB->queryF($sql) or die($sql);
    list($gperm_id) = $xoopsDB->fetchRow($result);
    if (!empty($gperm_id)) {
        return;
    }

    $sql = "INSERT INTO `" . $xoopsDB->prefix("group_permission") . "`
  (`gperm_groupid`, `gperm_itemid`, `gperm_modid`, `gperm_name`)
  VALUES
  ('{$groupid}','{$insert_id}',  '{$mid}', '{$perm_name}')";
    $xoopsDB->queryF($sql) or die($sql);
    $gperm_id = $xoopsDB->getInsertId();
    return $gperm_id;
}

//檢查是否有資料
function content_get_backup($tbl = "")
{
    global $xoopsDB;

    $sql    = "select count(*) from " . $xoopsDB->prefix("{$tbl}_gbak");
    $result = $xoopsDB->queryF($sql);
    if (!empty($result)) {
        return true;
    }
    return false;
}

function content_backup($dirname = "", $bak_table = array())
{
    global $xoopsDB;
    if (is_dir(XOOPS_ROOT_PATH . "/uploads/{$dirname}")) {
        full_copy(XOOPS_ROOT_PATH . "/uploads/{$dirname}", XOOPS_ROOT_PATH . "/uploads/{$dirname}_gbak");
    }

    foreach ($bak_table as $bak) {
        if (!content_get_backup($bak['name'])) {
            $sql = $bak['sql'];
            $xoopsDB->queryF($sql) or web_error($sql);

            $sql = "
      INSERT INTO `" . $xoopsDB->prefix("{$bak['name']}_gbak") . "`
      SELECT * from `" . $xoopsDB->prefix($bak['name']) . "`;
      ";
            $xoopsDB->queryF($sql) or web_error($sql);
        }
    }
}

/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op           = system_CleanVars($_REQUEST, 'op', '', 'string');
$update_sn    = system_CleanVars($_REQUEST, 'update_sn', 0, 'int');
$file_link    = system_CleanVars($_REQUEST, 'file_link', '', 'string');
$dirname      = system_CleanVars($_REQUEST, 'dirname', '', 'string');
$act          = system_CleanVars($_REQUEST, 'act', '', 'string');
$kind_dir     = system_CleanVars($_REQUEST, 'kind_dir', '', 'string');
$ssh_id       = system_CleanVars($_REQUEST, 'ssh_id', '', 'string');
$ssh_passwd   = system_CleanVars($_REQUEST, 'ssh_passwd', '', 'string');
$ssh_host     = system_CleanVars($_REQUEST, 'ssh_host', '', 'string');
$ftp_id       = system_CleanVars($_REQUEST, 'ftp_id', '', 'string');
$ftp_passwd   = system_CleanVars($_REQUEST, 'ftp_passwd', '', 'string');
$ftp_host     = system_CleanVars($_REQUEST, 'ftp_host', '', 'string');
$act_kind     = system_CleanVars($_REQUEST, 'act_kind', '', 'string');
$act_kind_arr = system_CleanVars($_REQUEST, 'act_kind_arr', '', 'array');
$hl           = system_CleanVars($_REQUEST, 'hl', '', 'string');
$mid          = system_CleanVars($_REQUEST, 'mid', 0, 'int');
$groupid      = system_CleanVars($_REQUEST, 'groupid', 0, 'int');
$cate_sn      = system_CleanVars($_REQUEST, 'cate_sn', 0, 'int');

switch ($op) {
    /*---判斷動作請貼在下方---*/

    case "one_key":
        one_key($dirname, $mid);
        break;

    case "install_module":
        to_do($file_link, $dirname, "install_module", $update_sn);
        break;

    case "update_module":
        to_do($file_link, $dirname, "update_module", $update_sn);
        break;

    case "ssh_login":
        ssh_login($ssh_host, $ssh_id, $ssh_passwd, $file_link, $dirname, $act, $update_sn);
        break;

    case "install_theme":
        install_module($file_link, $dirname, "install", $update_sn, 'themes');
        break;

    case "update_theme":
        install_module($file_link, $dirname, "update", $update_sn, 'themes');
        break;

    case "to_create_group":
        to_create_group($_POST['create_group']);
        redirect_header("main.php", 3, _MA_GUIDE_CREATE_GROUP_OK);
        break;

    case "create_one_cate":
        create_one_cate($mid, $groupid, $dirname);
        redirect_header("main.php?hl={$dirname}", 3, _MA_GUIDE_CREATE_CATE_OK);

    case "import_data":
        import_data($dirname, $act_kind, $mid, $cate_sn);
        redirect_header("main.php?hl={$dirname}", 3, _MA_GUIDE_IMPORT_OK);
        break;

    case "import_all_data":
        import_all_data($dirname, $act_kind_arr, $mid);
        header("location:main.php?op=done");
        break;

    case "done":
        die(_MA_GUIDE_IMPORT_OK);
        break;

    default:
        list_all_modules();
        break;

        /*---判斷動作請貼在上方---*/
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign("isAdmin", true);
$xoopsTpl->assign("hl", $hl);
include_once 'footer.php';
