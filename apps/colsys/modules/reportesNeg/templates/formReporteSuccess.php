<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$traficos = $sf_data->getRaw("traficos");
$reporte = $sf_data->getRaw("reporte");
$modalidadesAduana = $sf_data->getRaw("modalidadesAduana");

?>
<script language="javascript">

    

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
        }
        else{
             document.getElementById("combo-proveedor").style.display="";
             document.getElementById("combo-representante").style.display="";
             document.getElementById("combo-master").style.display="";

             document.getElementById("consignar-impo").style.display="";
             document.getElementById("consignar-expo").style.display="none";

             document.getElementById("expo-div").style.display="none";
        }



        cambiarTransporte();
    }

    function cambiarTransporte(){
        llenarModalidades('reporte_ca_impoexpo','reporte_ca_transporte', 'reporte_ca_modalidad', null, '<?=$reporte->getCaModalidad()?>');
        llenarLineas('reporte_ca_transporte', 'reporte_ca_idlinea', null, '<?=$reporte->getCaIdlinea()?>');
        llenarContinuaciones('reporte_ca_transporte', 'reporte_ca_continuacion',  '<?=$reporte->getCaContinuacion()?>');
        //llenarAgentes('reporte_ca_impoexpo','reporte_ca_transporte', 'reporte_ca_modalidad', null, '<?=$reporte->getCaModalidad()?>');
        cambiarAduana();
        cambiarContinuacion();
    }

    function cambiarModalidad(){        
        cambiarAduana();
    }

    function cambiarAduana(){
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
        }else{
            document.getElementById("reporte_ca_colmas").disabled = false;

            document.getElementById("row-agente").style.display = "";
            //muestra los otros paneles
            document.getElementById("guias-div").style.display = "";
            document.getElementById("continuacion-div").style.display = "";
        }


        if( document.getElementById("reporte_ca_colmas").value == "Sí" ){
            document.getElementById("aduana-row0").style.display = "";
            if( impoexpo!="<?=Constantes::EXPO?>" ){
                document.getElementById("aduana-row1").style.display = "";
                document.getElementById("titulo-aduana").innerHTML = "<b>Transporte de Carga Nacionalizada</b>";
            }else{
                document.getElementById("aduana-row1").style.display = "none";
                document.getElementById("titulo-aduana").innerHTML = "<b>Transporte Nacional</b>";
            }
            document.getElementById("aduana-row2").style.display = "";
            
            
        }else{
            document.getElementById("aduana-row0").style.display = "none";
            document.getElementById("aduana-row1").style.display = "none";
            document.getElementById("aduana-row2").style.display = "none";
        }
    }


    function cambiarSeguros(){

        if( document.getElementById("reporte_ca_seguro").value == "Sí" ){
            document.getElementById("seguros-row0").style.display = "";
            document.getElementById("seguros-row1").style.display = "";
        }else{
            document.getElementById("seguros-row0").style.display = "none";
            document.getElementById("seguros-row1").style.display = "none";
        }
    }

    function cambiarContinuacion(){

        if( document.getElementById("reporte_ca_continuacion").value != "N/A" ){
            document.getElementById("continuacion-row0").style.display = "";
            
        }else{
            document.getElementById("continuacion-row0").style.display = "none";
            
        }
    }


    function llenarContinuaciones( transporte , continuacionFldId,  defaultVal){
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


    

</script>

<?
include_partial("ventanaTercero", array("reporte"=>$reporte));
?>

<div align="center" class="content">
    <h1>Reportes de Negocio</h1>
    <br />
    <form action="<?=url_for("reportesNeg/formReporte")?>" method="post">
        <?        
        

        echo $form->renderHiddenFields();

        if( $reporte->getCaIdreporte() ){
        ?>
        <input type="hidden" name="id" value="<?=$reporte->getCaIdreporte()?>">
        <?
        }

        ?>
        <table class="tableList" width="80%">
            <tr>
                <th colspan="4">Datos para la referencia</th>
            </tr>
             <?
            if( $form->hasErrors() ){
            ?>
            <tr>
                <td colspan="4">
                    <ul class="error_list">
                        <li><div align="center">Hay un error, por favor verifique los datos digitados.</div></li>
                    </ul>
                </td>
            </tr>
            <?
            }
            ?>
            <?
            if( $form->renderGlobalErrors() ){
            ?>
            <tr>
                <td colspan="4">
                 <div align="left"><?php echo $form->renderGlobalErrors() ?>		</div></td>
            </tr>
            <?
            }
            ?>
            <tr>
                <td width="25%"><b>Clase</b></td>
                <td width="25%">
                    

                    <?
                    echo $form['ca_impoexpo']->renderError();
                    if( $reporte ){
                        $form->setDefault('ca_impoexpo', $reporte->getCaImpoexpo() );
                    }
                    echo $form['ca_impoexpo']->render();
                    ?>
                </td>
                <td width="25%"><b>Fecha de despacho</b></td>
                <td width="25%">
                    <?
                    echo $form['ca_fchdespacho']->renderError();
                    if( $reporte ){
                        $form->setDefault('ca_fchdespacho', $reporte->getCaFchdespacho() );
                    }
                    echo $form['ca_fchdespacho']->render();
                    ?>
                </td>
            </tr>
            
            <tr >
                <td colspan="4">

                    <div class="tab-pane" id="tab-pane-1">
                        <div class="tab-page">
                            <h2 class="tab">Trayecto</h2>
                            <?
                            include_component("reportesNeg", "trayecto", array("form"=>$form, "reporte"=>$reporte))
                            ?>

                        </div>
                        <div class="tab-page">
                            <h2 class="tab">Cliente</h2>
                            <table class="tableList" width="100%">
                                <tr class="row0">
                                    <th colspan="4"><b>Datos del cliente</b></th>
                                </tr>
                                <tr>
                                    <td><b>Cliente:</b></td>
                                    <td>
                                        <?
                                        echo $form['ca_idconcliente']->renderError();

                                        ?>
                                        <input type="hidden" name="ca_idconcliente" id="ca_idconcliente"  value="<?=$ca_idconcliente?$ca_idconcliente:$reporte->getCaIdconcliente()?>">
                                        <input type="text" name="idconcliente" id="idconcliente">
                                    </td>
                                    <td><b> Contacto: </b></td>
                                    <td>&nbsp;
                                        <div id="div_contacto" align="left">
                                             <?
                                            if( $reporte->getCaIdconcliente() ){
                                                echo $reporte->getContacto()->getNombre();
                                            }
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Orden del Cliente:</b></td>
                                    <td>
                                        <?
                                        echo $form['ca_orden_clie']->renderError();
                                        if( $reporte ){
                                            $form->setDefault('ca_orden_clie', $reporte->getCaOrdenClie() );
                                        }
                                        echo $form['ca_orden_clie']->render();
                                        ?>
                                    </td>
                                    <td><b> &nbsp; </b></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr id="combo-proveedor">
                                    <td class="row0"><b>Proveedor:</b></td>
                                    <td>
                                        <?
                                        if( $idproveedor ){
                                            $value = $idproveedor;
                                        }else{
                                            $value = $reporte->getCaIdproveedor();
                                        }
                                        include_component("widgets", "comboTercero", array( "tipo"=>"Proveedor", "id"=>"idproveedor", "name"=>"idproveedor", "value"=>$value));
                                        ?>
                                    </td>
                                    <td><b> &nbsp;</b></td>
                                    <td> &nbsp; </td>
                                </tr>

                                <tr id="combo-consignatario">
                                    <td class="row0"><b>Consignatario:</b></td>
                                    <td>
                                        <?
                                        if( $idconsignatario ){
                                            $value = $idconsignatario;
                                        }else{
                                            $value = $reporte->getCaIdconsignatario();
                                        }
                                        include_component("widgets", "comboTercero", array( "tipo"=>"Consignatario", "id"=>"idconsignatario", "name"=>"idconsignatario", "value"=>$value));
                                        ?>
                                    </td>
                                    <td><b> &nbsp;</b></td>
                                    <td> &nbsp; </td>
                                </tr>

                                <tr id="combo-master">
                                    <td class="row0"><b>Consigna. Master:</b></td>
                                    <td>
                                        <?
                                        if( $idmaster ){
                                            $value = $idmaster;
                                        }else{
                                            $value = $reporte->getCaIdmaster();
                                        }
                                        include_component("widgets", "comboTercero", array( "tipo"=>"Master", "id"=>"idmaster", "name"=>"idmaster", "value"=>$value));
                                        ?>
                                    </td>
                                    <td><b> &nbsp;</b></td>
                                    <td> &nbsp; </td>
                                </tr>


                                <tr id="combo-notify">
                                    <td class="row0"><b>Notify:</b></td>
                                    <td>
                                        <?
                                        if( $idnotify ){
                                            $value = $idnotify;
                                        }else{
                                            $value = $reporte->getCaIdnotify();
                                        }
                                        include_component("widgets", "comboTercero", array( "tipo"=>"Notify", "id"=>"idnotify", "name"=>"idnotify", "value"=>$value));
                                        ?>
                                    </td>
                                    <td><b> &nbsp;</b></td>
                                    <td> &nbsp; </td>
                                </tr>
                                
                                <tr id="combo-representante">
                                    <td class="row0"><b>Representante:</b></td>
                                    <td>
                                        <?
                                        if( $idrepresentante ){
                                            $value = $idrepresentante;
                                        }else{
                                            $value = $reporte->getCaIdrepresentante();
                                        }
                                        include_component("widgets", "comboTercero", array( "tipo"=>"Representante", "id"=>"idrepresentante", "name"=>"idrepresentante", "value"=>$value));
                                        ?>
                                    </td>
                                    <td><b> &nbsp;</b></td>
                                    <td> &nbsp; </td>
                                </tr>


                            </table>
                        </div>
                        <div class="tab-page">
                            <h2 class="tab">Preferencias</h2>
                            <?
                            include_component("reportesNeg", "preferenciasCliente", array("form"=>$form, "reporte"=>$reporte, "contactos"=>$contactos))
                            ?>
                        </div>
                        <div class="tab-page">
                            <h2 class="tab">Aduana</h2>
                            <?
                            include_component("reportesNeg", "aduana", array("form"=>$form, "formAduana"=>$formAduana, "reporte"=>$reporte) );
                            ?>
                        </div>
                        <div class="tab-page">
                            <h2 class="tab">Seguros</h2>
                            <?
                            include_component("reportesNeg", "seguros", array("form"=>$form, "formSeguro"=>$formSeguro, "reporte"=>$reporte, "seguro_conf"=>$seguro_conf) );
                            ?>
                            
                        </div>
                        <div class="tab-page">
                            <h2 class="tab">Cont. Viaje</h2>
                             <div  id="continuacion-div">
                            <?
                            include_component("reportesNeg", "continuacion", array("form"=>$form, "reporte"=>$reporte ) );
                            ?>
                            </div>
                        </div>
                        <div class="tab-page" >
                            <h2 class="tab">Guias</h2>
                            <div  id="guias-div">
                            <?
                            include_component("reportesNeg", "corteGuias", array("form"=>$form, "reporte"=>$reporte ) );
                            ?>
                            </div>
                        </div>
                        <div class="tab-page">
                            <h2 class="tab">Exportaciones</h2>
                            <div  id="expo-div">
                            <?
                            include_component("reportesNeg", "exportaciones", array("form"=>$form, "formExpo"=>$formExpo, "reporte"=>$reporte ) );
                            ?>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>     
            


           
            <tr>
                <td colspan="4">
                    <div align="center">
                        <input type="submit" value="Guardar" class="button" />
                        <?
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
    </form>

    <script language="javascript">
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
                {name: 'preferencias', mapping: 'ca_preferencias'}

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
                                
                                document.getElementById("ca_idconcliente").value = record.get("idcontacto");
                                document.getElementById("div_contacto").innerHTML = record.get("nombre")+' '+record.get("papellido")+' '+record.get("sapellido") ;


                                document.getElementById("reporte_ca_preferencias_clie").value=record.data.preferencias;

                                for(i=0; i< <?=ReporteForm::NUM_CC?>; i++){
                                    document.getElementById("reporte_contactos_"+i).value="";
                                    document.getElementById("reporte_confirmar_"+i).checked=false;
                                }


                                var confirmar =  record.data.confirmar ;
                                var brokenconfirmar=confirmar.split(",");

                                for(i=0; i<brokenconfirmar.length; i++){
                                    document.getElementById("reporte_contactos_"+i).value=brokenconfirmar[i];
                                    document.getElementById("reporte_confirmar_"+i).checked=true;
                                }

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
       
    </script>

</div>


<script language="javascript">
    cambiarImpoexpo();
    cambiarAduana();
    cambiarSeguros();

    
    
</script>