<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>


<input type="hidden" name="<?=$name?>" id="<?=$id?>" value="<?=isset($tercero)?$tercero->getCaIdtercero():""?>" />

<table border="0">
    <tr>
        <td width="332px">
            <div  id="<?=$id?>_fld"  ></div>
        </td>
        <td>
            <?=image_tag("16x16/new.gif", "onClick=nuevoTercero('$tipo', '$id') title='Nuevo $tipo'")." "?>
            <?=image_tag("16x16/edit.gif", "onClick=editarTercero('$tipo', '$id') id='editar$id' title='Editar $tipo' ".(isset($tercero)&&$tercero->getCaIdtercero()?"style='display:inline'":"style='display:none'" ))."  "?>
            <?=image_tag("16x16/delete.gif", "onClick=eliminarTercero('$id') id='eliminar$id' title='Eliminar $tipo' ".(isset($tercero)&&$tercero->getCaIdtercero()?"style='display:inline'":"style='display:none'" ))."  "?>

         </td>
    </tr>
</table>

<script type="text/javascript" >
//Consignatario
Ext.onReady(function(){

    var ds = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for("widgets/listaTercerosJSON?tipo=".$tipo)?>'
        }),
        reader: new Ext.data.JsonReader({
            root: 'terceros',
            totalProperty: 'totalCount',
            id: 'id'
        }, [
            {name: 'id', mapping: 't_ca_idtercero'},
            {name: 'nombre', mapping: 't_ca_nombre'},
			{name: 'ciudad', mapping: 'c_ca_ciudad'},
			{name: 'pais', mapping: 'p_ca_nombre'}


        ])
    });

	var resultTpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item"><strong>{nombre}</strong><br /><span><br />{ciudad} - {pais}</span> </div></tpl>'

    );

    var search = new Ext.form.ComboBox({
        store: ds,
        displayField:'nombre',
        id: "<?=$id?>_cmp",
        typeAhead: false,
        loadingText: 'Buscando...',
        width: 320,
        valueNotFoundText: 'No encontrado' ,
		minChars: 1,
        //hideTrigger:true,
        tpl: resultTpl,
        
        itemSelector: 'div.search-item',
	    emptyText:'Escriba el nombre del <?=ucfirst($tipo)?>...',
	    forceSelection:true,
        triggerAction: 'all',
        renderTo: "<?=$id?>_fld",
        
		//selectOnFocus:true,
        value: '<?=isset($tercero)?$tercero->getCaNombre():""?>',

		onSelect: function(record, index){ // override default onSelect to do redirect
			if(this.fireEvent('beforeselect', this, record, index) !== false){
				this.setValue(record.data[this.valueField || this.displayField]);
				this.collapse();
				this.fireEvent('select', this, record, index);
			}
            
			document.getElementById("<?=$id?>_fld").value=record.data.nombre;
			document.getElementById("<?=$id?>").value=record.data.id;
			document.getElementById("editar<?=$id?>").style.display="inline";
            document.getElementById("eliminar<?=$id?>").style.display="inline";

        }
    });
});


</script>