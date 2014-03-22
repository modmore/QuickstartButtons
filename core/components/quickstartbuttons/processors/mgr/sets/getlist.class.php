<?php

class QuickstartButtonsSetsGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'qsbSet';
	public $languageTopics = array('quickstartbuttons:default');
	public $defaultSortField = 'name ASC, id';
	public $defaultSortDirection = 'ASC';
	public $objectType = 'quickstartbuttons.qsbset';

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

    public function prepareRow(xPDOObject $object) {
        $arr = $object->toArray();
        $arr['usergroups'] = '';

        // fill number of buttons
        $c = $this->modx->newQuery('qsbButton');
        $c->where(array('set' => $object->get('id')));
        $arr['btnscount'] = $this->modx->getCount('qsbButton', $c);

        // fill usergroups
        $userGroups = $object->getMany('UserGroup');
        if(!empty($userGroups)) {

            /** @var qsbSetUserGroup $userGroup */
            foreach($userGroups as $userGroup) {

                /** @var modUserGroup $group */
                $group = $userGroup->getOne('UserGroup');
                if(!empty($group) && is_object($group)) {

                    $arr['usergroups'] .= ((!empty($arr['usergroups'])) ? ', ' : '' ).$group->get('name');
                }
            }
        }

        return $arr;
    }
}

return 'QuickstartButtonsSetsGetListProcessor';