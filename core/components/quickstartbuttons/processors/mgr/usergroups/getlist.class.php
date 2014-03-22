<?php

class QuickstartButtonsUserGroupsGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'qsbSetUserGroup';
	public $languageTopics = array('quickstartbuttons:default');
	public $defaultSortField = 'UserGroup.name';
	public $defaultSortDirection = 'ASC';
	public $objectType = 'quickstartbuttons.qsbsetusergroup';

    public function prepareQueryBeforeCount(xPDOQuery $c) {

        $c->select(array('qsbSetUserGroup.*', 'UserGroup.name'));
        $c->innerJoin('modUserGroup', 'UserGroup');
        $c->where(array('set' => $this->getProperty('id')));

        return $c;
    }
}

return 'QuickstartButtonsUserGroupsGetListProcessor';