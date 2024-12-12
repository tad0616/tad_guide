<?php
use Xmf\Request;
use XoopsModules\Tadtools\FancyBox;
use XoopsModules\Tadtools\StickyTableHeaders;
use XoopsModules\Tadtools\Utility;

/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = 'tad_guide_admin.tpl';
require_once __DIR__ . '/header.php';
use XoopsModules\Tad_adm\OnlineUpgrade;
if (!class_exists('XoopsModules\Tad_adm\OnlineUpgrade')) {
    require XOOPS_ROOT_PATH . '/modules/tad_adm/preloads/autoloader.php';
}

xoops_loadLanguage('admin', 'tad_adm');
/*-----------執行動作判斷區----------*/
$op = Request::getString('op');
$update_sn = Request::getInt('update_sn');
$file_link = Request::getString('file_link');
$dirname = Request::getString('dirname');
$act = Request::getString('act');
$kind_dir = Request::getString('kind_dir');
$ssh_id = Request::getString('ssh_id');
$ssh_passwd = Request::getString('ssh_passwd');
$ssh_host = Request::getString('ssh_host');
$ftp_id = Request::getString('ftp_id');
$ftp_passwd = Request::getString('ftp_passwd');
$ftp_host = Request::getString('ftp_host');
$act_kind = Request::getString('act_kind');
$act_kind_arr = Request::getArray('act_kind_arr');
$hl = Request::getString('hl');
$mid = Request::getInt('mid');
$groupid = Request::getInt('groupid');
$cate_sn = Request::getInt('cate_sn');

//可開群組的模組
$mod_arr = ['tadnews', 'tadgallery', 'tad_player', 'tad_uploader', 'tad_cal', 'tad_discuss', 'tad_faq', 'tad_link', 'tad_book3', 'tad_gphotos'];

$school_mod_arr = ['tad_adm', 'tadtools', 'tad_blocks', 'tad_users', 'tad_sitemap', 'tad_gphotos', 'tad_honor', 'tad_themes', 'tadnews', 'tadgallery', 'tad_player', 'tad_login', 'tad_uploader', 'tad_cal', 'tad_discuss', 'tad_faq', 'tad_link', 'tad_repair', 'tad_assignment', 'tad_form', 'tad_lunch3', 'tad_book3', 'tad_idioms', 'tad_evaluation', 'tad_web', 'logcounterx', 'tad_rss', 'randomquote'];
switch ($op) {

    case 'one_key':
        one_key($dirname, $mid);
        break;

    case "ssh_login":
        OnlineUpgrade::ssh_login($ssh_host, $ssh_id, $ssh_passwd, $file_link, $dirname, $act, $update_sn, $xoops_sn);
        break;

    case "install_module":
        OnlineUpgrade::to_do($file_link, $dirname, "install_module", $update_sn);
        break;

    case "upgrade_module":
        OnlineUpgrade::to_do($file_link, $dirname, "upgrade_module", $update_sn);
        break;

    case 'to_create_group':
        to_create_group($_POST['create_group']);
        redirect_header('main.php', 3, _MA_GUIDE_CREATE_GROUP_OK);
        break;
    case 'create_one_cate':
        create_one_cate($mid, $groupid, $dirname);
        redirect_header("main.php?hl={$dirname}", 3, _MA_GUIDE_CREATE_CATE_OK);

    // no break
    case 'import_data':
        import_data($dirname, $act_kind, $mid, $cate_sn);
        redirect_header("main.php?hl={$dirname}", 3, _MA_GUIDE_IMPORT_OK);
        break;
    case 'import_all_data':
        import_all_data($dirname, $act_kind_arr, $mid);
        header('location:main.php?op=done');
        break;
    case 'done':
        $content = "<div class='alert alert-success text-center border-0 mt-5' style='font-size:4rem;'>" . _MA_GUIDE_IMPORT_OK . "</div>";
        die(Utility::html5($content, false, true, 5, true, 'container', _MA_GUIDE_IMPORT_OK, '<style>body{background:#d1e7dd;}</style>'));
    default:
        list_all_modules();
        break;

}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('hl', $hl);
$xoopsTpl->assign('now_op', 'list_all_modules');
require_once __DIR__ . '/footer.php';

/*-----------功能函數區--------------*/

