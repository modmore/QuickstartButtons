<?php

class QuickstartButtonsGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'qsbButton';
	public $languageTopics = array('quickstartbuttons:default');
	public $defaultSortField = 'ranking ASC, id';
	public $defaultSortDirection = 'ASC';
	public $objectType = 'quickstartbuttons.qsbbutton';

    public function prepareQueryBeforeCount(xPDOQuery $c) {

        $c->select(array('qsbButton.*', 'Icon.class AS iconcls', 'Icon.path as iconpath'));
        $c->leftJoin('qsbIcon', 'Icon');
        $c->where(array('set' => $this->getProperty('id')));

        $query = $this->getProperty('query');
        if(!empty($query)) {
            $c->andCondition(array(
                'id' => $query,
                'OR:text:LIKE' => '%'.$query.'%',
            ));
        }

        return $c;
    }
}

return 'QuickstartButtonsGetListProcessor';

