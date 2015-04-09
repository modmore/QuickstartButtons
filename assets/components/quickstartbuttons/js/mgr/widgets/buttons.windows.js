// ------------------
// Create window
QuickstartButtons.window.CreateUpdateButton = function(config) {
	config = config || {};
    config.id = this.ident = config.ident || Ext.id();

    Ext.applyIf(config,{
		title: _('quickstartbuttons.buttons.create')
        ,cls: 'quickstartbuttons-window-vtabs'
        ,bodyCssClass: 'window-vtabs'
        ,url: QuickstartButtons.config.connector_url
		,baseParams: {
            action: ((config.isUpdate) ? 'mgr/buttons/update' : 'mgr/buttons/create')
            ,set: ((config.isUpdate) ? config.record.set : config.setId)
        }
        ,width: 650
        ,resizable: false
        ,maximizable: false
        ,modal: true
        ,autoHeight: true
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
                    xtype: 'textfield'
                    ,fieldLabel: _('quickstartbuttons.buttons.text')
                    ,name: 'text'
                    ,anchor: '100%'
                    ,allowBlank: false
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
                title: _('quickstartbuttons.buttons.icon')
                ,layout: 'form'
                ,items: [/*{
                    html: '<p>' + _('quickstartbuttons.buttons.icon_desc') + '</p><br/>'
                    ,border: false
                },*/{
                    xtype: 'quickstartbuttons-combo-icons'
                    ,name: 'icon'
                    ,fieldLabel: _('quickstartbuttons.buttons.icon.preset')
                    ,anchor: '100%'
                    ,allowBlank: true
                    ,selected: config.record.icon
                },{
                    html: '<br/>'
                    ,border: false
                },{
                    html: '----- ' + _('quickstartbuttons.buttons.icon.or') + ' -----'
                    ,border: false
                    ,bodyStyle: 'text-align:center;'
                },{
                    html: '<br/>'
                    ,border: false
                },{
                    xtype: 'modx-combo-source'
                    ,id: 'quickstartbuttons-button-icon-ms-'+this.ident
                    ,name: 'icon_ms'
                    ,hiddenName: 'icon_ms'
                    ,fieldLabel: _('quickstartbuttons.buttons.icon.ms')
                    ,anchor: '100%'
                    ,allowBlank: true
                    ,listeners: {
                        'select': { fn: function(cb,rec,idx) {
                            var fileFld = Ext.getCmp('quickstartbuttons-button-icon-msbrowse-'+this.ident);
                                fileFld.config.source = rec.id;
                                fileFld.browser = null; // to make the browser load again
                                fileFld.setValue('');
                                fileFld.setDisabled(false);
                        } ,scope: this }
                        ,scope: this
                    }
                },{
                    xtype: 'modx-combo-browser'
                    ,id: 'quickstartbuttons-button-icon-msbrowse-'+this.ident
                    ,name: 'icon_file'
                    ,hiddenName: 'icon_file'
                    ,fieldLabel: _('quickstartbuttons.buttons.icon.select')
                    ,anchor: '100%'
                    ,allowBlank: true
                    ,disabled: ((config.isUpdate && !Ext.isEmpty(config.record.icon_ms)) ? false : true)
                    ,hideSourceCombo: true
                    ,allowedFileTypes: 'png,jpg,jpeg,gif,bmp,tiff'
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
                    },
                    namespaceTarget: config.id + '-namespace',
                    listeners: {
                        select: function(combo, record) {
                            console.log(combo, record);
                            var nsField = Ext.getCmp(combo.namespaceTarget),
                                value = '';
                            if (record.data.namespace && record.data.namespace.length > 0) {
                                value = record.data.namespace;
                            }
                            nsField.setValue(value);
                        }
                    }
                },{
                    xtype: 'hidden',
                    name: 'action_namespace',
                    id: config.id + '-namespace'
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