//步驟1，安裝模組
function list_all_modules()
{
    global $xoopsDB, $xoopsTpl, $school_mod_arr;

    list($all_install, $all_uninstall) = OnlineUpgrade::list_modules('return');
    // die(var_export($all_install));

    $act_log = $log = $all_data = [];
    // print_r($all_uninstall);

    foreach ($all_install as $function => $all_items) {
        foreach ($all_items as $kind => $items) {
            foreach ($items as $enable => $mods) {
                foreach ($mods as $dirname => $module) {
                    if (!in_array($dirname, $school_mod_arr)) {
                        continue;
                    }

                    $log[$dirname] = get_dir_log($dirname, $module['mid']);
                    $all_data[$dirname] = $module;
                    $all_data[$dirname]['function'] = $function;
                }
            }
        }
    }

    foreach ($all_uninstall as $kind => $items) {
        foreach ($items as $enable => $mods) {
            foreach ($mods as $dirname => $module) {
                if (!in_array($dirname, $school_mod_arr)) {
                    continue;
                }

                $log[$dirname] = get_dir_log($dirname, 0);
                $all_data[$dirname] = $module;
                $all_data[$dirname]['function'] = 'install';
            }
        }
    }

    //取得群組
    $groups = Utility::get_all_groups();
    $xoopsTpl->assign('groups', $groups);
    $xoopsTpl->assign('all_data', $all_data);

    //找出目前的更新紀錄
    $sql = 'SELECT `act_kind`, `kind_title`, `act_name`, `act_date`, `cate_sn` FROM `' . $xoopsDB->prefix('tad_guide') . '` ORDER BY `kind_title`';
    $result = Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    while (list($act_kind, $dirname, $act_name, $act_date, $cate_sn) = $xoopsDB->fetchRow($result)) {
        $act_log[$dirname][$act_kind] = $act_date;
    }

    $xoopsTpl->assign('log', $log);
    $xoopsTpl->assign('act_log', $act_log);
    $xoopsTpl->assign('now_op', 'list_all_modules');
    $xoopsTpl->assign('school_mod_arr', $school_mod_arr);

    $FancyBox = new FancyBox('.modulesadmin', '800px', null, false);
    $FancyBox->render();

    $onekey_FancyBox = new FancyBox('.onekey', '60%', '80%', false, false);
    $onekey_FancyBox->render(true);
    //加在連結中：class="edit_dropdown" rel="group"（圖） data-fancybox-type="iframe"（HTML）

    $StickyTableHeaders = new StickyTableHeaders(false);
    $StickyTableHeaders->render('#list_modules');
}

//取得模組的安裝精靈設定檔
function get_dir_log($dirname, $mid)
{
    global $school_mod_arr, $xoopsConfig;
    if (!in_array($dirname, $school_mod_arr)) {
        return;
    }

    $dir = XOOPS_ROOT_PATH . "/modules/tad_guide/admin/setup/{$dirname}/{$xoopsConfig['language']}/";
    $log['blocks_file_exists'] = file_exists("{$dir}/blocks.php");
    //$log['blocks_all_file_exists']=file_exists("{$dir}/blocks_all.php");
    $log['config_exists'] = file_exists("{$dir}/config.php");
    $log['content_exists'] = file_exists("{$dir}/content.php");
    $log['content_all_exists'] = file_exists("{$dir}/content_all.php");
    $log['cates'] = group_cate($dirname, $mid);

    return $log;
}

