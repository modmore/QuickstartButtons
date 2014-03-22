<?php

$modx->log(modX::LOG_LEVEL_INFO, 'Add in records...');

$set = $modx->newObject('qsbSet');
$set->fromArray(array(
    'name' => 'modmore Quickstart Buttons',
    'description' => 'Just click the button below to review the documentation or start investigation yourself by going to "Dashboard > Quickstart Buttons" in the top navigation menu from MODX.',
    'perrow' => 'two',
));

$buttons = array();
$buttons[] = $modx->newObject('qsbButton', array(
    'text' => 'Open the Quickstart Buttons documentation',
    'description' => 'Click here to review the documentation of modmores\' Quickstart Buttons',
    'link' => 'http://www.modmore.com/extras/quickstartbuttons/docs/',
    'newwindow' => true,
    'ranking' => 1,
));

$icon = $modx->getObject('qsbIcon', array('name' => 'modmore'));
$buttons[0]->addOne($icon);

$set->addMany($buttons);
$set->save();