<?php

/** @var modX $modx */
$modx =& $object->xpdo;

switch($options[xPDOTransport::PACKAGE_ACTION]) {
	case xPDOTransport::ACTION_INSTALL:
        $modx->log(modX::LOG_LEVEL_INFO, 'Install default records...');
        $modelPath = $modx->getOption('quickstartbuttons.core_path', null, $modx->getOption('core_path').'components/quickstartbuttons/').'model/';
		$modx->addPackage('quickstartbuttons', $modelPath);

        $set = $modx->newObject('qsbSet');
        $set->fromArray(array(
            'name' => 'modmore Quickstart Buttons',
            'description' => 'Just click the button below to review the documentation or start investigation yourself by going to "Dashboard > Quickstart Buttons" in the top navigation menu from MODX.',
            'perrow' => 'two',
        ));

        if($set->save()) {

            $button = $modx->newObject('qsbButton');
            $button->fromArray(array(
                'set' => $set->get('id'),
                'text' => 'Open the Quickstart Buttons documentation',
                'description' => 'Click here to review the documentation of modmores\' Quickstart Buttons',
                'link' => 'http://www.modmore.com/extras/quickstartbuttons/documentation/',
                'newwindow' => true,
                'ranking' => 1,
            ));

            $icon = $modx->getObject('qsbIcon', array('name' => 'modmore'));
            if($button->save() && !empty($icon)) {

                $button->set('icon', $icon->get('id'));
                $button->save();
            }
        }

    break;
}
