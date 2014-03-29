<?php

class QuickstartButtonsRemoveProcessor extends modObjectRemoveProcessor {
    public $classKey = 'qsbButton';
	public $languageTopics = array('quickstartbuttons:default');
	public $objectType = 'quickstartbuttons.qsbbutton';

    public function afterRemove() {
        $this->modx->cacheManager->refresh(array(
            'default' => array('qsb' => array()),
        ));
        return parent::afterRemove();
    }
}

return 'QuickstartButtonsRemoveProcessor';