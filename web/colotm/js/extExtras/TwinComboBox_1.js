/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

Ext.namespace('Ext.ux.form');
Ext.ux.form.TwinComboBox = Ext.extend(Ext.form.ComboBox, {
  getTrigger : Ext.form.TwinTriggerField.prototype.getTrigger,
  initTrigger : Ext.form.TwinTriggerField.prototype.initTrigger,
  trigger1Class : 'x-form-clear-trigger',
  hideTrigger1 : true,

  initComponent : function() {
    Ext.ux.form.TwinComboBox.superclass.initComponent.call(this);

    this.triggerConfig = {
      tag : 'span',
      cls : 'x-form-twin-triggers',
      cn : [{
        tag : 'img',
        src : Ext.BLANK_IMAGE_URL,
        cls : 'x-form-trigger ' + this.trigger1Class
      }, {
        tag : 'img',
        src : Ext.BLANK_IMAGE_URL,
        cls : 'x-form-trigger ' + this.trigger2Class
      }]
    };
  },

  reset : Ext.form.Field.prototype.reset.createSequence(function() {
    this.triggers[0].hide();
  }),

  onViewClick : Ext.form.ComboBox.prototype.onViewClick.createSequence(function() {
    this.triggers[0].show();
  }),

  onTrigger2Click : function() {
    this.onTriggerClick();
  },

  onTrigger1Click : function() {
    this.clearValue();
    this.triggers[0].hide();
    this.fireEvent('clear', this);
  }
});
Ext.ComponentMgr.registerType('twincombo', Ext.ux.form.TwinComboBox);