<?php

use XoopsModules\Tad_guide\Update;

if (!class_exists('XoopsModules\Tad_guide\Update')) {
    include dirname(__DIR__) . '/preloads/autoloader.php';
        }
function xoops_module_update_tad_guide(&$module, $old_version)
    {
                return true;
            }
