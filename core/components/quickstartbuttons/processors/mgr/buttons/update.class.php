<?php

class QuickstartButtonsUpdateProcessor extends modObjectUpdateProcessor {
    public $classKey = 'qsbButton';
	public $languageTopics = array('quickstartbuttons:default');
	public $objectType = 'quickstartbuttons.qsbbutton';

    public function beforeSet() {

        $action = $this->getProperty('action_id');
        if(empty($action)) { $this->setProperty('action_id', null); }
        else { $this->setProperty('action', $action); }

        $handler = $this->getProperty('handler');
        if(empty($handler)) { $this->setProperty('handler', null); }

        $link = $this->getProperty('link');
        if(empty($link)) { $this->setProperty('link', null); }

        return parent::beforeSet();
    }

    public function afterSave() {
        $this->modx->cacheManager->refresh(array(
            'default' => array('qsb' => array()),
        ));
        return parent::afterSave();
    }
}

return 'QuickstartButtonsUpdateProcessor';