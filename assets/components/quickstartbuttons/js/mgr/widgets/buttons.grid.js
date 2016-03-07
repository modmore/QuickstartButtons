QuickstartButtons.grid.Buttons = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        id: 'quickstartbuttons-grid-buttons'
		,url: QuickstartButtons.config.connector_url
		,baseParams: { action: 'mgr/buttons/getList' ,id: config.setId }
		,save_action: 'mgr/buttons/updateFromGrid'
		,autosave: true

		,fields: ['id','set','icon','icon_ms','icon_file','iconcls','iconpath','text','description','ranking','action_id','action_key','action_namespace','action_props','handler','link','newwindow','active']
		,paging: true
        ,pageSize: 6
		,remoteSort: true
		,anchor: '97%'
		,autoExpandColumn: 'text'
		,columns: [{
			header: _('quickstartbuttons.buttons.text')
			,dataIndex: 'text'
			,sortable: true
			,editor: { xtype: 'textfield' ,allowBlank: false ,maxLength: 255 }
            ,renderer: this.renderTextField.createDelegate(this,[this],true)
		},{
			header: _('quickstartbuttons.buttons.description')
			,dataIndex: 'description'
			,sortable: true
			,editor: { xtype: 'textfield' ,allowBlank: false }
		},{
			header: _('quickstartbuttons.buttons.ranking')
			,dataIndex: 'ranking'
			,sortable: true
            ,width: 25
			,editor: { xtype: 'numberfield' ,allowBlank: true ,allowDecimals: false ,allowNegative: false ,minValue: 0 }
		},{
			header: _('quickstartbuttons.buttons.active')
			,dataIndex: 'active'
			,sortable: true
			,width: 40
			,renderer: this.renderYNfield.createDelegate(this,[this],true)
			,editor: { xtype: 'combo-boolean' }
		}]
        ,tbar: [{
            text: _('quickstartbuttons.buttons.create')
			,handler: {
				xtype: 'quickstartbuttons-window-button-createupdate'
				,blankValues: true
                ,isUpdate: false
                ,setId: config.setId
			}
        },'->',{
			xtype: 'textfield'
			,id: 'buttons-search-filter'
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
		}]
    });

    QuickstartButtons.grid.Buttons.superclass.constructor.call(this, config);
};

Ext.extend(QuickstartButtons.grid.Buttons, MODx.grid.Grid, {
    search: function(tf, nv, ov) {
        var s = this.getStore();
        s.baseParams.query = tf.getValue();
        this.getBottomToolbar().changePage(1);
        this.refresh();
    }
    ,getMenu: function() {
		var m = [{
            text: _('quickstartbuttons.buttons.update')
            ,handler: this.updateButton
        },'-',{
			text: _('quickstartbuttons.buttons.remove')
			,handler: this.removeButton
		}];
		return m;
	}
    ,updateButton: function(btn, e) {
		var record = Ext.apply({}, this.menu.record);
		record.action_id = record.action_id || record.action_key;

        var w = MODx.load({
			xtype: 'quickstartbuttons-window-button-createupdate'
			,record: record
            ,isUpdate: true
			,listeners: {
				'success': { fn: this.refresh ,scope: this }
				,'hide': { fn: function() { this.destroy(); }}
			}
		});
		w.setValues(record);
        w.setTitle(_('quickstartbuttons.buttons.update') + ': ' + this.menu.record.text);
		w.show(e.target, function() {
			Ext.isSafari ? w.setPosition(null,30) : w.center();
		}, this);
    }
    ,removeButton: function(btn, e) {
		MODx.msg.confirm({
			title: _('quickstartbuttons.buttons.remove'),
			text: _('quickstartbuttons.buttons.remove_confirm', { text: this.menu.record.text }),
			url: this.config.url,
			params: {
				action: 'mgr/buttons/remove',
				id: this.menu.record.id
			},
			listeners: {
				'success': { fn:this.refresh, scope:this }
			}
		});
	}
    /** SOME RENDERS **/
	,renderTextField: function(v,md,rec,ri,ci,s,g) {
        var r = s.getAt(ri).data;

        if(!Ext.isEmpty(r.iconpath)) {
            return '<i class="icon" style="background-image: url(' + r.iconpath + ')"></i> ' + v;
        }

        return '<i class="fa fa-larger ' + r.iconcls + '"></i> ' + v;
    }
	,renderYNfield: function(v,md,rec,ri,ci,s,g) {
        var r = s.getAt(ri).data;
        v = Ext.util.Format.htmlEncode(v);
        var f = MODx.grid.Grid.prototype.rendYesNo;
        return f(v,md,rec,ri,ci,s,g);
    }
});
Ext.reg('quickstartbuttons-grid-buttons', QuickstartButtons.grid.Buttons);