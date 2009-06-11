
<div style="display:none">

</div>	
<input type="text" name="reporte" id="reporte" value="" size="10" Autocomplete="off" />			
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

<script language="javascript">
 Ext.onReady(function(){

    var ds = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for("widgets/datosComboReportes".$params)?>'
			
        }),
        reader: new Ext.data.JsonReader({
            root: 'reportes',
            totalProperty: 'totalCount'            
        }, [
            {name: 'idreporte', mapping: 'ca_idreporte'},
            {name: 'consecutivo', mapping: 'ca_consecutivo'}
			
        ])
    });
	
	/*
	var resultTpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item"><b>{compania}</b><br /><span>{nombre} {papellido} {sapellido} <br />{cargo}</span> </div></tpl>' 
			
    );*/
    
    var search = new Ext.form.ComboBox({
        store: ds,
		 id: 'reporte',
        displayField:'consecutivo',
		valueField:'consecutivo',
        typeAhead: false,
        loadingText: 'Buscando...',
        width: 160,
        valueNotFoundText: 'No encontrado' ,
		minChars: 1,
        hideTrigger:false,
        //tpl: resultTpl,
        applyTo: 'reporte',
        //itemSelector: 'div.search-item',		
	    emptyText:'',		
	    forceSelection:true,		
		selectOnFocus:true,
				
    });
});
</script>						