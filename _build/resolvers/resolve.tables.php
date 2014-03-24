<?php

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

		$manager->createObjectContainer('qsbSet');
        $manager->createObjectContainer('qsbSetUserGroup');
        $manager->createObjectContainer('qsbButton');
        $manager->createObjectContainer('qsbIcon');

        // set back console logging
        $modx->setLogLevel($oldLogLevel);

	break;

    case xPDOTransport::ACTION_UNINSTALL:

        $modx->log(xPDO::LOG_LEVEL_INFO, 'Removing database tables...');
        $modelPath = $modx->getOption('quickstartbuttons.core_path', null, $modx->getOption('core_path').'components/quickstartbuttons/').'model/';
		$modx->addPackage('quickstartbuttons', $modelPath);

		$manager = $modx->getManager();

        // to not report table creation in the console
        $oldLogLevel = $modx->getLogLevel();
        $modx->setLogLevel(0);

		$manager->removeObjectContainer('qsbSet');
        $manager->removeObjectContainer('qsbSetUserGroup');
        $manager->removeObjectContainer('qsbButton');
        $manager->removeObjectContainer('qsbIcon');

        // set back console logging
        $modx->setLogLevel($oldLogLevel);

	break;
}

return true;