//一鍵安裝
function one_key($dirname, $mid)
{
    global $xoopsConfig, $xoopsDB;
    $log = get_dir_log($dirname, $mid);
    $main = "
        <script type='text/javascript'>
            $().ready(function(){
                $('#clickAll').click(function() {
                    if($('#clickAll').prop('checked')){
                        $('input.ok_blocks').each(function() {
                        $(this).prop('checked', true);
                        });
                    }else{
                        $('input.ok_blocks').each(function() {
                        $(this).prop('checked', false);
                        });
                    }
                });
            });
        </script>

        <form action='main.php' method='post'>

        <h2 class='text-center'>{$dirname}" . _MA_GUIDE_ONE_KEY . "
        <input type='hidden' name='mid' value='$mid'>
        <input type='hidden' name='dirname' value='$dirname'>
        <input type='hidden' name='op' value='import_all_data'>
        <button type='submit' class='btn btn-primary'>" . _TAD_SAVE . "</button></h2>

        <div class='container'>

        <div class='row'>";

    $import_content = '';
    if ($log['content_all_exists']) {
        $import_content = "
        <label class='form-check checkbox'>
            <h4>
            <input type='checkbox' name='act_kind_arr[]' value='content_all' checked>
            " . _MA_GUIDE_CONTENT_COL . '
            </h4>
        </label>
        ';
    }

    if ($log['config_exists']) {
        $main .= "
        <div class='col-sm-3'>
            <label class='form-check checkbox'>
                <h4>
                <input type='checkbox' name='act_kind_arr[]' value='config' checked>
                " . _MA_GUIDE_IMPORT_CONFIG . "
                </h4>
            </label>
            $import_content
        </div>";
    }

    if ($log['blocks_file_exists']) {
        $sql = 'SELECT * FROM `' . $xoopsDB->prefix('newblocks') . '` WHERE `dirname`=? AND `block_type`!=? ORDER BY `func_num`';
        $result = Utility::query($sql, 'ss', [$dirname, 'D']) or Utility::web_error($sql, __FILE__, __LINE__);

        while (false !== ($col = $xoopsDB->fetchArray($result))) {
            foreach ($col as $k => $v) {
                $$k = $v;
            }
            $b[$func_num] = $col;
        }

        $main .= "
        <div class='col-sm-6'>
            <label class='form-check checkbox'>
                <h4><input type='checkbox' id='clickAll'>" . _MA_GUIDE_BLOCKS_COL . "</h4>
                <input type='hidden' name='act_kind_arr[]' value='blocks'>
            </label>";

        $dir = XOOPS_ROOT_PATH . "/modules/tad_guide/admin/setup/{$dirname}/{$xoopsConfig['language']}/";
        include "{$dir}/blocks.php";
        //$new_data[1]=array('options'=>'0|0|true','title'=>'影音特區[hide]','side'=>'8','weight'=>'2','visible'=>'1');

        foreach ($new_data as $func_num => $block) {
            $checked = 1 == $block['visible'] ? 'checked' : '';
            $place = constant("_MA_GUIDE_BS_{$block['side']}");

            $visible = 1 == $b[$func_num]['visible'] ? "<span class='badge badge-warning'>" . _MA_GUIDE_BLOCK_INSTALLED . '</span>' : '';
            $main .= "
            <label class='form-check checkbox'>
                <input type='checkbox' name='ok_blocks[]' value='{$func_num}' $checked class='ok_blocks'>
                {$block['title']}
                <span class='badge badge-info'>{$place}</span>
                {$visible}
            </label>";
        }
        $main .= '
            </div>';
    }

    if ($log['cates']) {
        $groups_setup = '';
        foreach ($log['cates'] as $groupid => $cate) {
            if ('1' != $cate['show_cate'] or $groupid <= 3) {
                continue;
            }

            $tt = sprintf(_MA_GUIDE_CREATE_CATE, $cate['groupname']);
            if (empty($cate['cate_sn'])) {
                $groups_setup .= "
                <label class='form-check checkbox'>
                <input type='checkbox' name='groupid[]' value='{$groupid}' checked>
                {$tt}
                </label>";
            }
        }

        if (!empty($groups_setup)) {
            $main .= "
                <div class='col-sm-3'>
                    <label class='form-check checkbox'>
                    <h4>" . _MA_GUIDE_CREATE_GROUP . "</h4>
                    <input type='hidden' name='act_kind_arr[]' value='create_group'>
                    </label>
                    $groups_setup
                </div>";
        }
    }

    $main .= '</div>
    </div>
    </form>';

    $html5 = Utility::html5($main, false, true, $_SESSION['bootstrap'], true, 'container-fluid');
    die($html5);
}

//取得最後更新時間
function get_last_update($dirname = '')
{
    global $xoopsDB;
    $sql = 'SELECT `last_update` FROM `' . $xoopsDB->prefix('modules') . '` WHERE `dirname`=?';
    $result = Utility::query($sql, 's', [$dirname]) or Utility::web_error($sql, __FILE__, __LINE__);

    list($last_update) = $xoopsDB->fetchRow($result);

    return $last_update;
}

//顯示群組的分類
function group_cate($dirname, $mid = 0)
{
    global $xoopsDB, $mod_arr;

    $sql = 'SELECT `groupid`, `name` FROM `' . $xoopsDB->prefix('groups') . '` ORDER BY `groupid`';
    $result = Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    while (list($groupid, $name) = $xoopsDB->fetchRow($result)) {
        //以下會產生這些變數： `groupid`, `name`, `description`, `group_type`
        $mod_cate[$groupid]['dirname'] = $dirname;
        $mod_cate[$groupid]['mid'] = $mid;
        $mod_cate[$groupid]['groupid'] = $groupid;
        $mod_cate[$groupid]['groupname'] = $name;
        $mod_cate[$groupid]['show_cate'] = in_array($dirname, $mod_arr);
        if ($mid and in_array($dirname, $mod_arr)) {
            $cate = get_mod_cate($dirname, $name);
            $mod_cate[$groupid]['cate_sn'] = $cate['sn'];
            $mod_cate[$groupid]['cate_title'] = $cate['title'];
            $mod_cate[$groupid]['cate_power'] = $cate['power'];
            $mod_cate[$groupid]['file'] = $cate['file'];
            $mod_cate[$groupid]['col'] = $cate['col'];
        } else {
            $mod_cate[$groupid]['cate_sn'] = '';
            $mod_cate[$groupid]['cate_title'] = '';
            $mod_cate[$groupid]['cate_power'] = '';
            $mod_cate[$groupid]['file'] = '';
            $mod_cate[$groupid]['col'] = '';
        }
        //if($groupid==4)die(var_export($mod_cate));
    }

    return $mod_cate;
}

//快速建立群組
function to_create_group($create_group = '')
{
    $new_group = explode(';', $create_group);

    foreach ($new_group as $group) {
        Utility::mk_group($group);
    }
}

