/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
    * @autor Nataly Puentes
    * @return ComboBox Clientes según filtro ingresado
    * @param
    *        query : texto digitado para filtrar 
    * @date:  2016-03-31
*/
WidgetUploadButton=[
Ext.define('Colsys.Widgets.WidgetUploadButton', {
    extend: 'Ext.form.field.FileButton',
    alias: 'Colsys.Widgets.WidgetUploadButton',
    listeners: {
	afterrender: function(fileField) {
            fileField.fileInputEl.on('change', function(event) {
		var files = event.target.files;
		f = files[0];
		var reader = new FileReader();
		reader.onload = (function(File) {
        		return function(e) {
				fileInfo = e.target.result;
                                Ext.Ajax.request({
                                    waitMsg: 'Analizando...',
                                    url: '/widgets5/procesarArchivo',
                                    params :	
                                    {
                                        archivo: fileInfo
                                    },
                                    success: function(response, opts)
                                    {
                                        var res = Ext.decode(response.responseText); 
                                        if(res.reportes){
                                            var store = 'gridhouse'.getStore();
                                            store.load({
                                                params : {
                                                ca_reporte:res.reportes[0],
                                                }
                                            });
                                            console.log(res.reportes);
                                        }
                                        if(res.referencias){
                                            console.log("referencias");
                                            console.log(res.referencias);
                                        }
                                        
                                        /*console.log("referencias");
                                        console.log(res.referencias);*/
                                    }
                                });
				//console.log(fileInfo);
			};
       		})(f);		
		reader.readAsText(f, 'UTF-8');
            });
        }
    },
        initComponent: function() {
            var me = this;
            Ext.applyIf(me, {
                loadingText: 'Loading...',
                store: {type: 'roletemplatesremote'}
            });
            me.callParent(arguments);
            //me.getStore().on('beforeload', this.beforeTemplateLoad, this);
        }    
})]
    
/*Ext.apply(this, config);

        if( !this.actionURL ){
            this.actionURL = "/gestDocumental/subirArchivo";
        }*/
/*
WidgetUploadButton = function( config ){
        
        Ext.apply(this, config);

        if( !this.actionURL ){
            this.actionURL = "gestDocumental/subirArchivo";
        }

       
       
        WidgetUploadButton.superclass.constructor.call(this, {
            listeners: {
                afterrender : function(button){
                    button.wrap = button.el.wrap();
                    button.wrap.setStyle({position:'relative',overflow:'hidden'});
                    var width = button.wrap.getWidth();
                    this.fileForm = button.wrap.createChild({
                        tag: 'form',
                        method: 'post',
                        action: this.actionURL
                    });
                    
                   

                    button.fileInput = this.fileForm.createChild({
                        name: 'file',
                        style: 'position: absolute; top: 0px; font-size: '+(width*0.5)+'px; left: -'+(width*1.5)+'px; border: none; cursor: pointer',
                        tag: 'input',
                        type: 'file',
                        size: 1
                    });
                    if (button.handleMouseEvents) {
                        button.fileInput.on('mouseover', button.onMouseOver, button);
                        button.fileInput.on('mousedown', button.onMouseDown, button);
                    }
                    button.fileInput.setOpacity(0.0);
                    button.resizeEl = button.positionEl = button.wrap;
                    button.fileInput.on('change',function(){
                        this.fileUpload();
                    }.createDelegate(this));
                }.createDelegate(this)
            }
        });
    };

    Ext.extend(WidgetUploadButton, Ext.Button, {
        fileUpload : function(){
            this.actionFileUpload();
        },
        actionFileUpload :  function(){
            var update = this.update;
            var confirm = this.confirm;
            this.actionDo({
                form: this.fileForm,
                isUpload: true,
                params: {
                    action: "file_upload",
                    filePrefix: this.filePrefix,
                    folder: this.folder
                },
                successCallback: function(response,con){
                    if ( response.filename ){
                        //this.fileStore.reload();
                        //alert( update );
                        if(!this.callback)
                        {
                            if( update ){
                                console.log(document);
                                //document.getElementById(update).innerHTML = "<a href='<?=url_for("gestDocumental/verArchivo?idarchivo=")?>"+Base64.encode(response.folder+"/"+response.filename)+"'>"+response.filename+"</a>";
                            }
                        }
                        else
                        {
                            jQuery.globalEval(this.callback+"('"+response.filename+"');");
                        }

                            if( confirm ){
                                Ext.MessageBox.alert("", "El archivo "+response.filename+" se ha subido correctamente.");
                            }

                        
                    }
                    
                }
                //successMessage: this.ldic.ok_file_upload,
                //failureMessage: this.ldic.error_file_not_upload
            });
            this.fileForm.dom.reset();
        },
        actionDo : function(config){
            var connection = new Ext.data.Connection().request({
                url: this.actionURL,
                method: "POST",
                params: Ext.isDefined(config.params)?config.params:{},
                form : Ext.isDefined(config.form)?config.form:false,
                isUpload : Ext.isDefined(config.isUpload)?config.isUpload:false,
                successCallback: Ext.isFunction(config.successCallback)?config.successCallback.createDelegate(this):false,
                failureCallback: Ext.isFunction(config.failureCallback)?config.failureCallback.createDelegate(this):false,
                successMessage: Ext.isDefined(config.successMessage)?config.successMessage:false,
                failureMessage: Ext.isDefined(config.failureMessage)?config.failureMessage:false,
                success: function(o,con) {
                    var response = false;
                    if (o.responseText && o.responseText.indexOf('success')>-1){
                        response = Ext.util.JSON.decode(o.responseText);
                    }
                    if (response && response.success == true) {
                        if (Ext.isString(response.folder) && response.folder=='') response.folder='root';
                        if (con.successMessage){
                            this.showOk(con.successMessage);
                        }
                        if (con.successCallback) {
                            con.successCallback(response,con);
                        }
                    } else {
                        if (response && response.message) {
                            this.showError(response.message);
                        } else {
                            if (con.failureMessage){
                                this.showError(con.failureMessage);
                            }
                        }
                        if (con.failureCallback) {
                            con.failureCallback(con);
                        }
                    }
                }.createDelegate(this),
                failure: function(o,con) {
                    if (con.failureCallback) {
                        con.failureCallback.createDelegate(this,[con]);
                    }
                    //this.showError(this.ldic.error_no_connection);
                    this.showError("Error de Conexión");
                }.createDelegate(this)
            });
        }

    });
*/