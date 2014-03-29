// ------------------
// Create window
QuickstartButtons.window.CreateUpdateButton = function(config) {
	config = config || {};
    this.ident = config.ident || Ext.id();

    Ext.applyIf(config,{
		title: _('quickstartbuttons.sets.update')
        ,cls: 'quickstartbuttons-window-vtabs'
        ,bodyCssClass: 'window-vtabs'
        ,url: QuickstartButtons.config.connector_url
		,baseParams: {
            action: ((config.isUpdate) ? 'mgr/buttons/update' : 'mgr/buttons/create')
            ,set: config.setId || config.record.set
        }
        ,width: 650
        ,resizable: false
        ,maximizable: false
        ,modal: true
        ,fields: [{
            xtype: 'hidden'
            ,name: 'id'
        },{
            xtype: 'modx-vtabs'
            ,width: 500
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
                    layout: 'column'
                    ,border: false
                    ,defaults: { msgTarget: 'under' ,border: false }
                    ,items: [{
                        layout: 'form'
                        ,columnWidth: .5
                        ,defaults: { msgTarget: 'under' ,border: false }
                        ,items: [{
                            xtype: 'textfield'
                            ,fieldLabel: _('quickstartbuttons.buttons.text')
                            ,name: 'text'
                            ,anchor: '100%'
                            ,allowBlank: false
                        }]
                    },{
                        layout: 'form'
                        ,columnWidth: .5
                        ,defaults: { msgTarget: 'under' ,border: false }
                        ,items: [{
                            xtype: 'quickstartbuttons-combo-icons'
                            ,fieldLabel: _('quickstartbuttons.buttons.icon')
                            ,name: 'icon'
                            ,anchor: '100%'
                            ,allowBlank: false
                            ,selected: config.record.icon
                        }]
                    }]
                },{
                    xtype: 'textarea'
                    ,fieldLabel: _('quickstartbuttons.buttons.description')
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
                            xtype: 'numberfield'
                            ,fieldLabel: _('quickstartbuttons.buttons.ranking')
                            ,name: 'ranking'
                            ,anchor: '100%'
                            ,allowDecimals: false
                            ,allowNegative: false
                            ,minValue: 0
                        }]
                    },{
                        layout: 'form'
                        ,columnWidth: .5
                        ,defaults: { msgTarget: 'under' ,border: false }
                        ,items: [{ html: '<br/>' ,border: false },{
                            xtype: 'xcheckbox'
                            ,hideLabel: true
                            ,boxLabel: _('quickstartbuttons.buttons.active')
                            ,name: 'active'
                        }]
                    }]
                }]
            },{
                title: _('quickstartbuttons.buttons.link')
                ,layout: 'form'
                ,items: [{
                    html: '<p>' + _('quickstartbuttons.buttons.link_desc') + '</p><br/>'
                    ,border: false
                },{
                    xtype: 'modx-combo-action'
                    ,fieldLabel: _('quickstartbuttons.buttons.link.action')
                    ,name: 'action_id'
                    ,hiddenName: 'action_id'
                    ,anchor: '100%'
                    ,url: QuickstartButtons.config.connector_url
                    ,baseParams: {
                        action: 'mgr/common/modaction/getList'
                        ,combo: true
                        ,showNone: true
                        ,selected: config.record.action_id
                    }
                },{
                    xtype: 'textfield'
                    ,fieldLabel: _('quickstartbuttons.buttons.link.action_props')
                    ,description: _('quickstartbuttons.buttons.link.action_props_desc')
                    ,name: 'action_props'
                    ,anchor: '100%'
                },{
                    xtype: 'label'
                    ,html: _('quickstartbuttons.buttons.link.action_props_desc')
                    ,cls: 'desc-under'
                },{
                    xtype: 'textfield'
                    ,fieldLabel: _('quickstartbuttons.buttons.link.handler')
                    ,description: _('quickstartbuttons.buttons.link.handler_desc')
                    ,name: 'handler'
                    ,anchor: '100%'
                },{
                    xtype: 'textfield'
                    ,fieldLabel: _('quickstartbuttons.buttons.link.full')
                    ,name: 'link'
                    ,anchor: '100%'
                },{
                    xtype: 'xcheckbox'
                    ,hideLabel: true
                    ,boxLabel: _('quickstartbuttons.buttons.link.newwindow')
                    ,name: 'newwindow'
                }]
            }]
        }]
	});
	QuickstartButtons.window.CreateUpdateButton.superclass.constructor.call(this,config);
};
Ext.extend(QuickstartButtons.window.CreateUpdateButton, MODx.Window);
Ext.reg('quickstartbuttons-window-button-createupdate', QuickstartButtons.window.CreateUpdateButton);