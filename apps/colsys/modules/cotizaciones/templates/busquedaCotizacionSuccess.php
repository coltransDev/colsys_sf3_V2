<?
/*
* Muestra los resultados de la busqueda de la cotización 
* @author Andres Botero
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

if( $seguimiento ){
	$url.="&seguimiento=".$seguimiento;
}

$pagerLayout = new Doctrine_Pager_Layout(
      $pager,
      new Doctrine_Pager_Range_Sliding(array(
            'chunk' => 5
      )),
      url_for($url)."?page={%page_number}"
);

$pagerLayout->setTemplate('<a href="{%url}">{%page}</a> ');
$pagerLayout->setSelectedTemplate('{%page}');


$idsList = $pager->execute();

$pagerLayout->display();


?>
<br />
<br />
<form id="formProducto" name="formProducto" >
<table class="tableList" width="800px" border="1" id="mainTable">
	<tr>
		<th width="57" scope="col">Consecutivo</th>
		<th width="668" colspan="4" scope="col">Cotizaci&oacute;n</th>
	</tr>
	<?
	
	foreach( $cotizaciones as $cotizacion ){
		$contacto = $cotizacion->getContacto();
		$cliente = $contacto->getCliente(); 
	?>
	<tr>
	  <td rowspan="2"  >
        <?=link_to("C".$cotizacion->getCaConsecutivo(), "cotizaciones/consultaCotizacion?id=".$cotizacion->getCaIdcotizacion())?>
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
	</tr>
    
	<tr>
	  <td colspan="4" >
        <b>Trayectos:</b>
	  	<table class="tableList" width="100%" border="1">
        <?
        $productos = $cotizacion->getCotProductos();

        if( count($productos)>0 ){
        ?>
	  	
        <? 
            foreach( $productos as $producto ){
                if($producto->getCaTransporte()=="OTM-DTA")
                    continue;
                $origen = $producto->getOrigen();
                $destino = $producto->getDestino();
            ?>
        <tr>
          <td width="33%" class="listar" >
            <?=$producto->getCaImpoexpo()?>
            &raquo;			
            <?=$producto->getCaTransporte()?>
            &raquo;
            <?=$producto->getCaModalidad()?> [<?=$producto->getCaProducto()?>]</td>
          <td width="32%" class="listar"><?=$origen->getTrafico()." ".$origen->getCaCiudad()?>
            &raquo;
            <?=$destino->getTrafico()." ".$destino->getCaCiudad()?></td>
            <td width="35%" class="listar">
                <?
                echo isset($estados[$producto->getCaEtapa()])?$estados[$producto->getCaEtapa()]:"";

                $seg = $producto->getUltSeguimiento();
                if( $producto->getCaEtapa()==Cotizacion::EN_SEGUIMIENTO ){
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
            </td><td width="50" style="width: 50px; padding: 15px">
                <input type="checkbox" name="idproducto[]" value="<?=$producto->getCaIdproducto()?>">
                <?
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
             
                <td width="35%" class="listar">
                    <?
                    echo isset($estados[$cotizacion->getCaEtapa()])?$estados[$cotizacion->getCaEtapa()]:"";
                    if( $cotizacion->getCaEtapa()==Cotizacion::EN_SEGUIMIENTO ){
                        $seg = $cotizacion->getUltSeguimiento();
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
        <tr><td colspan="4"></td><td align="right"><input value="Aprobar" type="button" onclick="validar()"  ></td></tr>
        <?
        }
	?>
	
	
</table>
</form>
<script type="text/javascript">
    function validar()
    {
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
                    alert("Error:"+a.responseText.replace(/<br \/>/gi ,"\n"));
           },
           failure: function(a,b){
               alert("Error:"+a.responseText.toString());

           }

        });
    }
</script>
<br />
<br />
</div>
