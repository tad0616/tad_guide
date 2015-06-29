<?php
include_once XOOPS_ROOT_PATH . '/modules/tadtools/language/' . $xoopsConfig['language'] . '/modinfo_common.php';

define('_MI_TADGUIDE_NAME', 'XOOPS安裝精靈');
define('_MI_TADGUIDE_AUTHOR', 'tad');
define('_MI_TADGUIDE_CREDITS', '');
define('_MI_TADGUIDE_DESC', '此模組用來快速建立群組以及在各模組開設對應的分類及設定權限');
define('_MI_TADGUIDE_AUTHOR_WEB', 'Tad 教材網');
define('_MI_TADGUIDE_ADMENU1', '主管理介面');
define('_MI_TADGUIDE_ADMENU1_DESC', '主管理介面');

define('_MI_TADGUIDE_DIRNAME', basename(dirname(dirname(__DIR__))));
define('_MI_TADGUIDE_HELP_HEADER', __DIR__ . '/help/helpheader.html');
define('_MI_TADGUIDE_BACK_2_ADMIN', '管理');

//help
define('_MI_TADGUIDE_HELP_OVERVIEW', '概要');
