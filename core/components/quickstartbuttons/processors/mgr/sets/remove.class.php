<?php

class QuickstartButtonsSetRemoveProcessor extends modObjectRemoveProcessor {
    public $classKey = 'qsbSet';
	public $languageTopics = array('quickstartbuttons:default');
	public $objectType = 'quickstartbuttons.qsbset';

    public function afterRemvoe() {
        $this->modx->cacheManager->refresh(array(
            'default' => array('qsb' => array()),
        ));
        return parent::afterRemvoe();
    }
}

return 'QuickstartButtonsSetRemoveProcessor';