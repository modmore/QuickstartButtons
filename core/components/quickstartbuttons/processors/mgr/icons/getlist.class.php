<?php

class QuickstartButtonsIconsGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'qsbIcon';
	public $languageTopics = array('quickstartbuttons:default');
	public $defaultSortField = 'name ASC, class ASC, id';
	public $defaultSortDirection = 'ASC';
	public $objectType = 'quickstartbuttons.qsbicon';

    public function initialize() {
        $this->modx->getParser();
        return parent::initialize();;
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
                'name:LIKE' => '%'.$query.'%',
                'OR:class:LIKE' => '%'.$query.'%',
            ));
        }

        return $c;
    }

    public function prepareRow(xPDOObject $object) {
        $arr = $object->toArray();

        $path = $arr['path'];
        if(!empty($arr['path'])) {
            $this->modx->parser->processElementTags('', $path, true, true);
            $arr['path'] = $path;
        }

        return $arr;
    }
}

return 'QuickstartButtonsIconsGetListProcessor';