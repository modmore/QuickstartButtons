<?php

/** @var xPDO|modX $modx */
$modx =& $object->xpdo;

switch($options[xPDOTransport::PACKAGE_ACTION]) {
	case xPDOTransport::ACTION_INSTALL:
	case xPDOTransport::ACTION_UPGRADE:

        $modx->log(xPDO::LOG_LEVEL_INFO, 'Creating database tables...');
		$modelPath = $modx->getOption('quickstartbuttons.core_path', null, $modx->getOption('core_path').'components/quickstartbuttons/').'model/';
		$modx->addPackage('quickstartbuttons', $modelPath);

		$manager = $modx->getManager();

        // to not report table creation in the console
        $oldLogLevel = $modx->getLogLevel();
        $modx->setLogLevel(0);

        // since 1.0.1
		$manager->addField('qsbButton', 'action_props', array('after' => 'action_id'));

        // since 1.1.0
        $manager->alterField('qsbButton', 'icon');
        $manager->addField('qsbButton', 'icon_ms', array('after' => 'icon'));
        $manager->addField('qsbButton', 'icon_file', array('after' => 'icon_ms'));


        // since 1.2.0, 2015-04-09
        $manager->addField('qsbButton', 'action_key', array('after' => 'action_id'));
        $manager->addField('qsbButton', 'action_namespace', array('after' => 'action_key'));

        // set back console logging
        $modx->setLogLevel($oldLogLevel);

	break;
}

return true;