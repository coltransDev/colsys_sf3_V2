<script language="javascript" type="text/javascript">
    var getDV = function(comprobar){

        if( document.getElementById("tipo_identificacion").value=="3" ){
            document.getElementById("idalterno").value="";
            document.getElementById("idalterno").disabled=true;
        }else{
            document.getElementById("idalterno").disabled=false;
        }

        if( document.getElementById("tipo_identificacion").value=="1" ){
            var dv = d_verificacion(document.getElementById("idalterno").value);
            document.getElementById("dv").value = dv;
            if( comprobar ){
                Ext.Ajax.request(
                {
                    waitMsg: 'Comprobando ID...',
                    url: '<?=url_for("ids/comprobarId")?>',
                    //Solamente se envian los cambios
                    params :	{idalterno:document.getElementById("idalterno").value,
                                 tipo_identificacion:document.getElementById("tipo_identificacion").value
                                },

                    callback :function(options, success, response){

                        var res = Ext.util.JSON.decode( response.responseText );
                        //alert(res.id);
                        if(res.id){
                            document.location = '<?=url_for("ids/verIds?modo=".$modo)?>?id='+res.id
                        }
                    }
                 }
                );
            }

        }else{
            document.getElementById("dv").value = "";
        }
    }
    
    var habilitar = function(){
        if( document.getElementById("controladoporsig").value=="1" || document.getElementById("controladoporsig").value=="2" || document.getElementById("controladoporsig").value=="5" || document.getElementById("controladoporsig").value=="6"){
            document.getElementById("fchvencimiento").style.display = "none";
            document.getElementById("nfchvencimiento").style.display = "none";
        }else{
            document.getElementById("fchvencimiento").style.display = "";
            document.getElementById("nfchvencimiento").style.display = "";
        }
    }

    var changeTipo = function(){

        if( document.getElementById("tipo_proveedor").value=="TRI" || document.getElementById("tipo_proveedor").value=="TRN" ){
            document.getElementById("prov_tri").style.display="";
        }else{
            document.getElementById("prov_tri").style.display="none";
        }


    }
