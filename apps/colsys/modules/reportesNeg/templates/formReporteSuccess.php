<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("reportesNeg","mainPanel");

$traficos = $sf_data->getRaw("traficos");
$reporte = $sf_data->getRaw("reporte");
$modalidadesAduana = $sf_data->getRaw("modalidadesAduana");
$bodegas = $sf_data->getRaw("bodegas");
$agentes = $sf_data->getRaw("agentes");
?>
<script language="javascript">

    var guardar = function( opcion ){
        document.getElementById("opcion").value = opcion;
        document.form1.submit();
    }

    var traficos = <?=json_encode($traficos)?>;
    var cambiarImpoexpo = function(){
        var clase = document.getElementById("reporte_ca_impoexpo").value;

        //Cambia la información de los traficos dependiendo si es impo o expo
        var fldTrafico = document.getElementById("country_reporte_ca_origen");

        if( clase=="<?=Constantes::EXPO?>" ){
            fldTrafico.length=0;
            fldTrafico[fldTrafico.length] = new Option('Colombia','CO-057',false,false);
        }else{
            fldTrafico.length=0;
            for( i in traficos ){               
                if( typeof(traficos[i]['ca_idtrafico'])!="undefined" ){
                    fldTrafico[fldTrafico.length] = new Option(traficos[i]['ca_nombre'],traficos[i]['ca_idtrafico'],false,false);
                }
            }
        }

        <?
        if( $ca_traorigen ){
            $value = $ca_traorigen;
        }else{
            $value = $reporte->getOrigen()->getCaIdtrafico();
        }
        ?>
        fldTrafico.value = '<?=$value?>';
        <?
        if( $ca_origen ){
            $value = $ca_origen;
        }else{
            $value = $reporte->getCaOrigen();
        }
        ?>
        llenarCiudades("country_reporte_ca_origen", "reporte_ca_origen", false, '<?=$value?>' );


        //Hace el mismo procedimiento parqa eldestino
        var fldTrafico = document.getElementById("country_reporte_ca_destino");

        if( clase!="<?=Constantes::EXPO?>" && clase!="<?=Constantes::TRIANGULACION?>"){
            fldTrafico.length=0;
            fldTrafico[fldTrafico.length] = new Option('Colombia','CO-057',false,false);
        }else{
            fldTrafico.length=0;
            for( i in traficos ){
                if( typeof(traficos[i]['ca_idtrafico'])!="undefined" ){
                    fldTrafico[fldTrafico.length] = new Option(traficos[i]['ca_nombre'],traficos[i]['ca_idtrafico'],false,false);
                }
            }
        }

        <?
        if( $ca_tradestino ){
            $value = $ca_tradestino;
        }else{
            $value = $reporte->getDestino()->getCaIdtrafico();
        }
        ?>
        fldTrafico.value = '<?=$value?>';
        <?
        if( $ca_destino ){
            $value = $ca_destino;
        }else{
            $value = $reporte->getCaDestino();
        }
        ?>
        llenarCiudades("country_reporte_ca_destino", "reporte_ca_destino", false, '<?=$value?>' );




        //Muestra u oculta los combos de proveedor, consignatario etc.
        if( clase=="<?=Constantes::EXPO?>"  ){
             document.getElementById("combo-proveedor").style.display="none";
             document.getElementById("combo-representante").style.display="none";
             document.getElementById("combo-master").style.display="none";

             document.getElementById("consignar-impo").style.display="none";
             document.getElementById("consignar-expo").style.display="";

             document.getElementById("expo-div").style.display="";
             document.getElementById("continuacion-div").style.display="none";
             
             document.getElementById("incoterms-expo").style.display="";

             Ext.getCmp("tab-expo").enable();


        }
        else{
             document.getElementById("combo-proveedor").style.display="";
             document.getElementById("combo-representante").style.display="";
             document.getElementById("combo-master").style.display="";

             document.getElementById("consignar-impo").style.display="";
             document.getElementById("consignar-expo").style.display="none";

             document.getElementById("expo-div").style.display="none";
             document.getElementById("continuacion-div").style.display="";
             document.getElementById("incoterms-expo").style.display="none";
             Ext.getCmp("tab-expo").disable();

        }





        cambiarTransporte();
    }

    var cambiarTransporte = function(){
        llenarModalidades('reporte_ca_impoexpo','reporte_ca_transporte', 'reporte_ca_modalidad', null, '<?=$reporte->getCaModalidad()?>');
        llenarLineas('reporte_ca_transporte', 'reporte_ca_idlinea', null, '<?=$reporte->getCaIdlinea()?>');
        llenarContinuaciones('reporte_ca_transporte', 'reporte_ca_continuacion',  '<?=$ca_continuacion?$ca_continuacion:$reporte->getCaContinuacion()?>');
        //llenarAgentes('reporte_ca_impoexpo','reporte_ca_transporte', 'reporte_ca_modalidad', null, '<?=$reporte->getCaModalidad()?>');        
        cambiarAduana();
        cambiarContinuacion();

        var transporte = document.getElementById("reporte_ca_transporte").value;

        if( transporte=="<?=Constantes::MARITIMO?>" ){
            document.getElementById("tipo_volumen_maritimo").style.display = "";
            document.getElementById("tipo_volumen_aereo").style.display = "none";

            document.getElementById("emisionbl").style.display = "";
            document.getElementById("cuantosbl").style.display = "";

            document.getElementById("notificar_otm").style.display = "";

            
        }else{
            document.getElementById("tipo_volumen_maritimo").style.display = "none";
            document.getElementById("tipo_volumen_aereo").style.display = "";
            document.getElementById("emisionbl").style.display = "none";
            document.getElementById("cuantosbl").style.display = "none";

            document.getElementById("notificar_otm").style.display = "none";
            
        }
        var clase = document.getElementById("reporte_ca_impoexpo").value;
        if( transporte=="<?=Constantes::MARITIMO?>" || clase=="<?=Constantes::EXPO?>" ){
            //El notify solo aplica para maritimo
            document.getElementById("combo-notify").style.display="";
            document.getElementById("repnotify_0").style.display="";
            document.getElementById("repnotify_1").style.display="";
            document.getElementById("repnotify_2").style.display="";

        }else{
            document.getElementById("combo-notify").style.display="none";
            document.getElementById("repnotify_0").style.display="none";
            document.getElementById("repnotify_1").style.display="none";
            document.getElementById("repnotify_2").style.display="none";
        }

        llenarTipos();

    }

    var cambiarModalidad = function(){
        cambiarAduana();
    }

    var cambiarAduana = function(){
        var modalidadesAduana = [<?=implode(",", $modalidadesAduana )?>];

        var transporte = document.getElementById("reporte_ca_transporte").value;
        var impoexpo = document.getElementById("reporte_ca_impoexpo").value;
        var modalidad = document.getElementById("reporte_ca_modalidad").value;

        var soloAduana = false;
        for( var i=0; i<modalidadesAduana.length; i++ ){
            
            if( modalidadesAduana[i]==modalidad ){
                soloAduana = true;
            }
        }
       
        if( soloAduana ){
            document.getElementById("reporte_ca_colmas").value = "Sí";
            document.getElementById("reporte_ca_colmas").disabled = true;


            document.getElementById("row-agente").style.display = "none";
            //oculta los otros paneles

            document.getElementById("guias-div").style.display = "none";            
            document.getElementById("continuacion-div").style.display = "none";
            Ext.getCmp("tab-corte-documentos").disable();
        }else{
            document.getElementById("reporte_ca_colmas").disabled = false;

            document.getElementById("row-agente").style.display = "";
            //muestra los otros paneles
            document.getElementById("guias-div").style.display = "";
            if( impoexpo=="<?=Constantes::IMPO?>"){
                document.getElementById("continuacion-div").style.display = "";
            }else{
                document.getElementById("continuacion-div").style.display = "none";
            }
            Ext.getCmp("tab-corte-documentos").enable();
        }


        if( document.getElementById("reporte_ca_colmas").value == "Sí" ){
            document.getElementById("aduana-row0").style.display = "";
            if( impoexpo!="<?=Constantes::EXPO?>" ){
                document.getElementById("aduana-row1").style.display = "";
                document.getElementById("aduana-row3").style.display = "";
                document.getElementById("titulo-aduana").innerHTML = "<b>Transporte de Carga Nacionalizada</b>";
            }else{
                document.getElementById("aduana-row1").style.display = "none";
                document.getElementById("aduana-row3").style.display = "none";
                document.getElementById("titulo-aduana").innerHTML = "<b>Transporte Nacional</b>";
            }
            document.getElementById("aduana-row2").style.display = "";
            
            
        }else{
            document.getElementById("aduana-row0").style.display = "none";
            document.getElementById("aduana-row1").style.display = "none";
            document.getElementById("aduana-row2").style.display = "none";
            document.getElementById("aduana-row3").style.display = "none";
        }
    }


    var cambiarSeguros = function(){

        if( document.getElementById("reporte_ca_seguro").value == "Sí" ){
            document.getElementById("seguros-row0").style.display = "";
            document.getElementById("seguros-row1").style.display = "";
        }else{
            document.getElementById("seguros-row0").style.display = "none";
            document.getElementById("seguros-row1").style.display = "none";
        }
    }

    var cambiarContinuacion = function(){

        if( document.getElementById("reporte_ca_continuacion").value != "N/A" ){
            document.getElementById("continuacion-row0").style.display = "";
            
        }else{
            document.getElementById("continuacion-row0").style.display = "none";
            
        }
    }


    var llenarContinuaciones = function( transporte , continuacionFldId,  defaultVal){
        var transporteVal = document.getElementById( transporte ).value;
        var fld = document.getElementById( continuacionFldId );

        fld.length=0;
        fld[fld.length] = new Option('N/A','N/A',false, defaultVal=="N/A");
        
        if( transporteVal=="<?=Constantes::AEREO?>" ){
            fld[fld.length] = new Option('CABOTAJE','CABOTAJE',false,defaultVal=="CABOTAJE");
        }

        if( transporteVal=="<?=Constantes::MARITIMO?>" ){
            fld[fld.length] = new Option('OTM','OTM',false,defaultVal=="OTM");
            fld[fld.length] = new Option('DTA','DTA',false,defaultVal=="DTA");
        }
    }

    var bodegas = <?=json_encode($bodegas)?>
    
    var llenarBodegas  = function(){
        var tipo = document.getElementById("reporte_tipo").value;
        var transporte = document.getElementById( "reporte_ca_transporte" ).value;
        var bodega = document.getElementById("reporte_ca_idbodega");
        bodega.length = 0;
        for( i in bodegas ){
            var tr = bodegas[i]["b_ca_transporte"];            
            if( typeof(tr)!="undefined" ){
                if( tipo==bodegas[i]["b_ca_tipo"] && tr.indexOf(transporte)!=-1 && bodegas[i]["b_ca_tipo"] ){
                    var selected = false;
                    <?
                    $bodega = $reporte->getBodega();
                    if( $bodega && $bodega->getCaTipo() ){
                    ?>
                        if( bodegas[i]["b_ca_idbodega"]=="<?=$bodega->getCaIdbodega()?>" ){
                            selected = true;
                        }
                    <?
                    }
                    ?>
                    bodega[bodega.length] = new Option(bodegas[i]["b_ca_nombre"],bodegas[i]["b_ca_idbodega"],false,selected);
                }
            }
        }
    }

    var llenarTipos = function(){
        var transporte = document.getElementById( "reporte_ca_transporte" ).value;
        var tipo = document.getElementById("reporte_tipo");
        tipo.length=0;
        
        var idconsignar = document.getElementById("reporte_ca_idconsignar_impo");
        idconsignar.length=0;

        var lastTipo = "";
        for( i in bodegas ){
            var tr = bodegas[i]["b_ca_transporte"];
            if( typeof(tr)!="undefined" ){
                if( bodegas[i]["b_ca_tipo"] == 'Coordinador Logístico' || bodegas[i]["b_ca_tipo"] == 'Operador Multimodal'){
                    //Llena la casilla Consignar HAWB/HBL a:

                    var selected2 = false;
                    <?
                    if( $reporte->getCaIdconsignar() ){
                    ?>
                        if( bodegas[i]["b_ca_idbodega"]=="<?=$reporte->getCaIdconsignar()?>" ){
                            selected2 = true;                            
                        }
                    <?
                    }
                    ?>

                    if( transporte=='<?=Constantes::AEREO?>'){
                        if(   bodegas[i]["b_ca_tipo"] == 'Coordinador Logístico' ){
                            idconsignar[idconsignar.length] = new Option(bodegas[i]["b_ca_nombre"],bodegas[i]["b_ca_idbodega"],false,selected2);
                        }
                    }else{
                        idconsignar[idconsignar.length] = new Option(bodegas[i]["b_ca_nombre"],bodegas[i]["b_ca_idbodega"],false,selected2);
                    }
                }else{
                    //Llena transladar a:
                    if( lastTipo!=bodegas[i]["b_ca_tipo"] && tr.indexOf(transporte)!=-1 && bodegas[i]["b_ca_tipo"] ){
                        lastTipo=bodegas[i]["b_ca_tipo"];
                        var selected = false;
                        <?
                        $bodega = $reporte->getBodega();
                        if( $bodega && $bodega->getCaTipo() ){
                        ?>
                            if( bodegas[i]["b_ca_tipo"]=="<?=$bodega->getCaTipo()?>" ){
                                selected = true;
                            }
                        <?
                        }
                        ?>

                        tipo[tipo.length] = new Option(bodegas[i]["b_ca_tipo"],bodegas[i]["b_ca_tipo"],false,selected);
                    }
                }
            }
        }

       
        llenarBodegas();
    }

    var llenarAgentes = function(){
        var agentes = <?=json_encode($agentes)?>;
        var target = document.getElementById("reporte_ca_idagente");
        var clase = document.getElementById("reporte_ca_impoexpo").value;
        
       
        if( document.getElementById("listar_todos")!=null ){
            var listar_todos = document.getElementById("listar_todos").checked;
            if( clase=="<?=Constantes::EXPO?>" ){
                var trafico = document.getElementById( "country_reporte_ca_destino" ).value;
            }else{
                var trafico = document.getElementById( "country_reporte_ca_origen" ).value;
            }

            target.length=0;
            
            var i = 0;
            for( idx in agentes ){
                if( typeof(agentes[idx]["idagente"])!="undefined" ){
                    var selected = false;              
                    
                    var idagente = agentes[idx]["idagente"];
                    if( idagente=="<?=$reporte->getCaIdagente()?>" ){
                        selected = true;
                    }

                    if( agentes[idx]["idtrafico"]== trafico || listar_todos || idagente=="<?=$reporte->getCaIdagente()?>" ){ //
                        target[target.length] = new Option(agentes[idx]["pais"]+"-"+agentes[idx]["nombre"],idagente,false,selected);                        
                    }

                }
            }
            
        }
    }
    

   



