<?php

class QuickstartButtonsUpdateProcessor extends modObjectUpdateProcessor {
    public $classKey = 'qsbButton';
	public $languageTopics = array('quickstartbuttons:default');
	public $objectType = 'quickstartbuttons.qsbbutton';

    public function beforeSet() {

        // link

        $action = $this->getProperty('action_id');
        if(empty($action)) {
            $this->setProperty('action_id', null);
            $this->setProperty('action_key', null);
            $this->setProperty('action_namespace', null);
        }
        else {
            if (is_numeric($action)) {
                $this->setProperty('action_id', $action);
                $this->setProperty('action_key', null);
                $this->setProperty('action_namespace', null);
            }
            else {
                $this->setProperty('action_id', null);
                $this->setProperty('action_key', $action);
            }
        }

        $handler = $this->getProperty('handler');
        if(empty($handler)) { $this->setProperty('handler', null); }

        $link = $this->getProperty('link');
        if(empty($link)) { $this->setProperty('link', null); }

        // icon

        $icon = $this->getProperty('icon');
        if(empty($icon)) { $this->setProperty('icon', null); }

        $iconms = $this->getProperty('icon_ms');
        if(empty($iconms)) { $this->setProperty('icon_ms', null); }

        $iconfile = $this->getProperty('icon_file');
        if(empty($iconfile)) { $this->setProperty('icon_file', null); }

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