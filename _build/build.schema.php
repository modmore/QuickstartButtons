<?php

define('PKG_NAME', 'Redirector');
define('PKG_NAME_LOWER', strtolower(PKG_NAME));

require_once dirname(__FILE__).'/build.config.php';
include_once MODX_CORE_PATH . 'model/modx/modx.class.php';

$modx = new modX();
$modx->initialize('mgr');
$modx->loadClass('transport.modPackageBuilder','',false, true);
$modx->setLogLevel(modX::LOG_LEVEL_INFO);
$modx->setLogTarget(XPDO_CLI_MODE ? 'ECHO' : 'HTML');

$root = dirname(dirname(__FILE__)).'/';
$sources = array(
    'root' => $root,
    'build' => $root . '_build/',
    'resolvers' => $root . '_build/resolvers/',
    'data' => $root . '_build/data/',

    'model' => $root.'core/components/quickstartbuttons/model/',
    'schema' => $root.'core/components/quickstartbuttons/model/schema/',
    'schema_file' => $root.'core/components/quickstartbuttons/model/schema/quickstartbuttons.mysql.schema.xml',
    'source_core' => $root.'core/components/quickstartbuttons/',
    'source_assets' => $root.'assets/components/quickstartbuttons/',
);

$manager= $modx->getManager();
$generator= $manager->getGenerator();

if(!is_dir($sources['model'])) {
	$modx->log(modX::LOG_LEVEL_ERROR,'Model directory not found ('.$sources['model'].')!');
	die();
}

if(!file_exists($sources['schema_file'])) {
	$modx->log(modX::LOG_LEVEL_ERROR,'Schema file not found!');
	die();
}

$generator->parseSchema($sources['schema_file'], $sources['model']);

$modx->addPackage('quickstartbuttons', $sources['model']);
$manager->createObjectContainer('qsbSet');
$manager->createObjectContainer('qsbSetUserGroup');
$manager->createObjectContainer('qsbButton');
$manager->createObjectContainer('qsbIcon');

//$manager->alterField('qsbButton', 'iconcls');
//$manager->removeField('qsbButton', 'link_target');
//$manager->addField('qsbButton', 'newwindow', array('after' => 'link'));

// icons
$truncate = $modx->query("TRUNCATE TABLE  {$modx->getTableName('qsbIcon')}");
$truncate->execute();

$icons = include($sources['resolvers'].'icons.resolve.php');
foreach($icons as $icon) {
    $icon->save();
}

// sets and buttons
$truncate = $modx->query("TRUNCATE TABLE  {$modx->getTableName('qsbSet')}");
$truncate->execute();
$truncate = $modx->query("TRUNCATE TABLE  {$modx->getTableName('qsbSetUserGroup')}");
$truncate->execute();
$truncate = $modx->query("TRUNCATE TABLE  {$modx->getTableName('qsbButton')}");
$truncate->execute();

include($sources['resolvers'].'records.resolve.php');