var QuickstartButtons = function(config) {
    config = config || {};
    QuickstartButtons.superclass.constructor.call(this, config);
};

Ext.extend(QuickstartButtons, Ext.Component,{
    page:{}, window:{}, grid:{}, tree:{}, panel:{}, combo:{}, config:{}
});
Ext.reg('quickstartbuttons', QuickstartButtons);

QuickstartButtons = new QuickstartButtons();