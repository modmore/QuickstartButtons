<?php

class QuickstartButtonsSetRemoveProcessor extends modObjectRemoveProcessor {
    public $classKey = 'qsbSet';
	public $languageTopics = array('quickstartbuttons:default');
	public $objectType = 'quickstartbuttons.qsbset';
}

return 'QuickstartButtonsSetRemoveProcessor';