<?
/*
* Muestra los resultados de la busqueda de la cotización 
* @author Andres Botero y Mauricio Quinche
*/	
?>
<div align="center">
<?
$url = "cotizaciones/busquedaCotizacion?criterio=".$criterio;
if( $cadena ){
	$url.="&cadena=".$cadena;
}
if( $login ){
	$url.="&login=".$login;
}
if( $transporte ){
	$url.="&transporte=".$transporte;
}
if( $idorigen ){
	$url.="&idorigen=".$idorigen;
}
if( $iddestino ){
	$url.="&iddestino=".$iddestino;
}
if( $seguimiento ){
	$url.="&seguimiento=".$seguimiento;
}
?>
    <table>
        <tr>
<?
$pagerLayout = new Doctrine_Pager_Layout($pager,new Doctrine_Pager_Range_Sliding(array('chunk' => 5)),url_for($url)."?page={%page_number}");
$pagerLayout->setTemplate('<td style="width: 15px;"><a href="{%url}">{%page}</a><td>');
$pagerLayout->setSelectedTemplate('<td style="width: 15px;">{%page}<td>');
$idsList = $pager->execute();

$pagerLayout->display();
?>
        </tr>
    </table>
<br />
<br />
<form id="formProducto" name="formProducto" method="post" action="#" >
<table class="tableList" width="900px" border="1" id="mainTable">
    <tr>
        <th width="70" scope="col">Consecutivo</th>
        <th width="660" colspan="4" scope="col">Cotizaci&oacute;n</th>
        <th width="170" colspan="1" scope="col">Seguimiento</th>
        
    </tr>