//取得模組現有分類
function get_mod_cate($dirname = '', $group_name = '')
{
    global $xoopsDB, $mod_arr;
    //$mod_arr=array('tadnews','tadgallery','tad_player','tad_uploader','tad_cal','tad_discuss','tad_faq','tad_link');
    if (!in_array($dirname, $mod_arr)) {
        return;
    }

    $cate['sn'] = '';
    $cate['title'] = '-';
    $cate['power'] = '';
    $cate['file'] = '';
    $cate['col'] = '';
    if (file_exists(XOOPS_ROOT_PATH . "/modules/tad_guide/admin/setup/{$dirname}/function.php")) {
        require_once XOOPS_ROOT_PATH . "/modules/tad_guide/admin/setup/{$dirname}/function.php";

        $cate = call_user_func("get_{$dirname}_cate", $group_name);
    }

    return $cate;
}

//備份偏好設定
function backup_config($dirname = '', $mid = '')
{
    global $xoopsDB;

    //檢查有無之前備份
    $sql = 'SELECT `act_date` FROM `' . $xoopsDB->prefix('tad_guide_backup') . '` WHERE `act_kind`=\'config\' AND `kind_title`=?';
    $result = Utility::query($sql, 's', [$dirname]) or Utility::web_error($sql, __FILE__, __LINE__);

    list($act_date) = $xoopsDB->fetchRow($result);

    if (empty($act_date)) {
        //撈取預設偏好設定
        $sql = 'SELECT * FROM `' . $xoopsDB->prefix('config') . '` WHERE `conf_modid`=?';
        $result = Utility::query($sql, 'i', [$mid]) or Utility::web_error($sql, __FILE__, __LINE__);

        $backup_content = [];
        while (false !== ($col = $xoopsDB->fetchArray($result))) {
            $syntax = [];
            foreach ($col as $k => $v) {
                $syntax[] = "`{$k}`='{$v}'";
            }
            $all_syntax = implode(',', $syntax);

            $backup_content[] = 'update `' . $xoopsDB->prefix('config') . "` set {$all_syntax} where `conf_id`='{$col['conf_id']}';";
        }

        //模組名稱部份
        $sql = 'SELECT `name`, `weight` FROM `' . $xoopsDB->prefix('modules') . '` WHERE `mid`=?';
        $result = Utility::query($sql, 'i', [$mid]) or Utility::web_error($sql, __FILE__, __LINE__);

        list($name, $weight) = $xoopsDB->fetchRow($result);
        $backup_content[] = 'update `' . $xoopsDB->prefix('modules') . "` set `name`='$name',`weight`='$weight' where `mid`='{$mid}';";

        $backup_content = implode('##', $backup_content);

        //開始備份
        $time = date('Y-m-d H:i:s');
        $sql = 'REPLACE INTO `' . $xoopsDB->prefix('tad_guide_backup') . '` (`act_kind`, `kind_title`, `act_date`, `backup_content`) VALUES (?, ?, ?, ?)';
        Utility::query($sql, 'ssss', ['config', $dirname, $time, $backup_content]) or Utility::web_error($sql, __FILE__, __LINE__);

    }
}

//還原偏好設定
function restore_config($dirname = '', $mid = '')
{
    global $xoopsDB;

    //檢查有無之前備份
    $sql = 'SELECT `backup_content` FROM `' . $xoopsDB->prefix('tad_guide_backup') . '` WHERE `act_kind`=? AND `kind_title`=?';
    $result = Utility::query($sql, 'ss', [$dirname, 'config']) or Utility::web_error($sql, __FILE__, __LINE__);

    list($backup_content) = $xoopsDB->fetchRow($result);

    if (!empty($backup_content)) {
        $restroe_sql = explode('##', $backup_content);
        foreach ($restroe_sql as $sql) {
            if (!empty($sql)) {
                $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
            }
        }
        $sql = 'DELETE FROM `' . $xoopsDB->prefix('tad_guide_backup') . '` WHERE `act_kind`=? AND `kind_title`=?';
        Utility::query($sql, 'ss', ['config', $dirname]) or Utility::web_error($sql, __FILE__, __LINE__);

    }
}

//備份區塊設定
function backup_blocks($dirname = '', $mid = '')
{
    global $xoopsDB;

    //檢查有無之前備份
    $sql = 'SELECT `act_date` FROM `' . $xoopsDB->prefix('tad_guide_backup') . '` WHERE `act_kind`=? AND `kind_title`=?';
    $result = Utility::query($sql, 'ss', [$act_kind, $dirname]) or Utility::web_error($sql, __FILE__, __LINE__);

    list($act_date) = $xoopsDB->fetchRow($result);

    if (empty($act_date)) {
        //撈取預設偏好設定
        $sql = 'SELECT * FROM `' . $xoopsDB->prefix('newblocks') . '` WHERE `dirname`=? AND `block_type`!=? ORDER BY `func_num`';
        $result = Utility::query($sql, 'ss', [$dirname, 'D']) or Utility::web_error($sql, __FILE__, __LINE__);

        $backup_content = '';
        while (false !== ($col = $xoopsDB->fetchArray($result))) {
            $syntax = [];
            foreach ($col as $k => $v) {
                $syntax[] = "`{$k}`='{$v}'";
            }
            $all_syntax = implode(',', $syntax);

            $backup_content .= 'update `' . $xoopsDB->prefix('newblocks') . "` set {$all_syntax} where `bid`='{$col['bid']}';\n";
        }
        //開始備份
        $time = date('Y-m-d H:i:s');
        $sql = 'REPLACE INTO `' . $xoopsDB->prefix('tad_guide_backup') . '` (`act_kind`, `kind_title`, `act_date`, `backup_content`) VALUES (?, ?, ?, ?)';
        Utility::query($sql, 'ssss', ['blocks', $dirname, $time, $backup_content]) or Utility::web_error($sql, __FILE__, __LINE__);

    }
}