</script>

<?
include_partial("ventanaTercero", array("reporte"=>$reporte));
?>
<form name="form1" action="<?=url_for("reportesNeg/formReporte")?>" method="post">
<input type="hidden" name="opcion" id="opcion" value="" />
<div align="center" class="content">
   


    <div id="panel"></div>

</div>

<?
echo $form->renderHiddenFields();

if( $reporte->getCaIdreporte() ){
?>
<input type="hidden" name="id" value="<?=$reporte->getCaIdreporte()?>">
<?
}

?>
<div style="display:none" >
    <?
    echo $form['ca_idcotizacion']->renderError();
    if( $reporte ){
        $form->setDefault('ca_idcotizacion', $reporte->getCaIdcotizacion() );
    }
    echo $form['ca_idcotizacion']->render();

    echo $form['ca_idproducto']->renderError();
    if( $reporte ){
        $form->setDefault('ca_idproducto', $reporte->getCaIdproducto() );
    }
    echo $form['ca_idproducto']->render();
    ?>

</div>

<div id="header"  class="x-hide-display">
<table class="tableList alignLeft" >
           
             <?
            if( $form->hasErrors() || $formAduana->hasErrors() || $formSeguro->hasErrors() || $formExpo->hasErrors() ){
            ?>
            <tr>
                <td colspan="8">
                    <ul class="error_list">
                        <li><div align="center">Hay un error, por favor verifique los datos digitados.</div></li>
                    </ul>
                </td>
            </tr>
            <?
            }
            ?>
            <?
            if( $form->renderGlobalErrors() || $formExpo->renderGlobalErrors() || $formAduana->renderGlobalErrors() || $formSeguro->renderGlobalErrors()  ){
            ?>
            <tr>
                <td colspan="8">
                    <div align="left">
                        <?=$form->renderGlobalErrors()?>
                        <?=$formExpo->renderGlobalErrors()?>
                        <?=$formAduana->renderGlobalErrors()?>
                        <?=$formSeguro->renderGlobalErrors()?>
                    </div>
                </td>
            </tr>
            <?
            }


           
            ?>
            <tr>
                <td width="16%"><b>Cotizaci&oacute;n</b></td>
                <td width="16%">
                   <input type="text" name="cotizacion" id="cotizacion" value="" size="10" Autocomplete="off" />	
                </td>
                <td width="16%"><b>Clase</b></td>
                <td width="16%">


                    <?
                    echo $form['ca_impoexpo']->renderError();
                    if( $reporte ){
                        $form->setDefault('ca_impoexpo', $reporte->getCaImpoexpo() );
                    }
                    echo $form['ca_impoexpo']->render();
                    ?>
                </td>
                <td width="17%"><b>Fecha de despacho</b></td>
                <td width="17%">
                    <?
                    echo $form['ca_fchdespacho']->renderError();
                    if( $reporte ){
                        $form->setDefault('ca_fchdespacho', $reporte->getCaFchdespacho() );
                    }
                    echo $form['ca_fchdespacho']->render();
                    ?>
                </td>
                <td width="16%"><b>Rep. Comercial</b></td>
                <td width="16%">
                    <?
                    if( $nivel>=2 ){
                        echo $form['ca_login']->renderError();
                        if( $reporte ){
                            $form->setDefault('ca_login', $reporte->getCaLogin() );
                        }
                        echo $form['ca_login']->render();
                    }else{
                    ?>
                    <div id="comercial"><?=$reporte->getCaLogin()?></div>
                    <?
                    }
                    ?>
                </td>

            </tr>
