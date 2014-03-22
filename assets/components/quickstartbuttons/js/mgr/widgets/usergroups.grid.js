QuickstartButtons.grid.UserGroups = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        id: 'quickstartbuttons-grid-usergroups'
		,url: QuickstartButtons.config.connector_url
		,baseParams: { action: 'mgr/usergroups/getList' ,id: config.setId }
		,fields: ['usergroup','set','name']
		,paging: true
        ,pageSize: 6
		,remoteSort: true
		,anchor: '97%'
		,autoExpandColumn: 'name'
		,columns: [{
			header: _('quickstartbuttons.usergroups.name')
			,dataIndex: 'name'
			,sortable: true
		}]
        ,tbar: [{
            text: _('quickstartbuttons.usergroups.add')
			,handler: {
				xtype: 'quickstartbuttons-window-usergroups-add'
				,blankValues: true
                ,setId: config.setId
			}
        }]
    });

    QuickstartButtons.grid.UserGroups.superclass.constructor.call(this, config);
};

Ext.extend(QuickstartButtons.grid.UserGroups, MODx.grid.Grid, {
    getMenu: function() {
		var m = [{
			text: _('quickstartbuttons.usergroups.remove')
			,handler: this.removeUserGroup
		}];
		return m;
	}
    ,removeUserGroup: function(btn, e) {
		MODx.msg.confirm({
			title: _('quickstartbuttons.usergroups.remove'),
			text: _('quickstartbuttons.usergroups.remove_confirm', { name: this.menu.record.name }),
			url: this.config.url,
			params: {
				action: 'mgr/usergroups/remove'
				,usergroup: this.menu.record.usergroup
				,set: this.menu.record.set
			},
			listeners: {
				'success': { fn:this.refresh, scope:this }
			}
		});
	}
});
Ext.reg('quickstartbuttons-grid-usergroups', QuickstartButtons.grid.UserGroups);