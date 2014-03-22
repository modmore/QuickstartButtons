<?php

class QuickstartButtonsUserGroupCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'qsbSetUserGroup';
	public $languageTopics = array('quickstartbuttons:default');
	public $objectType = 'quickstartbuttons.qsbsetusergroup';

    public function beforeSave() {

        $this->object->fromArray($this->getProperties(), '', true);
        return parent::beforeSave();
    }
}

return 'QuickstartButtonsUserGroupCreateProcessor';