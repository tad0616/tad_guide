<?php
$modversion = [];

//---模組基本資訊---//
$modversion['name'] = _MI_TADGUIDE_NAME;
$modversion['version'] = '1.5';
$modversion['description'] = _MI_TADGUIDE_DESC;
$modversion['author'] = _MI_TADGUIDE_AUTHOR;
$modversion['credits'] = _MI_TADGUIDE_CREDITS;
$modversion['help'] = 'page=help';
$modversion['license'] = 'GPL see LICENSE';
$modversion['image'] = 'images/logo.png';
$modversion['dirname'] = basename(__DIR__);

//---模組狀態資訊---//
$modversion['release_date'] = '2019-05-10';
$modversion['module_website_url'] = 'https://tad0616.net';
$modversion['module_website_name'] = _MI_TADGUIDE_AUTHOR_WEB;
$modversion['module_status'] = 'release';
$modversion['author_website_url'] = 'https://tad0616.net';
$modversion['author_website_name'] = _MI_TADGUIDE_AUTHOR_WEB;
$modversion['min_php'] = 5.4;
$modversion['min_xoops'] = '2.5';

//---paypal資訊---//
$modversion['paypal'] = [];
$modversion['paypal']['business'] = 'tad0616@gmail.com';
$modversion['paypal']['item_name'] = 'Donation :' . _MI_TADGUIDE_AUTHOR;
$modversion['paypal']['amount'] = 0;
$modversion['paypal']['currency_code'] = 'USD';

//---安裝設定---//
$modversion['onInstall'] = 'include/onInstall.php';
$modversion['onUpdate'] = 'include/onUpdate.php';
$modversion['onUninstall'] = 'include/onUninstall.php';

//---啟動後台管理界面選單---//
$modversion['system_menu'] = 1;
//---資料表架構---//
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'][1] = 'tad_guide';
$modversion['tables'][2] = 'tad_guide_backup';

//---管理介面設定---//
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/main.php';
$modversion['adminmenu'] = 'admin/menu.php';

//---使用者主選單設定---//
$modversion['hasMain'] = 0;

//---樣板設定---//
$i = 0;
$modversion['templates'][$i]['file'] = 'tad_guide_adm_main.tpl';
$modversion['templates'][$i]['description'] = 'tad_guide_adm_main.tpl';

//---區塊設定---//
$i = 0;
// $i++;
// $modversion['config'][$i]['name']        = 'ssh_port';
// $modversion['config'][$i]['title']       = '_MI_TADGUIDE_SSH_PORT';
// $modversion['config'][$i]['description'] = '_MI_TADGUIDE_SSH_PORT_DESC';
// $modversion['config'][$i]['formtype']    = 'textbox';
// $modversion['config'][$i]['valuetype']   = 'int';
// $modversion['config'][$i]['default']     = '22';