//還原區塊設定
function restore_blocks($dirname = '', $mid = '')
{
    global $xoopsDB;

    //檢查有無之前備份
    $sql = 'SELECT `backup_content` FROM `' . $xoopsDB->prefix('tad_guide_backup') . '` WHERE `act_kind`=? AND `kind_title`=?';
    $result = Utility::query($sql, 'ss', ['blocks', $dirname]) or Utility::web_error($sql, __FILE__, __LINE__);

    list($backup_content) = $xoopsDB->fetchRow($result);

    if (!empty($backup_content)) {

        $sql_arr = explode("\n", $backup_content);
        foreach ($sql_arr as $sql) {
            if ($sql) {
                $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
            }
        }

        $sql = 'DELETE FROM `' . $xoopsDB->prefix('tad_guide_backup') . '` WHERE `act_kind`=? AND `kind_title`=?';
        Utility::query($sql, 'ss', ['blocks', $dirname]) or Utility::web_error($sql, __FILE__, __LINE__);

    }
}

//內容還原
function restore_content($dirname = '', $bak_table = [])
{
    global $xoopsDB;
    if (is_dir(XOOPS_ROOT_PATH . "/uploads/{$dirname}")) {
        Utility::delete_directory(XOOPS_ROOT_PATH . "/uploads/{$dirname}");
        rename(XOOPS_ROOT_PATH . "/uploads/{$dirname}_gbak", XOOPS_ROOT_PATH . "/uploads/{$dirname}");
    }

    foreach ($bak_table as $bak) {
        $sql = 'DROP TABLE `' . $xoopsDB->prefix($bak['name']) . '`';
        Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

        $sql = 'RENAME TABLE `' . $xoopsDB->prefix("{$bak['name']}_gbak") . '` TO `' . $xoopsDB->prefix($bak['name']) . '`';
        Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    }

    return false;
}

//一鍵匯入
function import_all_data($dirname, $act_kind_arr, $mid)
{
    foreach ($act_kind_arr as $act_kind) {
        import_data($dirname, $act_kind, $mid, '', 'batch');
    }
}

