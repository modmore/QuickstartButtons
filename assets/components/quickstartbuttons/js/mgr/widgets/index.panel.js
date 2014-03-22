QuickstartButtons.panel.Index = function(config) {
    config = config || {};
    Ext.apply(config, {
        border: false
		,baseCls: 'modx-formpanel'
		,cls: 'container'
		,defaults: { collapsible: false ,autoHeight: true }
		,items: [{
			html: '<h2>'+_('quickstartbuttons.manage')+'</h2>'
			,border: false
			,cls: 'modx-page-header'
		},{
			defaults: { border: false, autoHeight: true }
			,items: [{
				html: '<p>' + _('quickstartbuttons.sets_desc') + '</p>'
				,bodyCssClass: 'panel-desc'
			},{
				xtype: 'quickstartbuttons-grid-sets'
				,preventRender: true
				,cls: 'main-wrapper'
			}]
		}]
    });

    QuickstartButtons.panel.Index.superclass.constructor.call(this, config);
};

Ext.extend(QuickstartButtons.panel.Index, MODx.Panel);
Ext.reg('quickstartbuttons-panel-index', QuickstartButtons.panel.Index);