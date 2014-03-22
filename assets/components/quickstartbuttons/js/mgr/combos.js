QuickstartButtons.combo.UserGroups = function(config) {
    config = config || {};
    Ext.applyIf(config, {
        name: 'usergroup'
		,hiddenName: 'usergroup'
		,displayField: 'name'
		,valueField: 'id'
		,fields: ['id','name']
        ,pageSize: 20
		,forceSelection: true
		,typeAhead: true
		,editable: true
		,allowBlank: false
		,autocomplete: true
		,url: QuickstartButtons.config.connector_url
		,baseParams: {
            action: 'mgr/common/modusergroup/getList'
			,combo: true
        }
    });
	
    QuickstartButtons.combo.UserGroups.superclass.constructor.call(this, config);
};
Ext.extend(QuickstartButtons.combo.UserGroups, MODx.combo.ComboBox);
Ext.reg('quickstartbuttons-combo-usergroups', QuickstartButtons.combo.UserGroups);


QuickstartButtons.combo.Icons = function(config) {
    config = config || {};
    Ext.applyIf(config, {
        name: 'icon'
		,hiddenName: 'icon'
		,displayField: 'name'
		,valueField: 'id'
		,fields: ['id','name','class','path']
        ,mode: 'remote'
        ,pageSize: 20
		,forceSelection: true
		,typeAhead: true
		,editable: true
		,allowBlank: false
		,autocomplete: true
        ,minChars: 1
		,url: QuickstartButtons.config.connector_url
		,baseParams: {
            action: 'mgr/icons/getlist'
			,combo: true
            ,selected: config.selected
        }
        ,tpl: new Ext.XTemplate('<tpl for="."><div class="x-combo-list-item">'
            ,'<tpl if="Ext.isEmpty(path)"><i class="fa {class}"></i> </tpl>'
            ,'<tpl if="!Ext.isEmpty(path)"><i class="icon {class}" style="background-image:url({path});"></i> </tpl>'
            ,'{name}</div></tpl>')
    });

    QuickstartButtons.combo.Icons.superclass.constructor.call(this, config);
};
Ext.extend(QuickstartButtons.combo.Icons, MODx.combo.ComboBox);
Ext.reg('quickstartbuttons-combo-icons', QuickstartButtons.combo.Icons);


QuickstartButtons.combo.WidgetItemsPerRow = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        store: [
            ['one', _('quickstartbuttons.sets.buttonsperrow.one')]
            ,['two', _('quickstartbuttons.sets.buttonsperrow.two')]
            ,['three', _('quickstartbuttons.sets.buttonsperrow.three')]
            ,['four', _('quickstartbuttons.sets.buttonsperrow.four')]
            ,['five', _('quickstartbuttons.sets.buttonsperrow.five')]
        ]
        ,name: 'perrow'
        ,hiddenName: 'perrow'
        ,triggerAction: 'all'
        ,editable: false
        ,selectOnFocus: false
        ,preventRender: true
        ,forceSelection: true
        ,enableKeyEvents: true
    });
    QuickstartButtons.combo.WidgetItemsPerRow.superclass.constructor.call(this,config);
};
Ext.extend(QuickstartButtons.combo.WidgetItemsPerRow, MODx.combo.ComboBox);
Ext.reg('quickstartbuttons-combo-widgetitemsperrow', QuickstartButtons.combo.WidgetItemsPerRow);


/* Copied from core */

MODx.combo.DashboardWidgetSize = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        store: new Ext.data.SimpleStore({
            fields: ['d','v']
            ,data: [
                [_('widget_size_half'),'half']
                ,[_('widget_size_full'),'full']
                ,[_('widget_size_double'),'double']
            ]
        })
        ,name: 'size'
        ,hiddenName: 'size'
        ,displayField: 'd'
        ,valueField: 'v'
        ,mode: 'local'
        ,triggerAction: 'all'
        ,editable: false
        ,selectOnFocus: false
        ,preventRender: true
        ,forceSelection: true
        ,enableKeyEvents: true
    });
    MODx.combo.DashboardWidgetSize.superclass.constructor.call(this,config);
};
Ext.extend(MODx.combo.DashboardWidgetSize,MODx.combo.ComboBox);
Ext.reg('modx-combo-dashboard-widget-size',MODx.combo.DashboardWidgetSize);