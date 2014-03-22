<?php

class QuickstartButtonsModUserGroupGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'modUserGroup';
	public $languageTopics = array('quickstartbuttons:default');
	public $defaultSortField = 'name ASC, id';
	public $defaultSortDirection = 'ASC';
	public $objectType = 'modusergroup';

    public function prepareQueryBeforeCount(xPDOQuery $c) {

        $query = $this->getProperty('query');
        if(!empty($query)) {
            $c->andCondition(array(
                'id' => $query,
                'OR:name:LIKE' => '%'.$query.'%',
            ));
        }

        return $c;
    }
}

return 'QuickstartButtonsModUserGroupGetListProcessor';