</script>
<div class="content" align="center">

    <form action="<?=url_for("ids/formIds?modo=".$modo."" )?>" method="post" name="form1" >
	<input type="hidden" name="id" value="<?=$ids->getCaId()?>" />
    <table width="80%" border="0" class="tableList alignLeft">
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
            
                echo $form['tipo_identificacion']->renderError();

                if( $ids->getCaTipoidentificacion() ){
                    $form->setDefault('tipo_identificacion', $ids->getCaTipoidentificacion() );
                }elseif( $modo=="agentes" ){
                    $form->setDefault('tipo_identificacion', 3 );
                }
                echo $form['tipo_identificacion']->render();
           
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
            
            echo $form['idalterno']->renderError();
            if( $ids->getCaIdalterno() ){
                $form->setDefault('idalterno', $ids->getCaIdalterno() );
            }
            echo $form['idalterno']->render();
            
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
            echo $form['dv']->renderError();
            if( $ids->getCaDv() ){
                $form->setDefault('dv', $ids->getCaDv() );
            }
            echo $form['dv']->render();            
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
    <tr>        
    
        <td valign="top"> 
            <div align="left"><b>TP Logistics</b></div><div align="left"><b>Consolcargo</b></div></td>
        <td valign="top">
            <?
            echo $form['tplogistics']->renderError();
            if( $agente ){
                $form->setDefault('tplogistics', $agente->getCaTplogistics() );
            }else{
                $form->setDefault('tplogistics', false );
            }
            echo $form['tplogistics']->render();
            echo "<br>";
            echo $form['tplogistics']->renderError();
            
            if( $agente ){
                $form->setDefault('consolcargo', $agente->getCaConsolcargo() );
            }else{
                $form->setDefault('consolcargo', false );
            }
            echo $form['consolcargo']->render();
            ?>
        </td>
        <td width="16%" valign="top">
            <div align="left"><b>Informaci&oacute;n de Seguridad:</b></div>
        </td>
        <td width="26%">
            <div align="left">
            <?
            echo $form['infosec']->renderError();
            $form->setDefault('infosec', $agente->getCaInfosec() );
            echo $form['infosec']->render();
            ?>
             </div>
        </td>
    </tr>
    
    <tr>        
    
        <td valign="top"> 
            <div align="left"><b>Modalidad</b></div></td>
        <td valign="top">
            <?
            echo $form['modalidad']->renderError();
            if( $agente ){
                $form->setDefault('modalidad', $agente->getCaModalidad() );
            }else{
                $form->setDefault('modalidad', "" );
            }
            echo $form['modalidad']->render();
            echo "<br>";
            echo $form['modalidad']->renderError();            
            
            ?>
        </td>
        <td width="16%" valign="top">
            <div align="left"><b>Observaciones:</b></div>
        </td>
        <td width="26%">
            <div align="left">
            <?
            echo $form['observaciones']->renderError();
            $form->setDefault('observaciones', $agente->getCaObservaciones() );
            echo $form['observaciones']->render();
            ?>
             </div>
        </td>
    </tr>
    
    <tr>        
    
        <td valign="top"> 
            <div align="left"><b>Sucursal Compañia</b></div></td>
        <td valign="top">
            <?
            echo $form['sucursal']->renderError();
            if( $agente ){
                $form->setDefault('sucursal', $agente->getCaSucursal() );
            }else{
                $form->setDefault('sucursal', "" );
            }
            echo $form['sucursal']->render();
            echo "<br>";
            echo $form['sucursal']->renderError();            
            
            ?>
        </td>
        <td width="16%" valign="top">
            
        </td>
        <td width="26%">
            
        </td>
    </tr>
    
    <?

    }    
    if( isset($formProveedor) ){
        $proveedor = $ids->getIdsProveedor();
    
    ?>
    <tr >
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
        <td> <div align="left"><b>Activo Impo:</b></div></td>
		<td colspan="3">
                <div align="left">
           <?
            echo $form['activo_impo']->renderError();
            if( $proveedor ){
                $form->setDefault('activo_impo', $proveedor->getCaActivoImpo() );
            }else{
                $form->setDefault('activo_impo', true );
            }
            echo $form['activo_impo']->render();
            ?>
            </div>
           
        </td>
	</tr>
    <tr >
        <td colspan="2">&nbsp;</td>
        <td> <div align="left"><b>Activo Expo:</b></div></td>
		<td colspan="3">
                <div align="left">
           <?
            echo $form['activo_expo']->renderError();
            if( $proveedor ){
                $form->setDefault('activo_expo', $proveedor->getCaActivoExpo() );
            }else{
                $form->setDefault('activo_expo', true );
            }
            echo $form['activo_expo']->render();
            ?>
            </div>

        </td>
    </tr>
    <tr >
        <td colspan="2">&nbsp;</td>
        <td> <div align="left"><b>Vetado:</b></div></td>
		<td colspan="3">
                <div align="left">
           <?
            echo $form['vetado']->renderError();
            if( $proveedor ){
                $form->setDefault('vetado', $proveedor->getCaVetado() );
            }else{
                $form->setDefault('vetado', false );
            }
            echo $form['vetado']->render();
            ?>
            </div>
        </td>
    </tr>
    <?
    if( $idtrafico=="CO-057" ){
    ?>
    <tr >
        <td> <div align="left"><b>Empresa:</b></div></td>
		<td >
            <div align="left">
            <?
            echo $form['empresa']->renderError();
            if( $proveedor ){
                $form->setDefault('empresa', $proveedor->getCaEmpresa() );
            }
            echo $form['empresa']->render();
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
    <tr id="prov_tri">
        <td> <div align="left"><b>Sigla:</b></div></td>
		<td >
            <div align="left">
            <?
            echo $form['sigla']->renderError();
            if( $proveedor ){
                $form->setDefault('sigla', $proveedor->getCaSigla() );
            }
            echo $form['sigla']->render();
            ?>
            </div>
        </td>
        <td> <div align="left"><b>Transporte:</b></div></td>
		<td colspan="3">
                <div align="left">
            <?
            echo $form['transporte']->renderError();
            if( $proveedor ){
                $form->setDefault('transporte', $proveedor->getCaTransporte() );
            }
            echo $form['transporte']->render();
            ?>
            </div>

        </td>
	</tr>

        <?
        if( $nivel>=5 ){
        ?>

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
        <td> <div align="left"><b>Aprobado:</b></div></td>
            <td >
             <div align="left">
            <?
            echo $form['aprobado']->renderError();
            if( $proveedor ){
                $form->setDefault('aprobado', $proveedor->getCaFchaprobado() );
            }
            echo $form['aprobado']->render();
            ?>
            </div>
            </td>
        <td> <div align="left"><b>Obliga Firma Contrato Comodato:</b></td>
		<td colspan="3">
             <div align="left">
            <?
            echo $form['contrato_comodato']->renderError();
            if( $proveedor ){
                $form->setDefault('contrato_comodato', $proveedor->getCaContratoComodato() );
            }
            echo $form['contrato_comodato']->render();
            ?>
            </div>
        </td>
    </tr>
    <tr>
        <td> <div align="left" id="nfchvencimiento"><b>Fch. Vencimiento:</b></div></td>
        <td><div align="left" id="fchvencimiento">
            <?
            echo $form['fchvencimiento']->renderError();
            if( $proveedor ){
                $form->setDefault('fchvencimiento', $proveedor->getCaFchvencimiento() );
            }
            echo $form['fchvencimiento']->render();
            ?>
            </div>
        </td>
        <td> <div align="left"><b>Jefe Encargado:</b></div></td>
        <td><div align="left">
            <?
            echo $form['jefecuenta']->renderError();
            if( $proveedor ){
                $form->setDefault('jefecuenta', $proveedor->getCaJefecuenta() );
            }
            echo $form['jefecuenta']->render();
            ?>
            </div>
        </td>
    </tr>
    <tr>
        <th colspan="6"><div align="left"><b>Informaci&oacute;n de Seguridad:</b></div></th>
    </tr>
    <tr>
        <td> <div align="left"><b>Antecedentes Legales:</b></td>
        <td><div align="left">
            <?

            echo $form['ant_legales']->renderError();
            if( $proveedor ){
                $form->setDefault('ant_legales', $proveedor->getCaAntlegales() );
            }
            echo $form['ant_legales']->render();
            ?>
            </div></td>
        <td> <div align="left"><b>Antecedentes Penales:</b></td>
        <td><div align="left">
        <?

        echo $form['ant_penales']->renderError();
        if( $proveedor ){
            $form->setDefault('ant_penales', $proveedor->getCaAntlegales() );
        }
        echo $form['ant_penales']->render();
        ?>
            </div></td>
         <td> <div align="left"><b>Antecedentes Financieros:</b></td>
        <td><div align="left">
        <?

        echo $form['ant_financieros']->renderError();
        if( $proveedor ){
            $form->setDefault('ant_financieros', $proveedor->getCaAntlegales() );
        }
        echo $form['ant_financieros']->render();
        ?>
            </div></td>
    </tr>
	


    <?
        }
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

    
    getDV( false );
    changeTipo();
    habilitar();
</script>



