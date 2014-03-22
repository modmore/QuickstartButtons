Ext.onReady(function() {
    MODx.load({ xtype: 'quickstartbuttons-page-index' });
});

// index page
QuickstartButtons.page.Index = function(config) {
	config = config || {};
	
	Ext.applyIf(config,{
		components: [{
			xtype: 'quickstartbuttons-panel-index',
			renderTo: 'quickstartbuttons-panel-index-div'
		}]
	});
	
	QuickstartButtons.page.Index.superclass.constructor.call(this, config);
};

Ext.extend(QuickstartButtons.page.Index, MODx.Component);
Ext.reg('quickstartbuttons-page-index', QuickstartButtons.page.Index);