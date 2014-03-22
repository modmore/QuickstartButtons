<?php

class QuickstartButtonsUserGroupRemoveProcessor extends modObjectRemoveProcessor {
    public $classKey = 'qsbSetUserGroup';
	public $languageTopics = array('quickstartbuttons:default');
	public $objectType = 'quickstartbuttons.qsbsetusergroup';

    public function initialize() {
        $usergroup = $this->getProperty('usergroup');
        $set = $this->getProperty('set');
        if (empty($usergroup) || empty($set)) return $this->modx->lexicon($this->objectType.'_err_ns');

        $this->object = $this->modx->getObject($this->classKey, array('usergroup' => $usergroup, 'set' => $set));
        if (empty($this->object)) return $this->modx->lexicon($this->objectType.'_err_nfs', array('usergroup' => $usergroup, 'set' => $set));

        if ($this->checkRemovePermission && $this->object instanceof modAccessibleObject && !$this->object->checkPolicy('remove')) {
            return $this->modx->lexicon('access_denied');
        }
        return true;
    }
}

return 'QuickstartButtonsUserGroupRemoveProcessor';