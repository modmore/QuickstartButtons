<?php

class QuickstartButtonsGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'qsbButton';
	public $languageTopics = array('quickstartbuttons:default');
	public $defaultSortField = 'ranking ASC, id';
	public $defaultSortDirection = 'ASC';
	public $objectType = 'quickstartbuttons.qsbbutton';

    public function prepareQueryBeforeCount(xPDOQuery $c) {
        $c->leftJoin('qsbIcon', 'Icon');
        $c->select(array('qsbButton.*', 'Icon.class AS iconcls', 'Icon.path as iconpath'));
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

    public function prepareRow(xPDOObject $object)
    {
        $arr = $object->toArray('', false, true, true);
        if(!empty($arr['iconpath'])) {
            $path = $arr['iconpath'];
            $this->modx->parser->processElementTags('', $path, true, true);
            $arr['iconpath'] = $path;
        }
        return $arr;
    }

}

return 'QuickstartButtonsGetListProcessor';

