<?php

class QuickstartButtonsRemoveProcessor extends modObjectRemoveProcessor {
    public $classKey = 'qsbButton';
	public $languageTopics = array('quickstartbuttons:default');
	public $objectType = 'quickstartbuttons.qsbbutton';
}

return 'QuickstartButtonsRemoveProcessor';