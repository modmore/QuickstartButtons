<?php

class QuickstartButtonsModActonGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'modAction';
	public $languageTopics = array('quickstartbuttons:default');
	public $defaultSortField = 'namespace=\'core\' DESC, namespace ASC, controller';
	public $defaultSortDirection = 'ASC';
	public $objectType = 'modaction';

    public function initialize() {
        $initialized = parent::initialize();
        $this->setDefaultProperties(array(
            'showNone' => false,
        ));
        return $initialized;
    }

    public function prepareQueryBeforeCount(xPDOQuery $c) {

        $selected = $this->getProperty('selected');
        if(!empty($selected)) {
            $newSort = 'FIELD(id, '.$selected.') DESC, '.$this->defaultSortField;
            $this->setProperty('sort', $newSort);
        }

        $query = $this->getProperty('query');
        if(!empty($query)) {
            $c->andCondition(array(
                'id' => $query,
                'OR:name:LIKE' => '%'.$query.'%',
            ));
        }

        return $c;
    }

    public function beforeIteration(array $list) {
        if ($this->getProperty('showNone',false)) {
            $list = array('0' => array(
                'id' => '',
                'controller' => $this->modx->lexicon('none'),
                'namespace' => '',
            ));
        }
        return $list;
    }
}

return 'QuickstartButtonsModActonGetListProcessor';