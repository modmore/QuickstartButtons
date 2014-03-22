<?php

class QuickstartButtonsHomeManagerController extends QuickstartButtonsManagerController {
    public function process(array $scriptProperties = array()) {

    }

    public function getPageTitle() { return $this->modx->lexicon('quickstartbuttons'); }

    public function loadCustomCssJs() {
        $this->addJavascript($this->quickstartbuttons->config['jsUrl'].'mgr/widgets/sets.grid.js');
        $this->addJavascript($this->quickstartbuttons->config['jsUrl'].'mgr/widgets/buttons.grid.js');
        $this->addJavascript($this->quickstartbuttons->config['jsUrl'].'mgr/widgets/usergroups.grid.js');

        $this->addJavascript($this->quickstartbuttons->config['jsUrl'].'mgr/widgets/sets.windows.js');
        $this->addJavascript($this->quickstartbuttons->config['jsUrl'].'mgr/widgets/buttons.windows.js');
        $this->addJavascript($this->quickstartbuttons->config['jsUrl'].'mgr/widgets/usergroups.windows.js');

        $this->addJavascript($this->quickstartbuttons->config['jsUrl'].'mgr/widgets/index.panel.js');
        $this->addLastJavascript($this->quickstartbuttons->config['jsUrl'].'mgr/sections/index.js');
    }

    public function getTemplateFile() { return $this->quickstartbuttons->config['templatesPath'].'home.tpl'; }
}
