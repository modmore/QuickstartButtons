<?php

$widgets = array();
$widgets[1]= $modx->newObject('modDashboardWidget');
$widgets[1]->fromArray(array (
  'name' => 'quickstartbuttons.widget',
  'description' => 'quickstartbuttons.widget_desc',
  'type' => 'file',
  'size' => 'full',
  'content' => '[[++core_path]]components/quickstartbuttons/model/quickstartbuttons/dashboardwidget.class.php',
  'namespace' => 'quickstartbuttons',
  'lexicon' => 'quickstartbuttons:dashboards',
), '', true, true);

return $widgets;