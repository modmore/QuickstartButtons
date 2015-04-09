<?php
/**
 * Grabs a list of actions
 */
class QuickstartButtonsModActonGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'modAction';
    public $languageTopics = array('action','menu','namespace');
    public $permission = 'actions';
    public $defaultSortField = 'controller';

    protected $query = false;

    /**
     * {@inheritDoc}
     * @return mixed
     */
    public function initialize() {
        $initialized = parent::initialize();
        $this->setDefaultProperties(array(
            'showNone' => true,
        ));
        return $initialized;
    }

    public function beforeIteration(array $list) {
        if ($this->getProperty('showNone',false)) {
            $list[] = array('id' => 0, 'controller' => $this->modx->lexicon('action_none'), 'namespace' => '');
        }
        $oldActions = array('browser', 'context',
            'context/create', 'context/update', 'context/view',
            'element', 'element/chunk', 'element/chunk/create', 'element/chunk/update',
            'element/plugin', 'element/plugin/create', 'element/plugin/update',
            'element/propertyset/index', 'element/snippet', 'element/snippet/create',
            'element/snippet/update', 'element/template', 'element/template/create',
            'element/template/tvsort', 'element/template/update', 'element/tv',
            'element/tv/create', 'element/tv/update', 'element/view', 'help',
            'resource', 'resource/create', 'resource/data', 'resource/empty_recycle_bin',
            'resource/site_schedule', 'resource/tvs', 'resource/update', 'search', 'security',
            'security/access/policy/template/update', 'security/access/policy/update',
            'security/forms', 'security/forms/profile/update', 'security/forms/set/update',
            'security/login', 'security/message', 'security/permission', 'security/profile',
            'security/resourcegroup/index', 'security/role', 'security/user', 'security/user/create',
            'security/user/update', 'security/usergroup/create', 'security/usergroup/update',
            'source/create', 'source/index', 'source/update', 'system', 'system/action',
            'system/contenttype', 'system/dashboards', 'system/dashboards/create',
            'system/dashboards/update', 'system/dashboards/widget/create',
            'system/dashboards/widget/update', 'system/event', 'system/file', 'system/file/create',
            'system/file/edit', 'system/import', 'system/import/html', 'system/info',
            'system/logs/index', 'system/phpinfo', 'system/refresh_site', 'system/settings',
            'welcome', 'workspaces', 'workspaces/lexicon',
            'workspaces/namespace', 'workspaces/package/view');

        foreach ($oldActions as $action) {
            if (!$this->query || (strpos($action, $this->query) !== false)) {
                $list[] = array('id' => $action, 'controller' => $action, 'namespace' => 'core');
            }
        }

        return $list;
    }

    public function prepareQueryBeforeCount(xPDOQuery $c) {

        $selected = $this->getProperty('selected');
        if(!empty($selected)) {
            $newSort = 'FIELD(id, '.$selected.') DESC, '.$this->defaultSortField;
            $this->setProperty('sort', $newSort);
        }

        $query = $this->getProperty('query');
        if(!empty($query)) {
            $this->query = $query;
            $c->andCondition(array(
                'id' => $query,
                'OR:name:LIKE' => '%'.$query.'%',
            ));
        }

        return $c;
    }

    public function prepareQueryAfterCount(xPDOQuery $c) {
        $c->sortby($this->modx->getSelectColumns('modAction','modAction','',array('namespace')),'ASC');
        return $c;
    }
}

return 'QuickstartButtonsModActonGetListProcessor';