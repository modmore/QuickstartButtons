<?php
/* Get the core config */
if (!file_exists(dirname(dirname(__FILE__)).'/config.core.php')) {
    die('ERROR: missing '.dirname(dirname(__FILE__)).'/config.core.php file defining the MODX core path.');
}

echo "<pre>";
/* Boot up MODX */
echo "Loading modX...\n";
require_once dirname(dirname(__FILE__)).'/config.core.php';
require_once MODX_CORE_PATH.'model/modx/modx.class.php';
$modx = new modX();
echo "Initializing manager...\n";
$modx->initialize('mgr');
$modx->getService('error','error.modError', '', '');

$componentPath = dirname(dirname(__FILE__));

$QuickstartButtons = $modx->getService('quickstartbuttons','QuickstartButtons', $componentPath.'/core/components/quickstartbuttons/model/quickstartbuttons/', array(
    'quickstartbuttons.core_path' => $componentPath.'/core/components/quickstartbuttons/',
));


/* Namespace */
if (!createObject('modNamespace',array(
    'name' => 'quickstartbuttons',
    'path' => $componentPath.'/core/components/quickstartbuttons/',
    'assets_path' => $componentPath.'/assets/components/quickstartbuttons/',
),'name', false)) {
    echo "Error creating namespace quickstartbuttons.\n";
}

/* Path settings */
if (!createObject('modSystemSetting', array(
    'key' => 'quickstartbuttons.core_path',
    'value' => $componentPath.'/core/components/quickstartbuttons/',
    'xtype' => 'textfield',
    'namespace' => 'quickstartbuttons',
    'area' => 'Paths',
    'editedon' => time(),
), 'key', false)) {
    echo "Error creating quickstartbuttons.core_path setting.\n";
}

if (!createObject('modSystemSetting', array(
    'key' => 'quickstartbuttons.assets_path',
    'value' => $componentPath.'/assets/components/quickstartbuttons/',
    'xtype' => 'textfield',
    'namespace' => 'quickstartbuttons',
    'area' => 'Paths',
    'editedon' => time(),
), 'key', false)) {
    echo "Error creating quickstartbuttons.assets_path setting.\n";
}

/* Fetch assets url */
$url = 'http';
if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) {
    $url .= 's';
}
$url .= '://'.$_SERVER["SERVER_NAME"];
if ($_SERVER['SERVER_PORT'] != '80') {
    $url .= ':'.$_SERVER['SERVER_PORT'];
}
$requestUri = $_SERVER['REQUEST_URI'];
$bootstrapPos = strpos($requestUri, '_bootstrap/');
$requestUri = rtrim(substr($requestUri, 0, $bootstrapPos), '/').'/';
$assetsUrl = "{$url}{$requestUri}assets/components/quickstartbuttons/";

if (!createObject('modSystemSetting', array(
    'key' => 'quickstartbuttons.assets_url',
    'value' => $assetsUrl,
    'xtype' => 'textfield',
    'namespace' => 'quickstartbuttons',
    'area' => 'Paths',
    'editedon' => time(),
), 'key', false)) {
    echo "Error creating quickstartbuttons.assets_url setting.\n";
}

// Create widget
if (!createObject('modDashboardWidget', array(
    'name' => 'quickstartbuttons.widget',
    'description' => 'quickstartbuttons.widget_desc',
    'type' => 'file',
    'size' => 'full',
    'content' => '[[++core_path]]components/quickstartbuttons/model/quickstartbuttons/dashboardwidget.class.php',
    'namespace' => 'quickstartbuttons',
    'lexicon' => 'quickstartbuttons:dashboards',
), 'name', false)) {
    echo "Error creating quickstartbuttons.widget widget.\n";
}

// Create action
if (!createObject('modAction', array(
    'namespace' => 'quickstartbuttons',
    'parent' => 0,
    'controller' => 'controllers/index',
    'haslayout' => true,
    'lang_topics' => 'quickstartbuttons'.':default',
    'assets' => '',
), array('namespace','controller'), false)) {
    echo "Error creating modAction.\n";
}

$action = $modx->getObject('modAction', array('namespace' => 'quickstartbuttons', 'controller' => 'controllers/index'));
if ($action) {
    if (!createObject('modMenu', array(
        'text' => 'quickstartbuttons',
        'parent' => 'components',
        'description' => 'quickstartbuttons.menu_desc',
        'icon' => 'images/icons/plugin.gif',
        'menuindex' => 0,
        'params' => '',
        'handler' => '',
        'permissions' => 'dashboards',
        'action' => $action->get('id')
    ), 'text', true)) {
        echo "Error creating modMenu.\n";
    }
}

$manager = $modx->getManager();

/* Create the tables */
$objectContainers = array(
    'qsbButton',
    'qsbIcon',
    'qsbSet',
    'qsbSetUserGroup',
);
echo "Creating tables...\n";

foreach ($objectContainers as $oC) {
    $manager->createObjectContainer($oC);
}

$manager->alterField('qsbButton', 'icon');
$manager->addField('qsbButton', 'icon_ms', array('after' => 'icon'));
$manager->addField('qsbButton', 'icon_file', array('after' => 'icon_ms'));

if (isset($_GET['loadIcons'])) {
    echo "Loading icons..\n";

    $modx->loadClass('transport.xPDOTransport', XPDO_CORE_PATH, true, true);
    $options = array(
        xPDOTransport::PACKAGE_ACTION => xPDOTransport::ACTION_INSTALL
    );
    include $componentPath . '/_build/resolvers/resolve.icons.php';
}
else {
    echo 'Not loading icons, pass ?loadIcons to the url to also load icons.'."\n";
}

echo "Done.";


/**
 * Creates an object.
 *
 * @param string $className
 * @param array $data
 * @param string $primaryField
 * @param bool $update
 * @return bool
 */
function createObject ($className = '', array $data = array(), $primaryField = '', $update = true) {
    global $modx;
    /* @var xPDOObject $object */
    $object = null;

    /* Attempt to get the existing object */
    if (!empty($primaryField)) {
        if (is_array($primaryField)) {
            $condition = array();
            foreach ($primaryField as $key) {
                $condition[$key] = $data[$key];
            }
        }
        else {
            $condition = array($primaryField => $data[$primaryField]);
        }
        $object = $modx->getObject($className, $condition);
        if ($object instanceof $className) {
            if ($update) {
                $object->fromArray($data);
                return $object->save();
            } else {
                $condition = $modx->toJSON($condition);
                echo "Skipping {$className} {$condition}: already exists.\n";
                return true;
            }
        }
    }

    /* Create new object if it doesn't exist */
    if (!$object) {
        $object = $modx->newObject($className);
        $object->fromArray($data, '', true);
        return $object->save();
    }

    return false;
}
