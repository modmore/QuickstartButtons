<?php
/** @var modX $modx */
// Used for bootstrapping
if (!isset($modx)) {
    $modx =& $object->xpdo;
}

switch($options[xPDOTransport::PACKAGE_ACTION]) {
	case xPDOTransport::ACTION_INSTALL:
	case xPDOTransport::ACTION_UPGRADE:

        $modelPath = $modx->getOption('quickstartbuttons.core_path', null, $modx->getOption('core_path').'components/quickstartbuttons/').'model/';
		$modx->addPackage('quickstartbuttons', $modelPath);

        /* add in icons */
        $modx->log(modX::LOG_LEVEL_INFO, 'Import default icons...');
        $assetsPath = $modx->getOption('quickstartbuttons.assets_path', null, $modx->getOption('assets_path').'components/quickstartbuttons/');

        $icons = array();
        $iconsFile = $assetsPath.'lib/font-awesome/css/font-awesome.css';
        if(file_exists($iconsFile)) {

            $cssIcons = file_get_contents($iconsFile);
            preg_match_all('/\.(fa\-[a-zA-Z0-9\-]*?):before \{/', $cssIcons, $matches);
            $classes = $matches[1];

            foreach($classes as $key => $class) {

                $class = str_replace(array('i.', ':before', ':after'), '', $class);
                $classes[$key] = $class;
            }

            $classes = array_unique($classes);
            sort($classes);

            foreach($classes as $index => $class) {

                $name = str_replace('fa-', '', $class);
                $name = str_replace('-', ' ', $name);

                $exists = $modx->getCount('qsbIcon', array(
                    'name' => ucwords($name),
                    'class' => $class,
                    'preset' => true,
                ));

                if ($exists < 1) {
                    $icons[] = $modx->newObject('qsbIcon', array(
                        'name' => ucwords($name),
                        'class' => $class,
                        'preset' => true,
                    ));
                }
            }
        }

        $exists = $modx->getCount('qsbIcon', array(
            'name' => 'modmore',
            'class' => 'icon-modmore',
            'preset' => true,
        ));

        if ($exists < 1) {
            $icons[] = $modx->newObject('qsbIcon', array(
                'name' => 'modmore',
                'class' => 'icon-modmore',
                'path' => '[[++assets_url]]components/quickstartbuttons/icons/modmore.png',
                'preset' => true,
            ));
        }

        // save all
        foreach($icons as $icon) {
            $icon->save();
        }

    break;
}
