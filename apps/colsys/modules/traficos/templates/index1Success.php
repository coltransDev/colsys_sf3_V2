<?
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Headers: X-Requested-With'); 
?>
<script language="javascript" type="text/javascript">
	function habilitar( field, checked ){
	
		//alert(field.getRawValue()+" "+checked);
		
		if( field.getRawValue()=="activos" && checked ){
			Ext.getCmp("reporte").disable();
			Ext.getCmp("cliente").enable();			
		}
		
		if( field.getRawValue()=="reporte" && checked ){	
			Ext.getCmp("reporte").enable();
			Ext.getCmp("cliente").disable();			
		}
	}
	
</script>

<div class="content" align="center" >
	
	
	<div id="panel"></div>
</div>
<script language="javascript" type="text/javascript">
    
   

    Ext.Ajax.cors = true;    
    Ext.lib.Ajax.isCrossDomain = function(u) {
	var match = /(?:(\w*:)\/\/)?([\w\.]*(?::\d*)?)/.exec(u);
	if (!match[1]) return false; // No protocol, not cross-domain
	return (match[1] != location.protocol) || (match[2] != location.host);
};

Ext.override(Ext.data.Connection, {

    request : function(o){
        if(this.fireEvent("beforerequest", this, o) !== false){
            var p = o.params;

            if(typeof p == "function"){
                p = p.call(o.scope||window, o);
            }
            if(typeof p == "object"){
                p = Ext.urlEncode(p);
            }
            if(this.extraParams){
                var extras = Ext.urlEncode(this.extraParams);
                p = p ? (p + '&' + extras) : extras;
            }

            var url = o.url || this.url;
            if(typeof url == 'function'){
                url = url.call(o.scope||window, o);
            }

            if(o.form){
                var form = Ext.getDom(o.form);
                url = url || form.action;

                var enctype = form.getAttribute("enctype");
                if(o.isUpload || (enctype && enctype.toLowerCase() == 'multipart/form-data')){
                    return this.doFormUpload(o, p, url);
                }
                var f = Ext.lib.Ajax.serializeForm(form);
                p = p ? (p + '&' + f) : f;
            }

            var hs = o.headers;
            if(this.defaultHeaders){
                hs = Ext.apply(hs || {}, this.defaultHeaders);
                if(!o.headers){
                    o.headers = hs;
                }
            }

            var cb = {
                success: this.handleResponse,
                failure: this.handleFailure,
                scope: this,
                argument: {options: o},
                timeout : this.timeout
            };

            var method = o.method||this.method||(p ? "POST" : "GET");

            if(method == 'GET' && (this.disableCaching && o.disableCaching !== false) || o.disableCaching === true){
                url += (url.indexOf('?') != -1 ? '&' : '?') + '_dc=' + (new Date().getTime());
            }

            if(typeof o.autoAbort == 'boolean'){ // options gets top priority
                if(o.autoAbort){
                    this.abort();
                }
            }else if(this.autoAbort !== false){
                this.abort();
            }
            if((method == 'GET' && p) || o.xmlData || o.jsonData){
                url += (url.indexOf('?') != -1 ? '&' : '?') + p;
                p = '';
            }
            if (o.scriptTag || this.scriptTag || Ext.lib.Ajax.isCrossDomain(url)) {
               this.transId = this.scriptRequest(method, url, cb, p, o);
            } else {
               this.transId = Ext.lib.Ajax.request(method, url, cb, p, o);
            }
            return this.transId;
        }else{
            Ext.callback(o.callback, o.scope, [o, null, null]);
            return null;
        }
    },
    
    scriptRequest : function(method, url, cb, data, options) {
        var transId = ++Ext.data.ScriptTagProxy.TRANS_ID;
        var trans = {
            id : transId,
            cb : options.callbackName || "stcCallback"+transId,
            scriptId : "stcScript"+transId,
            options : options
        };

        url += (url.indexOf("?") != -1 ? "&" : "?") + data + String.format("&{0}={1}", options.callbackParam || this.callbackParam || 'callback', trans.cb);

        var conn = this;
        window[trans.cb] = function(o){
            conn.handleScriptResponse(o, trans);
        };

//      Set up the timeout handler
        trans.timeoutId = this.handleScriptFailure.defer(cb.timeout, this, [trans]);

        var script = document.createElement("script");
        script.setAttribute("src", url);
        script.setAttribute("type", "text/javascript");
        script.setAttribute("id", trans.scriptId);
        document.getElementsByTagName("head")[0].appendChild(script);

        return trans;
    },

    handleScriptResponse : function(o, trans){
        this.transId = false;
        this.destroyScriptTrans(trans, true);
        var options = trans.options;
        
//      Attempt to parse a string parameter as XML.
        var doc;
        if (typeof o == 'string') {
            if (window.ActiveXObject) {
                doc = new ActiveXObject("Microsoft.XMLDOM");
                doc.async = "false";
                doc.loadXML(o);
            } else {
                doc = new DOMParser().parseFromString(o,"text/xml");
            }
        }

//      Create the bogus XHR
        response = {
            responseObject: o,
            responseText: (typeof o == "object") ? Ext.util.JSON.encode(o) : String(o),
            responseXML: doc,
            argument: options.argument
        }
        this.fireEvent("requestcomplete", this, response, options);
        Ext.callback(options.success, options.scope, [response, options]);
        Ext.callback(options.callback, options.scope, [options, true, response]);
    },
    
    handleScriptFailure: function(trans) {
        this.transId = false;
        this.destroyScriptTrans(trans, false);
        var options = trans.options;
        response = {
            argument:  options.argument,
            status: 500,
            statusText: 'Server failed to respond',
            responseText: ''
        };
        this.fireEvent("requestexception", this, response, options, {
            status: -1,
            statusText: 'communication failure'
        });
        Ext.callback(options.failure, options.scope, [response, options]);
        Ext.callback(options.callback, options.scope, [options, false, response]);
    },
    
    // private
    destroyScriptTrans : function(trans, isLoaded){
        document.getElementsByTagName("head")[0].removeChild(document.getElementById(trans.scriptId));
        clearTimeout(trans.timeoutId);
        if(isLoaded){
            window[trans.cb] = undefined;
            try{
                delete window[trans.cb];
            }catch(e){}
        }else{
            // if hasn't been loaded, wait for load to remove it to prevent script error
            window[trans.cb] = function(){
                window[trans.cb] = undefined;
                try{
                    delete window[trans.cb];
                }catch(e){}
            };
        }
    }
});



	Ext.onReady(function(){
            
            


/* Ext.Ajax.request({
     url: 'http://localhost:8152/',
     timeout: 60000
 });*/
 
		
		 var ds = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for("widgets/datosComboClientes")?>'
        }),
        reader: new Ext.data.JsonReader({
            root: 'clientes',
            totalProperty: 'totalCount',
            id: 'id'
        }, [
            {name: 'id', mapping: 'ca_idcliente'},
            {name: 'compania', mapping: 'ca_compania'},
			
			{name: 'preferencias', mapping: 'ca_preferencias'},
			{name: 'confirmar', mapping: 'ca_confirmar'},
           
        ])
    });
	
	var resultTpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item"><b>{compania}</b><br /><span>{nombre} {papellido} {sapellido} <br />{cargo}</span> </div></tpl>' 
			
    );
    
    var comboClientes = new Ext.form.ComboBox({
        store: ds,
		id:'cliente',
        displayField:'compania',
        typeAhead: false,
        loadingText: 'Buscando...',
        width: 320,
        valueNotFoundText: 'No encontrado' ,
		minChars: 1,
        hideTrigger:false,
		hideLabel: true,
        tpl: resultTpl,
		allowBlank : false, 
        //applyTo: 'cliente',
		//renderTo:"comboClientes",
        itemSelector: 'div.search-item',		
	    emptyText:'Escriba el nombre del cliente...',		
	    forceSelection:true,		
		selectOnFocus:true,
		
		onSelect: function(record, index){ // override default onSelect to do redirect			
			if(this.fireEvent('beforeselect', this, record, index) !== false){
				this.setValue(record.data[this.valueField || this.displayField]);
				this.collapse();
				this.fireEvent('select', this, record, index);
			}
			

			Ext.getCmp("idcliente").setValue(record.data.id);          
        }
    });

	
	<?
	
	
	
	$params = "";
	if( isset($impoexpo)){
		if( $params=="" ){
			$params.="?";
		}else{
			$params.="&";
		}
		$params .= "impoexpo=".utf8_encode($impoexpo);
	}
	
	
	if( isset($transporte)){
		if( $params=="" ){
			$params.="?";
		}else{
			$params.="&";
		}
		$params .= "transporte=".utf8_encode($transporte);
	}
	?>
	
        



        
		
	var ds1 = new Ext.data.Store({        
        scriptTag: true,
        restful:true,
        //url: 'https://127.0.0.1:8152',
        proxy: new Ext.data.HttpProxy({
            //url: '<?=url_for("widgets/datosComboReportes".$params)?>'
            //url: 'https://127.0.0.1:8152'//,
            //url: 'https://10.192.1.103:8152',
            url: 'https://10.192.1.70:8152',
            type:'json'
        }),
        reader: new Ext.data.JsonReader({
            type:'json',
            root: 'reportes',
            totalProperty: 'totalCount'            
        }, [
            {name: 'idreporte', mapping: 'ca_idreporte'},
            {name: 'consecutivo', mapping: 'ca_consecutivo'}
        ])
    });
    
    var ds = new Ext.data.JsonStore({
    // store configs
    autoDestroy: true,
    url: 'https://10.192.1.70:8152',
    storeId: 'myStore',
    // reader configs
    root: 'reportes',
    totalProperty: 'totalCount',    
    fields: [ {name: 'ca_idreporte', mapping: 'ca_idreporte'},
            {name: 'ca_consecutivo', mapping: 'ca_consecutivo'}]
});
	
	
    var comboReporte = new Ext.form.ComboBox({
        store: ds,
	id: 'reporte',
        displayField:'ca_consecutivo',
	valueField:'ca_consecutivo',
        typeAhead: false,
        loadingText: 'Buscando...',
        width: 160,
        valueNotFoundText: 'No encontrado' ,
	minChars: 1,
        hideTrigger:false,
	hideLabel: true	,
	disabled : true ,
	allowBlank : false, 		
        //tpl: resultTpl,
        //applyTo: 'reporte',
        //itemSelector: 'div.search-item',		
	emptyText:'',		
	forceSelection:true,		
        selectOnFocus:true
				
    });

		
		
		
	var mainPanel = new Ext.FormPanel({
      
        frame:true,
        title: 'Modulo de status de tráficos',
        bodyStyle:'padding:5px 5px 0',
        width: 450,
        defaults: {width: 330},
        defaultType: 'textfield',
		standardSubmit: true, 
		/*url: '<?=url_for("traficos/listaStatus?modo=".$modo)?>',*/

        items: [
			{
				xtype:'hidden',
				id: 'idcliente',
				name: 'idcliente'
				
			},
			new  Ext.form.Radio({
				name : 'tipo',
				boxLabel : 'Ver reportes activos',
				hideLabel: true,
				checked : true,
				inputValue  : 'activos', 
				handler : habilitar		
			})
			,
			
			comboClientes,
			new  Ext.form.Radio({
				name : 'tipo',
				boxLabel :'Por n&uacute;mero de reporte',
				hideLabel: true,
				inputValue  : 'reporte', 				
				handler : habilitar
								
			})
			,
			comboReporte
			
        ],

       buttons: [{
	            text: 'Continuar',
	            handler: function(){
					
	            	if( mainPanel.getForm().isValid() ){
						
						var queryStr = "";
						//alert(  mainPanel.getForm().findField("tipo").getValue() + " "+mainPanel.getForm().findField("tipo").getRawValue() );
						if( mainPanel.getForm().findField("tipo").getRawValue()=="activos" && mainPanel.getForm().findField("tipo").getValue() ){
							queryStr = "?idcliente="+mainPanel.getForm().findField("idcliente").getValue();
						}else{	
							queryStr = "?reporte="+mainPanel.getForm().findField("reporte").getValue();		
						}
												
						document.location = '<?=url_for("traficos/listaStatus?modo=".$modo)?>'+queryStr
	            		
					}else{
						Ext.MessageBox.alert('Error:', '¡Atención: La información está incompleta!');
					}	            	
	            }
	        }
			]
    });

    mainPanel.render("panel");

		/*	
		var ver = document.form1.ver
		var value='';	
		for (i=0;i<ver.length;i++){
			  if ( ver[i].checked ){
					 value = ver[i].value;
			  }
		} 
	
		habilitar(value);*/
	});
</script>
