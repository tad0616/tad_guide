<?php
use Xmf\Request;
use XoopsModules\Tadtools\Utility;

/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = 'tad_guide_admin.tpl';
require_once __DIR__ . '/header.php';
/*-----------執行動作判斷區----------*/
$op = Request::getString('op');

//可開群組的模組
$mod_arr = ['tadnews', 'tadgallery', 'tad_player', 'tad_uploader', 'tad_cal', 'tad_discuss', 'tad_faq', 'tad_link', 'tad_book3', 'tad_gphotos'];

$school_mod_arr = ['tad_adm', 'tadtools', 'tad_blocks', 'tad_users', 'tad_sitemap', 'tad_gphotos', 'tad_honor', 'tad_themes', 'tadnews', 'tadgallery', 'tad_player', 'tad_login', 'tad_uploader', 'tad_cal', 'tad_discuss', 'tad_faq', 'tad_link', 'tad_repair', 'tad_assignment', 'tad_form', 'tad_lunch3', 'tad_book3', 'tad_idioms', 'tad_evaluation', 'tad_web', 'logcounterx', 'tad_rss', 'randomquote'];

switch ($op) {

    default:
        mk_config();
        break;

}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('now_op', 'mk_config');
require_once __DIR__ . '/footer.php';

/*-----------功能函數區--------------*/

//步驟1，安裝模組
function mk_config()
{
    global $xoopsDB, $xoopsTpl, $school_mod_arr;

    $modules = $modules_config = $config_count = $modules_block = $block_count = [];
    $sql = 'SELECT `mid`, `name`, `dirname` FROM `' . $xoopsDB->prefix('modules') . '` ORDER BY `dirname`';
    $result = Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    while (list($mid, $name, $dirname) = $xoopsDB->fetchRow($result)) {
        if (in_array($dirname, $school_mod_arr)) {
            $modules[$mid] = ['mid' => $mid, 'name' => $name, 'dirname' => $dirname];
        }
    }

    $all_mid = implode(',', array_keys($modules));
    $sql = 'SELECT `bid`, `mid`, `options`, `name`, `title`, `side`, `weight`, `visible` FROM `' . $xoopsDB->prefix('newblocks') . '` WHERE `mid` IN (' . $all_mid . ') ORDER BY `side`, `weight`';
    $result = Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    while ($block = $xoopsDB->fetchArray($result)) {
        $mid = $block['mid'];
        $bid = $block['bid'];
        $modules_block[$mid][$bid] = $block;
        if (!isset($block_count[$mid])) {
            $block_count[$mid] = 1;
        } else {
            $block_count[$mid]++;
        }
    }

    $sql = 'SELECT `conf_modid`, `conf_name`, `conf_value` FROM `' . $xoopsDB->prefix('config') . '` WHERE `conf_modid` IN (' . $all_mid . ') ORDER BY `conf_modid`, `conf_order`';
    $result = Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    while (list($conf_modid, $conf_name, $conf_value) = $xoopsDB->fetchRow($result)) {
        $modules_config[$conf_modid][$conf_name] = $conf_value;
        if (!isset($config_count[$conf_modid])) {
            $config_count[$conf_modid] = 1;
        } else {
            $config_count[$conf_modid]++;
        }
    }

    $xoopsTpl->assign('all_modules', $modules);
    $xoopsTpl->assign('modules_block', $modules_block);
    $xoopsTpl->assign('block_count', $block_count);
    $xoopsTpl->assign('modules_config', $modules_config);
    $xoopsTpl->assign('config_count', $config_count);
}