</table>


</div>


<div id="footer"  class="x-hide-display">
    <table class="tableList alignLeft" >
         <tr>
                <td colspan="8">
                    <div align="center">
                        <?
                        if( $editable ){
                        ?>
                        <input type="button" value="Guardar" class="button" onClick="javascript:guardar(1)" />
                        <?
                        }
                        if( $reporte->getCaIdreporte() ){
                            if( $nuevaVersion ){
                            ?>
                            <input type="button" value="Nueva versi&oacute;n" class="button" onClick="javascript:guardar(2)" />
                            <?
                            }
                        ?>
                        <input type="button" value="Reporte nuevo" class="button" onClick="javascript:guardar(3)" />
                        <?
                        }
                        if( $reporte->isNew() ){
                            $url = "reportesNeg/index";
                        }else{
                            $url = "reportesNeg/consultaReporte?id=".$reporte->getCaIdreporte();
                        }
                        ?>
                        <input type="button" value="Cancelar" class="button" onClick="document.location='<?=url_for($url)?>'" />
                    </div>
                </td>
            </tr>
        </table>

</div>
<div id="trayecto"  class="x-hide-display">
    
    <?
    include_component("reportesNeg", "formTrayecto", array("form"=>$form, "reporte"=>$reporte))
    ?>

    <div  id="continuacion-div">
    <?
    include_component("reportesNeg", "formContinuacion", array("form"=>$form, "reporte"=>$reporte ) );
    ?>
    </div>