//匯入資料
function import_data($dirname, $act_kind, $mid = '0', $cate_sn = '0', $mode = '')
{
    global $xoopsDB, $xoopsConfig;

    $mid = (int) $mid;
    $cate_sn = (int) $cate_sn;

    if ('blocks' === $act_kind) {
        include "setup/{$dirname}/{$xoopsConfig['language']}/blocks.php";

        backup_blocks($dirname, $mid);

        //先找出該模組所有區塊資訊
        $sql = 'SELECT * FROM `' . $xoopsDB->prefix('newblocks') . '` WHERE `dirname`=? AND `block_type`!=? ORDER BY `func_num`';
        $result = Utility::query($sql, 'ss', [$dirname, 'D']) or Utility::web_error($sql, __FILE__, __LINE__);

        while (false !== ($tad_guide_data = $xoopsDB->fetchArray($result))) {
            foreach ($tad_guide_data as $k => $v) {
                $$k = $v;
            }

            if ('batch' === $mode) {
                $visible = in_array($func_num, $_POST['ok_blocks']) ? 1 : 0;
            } else {
                $visible = $new_data[$func_num]['visible'];
            }

            //更新區塊的資訊（匯入自訂值）
            $sql = 'UPDATE `' . $xoopsDB->prefix('newblocks') . '` SET `options`=?, `title`=?, `side`=?, `weight`=?, `visible`=? WHERE `bid`=?';
            Utility::query($sql, 'sssiii', [
                $new_data[$func_num]['options'],
                $new_data[$func_num]['title'],
                $new_data[$func_num]['side'],
                $new_data[$func_num]['weight'],
                $visible,
                $bid,
            ]) or Utility::web_error($sql, __FILE__, __LINE__);

            //更新該區塊的顯示頁面
            $module_id_val = $new_data[$func_num]['side'] <= 1 ? 0 : -1;
            $sql = 'UPDATE `' . $xoopsDB->prefix('block_module_link') . '` SET `module_id`=? WHERE `block_id`=?';
            Utility::query($sql, 'ii', [$module_id_val, $bid]) or Utility::web_error($sql, __FILE__, __LINE__);

            //檢查群組可讀取權限
            for ($g = 1; $g <= 3; $g++) {
                $sql = 'SELECT `gperm_id` FROM `' . $xoopsDB->prefix('group_permission') . '` WHERE `gperm_groupid` =? AND `gperm_itemid` =? AND `gperm_modid` = 1 AND `gperm_name` =?';
                $rr = Utility::query($sql, 'iis', [$g, $bid, 'block_read']) or Utility::web_error($sql, __FILE__, __LINE__);

                list($gperm_id) = $xoopsDB->fetchRow($rr);
                if (empty($gperm_id)) {
                    $sql = 'INSERT INTO `' . $xoopsDB->prefix('group_permission') . '` (`gperm_groupid`, `gperm_itemid`, `gperm_modid`, `gperm_name`) VALUES(?, ?, 1, ?)';
                    Utility::query($sql, 'iis', [$g, $bid, 'block_read']) or Utility::web_error($sql, __FILE__, __LINE__);

                }
            }

            //找出該區塊的樣板設定
            $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tplfile') . '` WHERE `tpl_refid`=? AND `tpl_type`=?';
            $r = Utility::query($sql, 'is', [$bid, 'block']) or Utility::web_error($sql, __FILE__, __LINE__);

            $blockTpl = $xoopsDB->fetchArray($r);

            //找出該區塊的樣板
            $sql = 'SELECT `tpl_source` FROM `' . $xoopsDB->prefix('tplsource') . '` WHERE `tpl_id`=?';
            $r = Utility::query($sql, 'i', [$blockTpl['tpl_id']]) or Utility::web_error($sql, __FILE__, __LINE__);

            list($tpl_source) = $xoopsDB->fetchRow($r);

            //假設有要匯入該區塊的複製區塊
            foreach ($copy_data[$func_num] as $bb) {
                if (!is_array($bb)) {
                    break;
                }

                //找出之前複製的區塊
                $sql = 'SELECT `bid` FROM `' . $xoopsDB->prefix('newblocks') . '` WHERE `mid`=? AND `func_num`=? AND `block_type`=?';
                $r = Utility::query($sql, 'iis', [$mid, $func_num, 'D']) or Utility::web_error($sql, __FILE__, __LINE__);

                while (list($copy_bid) = $xoopsDB->fetchRow($r)) {
                    //清除掉之前複製的區塊
                    $sql = 'DELETE FROM `' . $xoopsDB->prefix('newblocks') . '` WHERE `bid` = ?';
                    Utility::query($sql, 'i', [$copy_bid]) or Utility::web_error($sql, __FILE__, __LINE__);

                    //清除掉之前複製的區塊模組連結
                    $sql = 'DELETE FROM `' . $xoopsDB->prefix('block_module_link') . '` WHERE `block_id` = ?';
                    Utility::query($sql, 'i', [$copy_bid]) or Utility::web_error($sql, __FILE__, __LINE__);

                    //清除之前複製的區塊權限
                    $sql = 'DELETE FROM `' . $xoopsDB->prefix('group_permission') . '` WHERE `gperm_itemid` = ? AND `gperm_name` = "block_read"';
                    Utility::query($sql, 'i', [$copy_bid]) or Utility::web_error($sql, __FILE__, __LINE__);

                    //清除之前複製的樣板設定
                    $sql = 'DELETE FROM `' . $xoopsDB->prefix('tplfile') . '` WHERE `tpl_refid` = ? AND `tpl_module` = ? AND `tpl_type` = "block"';
                    Utility::query($sql, 'is', [$copy_bid, $dirname]) or Utility::web_error($sql, __FILE__, __LINE__);
                }

                //複製區塊
                $sql = 'INSERT INTO `' . $xoopsDB->prefix('newblocks') . '` (`mid`, `func_num`, `options`, `name`, `title`, `content`, `side`, `weight`, `visible`, `block_type`, `c_type`, `isactive`, `dirname`, `func_file`, `show_func`, `edit_func`, `template`, `bcachetime`, `last_modified`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, \'D\', ?, ?, ?, ?, ?, ?, ?, ?, ?)';
                Utility::query($sql, 'iissssiiisisssssii', [$mid, $func_num, $bb['options'], $name, $bb['title'], $content, $bb['side'], $bb['weight'], $bb['visible'], $c_type, $isactive, $dirname, $func_file, $show_func, $edit_func, $template, $bcachetime, $last_modified]) or Utility::web_error($sql, __FILE__, __LINE__);

                $new_copy_bid = $xoopsDB->getInsertId();

                //複製區塊權限
                $tbl = $xoopsDB->prefix('group_permission');
                $sql = 'INSERT INTO `' . $tbl . '` (`gperm_groupid`, `gperm_itemid`, `gperm_modid`, `gperm_name`) VALUES (1, ?, 1, \'block_read\'), (2, ?, 1, \'block_read\'), (3, ?, 1, \'block_read\')';
                Utility::query($sql, 'iii', [$new_copy_bid, $new_copy_bid, $new_copy_bid]) or Utility::web_error($sql, __FILE__, __LINE__);

                //設定區塊顯示位置
                $module_id_val = $bb['side'] <= 1 ? 0 : -1;
                $tbl = $xoopsDB->prefix('block_module_link');
                $sql = 'INSERT INTO `' . $tbl . '` (`block_id`, `module_id`) VALUES (?, ?)';
                Utility::query($sql, 'ii', [$new_copy_bid, $module_id_val]) or Utility::web_error($sql, __FILE__, __LINE__);

                // 複製區塊樣板設定
                $tbl = $xoopsDB->prefix('tplfile');
                $sql = 'INSERT INTO `' . $tbl . '` (`tpl_refid`, `tpl_module`, `tpl_tplset`, `tpl_file`, `tpl_desc`, `tpl_lastmodified`, `tpl_lastimported`, `tpl_type`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
                Utility::query($sql, 'issssiis', [
                    $new_copy_bid,
                    $blockTpl['tpl_module'],
                    $blockTpl['tpl_tplset'],
                    $blockTpl['tpl_file'],
                    $blockTpl['tpl_desc'],
                    $blockTpl['tpl_lastmodified'],
                    $blockTpl['tpl_lastimported'],
                    $blockTpl['tpl_type'],
                ]) or Utility::web_error($sql, __FILE__, __LINE__);

                $tpl_id = $xoopsDB->getInsertId();

                //複製區塊樣板
                $tbl = $xoopsDB->prefix('tplsource');
                $sql = 'INSERT INTO `' . $tbl . '` (`tpl_id`, `tpl_source`) VALUES(?, ?)';
                Utility::query($sql, 'is', [$tpl_id, $tpl_source]) or Utility::web_error($sql, __FILE__, __LINE__);

            }
        }

        $act_name = _MA_GUIDE_IMPORT_BLOCK;
    } elseif ('config' === $act_kind) {
        include "setup/{$dirname}/{$xoopsConfig['language']}/config.php";

        backup_config($dirname, $mid);

        //更新模組偏好設定
        $sql = 'SELECT `conf_name` FROM `' . $xoopsDB->prefix('config') . '` WHERE `conf_modid`=?';
        $result = Utility::query($sql, 'i', [$mid]) or Utility::web_error($sql, __FILE__, __LINE__);

        while (list($conf_name) = $xoopsDB->fetchRow($result)) {
            $update_sql = 'UPDATE `' . $xoopsDB->prefix('config') . '` SET `conf_value`=? WHERE `conf_name`=? AND `conf_modid`=?';
            Utility::query($update_sql, 'ssi', [$new_config[$conf_name], $conf_name, $mid]) or die($update_sql . '<br>' . $xoopsDB->error() . '<br>' . __FILE__ . ':' . __LINE__);

        }
        $act_name = _MA_GUIDE_IMPORT_CONFIG;

        //更新模組名稱及順序
        if ($mod_config['name']) {
            $sql = 'UPDATE `' . $xoopsDB->prefix('modules') . '` SET `name`=?, `weight`=? WHERE `mid`=?';
            Utility::query($sql, 'sii', [$mod_config['name'], $mod_config['weight'], $mid]) or Utility::web_error($sql, __FILE__, __LINE__);

        }
    } elseif ('content_all' === $act_kind) {
        if (file_exists("setup/{$dirname}/backup.php")) {
            $bak_table = '';
            include "setup/{$dirname}/backup.php";
            content_backup($dirname, $bak_table);
        }

        include "setup/{$dirname}/{$xoopsConfig['language']}/content_all.php";
        $act_name = _MA_GUIDE_IMPORT_CONTENT;

        call_user_func("{$dirname}_content");
    } elseif ('content' === $act_kind) {
        if (file_exists("setup/{$dirname}/backup.php")) {
            $bak_table = '';
            include "setup/{$dirname}/backup.php";
            content_backup($dirname, $bak_table);
        }

        include "setup/{$dirname}/{$xoopsConfig['language']}/content.php";
        $act_name = _MA_GUIDE_IMPORT_CONTENT;

        call_user_func("{$dirname}_content", $cate_sn);
    } elseif ('restore_config' === $act_kind) {
        restore_config($dirname, $mid);
        $sql = 'DELETE FROM `' . $xoopsDB->prefix('tad_guide') . '` WHERE `kind_title` = ? AND `act_kind` LIKE \'config\'';
        Utility::query($sql, 's', [$dirname]) or Utility::web_error($sql, __FILE__, __LINE__);

    } elseif ('restore_blocks' === $act_kind) {
        restore_blocks($dirname, $mid);
        $sql = 'DELETE FROM `' . $xoopsDB->prefix('tad_guide') . '` WHERE `kind_title`=? AND `act_kind` LIKE ?';
        Utility::query($sql, 'ss', [$dirname, 'blocks%']) or Utility::web_error($sql, __FILE__, __LINE__);

    } elseif ('restore' === $act_kind) {
        if (file_exists("setup/{$dirname}/backup.php")) {
            $bak_table = '';
            include "setup/{$dirname}/backup.php";
            restore_content($dirname, $bak_table);
            $sql = 'DELETE FROM `' . $xoopsDB->prefix('tad_guide') . '` WHERE `kind_title`=? AND `act_kind` LIKE ?';
            Utility::query($sql, 'ss', [$dirname, 'content%']) or Utility::web_error($sql, __FILE__, __LINE__);

        }
    } elseif ('create_group' === $act_kind) {
        foreach ($_POST['groupid'] as $groupid) {
            create_one_cate($mid, $groupid, $dirname);
        }
    }

    if ($act_name) {
        $sql = 'REPLACE INTO `' . $xoopsDB->prefix('tad_guide') . '` (`act_kind`, `kind_title`, `act_name`, `act_date`, `cate_sn`) VALUES(?, ?, ?, NOW(), ?)';
        Utility::query($sql, 'sssi', [$act_kind, $dirname, $act_name, $cate_sn]) or Utility::web_error($sql, __FILE__, __LINE__);

    }
}

//建立分類
function create_one_cate($mid = '', $groupid = '', $dirname = '')
{
    global $xoopsDB, $xoopsConfig;
    if (file_exists(XOOPS_ROOT_PATH . "/modules/tad_guide/admin/setup/{$dirname}/{$xoopsConfig['language']}/cate.php")) {
        $sql = 'SELECT `name` FROM `' . $xoopsDB->prefix('groups') . '` WHERE `groupid`=?';
        $result = Utility::query($sql, 'i', [$groupid]) or Utility::web_error($sql, __FILE__, __LINE__);

        list($name) = $xoopsDB->fetchRow($result);

        $create_cate[$groupid] = $name;
        require XOOPS_ROOT_PATH . "/modules/tad_guide/admin/setup/{$dirname}/{$xoopsConfig['language']}/cate.php";
    }
}

//新增權限
function add_perm($groupid = '', $insert_id = '', $mid = '', $perm_name = '')
{
    global $xoopsDB;

    $sql = 'SELECT `gperm_id` FROM `' . $xoopsDB->prefix('group_permission') . '` WHERE `gperm_groupid`=? AND `gperm_itemid`=? AND `gperm_modid`=? AND `gperm_name`=?';
    $result = Utility::query($sql, 'iiis', [$groupid, $insert_id, $mid, $perm_name]) or Utility::web_error($sql, __FILE__, __LINE__);

    list($gperm_id) = $xoopsDB->fetchRow($result);
    if (!empty($gperm_id)) {
        return;
    }

    $tbl = $xoopsDB->prefix('group_permission');
    $sql = 'INSERT INTO `' . $tbl . '` (`gperm_groupid`, `gperm_itemid`, `gperm_modid`, `gperm_name`) VALUES(?, ?, ?, ?)';
    Utility::query($sql, 'iiis', [$groupid, $insert_id, $mid, $perm_name]) or Utility::web_error($sql, __FILE__, __LINE__);

    $gperm_id = $xoopsDB->getInsertId();

    return $gperm_id;
}

/**
 * 檢查資料表是否存在且包含資料
 *
 * @param string $tbl 資料表名稱（不含前綴）
 * @return bool 資料表存在且有資料時返回 true，否則返回 false
 */
function content_get_backup($tbl = '')
{
    global $xoopsDB;

    if (empty($tbl)) {
        return false;
    }

    try {
        // 先檢查資料表是否存在
        $table_name = $xoopsDB->prefix($tbl . '_gbak');
        $check_table_sql = sprintf(
            "SELECT 1 FROM information_schema.tables
            WHERE table_schema = '%s'
            AND table_name = '%s'",
            $xoopsDB->dbname,
            $table_name
        );

        $result = $xoopsDB->query($check_table_sql);
        if (!$result || $xoopsDB->getRowsNum($result) === 0) {
            return false;
        }

        // 檢查資料表是否有資料
        $count_sql = sprintf(
            "SELECT COUNT(*) AS total FROM `%s`",
            $table_name
        );

        $result = $xoopsDB->query($count_sql);
        if (!$result) {
            return false;
        }

        $row = $xoopsDB->fetchArray($result);
        return ($row['total'] > 0);

    } catch (Exception $e) {
        // 可以根據需求記錄錯誤
        error_log(sprintf(
            'Check table error: %s, File: %s, Line: %d',
            $e->getMessage(),
            __FILE__,
            __LINE__
        ));
        return false;
    }
}

function content_backup($dirname = '', $bak_table = [])
{
    global $xoopsDB;
    if (is_dir(XOOPS_ROOT_PATH . "/uploads/{$dirname}")) {
        Utility::full_copy(XOOPS_ROOT_PATH . "/uploads/{$dirname}", XOOPS_ROOT_PATH . "/uploads/{$dirname}_gbak");
    }

    foreach ($bak_table as $bak) {
        if (!content_get_backup($bak['name'])) {
            $sql = $bak['sql'];
            $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);

            $sql = '
            INSERT INTO `' . $xoopsDB->prefix($bak['name'] . '_gbak') . '`
            SELECT * FROM `' . $xoopsDB->prefix($bak['name']) . '`
            ';
            Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

        }
    }
}