<?	
	foreach( $cotizaciones as $cotizacion ){
		$contacto = $cotizacion->getContacto();
		$cliente = $contacto->getCliente(); 
?>
    <tr>
        <td rowspan="2"  >
            <?=link_to("C".$cotizacion->getCaConsecutivo(), "cotizaciones/consultaCotizacion?id=".$cotizacion->getCaIdcotizacion())?>
            <br>V-<?=$cotizacion->getCaVersion()?>
				<?=$cotizacion->getCaFchanulado()?"<br />Anulada":""?>
        </td>
        <td ><b>Fch.Cotizacion:</b><br />
            <?=$cotizacion->getCaFchcreado()?></td>
        <td ><b>Cliente:</b><br />
            <?=$cliente?></td>
        <td ><b>Contacto:</b><br />
            <?=$contacto->getNombre()?></td>
        <td ><b>Vendedor:</b><br />
            <?=$cotizacion->getCaUsuario()?></td>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="6" >
            <b>Trayectos:</b>
            <table class="tableList" width="100%" border="1">
        <?
        $productos = $cotizacion->getCotProductos();
        if( count($productos)>0 ){
            foreach( $productos as $producto ){
                if($producto->getCaTransporte()=="OTM-DTA" && (Utils::compararFechas($producto->getCaFchcreado(), "2010-07-31")<1 ) )
                    continue;
                $origen = $producto->getOrigen();
                $destino = $producto->getDestino();
            ?>
                <tr>
                    <td width="300"  class="listar" >
                        <?=$producto->getCaImpoexpo()?>
                        &raquo;
                        <?=$producto->getCaTransporte()?>
                        &raquo;
                        <?=$producto->getCaModalidad()?> [<?=$producto->getCaProducto()?>]</td>
                    <td width="230" class="listar"><?=$origen->getTrafico()." ".$origen->getCaCiudad()?>
                        &raquo;
                        <?=$destino->getTrafico()." ".$destino->getCaCiudad()?></td>
                    <td width="190" class="listar">
                    <?
                    echo isset($estados[$producto->getCaEtapa()]) && $cotizacion->getCaFchanulado() =="" ?$estados[$producto->getCaEtapa()]:"";

                    $seg = $producto->getUltSeguimiento();
                    if( $producto->getCaEtapa()==Cotizacion::EN_SEGUIMIENTO && $cotizacion->getCaFchanulado() == "" ){
                    ?>
                        <a style="cursor:pointer" onclick="window.open('<?=url_for("cotseguimientos/formSeguimiento?idcotizacion=".$cotizacion->getCaIdcotizacion()."&idproducto=".$producto->getCaIdproducto())?>')" title="Haga click aca para crear un seguimiento. Se abrira una nueva ventana.">
                        <?
                        if( $seg ){
                            echo image_tag("16x16/button_ok.gif")."  <br />Ult. seguimiento ".Utils::fechaMes($seg->getCaFchseguimiento());
                        }else{
                            echo image_tag("16x16/button_cancel.gif")." <br /> Sin seguimientos";
                        }
                        ?>
                        </a>
                    </td>
                    <td  width="182" style="width: 182px; background-color: #FFFFCC">
                        <input type="hidden" name="idproducto[]" class="idproducto" value="<?=$producto->getCaIdproducto()?>" >
                        <select name="etapa[]" id="etapa_<?=$producto->getCaIdproducto()?>" onchange="chseguimiento('<?=$producto->getCaIdproducto()?>')" >
                                <option value="">...</option>
                                <option value="APR">Aprobar</option>
                                <option value="NAP">No Aprobar</option>
                                <option value="SEG">Seguimiento</option>
                        </select>
                        <br/>
                        <div id="NAP_<?=$producto->getCaIdproducto()?>" style="display:none;" >
                            <select name="seguimiento[]" id="seg_<?=$producto->getCaIdproducto()?>" disabled style="width: 250px"  >
                                <?
                                    foreach ($motivos as $motivo) {
                                        ?>
                                        <option value="<?=$motivo?>" title="<?=$motivo?>"><?=$motivo?></option>
                                        <?
                                    }
                                ?>
                            </select>
                        </div>
                        <div id="SEG_<?=$producto->getCaIdproducto()?>" style="display:none">
                            <textarea name="seguimiento[]" id="seg_<?=$producto->getCaIdproducto()?>" style="width: 100%"  rows="3" disabled></textarea>
                            <br>
                            <b>recordar seguimiento:</b>
                                <input type="checkbox" id="prog_seguimiento_<?=$producto->getCaIdproducto()?>" name="prog_seguimiento[]" onclick="fchseg('<?=$producto->getCaIdproducto()?>')" disabled>
                            
                            <div id="fchaseg_<?=$producto->getCaIdproducto()?>" style="display: none">
                                <input type="text" size="10" id="fchseguimiento_<?=$producto->getCaIdproducto()?>" name="fchseguimiento[]" disabled  />
                                <script type="text/javascript">
                                     new Ext.form.DateField({
                                                     applyTo: 'fchseguimiento_<?=$producto->getCaIdproducto()?>',
                                                     value: '',
                                                     width: 100,
                                                     format: 'Y-m-d',
                                                     enable:false
                                            });
                                </script>
                            </div>
                        </div>
                <?
                }
                else
                {
                    echo "</td><td>";
                }
                ?>
                    </td>
                </tr>
        <?
            }            
        }else{
            ?>

            <tr>
                <td width="65%" class="listar" colspan="2" >
                Sin trayectos</td>             
                <?
                $seg = $cotizacion->getUltSeguimiento();
                    if($seg)
                    {
                        $eta=isset($estados[$seg->getCaEtapa()]) && $cotizacion->getCaFchanulado()=="" ?$seg->getCaEtapa():Cotizacion::EN_SEGUIMIENTO;
                    }
                    else
                    {
                        $eta=Cotizacion::EN_SEGUIMIENTO;
                    }
                ?>
                <td width="35%" class="listar">
                    <?

                    
                    echo $estados[$eta];
                    if( ($eta==Cotizacion::EN_SEGUIMIENTO )&& !$cotizacion->getCaFchanulado()  ){
                        //$seg = $cotizacion->getUltSeguimiento();
                    ?>
                    <a style="cursor:pointer"  onclick="window.open('<?=url_for("cotseguimientos/formSeguimiento?idcotizacion=".$cotizacion->getCaIdcotizacion())?>')" title="Haga click aca para crear un seguimiento. Se abrira una nueva ventana.">
                            <?
                            if( $seg ){
                                echo image_tag("16x16/button_ok.gif")."  <br />Ult. seguimiento ".Utils::fechaMes($seg->getCaFchseguimiento());
                            }else{
                                echo image_tag("16x16/button_cancel.gif")." <br /> Sin seguimientos";
                            }
                            ?>
                     </a>
                    <?
                    }
                    ?>
                </td>
                <?
                if(!$seg && !$cotizacion->getCaFchanulado())
                {
                ?>
                <td  width="182" style="width: 182px; background-color: #FFFFCC">
                        <input type="hidden" name="idcotizacioncot[]" class="idcotizacion" value="<?=$cotizacion->getCaIdcotizacion()?>" >
                        <select name="etapacot[]" id="etapacot_<?=$cotizacion->getCaIdcotizacion()?>" onchange="chseguimientocot('<?=$cotizacion->getCaIdcotizacion()?>')" >
                                <option value="">...</option>
                                <option value="APR">Aprobar</option>
                                <option value="NAP">No Aprobar</option>
                                <option value="SEG">Seguimiento</option>
                        </select>
                        <br/>
                        <div id="NAPCOT_<?=$cotizacion->getCaIdcotizacion()?>" style="display:none;" >
                            <select name="seguimientocot[]" id="segcot_<?=$cotizacion->getCaIdcotizacion()?>" disabled style="width: 250px"  >
                                <?
                                    foreach ($motivos as $motivo) {
                                        ?>
                                        <option value="<?=$motivo?>" title="<?=$motivo?>"><?=$motivo?></option>
                                        <?
                                    }
                                ?>
                            </select>
                        </div>
                        <div id="SEGCOT_<?=$cotizacion->getCaIdcotizacion()?>" style="display:none">
                            <textarea name="seguimientocot[]" id="segcot_<?=$cotizacion->getCaIdcotizacion()?>" style="width: 100%"  rows="3" disabled></textarea>
                            <br>
                            <b>recordar seguimiento:</b>
                                <input type="checkbox" id="prog_seguimientocot_<?=$cotizacion->getCaIdcotizacion()?>" name="prog_seguimientocot[]" onclick="fchsegcot('<?=$cotizacion->getCaIdcotizacion()?>')" disabled>
                            
                            <div id="fchasegcot_<?=$cotizacion->getCaIdcotizacion()?>" style="display: none">
                                <input type="text" size="10" id="fchseguimientocot_<?=$cotizacion->getCaIdcotizacion()?>" name="fchseguimientocot[]" disabled  />
                                <script type="text/javascript">
                                     new Ext.form.DateField({
                                                     applyTo: 'fchseguimientocot_<?=$cotizacion->getCaIdcotizacion()?>',
                                                     value: '',
                                                     width: 100,
                                                     format: 'Y-m-d',
                                                     enable:false
                                            });
                                </script>
                            </div>
                        </div>
                </td>
                
                <?
                }
                ?>
              </tr>
            <?
        }
        ?>
         </table>
     </td>
    </tr>	
	<?
	}
	if( count($cotizaciones)==0 ){
	?>
	<tr>		
            <td  colspan="5" scope="col"><div align="center">No hay resultados</div></td>
	</tr>
	<?
	}else
        {
        ?>
        <tr>
            <td colspan="5"></td>
            <td align="right"><input id="bguardar" value="Guardar Seguimientos" type="button" onclick="validar()" ></td>
        </tr>
        <?
        }
	?>	
