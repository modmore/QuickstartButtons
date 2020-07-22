<?php

$menu = $modx->newObject('modMenu');
$menu->fromArray(array(
    'text' => PKG_NAME_LOWER,
    'parent' => 'components',
    'description' => PKG_NAME_LOWER.'.menu_desc',
    'icon' => 'images/icons/plugin.gif',
    'menuindex' => 99,
    'params' => '',
    'handler' => '',
    'permissions' => 'dashboards',
    'namespace' => 'quickstartbuttons',
    'action' => 'home'
), '', true, true);

return $menu;
