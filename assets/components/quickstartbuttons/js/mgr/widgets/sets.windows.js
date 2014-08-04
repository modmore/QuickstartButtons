// ------------------
// Create window
QuickstartButtons.window.CreateSet = function(config) {
	config = config || {};
    this.ident = config.ident || Ext.id();

	Ext.applyIf(config,{
		title: _('quickstartbuttons.sets.create')
		,url: QuickstartButtons.config.connector_url
		,baseParams: {
			action: 'mgr/sets/create'
		}
		,modal: true
        ,autoHeight: true
		,width: 450
		,fields: [{
			xtype: 'textfield'
			,fieldLabel: _('quickstartbuttons.sets.name')
			,name: 'name'
			,anchor: '100%'
			,allowBlank: false
		},{
			xtype: 'textarea'
			,fieldLabel: _('quickstartbuttons.sets.description')
			,name: 'description'
			,anchor: '100%'
		},{
            layout: 'column'
            ,border: false
            ,defaults: { msgTarget: 'under' ,border: false }
            ,items: [{
                layout: 'form'
                ,columnWidth: .5
                ,defaults: { msgTarget: 'under' ,border: false }
                ,items: [{
                    xtype: 'modx-combo-dashboard-widget-size'
                    ,name: 'size'
                    ,hiddenName: 'size'
                    ,fieldLabel: _('widget_size')
                    ,description: _('widget_size_desc')
                    ,anchor: '100%'
                    ,value: 'full'
                }]
            },{
                layout: 'form'
                ,columnWidth: .5
                ,defaults: { msgTarget: 'under' ,border: false }
                ,items: [{
                    xtype: 'quickstartbuttons-combo-widgetitemsperrow'
                    ,name: 'perrow'
                    ,hiddenName: 'perrow'
                    ,fieldLabel: _('quickstartbuttons.sets.buttonsperrow')
                    ,anchor: '100%'
                    ,value: 'four'
                }]
            }]
        },{
			xtype: 'xcheckbox'
			,hideLabel: true
			,boxLabel: _('quickstartbuttons.sets.active')
			,name: 'active'
		}]
	});
	QuickstartButtons.window.CreateSet.superclass.constructor.call(this,config);
};
Ext.extend(QuickstartButtons.window.CreateSet, MODx.Window);
Ext.reg('quickstartbuttons-window-sets-create', QuickstartButtons.window.CreateSet);

// ------------------
// Update window
QuickstartButtons.window.UpdateSet = function(config) {
	config = config || {};
    this.ident = config.ident || Ext.id();

	Ext.applyIf(config,{
		title: _('quickstartbuttons.sets.update')
        ,cls: 'quickstartbuttons-window-vtabs'
        ,bodyCssClass: 'window-vtabs'
        ,url: QuickstartButtons.config.connector_url
		,baseParams: { action: 'mgr/sets/update' }
        ,width: 800
        ,resizable: false
        ,maximizable: false
        ,autoHeight: true
        ,modal: true
        ,fields: [{
            xtype: 'hidden'
            ,name: 'id'
        },{
            xtype: 'modx-vtabs'
            ,width: 650
            ,autoHeight: true
            ,deferredRender: false
            ,forceLayout: true
            ,resizeTabs: false
            ,defaults: {
                border: false
                ,layout: 'form'
                ,autoHeight: true
                ,cls: 'main-wrapper'
                ,deferredRender: false
                ,forceLayout: true
            }
            ,items: [{
                title: _('quickstartbuttons.general')
                ,layout: 'form'
                ,items: [{
                    xtype: 'textfield'
                    ,name: 'name'
                    ,fieldLabel: _('quickstartbuttons.sets.name')
                    ,allowBlank: false
                    ,anchor: '100%'
                    ,maxLength: 255
                },{
                    xtype: 'textarea'
                    ,name: 'description'
                    ,fieldLabel: _('quickstartbuttons.sets.description')
                    ,allowBlank: true
                    ,anchor: '100%'
                    ,maxLength: 1024
                },{
                    layout: 'column'
                    ,border: false
                    ,defaults: { msgTarget: 'under' ,border: false }
                    ,items: [{
                        layout: 'form'
                        ,columnWidth: .5
                        ,defaults: { msgTarget: 'under' ,border: false }
                        ,items: [{
                            xtype: 'modx-combo-dashboard-widget-size'
                            ,name: 'size'
                            ,hiddenName: 'size'
                            ,fieldLabel: _('widget_size')
                            ,description: _('widget_size_desc')
                            ,anchor: '100%'
                        }]
                    },{
                        layout: 'form'
                        ,columnWidth: .5
                        ,defaults: { msgTarget: 'under' ,border: false }
                        ,items: [{
                            xtype: 'quickstartbuttons-combo-widgetitemsperrow'
                            ,name: 'perrow'
                            ,hiddenName: 'perrow'
                            ,fieldLabel: _('quickstartbuttons.sets.buttonsperrow')
                            ,anchor: '100%'
                        }]
                    }]
                },{
                    xtype: 'xcheckbox'
                    ,hideLabel: true
                    ,boxLabel: _('quickstartbuttons.sets.active')
                    ,name: 'active'
                }]
            },{
                title: _('quickstartbuttons.buttons')
                ,layout: 'form'
                ,items: [{
                    html: '<p>' + _('quickstartbuttons.buttons_desc') + '</p><br/>'
                    ,border: false
                },{
                    xtype: 'quickstartbuttons-grid-buttons'
                    ,preventRender: true
                    ,setId: config.record.id
                }]
            },{
                title: _('quickstartbuttons.usergroups')
                ,layout: 'form'
                ,items: [{
                    html: '<p>' + _('quickstartbuttons.usergroups_desc') + '</p><br/>'
                    ,border: false
                },{
                    xtype: 'quickstartbuttons-grid-usergroups'
                    ,preventRender: true
                    ,setId: config.record.id
                }]
            }]
        }]
    });
    QuickstartButtons.window.UpdateSet.superclass.constructor.call(this,config);
};
Ext.extend(QuickstartButtons.window.UpdateSet, MODx.Window);
Ext.reg('quickstartbuttons-window-sets-update', QuickstartButtons.window.UpdateSet);