</div>
<div id="cliente"  class="x-hide-display">
    
    <?
    include_component("reportesNeg", "formCliente", array("form"=>$form, "reporte"=>$reporte, "ca_idconcliente"=>$ca_idconcliente, "idproveedor"=>$idproveedor, "orden_prov"=>$orden_prov, "incoterms"=>$incoterms, "ca_notify"=>$ca_notify ) );
    ?>
</div>
<div id="preferencias"  class="x-hide-display">
    
    <?
    include_component("reportesNeg", "formPreferenciasCliente", array("form"=>$form, "reporte"=>$reporte, "contactos"=>$contactos))
    ?>
</div>
<div id="aduana"  class="x-hide-display">
    
    <?
    include_component("reportesNeg", "formAduana", array("form"=>$form, "formAduana"=>$formAduana, "reporte"=>$reporte) );
    ?>
</div>
<div id="seguros"  class="x-hide-display">
    
    <?
    include_component("reportesNeg", "formSeguros", array("form"=>$form, "formSeguro"=>$formSeguro, "reporte"=>$reporte, "seguro_conf"=>$seguro_conf) );
    ?>

</div>

<div id="guias"  class="x-hide-display">
    
    <div  id="guias-div">
    <?
    include_component("reportesNeg", "formCorteGuias", array("form"=>$form, "reporte"=>$reporte, "ca_notify"=>$ca_notify,"idconsignatario"=>$idconsignatario, "idmaster"=>$idmaster, "idnotify"=>$idnotify, "idrepresentante"=>$idrepresentante ) );
    ?>
    </div>
