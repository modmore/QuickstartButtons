<?php

class QuickstartButtonsDashboardWidget extends modDashboardWidgetInterface {

    /** @var QuickstartButtons $qsb */
    public $qsb;

	public function render() {
		$qsb = $this->modx->getService('quickstartbuttons','QuickstartButtons',$this->modx->getOption('quickstartbuttons.core_path',null,$this->modx->getOption('core_path').'components/quickstartbuttons/').'model/quickstartbuttons/');
		if (!($qsb instanceof QuickstartButtons)) return '';
        $this->qsb =& $qsb;

		// to load lexicons normally
		$this->modx->response->addLangTopic('quickstartbuttons:dashboard');
        $this->modx->controller->addCss($this->qsb->config['cssUrl'].'mgr.css');

        $output = $this->getDashboardButtons();
		return $output;
	}

    public function getDashboardButtons() {

        $usrGroupIds = (array) $this->modx->user->getUserGroups();
        $output = '';

        $c = $this->modx->newQuery('qsbSet');
        $c->leftJoin('qsbSetUserGroup', 'UserGroup');
        $c->where(array(
            'qsbSet.active' => true,
            "(`UserGroup`.`usergroup` IN (".implode(',', $usrGroupIds).") OR `UserGroup`.`usergroup` IS NULL OR `UserGroup`.`usergroup` = '')",
        ));
        $c->sortby('qsbSet.id', 'ASC');
        $c->limit(1);

        $set = $this->modx->getObject('qsbSet', $c);
        if(!empty($set) && is_object($set)) {

            $this->widget->set('name', $set->get('name'));
            $this->widget->set('description', $set->get('description'));
            $this->widget->set('size', $set->get('size'));

            // collect all buttons in set
            $c = $this->modx->newQuery('qsbButton');
            $c->select(array('qsbButton.*', 'Icon.class AS iconcls', 'Icon.path as iconpath'));
            $c->leftJoin('qsbIcon', 'Icon');
            $c->where(array('active' => true));
            $c->sortby('ranking ASC, id', 'ASC');

            $buttons = $set->getMany('Button', $c);
            if(!empty($buttons)) {

                $idx = 1;
                foreach($buttons as $button) {

                    $phs = $button->toArray();
                    $phs['idx'] = $idx;
                    $phs['href'] = '';

                    // figure out the link
                    $btnAction = $button->get('action');
                    if(!empty($btnAction)) { $phs['href'] = '?a='.$btnAction; }
                    $btnLink = $button->get('link');
                    if(!empty($btnLink)) { $phs['href'] = $btnLink; }

                    // concat output
                    $output .= $this->qsb->getChunk('Dashboard/Item', $phs)."\n";
                    $idx++;
                }

                if(!empty($output)) {
                    $phs = $set->toArray();
                    $phs['buttons'] = $output;
                    $output = $this->qsb->getChunk('Dashboard/Outer', $phs);
                }
            }
        }

        return $output;
    }
}

return 'QuickstartButtonsDashboardWidget';