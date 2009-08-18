<script language="javascript" type="text/javascript">
    var getDV = function(){

        if( document.getElementById("tipo_identificacion").value=="3" ){
            document.getElementById("id").value="";
            document.getElementById("id").disabled=true;
        }else{
            document.getElementById("id").disabled=false;
        }

        if( document.getElementById("tipo_identificacion").value=="1" ){
            var dv = d_verificacion(document.getElementById("id").value);
            document.getElementById("dv").value = dv;
        }else{
            document.getElementById("dv").value = "";
        }
    }
</script>
<div class="content" align="center">

    <form action="<?=url_for("ids/formIds?modo=".$modo."" )?>" method="post" name="form1" >
	<table width="80%" border="0" class="tableList">
	<tr>		
        <th colspan="6"><div align="left"><b>Datos basicos</b></div> </th>
	</tr>

    <?
	if( $form->renderGlobalErrors() ){
	?>
	<tr>
		<td colspan="6">
		 <div align="left"><?php echo $form->renderGlobalErrors() ?>		</div></td>
	</tr>
	<?
	}
	?>
    <tr>
		<td width="22%"> <div align="left"><b>Tipo de identificaci&oacute;n </b></div></td>
		<td width="25%">
             <div align="left">
            <?            
            if( $ids->isNew() ){
                echo $form['tipo_identificacion']->renderError();
                if( $modo=="agentes" ){
                    $form->setDefault('tipo_identificacion', 3 );
                }
                echo $form['tipo_identificacion']->render();
            }else{
                echo $ids->getCaTipoidentificacion();
                ?>
                <input type="hidden" name="tipo_identificacion" value="<?=$ids->getCaTipoidentificacion()?>" />
                <?
            }
            ?>
             </div>
        </td>
		<td width="16%">
             <div align="left">
                   <b>Identificaci&oacute;n</b>
             </div>
        </td>
        
		<td width="26%">
            <div align="left">
            <?
            if( !$ids->getCaId() ){
                echo $form['id']->renderError();
                echo $form['id']->render();
            }else{
                echo $ids->getCaId();
                ?>
                <input type="hidden" name="id" value="<?=$ids->getCaId()?>" />
                <?
            }
            ?>
            </div>
		<td width="6%">
               <div align="left">
                   <b>DV</b>
               </div>
        </td>
		<td width="5%">
            <div align="left">
            <?
            if( !$ids->getCaId() ){
                echo $form['dv']->renderError();
                echo $form['dv']->render();
            }else{
                echo $ids->getCaDv();
                ?>
                <input type="hidden" name="dv" value="<?=$ids->getCaDv()?>" />
                <?
            }
            ?>
            </div>

        </td>
	</tr>
	<tr>
		<td> <div align="left"><b>Nombre</b></div></td>
        <td colspan="5">
             <div align="left">
            <?
            echo $form['nombre']->renderError();
            $form->setDefault('nombre', $ids->getCaNombre() );
            echo $form['nombre']->render();
            ?>
             </div>
        </td>
	</tr>
	<tr>
        <td> <div align="left"><b>Website:</b></div></td>
		<td colspan="5">
             <div align="left">
            <?
            echo $form['website']->renderError();
            $form->setDefault('website', $ids->getCaWebsite() );
            echo $form['website']->render();
            ?>
             </div>
        </td>
	</tr>
    <?
    if( isset($formAgente) ){
        $agente = $ids->getIdsAgente();
    
    ?>
    <tr>
		<td> <div align="left"><b>Tipo</b></div></td>
        <td>
            <div align="left">
            <?
            echo $form['tipo']->renderError();
            if( $agente ){
                $form->setDefault('tipo', $agente->getCaTipo() );
            }else{
                $form->setDefault('tipo', 'Oficial' );

            }
            echo $form['tipo']->render();
            ?>
             </div></td>
        <td> <div align="left"><b>Activo</b></div></td>
        <td colspan="3">
            <?
            echo $form['activo']->renderError();
            if( $agente ){
                $form->setDefault('activo', $agente->getCaActivo() );
            }else{
                $form->setDefault('activo', true );
            }
            echo $form['activo']->render();
            ?>
        </td>
	</tr>
    <?

    }    
    if( isset($formProveedor) ){
        $proveedor = $ids->getIdsProveedor();
    
    ?>
    <tr>
        <td> <div align="left"><b>Tipo de Proveedor:</b></div></td>
		<td >
            <div align="left">
            <?
            echo $form['tipo_proveedor']->renderError();
            if( $proveedor ){
                $form->setDefault('tipo_proveedor', $proveedor->getCaTipo() );
            }
            echo $form['tipo_proveedor']->render();
            ?>
            </div>
        </td>
        <td> <div align="left"><b>Aprobado:</b></div></td>
		<td colspan="3">
            <div align="left">
            <?
            echo $form['aprobado']->renderError();
            if( $proveedor ){
                $form->setDefault('aprobado', $proveedor->getCaFchaprobado()?true:false );
            }
            echo $form['aprobado']->render();
            ?>
            </div>
        </td>
	</tr>

    <tr>
        <td> <div align="left"><b>Controlado por SIG:</b></div></td>
		<td >
            <div align="left">
            <?
            echo $form['controladoporsig']->renderError();
            if( $proveedor ){
                $form->setDefault('controladoporsig', $proveedor->getCaControladoporsig() );
            }
            echo $form['controladoporsig']->render();
            ?>
            </div>
        </td>
        <td> <div align="left"><b>Critico:</b></div></td>
		<td colspan="3">
            <div align="left">
            <?
            echo $form['critico']->renderError();
            if( $proveedor ){
                $form->setDefault('critico', $proveedor->getCaCritico() );
            }
            echo $form['critico']->render();
            ?>
            </div>
        </td>
	</tr>

     <tr>
        <td> <div align="left"><b>Activo:</b></div></td>
		<td >
            <div align="left">
           <?
            echo $form['activo']->renderError();
            if( $proveedor ){
                $form->setDefault('activo', $proveedor->getCaActivo() );
            }else{
                $form->setDefault('activo', true );
            }
            echo $form['activo']->render();
            ?>
            </div>
        </td>
        <td> &nbsp;</td>
		<td colspan="3">
           &nbsp;
        </td>
	</tr>


    <?
    }
    ?>

	<tr>
		<th colspan="6"><div align="left"><b>Oficina Principal:</b></div></th>
		</tr>
	<tr>
		<td> <div align="left"><b>Direcci&oacute;n</b></div></td>
		<td><div align="left">
            <?

            $sucursal = $ids->getSucursalPrincipal();

            echo $form['direccion']->renderError();
            if( $sucursal ){
                $form->setDefault('direccion', $sucursal->getCaDireccion() );
            }
            echo $form['direccion']->render();
            ?>

            </div></td>
            <td><div align="left"><b>Ciudad</b></div></td>
		<td><div align="left">
            <?
            echo $form['idciudad']->renderError();
            if( $sucursal ){
                $form->setDefault('idciudad', $sucursal->getCaIdciudad() );
            }
            echo $form['idciudad']->render();
            ?>

            </div></td>
		<td><div align="left">&nbsp;</div></td>
		<td><div align="left">&nbsp;</div></td>
	</tr>
	<tr>
        <td><b>Tel&eacute;fonos</b></td>
		<td><div align="left">
            <?
            echo $form['telefonos']->renderError();
            if( $sucursal ){
                $form->setDefault('telefonos', $sucursal->getCaTelefonos() );
            }
            echo $form['telefonos']->render();
            ?>
            </div>
        </td>
        <td><b>Fax</b></td>
		<td><div align="left">
            <?
            echo $form['fax']->renderError();
            if( $sucursal ){
                $form->setDefault('fax', $sucursal->getCaFax() );
            }
            echo $form['fax']->render();
            ?>
            </div>
        </td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>    		
    <tr>
		<td colspan="6">
            <div align="center">
                <input type="submit" value="Guardar" class="button" />&nbsp;

                 <?
                if( $ids->isNew() ){
                    $url = "ids/index?modo=".$modo;
                }else{
                    $url = "ids/verIds?id=".$ids->getCaId()."&modo=".$modo;
                }
                ?>
                <input type="button" value="Cancelar" class="button" onClick="document.location='<?=url_for($url)?>'" />
            </div>
       </td>
	</tr>
</table>
    </form>
</div>

<script language="javascript" type="text/javascript">

    <?
    if( $ids->isNew() ){
    ?>
    getDV();
    <?
    }
    ?>
</script>