</div>
<div id="exportaciones"  class="x-hide-display">
   
    <div  id="expo-div">
    <?
    include_component("reportesNeg", "formExportaciones", array("form"=>$form, "formExpo"=>$formExpo, "reporte"=>$reporte ) );
    ?>
    </div>
</div>

</form>

<script type="text/javascript">
    Ext.onReady(function(){
            
        var ds = new Ext.data.Store({
            proxy: new Ext.data.HttpProxy({
                url: '<?=url_for('widgets/listaContactosClientesJSON')?>'
            }),
            reader: new Ext.data.JsonReader({
                root: 'clientes',
                totalProperty: 'totalCount',
                id: 'id'
            }, [
                {name: 'idcontacto', mapping: 'ca_idcontacto'},
                {name: 'compania', mapping: 'ca_compania'},
                {name: 'cargo', mapping: 'ca_cargo'},
                {name: 'nombre', mapping: 'ca_nombres'},
                {name: 'papellido', mapping: 'ca_papellido'},
                {name: 'sapellido', mapping: 'ca_sapellido'},
                {name: 'vendedor', mapping: 'ca_vendedor'},
                {name: 'nombre_ven', mapping: 'ca_nombre'},
                {name: 'listaclinton', mapping: 'ca_listaclinton'},
                {name: 'fchcircular', mapping: 'ca_fchcircular', type:'int'},
                {name: 'status', mapping: 'ca_status'},
                {name: 'confirmar', mapping: 'ca_confirmar'},
                {name: 'preferencias', mapping: 'ca_preferencias'},
                {name: 'coordinador', mapping: 'ca_coordinador'},
                {name: 'diascredito', mapping: 'ca_diascredito'},
                {name: 'cupo', mapping: 'ca_cupo'}

            ])
        });

        //var data_productos = <?//json_encode();?>

        var resultTpl = new Ext.XTemplate(
            '<tpl for="."><div class="search-item"><b>{compania}</b><br /><span>{nombre} {papellido} {sapellido} <br />{cargo}</span> </div></tpl>'
    );

        <?
        if( $idconcliente ){
            $value = $idconcliente;
        }else{
            $cliente = $reporte->getCliente();
            if( $cliente ){
                $value = $reporte->getCliente()->getCaCompania();
            }else{
                $value = "";
            }
        }
        ?>
        var comboclientes =  new Ext.form.ComboBox({
                            store: ds,
                            id: 'combo-cliente',
                            fieldLabel: 'Cliente',
                            displayField:'compania',
                            typeAhead: false,
                            loadingText: 'Buscando...',
                            valueNotFoundText: 'No encontrado' ,
                            minChars: 1,
                            tpl: resultTpl,
                            width: 400,
                            applyTo: "idconcliente",
                            itemSelector: 'div.search-item',
                            emptyText:'Escriba el nombre del cliente...',
                            value: '<?=str_replace("'", "\\'", $value)?>',
                            forceSelection:true,
                            selectOnFocus:true,
                            allowBlank:false,

                            onSelect: function(record, index){ // override default onSelect to do redirect
                                if(this.fireEvent('beforeselect', this, record, index) !== false){
                                    this.setValue(record.data[this.valueField || this.displayField]);
                                    this.collapse();
                                    this.fireEvent('select', this, record, index);
                                }
                                var mensaje = "";


                                <?
                                if($nivel>=2){
                                ?>
                                    document.getElementById("reporte_ca_login").value=record.data.vendedor;
                                <?
                                }else{
                                ?>
                                    document.getElementById("comercial").innerHTML=record.data.vendedor;
                                <?
                                }
                                ?>
                                document.getElementById("ca_idconcliente").value = record.get("idcontacto");
                                document.getElementById("div_contacto").innerHTML = record.get("nombre")+' '+record.get("papellido")+' '+record.get("sapellido") ;
                                if( record.get("diascredito") ){
                                    document.getElementById("div_diascredito").innerHTML = record.get("diascredito")+" D&iacute;as";
                                }else{
                                    document.getElementById("div_diascredito").innerHTML = "";
                                }

                                if( record.get("cupo")!=0 || record.get("diascredito")!=0 ){
                                    document.getElementById("div_libautomatica").innerHTML = "S&iacute;";
                                }else{
                                    document.getElementById("div_libautomatica").innerHTML = "No";
                                }

                                document.getElementById("reporte_ca_preferencias_clie").value=record.data.preferencias;

                                for(i=0; i< <?=ReporteForm::NUM_CC?>; i++){
                                    document.getElementById("reporte_contactos_"+i).value="";
                                    document.getElementById("reporte_confirmar_"+i).checked=false;
                                    document.getElementById("reporte_contactos_"+i).readOnly=false;
                                }


                                var confirmar =  record.data.confirmar ;
                                var brokenconfirmar=confirmar.split(",");

                                for(i=0; i<brokenconfirmar.length; i++){
                                    document.getElementById("reporte_contactos_"+i).value=brokenconfirmar[i];
                                    document.getElementById("reporte_confirmar_"+i).checked=true;
                                    document.getElementById("reporte_contactos_"+i).readOnly=true;
                                }

                                document.getElementById("rep_aduana_ca_coordinador").value=record.data.coordinador;

                                if( record.data.ca_listaclinton=="Sí" ){
                                    alert("Este cliente se encuentra en lista Clinton");
                                }
                                /*
                                document.getElementById("listaclinton").value=record.data.listaclinton;

                                var fchcircular = record.get("fchcircular");
                                //alert( fchcircular);
                                if( !fchcircular ){
                                    Ext.MessageBox.alert("Alerta","El cliente no tiene circular 170");
                                }else{
                                    if( fchcircular+(86400*365)<=<?=time()?> ){
                                        Ext.MessageBox.alert("Alerta","La circular 170 se encuentra vencida");
                                    }else{
                                        if( fchcircular+(86400*335)<=<?=time()?> ){
                                            Ext.MessageBox.alert("Alerta","La circular 170 se vencera en menos de 30 dias");
                                        }
                                    }
                                }*/

                            }
                        });


    var storeCotizaciones = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for("widgets/listaCotizacionesJSON")?>'
        }),
        reader: new Ext.data.JsonReader({
            root: 'root',
            totalProperty: 'total'
        }, [
            {name: 'idcotizacion', mapping: 'c_ca_idcotizacion'},
            {name: 'consecutivo', mapping: 'c_ca_consecutivo'},
            {name: 'idproducto', mapping: 'p_ca_idproducto'},
            {name: 'producto', mapping: 'p_ca_producto'},
            {name: 'impoexpo', mapping: 'p_ca_impoexpo'},
            {name: 'transporte', mapping: 'p_ca_transporte'},
            {name: 'modalidad', mapping: 'p_ca_modalidad'},
            {name: 'idlinea', mapping: 'p_ca_idlinea'},
            {name: 'idmodalidad'},
            {name: 'tra_origen', mapping: 'o_ca_idtrafico'},
            {name: 'tra_destino', mapping: 'd_ca_idtrafico'},
			{name: 'origen', mapping: 'o_ca_ciudad'},
            {name: 'destino', mapping: 'd_ca_ciudad'},
            {name: 'idorigen', mapping: 'o_ca_idciudad'},
			{name: 'iddestino', mapping: 'd_ca_idciudad'},
			{name: 'idcontacto', mapping: 'con_ca_idcontacto'},
            {name: 'compania', mapping: 'cl_ca_compania'},
			{name: 'cargo', mapping: 'con_ca_cargo'},
			{name: 'nombre', mapping: 'con_ca_nombres'},
			{name: 'papellido', mapping: 'con_ca_papellido'},
			{name: 'sapellido', mapping: 'con_ca_sapellido'},
			{name: 'preferencias', mapping: 'cl_ca_preferencias'},
			{name: 'confirmar', mapping: 'cl_ca_confirmar'},
            {name: 'vendedor', mapping: 'c_ca_usuario'},
            {name: 'coordinador', mapping: 'cl_ca_coordinador'}
        ])
    });

	var resultTplCotizaciones = new Ext.XTemplate(
        '<tpl for="."><div class="search-item"><strong>{consecutivo}</strong><br /><span><br />{origen} - {destino}</span> </div></tpl>'

    );
    <?
    if( $idcotizacion ){
        $value = $idcotizacion;
    }else{
        $value = $reporte->getCaIdcotizacion();
    }
    ?>
    comboCotizacion = new Ext.form.ComboBox({
        id: 'combo-cotizacion',
        store: storeCotizaciones,
        displayField:'consecutivo',
        typeAhead: false,
        loadingText: 'Buscando...',
        width: 100,
        valueNotFoundText: 'No encontrado' ,
		minChars: 3,
        hideTrigger:true,
        tpl: resultTplCotizaciones,
        applyTo: 'cotizacion',
        itemSelector: 'div.search-item',
	    emptyText:'numero...',
	    forceSelection:true,
		selectOnFocus:true
        <?=isset($value)?",value: '".$value."'":""?>


    });

    comboCotizacion.addListener("select", function(combo, record, index){ ;

        //alert(record.data.consecutivo);
        document.getElementById("reporte_ca_idcotizacion").value=record.data.consecutivo;
        document.getElementById("reporte_ca_idproducto").value=record.data.idproducto;
        document.getElementById("reporte_ca_mercancia_desc").value=record.data.producto;
        document.getElementById("reporte_ca_impoexpo").value=record.data.impoexpo;
        cambiarImpoexpo();
        document.getElementById("reporte_ca_transporte").value=record.data.transporte;
        cambiarTransporte();
        document.getElementById("reporte_ca_modalidad").value=record.data.idmodalidad;
        
        Ext.getCmp('combo-cliente').setValue(record.data.compania);
        document.getElementById("ca_idconcliente").value = record.get("idcontacto");
        document.getElementById("div_contacto").innerHTML = record.get("nombre")+' '+record.get("papellido")+' '+record.get("sapellido") ;

        document.getElementById("reporte_ca_preferencias_clie").value=record.data.preferencias;

        for(i=0; i< <?=ReporteForm::NUM_CC?>; i++){
            
            document.getElementById("reporte_contactos_"+i).value="";
            document.getElementById("reporte_confirmar_"+i).checked=false;
        }


        var confirmar =  record.data.confirmar ;
        var brokenconfirmar=confirmar.split(",");

        for(i=0; i<brokenconfirmar.length&&i< <?=ReporteForm::NUM_CC?>; i++){
            document.getElementById("reporte_contactos_"+i).value=brokenconfirmar[i];
            document.getElementById("reporte_confirmar_"+i).checked=true;
        }

        document.getElementById("country_reporte_ca_origen").value = record.data.tra_origen;        
        llenarCiudades('country_reporte_ca_origen', 'reporte_ca_origen',false, record.data.idorigen)

        document.getElementById("country_reporte_ca_destino").value = record.data.tra_destino;
        llenarCiudades('country_reporte_ca_destino', 'reporte_ca_destino',false, record.data.iddestino)


        <?
        if($nivel>=2){
        ?>
         document.getElementById("reporte_ca_login").value=record.data.vendedor;
        <?
        }else{
        ?>

         document.getElementById("comercial").innerHTML=record.data.vendedor;

        <?
        }
        ?>
        
        document.getElementById("rep_aduana_ca_coordinador").value=record.data.coordinador;


        document.getElementById("reporte_ca_idlinea").value=record.data.idlinea;


    });


    var bodyStyle = 'padding: 5px 5px 5px 5px;';
    tabpanel = new Ext.TabPanel({
        activeTab: 0,
        frame:false,
        defaults:{autoHeight: true},
        items:[
            {contentEl:'trayecto', title: 'Trayecto',  bodyStyle: bodyStyle},
            {contentEl:'cliente', title: 'Cliente',  bodyStyle: bodyStyle},
            {contentEl:'preferencias', title: 'Preferencias', bodyStyle: bodyStyle},
            {contentEl:'aduana', title: 'Aduana', bodyStyle: bodyStyle},
            {contentEl:'seguros', title: 'Seguros', bodyStyle: bodyStyle},
            {contentEl:'guias', title: 'Corte de Documentos', id: 'tab-corte-documentos', bodyStyle: bodyStyle},
            {contentEl:'exportaciones', title: 'Exportaciones', id: 'tab-expo', bodyStyle: bodyStyle}
        ]
    });

    //tabpanel.render("panel");
    //tabpanel.setWidth(Ext.getBody().getWidth()-250);
   
    var panel = new Ext.Panel({
        title: "Reportes de Negocio <?=$reporte->getCaIdreporte()?$reporte->getCaConsecutivo()." ".$reporte->getCaVersion()."/".$reporte->numVersiones():""?>",
        items: [
            {contentEl:'header'},
            tabpanel,
            {contentEl:'footer'}
        ]
    });

    panel.render("panel");




    cambiarImpoexpo();
    cambiarAduana();
    cambiarSeguros();
});
</script>



<?
include_component("kbase","tooltipById", array("idcategory"=>18));
if( $opcion=="ayudas" ){
    include_component("kbase","tooltipCreator", array("idcategory"=>18));
}
?>