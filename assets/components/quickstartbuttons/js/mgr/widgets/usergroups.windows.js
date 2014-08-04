// ------------------
// Create window
QuickstartButtons.window.AddUserGroup = function(config) {
	config = config || {};
    this.ident = config.ident || Ext.id();

	Ext.applyIf(config,{
		title: _('quickstartbuttons.usergroups.add')
		,url: QuickstartButtons.config.connector_url
		,baseParams: { action: 'mgr/usergroups/create', set: config.setId }
		,width: 450
        ,autoHeight: true
		,fields: [{
            xtype: 'quickstartbuttons-combo-usergroups'
            ,hideLabel: true
            ,anchor: '100%'
        }]
	});
	QuickstartButtons.window.AddUserGroup.superclass.constructor.call(this,config);
};
Ext.extend(QuickstartButtons.window.AddUserGroup, MODx.Window);
Ext.reg('quickstartbuttons-window-usergroups-add', QuickstartButtons.window.AddUserGroup);
