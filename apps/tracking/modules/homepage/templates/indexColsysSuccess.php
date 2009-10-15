<div align="center">
<?

if( $sf_user->hasCredential("colsys_user") ){
	?>
	
	<form action="<?=url_for("homepage/indexColsys")?>" method="post">	
	<input type="hidden" name="idcliente" id="idcliente" />
	<table width="45%" border="1" class="table1">
		<tr>
			<th colspan="3" scope="col">Por favor seleccione un cliente</th>
		</tr>		
		<tr >
		  <td ><div align="left">
		    <input type="text" name="cliente" id="cliente" />
	      </div></td>
	  </tr>
		<tr >
		  <td ><div align="center">
		    <input type="submit"  value="Continuar" />
		    </div></td>
	  </tr>
	</table>
	
	
	
	</form>
	<script language="javascript">
		Ext.onReady(function(){
			
			var ds = new Ext.data.Store({
				proxy: new Ext.data.HttpProxy({
					url: '<?=url_for('general/listaClientesJSON')?>'
				}),
				reader: new Ext.data.JsonReader({
					root: 'clientes',
					totalProperty: 'totalCount',
					id: 'id'
				}, [
					 {name: 'idcliente', mapping: 'ca_idcliente'},
         			 {name: 'compania', mapping: 'ca_compania'}
				])
			});
		
			//var data_productos = <?//json_encode();?>
			
			var resultTpl = new Ext.XTemplate( 
				'<tpl for="."><div class="search-item">{compania}<br /></div></tpl>' 
			);
			
			
			new Ext.form.ComboBox({
					store: ds,
					fieldLabel: 'Cliente',
					displayField:'compania',
					typeAhead: false,
					loadingText: 'Buscando...',
					valueNotFoundText: 'No encontrado' ,
					minChars: 1,				        
					tpl: resultTpl,
					itemSelector: 'div.search-item',		
					emptyText:'Escriba el nombre del cliente...',
					value: '',		
					forceSelection:true,		
					selectOnFocus:true,
					allowBlank:false,
					applyTo: 'cliente',
					width: 320,
					
					
					onSelect: function(record, index){ // override default onSelect to do redirect		
						if(this.fireEvent('beforeselect', this, record, index) !== false){
							this.setValue(record.data[this.valueField || this.displayField]);
							this.collapse();
							this.fireEvent('select', this, record, index);
						}
						
						document.getElementById("idcliente").value = record.get("idcliente");
						
					}
				})
			
		});
		</script>
	
<?
}
?>
</div>

