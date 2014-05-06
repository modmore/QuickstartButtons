<?php

class QuickstartButtonsDuplicateSetProcessor extends modObjectDuplicateProcessor {
    public $classKey = 'qsbSet';
	public $languageTopics = array('quickstartbuttons:default');
    public $objectType = 'quickstartbuttons.qsbset';

    public function afterSave() {

        $buttons = $this->object->getMany('Button');

        /** @var qsbButton $button */
        foreach($buttons as $button) {
            $buttonArray = $button->toArray();
            unset($buttonArray['id']);

            /** @var qsbButton $newButton */
            $newButton = $this->modx->newObject('qsbButton');
            $newButton->fromArray($buttonArray);
            $newButton->set('set', $this->newObject->get('id'));
            $newButton->save();
        }
        return parent::afterSave();
    }
}

return 'QuickstartButtonsDuplicateSetProcessor';