</table>
</form>
<script type="text/javascript">
    function validar()
    {
        $("#bguardar").attr("disabled",true);
        objs=$(".idproducto");
        $.each(objs, function(i,item){
            if($("#etapa_"+item.value).val()!="")
            {
                 //$("#NAP_"+item.value+">input,#NAP_"+item.value+">textaera,#NAP_"+item.value+">select").attr("disabled",false);
                 //$("#SEG_"+item.value+">input,#SEG_"+item.value+">textaera,#SEG_"+item.value+">select").attr("disabled",false);

                $("#NAP_"+id+">*,#NAP_"+id+">*>*,#NAP_"+id+">*>*>*").attr("disabled",false);
                $("#SEG_"+id+">*,#SEG_"+id+">*>*,#SEG_"+id+">*>*>*").attr("disabled",false);

                 //$("#fchseguimiento_"+item.value).attr("disabled",false);

                if($("#etapa_"+item.value).val()=="NAP")
                {                    
                    $("#SEG_"+item.value+">#seg_"+item.value).attr("disabled",true);
                }
                else if($("#etapa_"+item.value).val()=="SEG")
                {                    
                    $("#NAP_"+item.value+">#seg_"+item.value).attr("disabled",true);
                }
                else
                {
                    $("#NAP_"+item.value+">#seg_"+item.value).attr("disabled",true);
                    $("#SEG_"+item.value+">#seg_"+item.value).attr("disabled",false);
                }
            }
            else
            {
                item.disabled=true;
                $("#etapa_"+item.value).attr("disabled",true)

                if($("#etapa_"+item.value).val()=="NAP")
                {
                    $("#NAP_"+item.value+">input,#NAP_"+item.value+">textaera,#NAP_"+item.value+">select").attr("disabled",true);
                }
                else if($("#etapa_"+item.value).val()=="SEG")
                {
                    $("#SEG_"+item.value+">input,#SEG_"+item.value+">textaera,#SEG_"+item.value+">select").attr("disabled",true);
                    $("#fchseguimiento_"+item.value).attr("disabled",true);
                }
            }
        });
        
        
        
        objs=$(".idcotizacion");
        $.each(objs, function(i,item){
            if($("#etapacot_"+item.value).val()!="")
            {
                 //$("#NAP_"+item.value+">input,#NAP_"+item.value+">textaera,#NAP_"+item.value+">select").attr("disabled",false);
                 //$("#SEG_"+item.value+">input,#SEG_"+item.value+">textaera,#SEG_"+item.value+">select").attr("disabled",false);

                $("#NAPCOT_"+id+">*,#NAPCOT_"+id+">*>*,#NAPCOT_"+id+">*>*>*").attr("disabled",false);
                $("#SEGCOT_"+id+">*,#SEGCOT_"+id+">*>*,#SEGCOT_"+id+">*>*>*").attr("disabled",false);

                 //$("#fchseguimiento_"+item.value).attr("disabled",false);

                if($("#etapacot_"+item.value).val()=="NAP")
                {                    
                    $("#SEGCOT_"+item.value+">#segcot_"+item.value).attr("disabled",true);
                }
                else if($("#etapacot_"+item.value).val()=="SEG")
                {
                    $("#NAPCOT_"+item.value+">#segcot_"+item.value).attr("disabled",true);
                }
                else
                {
                    $("#NAPCOT_"+item.value+">#segcot_"+item.value).attr("disabled",true);
                    $("#SEGCOT_"+item.value+">#segcot_"+item.value).attr("disabled",false);
                }
            }
            else
            {
                item.disabled=true;
                $("#etapacot_"+item.value).attr("disabled",true)

                if($("#etapacot_"+item.value).val()=="NAP")
                {
                    $("#NAPCOT_"+item.value+">input,#NAPCOT_"+item.value+">textaera,#NAPCOT_"+item.value+">select").attr("disabled",true);
                }
                else if($("#etapacot_"+item.value).val()=="SEG")
                {
                    $("#SEGCOT_"+item.value+">input,#SEGCOT_"+item.value+">textaera,#SEGCOT_"+item.value+">select").attr("disabled",true);
                    $("#fchseguimiento_"+item.value).attr("disabled",true);
                }
            }
            
        });
        
        Ext.Ajax.request(
        {
            waitMsg: 'Guardando cambios...',
            url: '<?=url_for("cotseguimientos/aprobarSeguimientos")?>',
            method: 'POST',
            form: 'formProducto',
            success: function(a,b){
                if(a.responseText.search(/error/i)==-1)
                {                    
                    alert("Se Actualizo Correctamente");
                    location.href='<?=url_for("$url")?>';
                }
                else
                {
                    alert("Error:"+a.responseText.replace(/<br \/>/gi ,"\n"));
                    $("#bguardar").attr("disabled",false);
                }
           },
           failure: function(a,b){
               alert("Error:"+a.responseText.toString());
               $("#bguardar").attr("disabled",false);
           }
        });
    }
    function checked1(id)
    {
        val=$("#idp_"+id).attr("checked");
        $("#seg_"+id).attr("disabled",!val);
        if(val==true)
            $("#seg_"+id).show();
        else
            $("#seg_"+id).hide();
    }
    function chseguimiento(id)
    {
        tipo=$("#etapa_"+id).attr("value");
        $("#NAP_"+id).hide();        
        $("#NAP_"+id+">*,#NAP_"+id+">*>*,#NAP_"+id+">*>*>*").attr("disabled",true);
        $("#SEG_"+id).hide();        
        $("#SEG_"+id+">*,#SEG_"+id+">*>*,#SEG_"+id+">*>*>*").attr("disabled",true);        
        
        if(tipo=="NAP")
        {            
            $("#NAP_"+id).show();            
            $("#NAP_"+id+">*,#NAP_"+id+">*>*,#NAP_"+id+">*>*>*").attr("disabled",false);
        }
        else if(tipo=="SEG")
        {         

            $("#SEG_"+id).show();
            $("#SEG_"+id+">*,#SEG_"+id+">*>*,#SEG_"+id+">*>*>*").attr("disabled",false);
        }
    }
    function fchseg(id)
    {
        val=$("#prog_seguimiento_"+id).attr("checked");
        if(val==true)
        {
            $("#fchaseg_"+id).show();      
        }
        else
        {
            $("#fchaseg_"+id).hide();      
        }
    }
    
    function chseguimientocot(id)
    {
        tipo=$("#etapacot_"+id).attr("value");
        $("#NAPCOT_"+id).hide();        
        $("#NAPCOT_"+id+">*,#NAPCOT_"+id+">*>*,#NAPCOT_"+id+">*>*>*").attr("disabled",true);
        $("#SEGCOT_"+id).hide();        
        $("#SEGCOT_"+id+">*,#SEGCOT_"+id+">*>*,#SEGCOT_"+id+">*>*>*").attr("disabled",true);        
        
        if(tipo=="NAP")
        {            
            $("#NAPCOT_"+id).show();            
            $("#NAPCOT_"+id+">*,#NAPCOT_"+id+">*>*,#NAPCOT_"+id+">*>*>*").attr("disabled",false);
        }
        else if(tipo=="SEG")
        {         

            $("#SEGCOT_"+id).show();
            $("#SEGCOT_"+id+">*,#SEGCOT_"+id+">*>*,#SEGCOT_"+id+">*>*>*").attr("disabled",false);
        }
    }
    function fchsegcot(id)
    {
        val=$("#prog_seguimientocot_"+id).attr("checked");
        if(val==true)
        {
            $("#fchasegcot_"+id).show();      
        }
        else
        {
            $("#fchasegcot_"+id).hide();      
        }
    }
</script>
</div>