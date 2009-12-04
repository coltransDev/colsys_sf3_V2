<div align="center" class="content">

<h3>Seguimientos Cotizaci&oacute;n No <?=$cotizacion->getCaConsecutivo()?></h3>

<br />
<table width="80%" border="0" class="tableList">
	
	<?

    if( count($productos)==0 ){
        $tarea = $cotizacion->getNotTarea();
        $seguimientos = $cotizacion->getSeguimientos();

        include_partial("seguimientos", array("tarea"=>$tarea, "seguimientos"=>$seguimientos, "cotizacion"=>$cotizacion));
    }else{
        foreach( $productos as $producto ){

            $tarea = $producto->getNotTarea();
            ?>
            <tr>
                <th colspan="5"><div align="left">
                    <b>Trayecto:</b>
                    <?=Utils::replace($producto->__toString())?>
                </div></th>
            </tr>

            
            <?
            $tarea = $producto->getNotTarea();
            $seguimientos = $producto->getSeguimientos();
            
            include_partial("seguimientos", array("tarea"=>$tarea, "seguimientos"=>$seguimientos, "cotizacion"=>$cotizacion, "producto"=>$producto));

        }
    }
	?>	
</table>
</div>