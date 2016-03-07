<?php

require_once dirname(dirname(__FILE__)) . '/model/quickstartbuttons/quickstartbuttons.class.php';

abstract class QuickstartButtonsManagerController extends modExtraManagerController {

    /** @var QuickstartButtons $quickstartbuttons */
    public $quickstartbuttons;

    public function initialize() {
        $this->quickstartbuttons = new QuickstartButtons($this->modx);

        $this->addCss($this->quickstartbuttons->config['cssUrl'].'mgr.css');
        $this->addCss($this->quickstartbuttons->config['assetsUrl'].'lib/font-awesome/css/font-awesome.min.css');
        $this->addJavascript($this->quickstartbuttons->config['jsUrl'].'mgr/quickstartbuttons.js');
        $this->addJavascript($this->quickstartbuttons->config['jsUrl'].'mgr/combos.js');
        $this->addHtml('<script type="text/javascript">
        Ext.onReady(function() {
            QuickstartButtons.config = '.$this->modx->toJSON($this->quickstartbuttons->config).';
            QuickstartButtons.config.connector_url = "'.$this->quickstartbuttons->config['connectorUrl'].'";
        });
        </script>');
        return parent::initialize();
    }

    public function getLanguageTopics() {
        return array('dashboards','quickstartbuttons:default');
    }

    public function checkPermissions() { return $this->modx->hasPermission('dashboards'); }
}

class ControllersIndexManagerController extends QuickstartButtonsManagerController {
    public static function getDefaultController() { return 'home'; }
}
