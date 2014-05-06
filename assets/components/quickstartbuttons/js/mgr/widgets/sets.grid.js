QuickstartButtons.grid.Sets = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        id: 'quickstartbuttons-grid-sets'
		,url: QuickstartButtons.config.connector_url
		,baseParams: { action: 'mgr/sets/getList' }
		,save_action: 'mgr/sets/updateFromGrid'
		,autosave: true
		
		,fields: ['id','name','description','size','perrow','btnscount','usergroups','active']
		,paging: true
		,remoteSort: true
		,anchor: '97%'
		,autoExpandColumn: 'name'
		,columns: [{
			header: _('quickstartbuttons.sets.name')
			,dataIndex: 'name'
			,sortable: true
			,editor: { xtype: 'textfield' ,allowBlank: false ,maxLength: 255 }
		},{
			header: _('quickstartbuttons.sets.description')
			,dataIndex: 'description'
			,sortable: true
            ,editor: { xtype: 'textfield' ,allowBlank: true }
		},{
			header: _('quickstartbuttons.sets.btnscount')
			,dataIndex: 'btnscount'
			,sortable: true
            ,editable: false
		},{
			header: _('quickstartbuttons.sets.usergroups')
			,dataIndex: 'usergroups'
			,sortable: true
            ,editable: false
            ,renderer: this.renderUserGroups.createDelegate(this,[this],true)
		},{
			header: _('quickstartbuttons.sets.active')
			,dataIndex: 'active'
			,sortable: true
			,width: 40
			,renderer: this.renderYNfield.createDelegate(this,[this],true)
			,editor: { xtype: 'combo-boolean' }
		}],
		tbar: [{
			text: _('quickstartbuttons.sets.create')
			,handler: {
				xtype: 'quickstartbuttons-window-sets-create'
				,blankValues: true
			}
		},'->',{
			xtype: 'textfield'
			,id: 'sets-search-filter'
			,emptyText: _('quickstartbuttons.search')
			,listeners: {
				'change': { fn: this.search, scope:this }
				,'render': { fn: function(tf) {
						tf.getEl().addKeyListener(Ext.EventObject.ENTER, function() {
							this.search(tf);
						}, this);
					},
					scope: this
				}
			}
		}],
		listeners: {
			'afterAutoSave': { fn: function(response) {
                if(response.success) {
                    this.refresh();
                }
            } ,scope: this }
		}
    });

    QuickstartButtons.grid.Sets.superclass.constructor.call(this, config);
};

Ext.extend(QuickstartButtons.grid.Sets, MODx.grid.Grid, {
	search: function(tf, nv, ov) {
        var s = this.getStore();
        s.baseParams.query = tf.getValue();
        this.getBottomToolbar().changePage(1);
        this.refresh();
    }
    ,getMenu: function() {
		var m = [{
            text: _('quickstartbuttons.sets.update')
            ,handler: this.updateSet
        },{
            text: _('quickstartbuttons.sets.duplicate')
            ,handler: this.duplicateSet
        },'-',{
			text: _('quickstartbuttons.sets.remove')
			,handler: this.removeSet
		}];
		return m;
	}
    ,updateSet: function(btn, e) {
        var w = MODx.load({
			xtype: 'quickstartbuttons-window-sets-update'
			,record: this.menu.record
			,listeners: {
				'success': { fn: this.refresh ,scope: this }
				,'hide': { fn: function() {
                    w.destroy();
                    this.refresh();
                } ,scope: this}
			}
		});
		w.setValues(this.menu.record);
        w.setTitle(_('quickstartbuttons.sets.update') + ': ' + this.menu.record.name);
		w.show(e.target, function() {
			Ext.isSafari ? w.setPosition(null,30) : w.center();
		}, this);
    }
    ,duplicateSet: function(btn, e) {
        MODx.Ajax.request({
            url: QuickstartButtons.config.connector_url
            ,params: {
                action: 'mgr/sets/duplicate'
                ,id: this.menu.record.id
            }
            ,listeners: {
                'success':{ fn: function() {
                    this.refresh();
                }
                ,scope:this }
            }
        });
    }
    ,removeSet: function(btn, e) {
		MODx.msg.confirm({
			title: _('quickstartbuttons.sets.remove'),
			text: _('quickstartbuttons.sets.remove_confirm', { title: this.menu.record.title }),
			url: this.config.url,
			params: {
				action: 'mgr/sets/remove',
				id: this.menu.record.id
			},
			listeners: {
				'success': { fn:this.refresh, scope:this }
			}
		});
	}
    /** SOME RENDERS **/
	,renderYNfield: function(v,md,rec,ri,ci,s,g) {
        var r = s.getAt(ri).data;
        v = Ext.util.Format.htmlEncode(v);
        var f = MODx.grid.Grid.prototype.rendYesNo;
        return f(v,md,rec,ri,ci,s,g);
    }
    ,renderUserGroups: function(v,md,rec,ri,ci,s,g) {
        if(Ext.isEmpty(v)) {
            return '<i>-- ' + _('quickstartbuttons.none') + ' --</i>';
        }
		return v;
	}
});
Ext.reg('quickstartbuttons-grid-sets', QuickstartButtons.grid.Sets);