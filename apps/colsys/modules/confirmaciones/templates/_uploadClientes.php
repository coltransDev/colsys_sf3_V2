<?
include_component("widgets", "widgetUploadImages");
?>
<tr>
				<th class="titulo" colspan="6">Adjuntar Fotos de averias en la carga de los clientes</th>
			</tr>
			<tr height="5">
				<td class="captura" colspan="6">&nbsp;</td>
			</tr>
            
			<?
            $dimension=100;
            $i=0;
            $j=0;
			foreach( $inoClientes as $inoCliente ){
                $i++;
				$cliente = $inoCliente->getCliente();
				$reporte = $inoCliente->getReporte();
                $folder="Referencias/".$inoCliente->getCaReferencia()."/".$inoCliente->getCaHbls()."/";
                $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;
                $archivos = sfFinder::type('file')->maxDepth(0)->in($directory);            
                $narchivos=count($archivos);
                $alto=ceil($narchivos/4)*$dimension;
                
			?>
			<tr>
				<td class="listar" style='font-size: 11px; vertical-align:bottom'><b>Reporte:</b><br />
					<?=$reporte?$reporte->getCaConsecutivo():"&nbsp;"?>
                    <input type="hidden" id='consolidar_comunicaciones_<?=$inoCliente->getOid()?>' value="<?=$cliente->getProperty("consolidar_comunicaciones")?>" />
                    <input type="hidden" id='nombre_cliente_<?=$inoCliente->getOid()?>' value="<?=$cliente->getCaCompania()?>" />
                </td>
				<td class="listar" style='font-size: 11px; vertical-align:bottom'><span class="listar" style="font-size: 11px; vertical-align:bottom"><b>Id Cliente:</b><br />
					<?=number_format($inoCliente->getCaIdcliente())?>
					</span></td>
				<td class="listar" style='font-size: 11px;' colspan="3"><b>Nombre del Cliente:</b><br />
					<?=Utils::replace($cliente->getCaCompania())?></td>
				<td class="listar"  >
                    <form>
		<div style="width: 180px; height: 18px; border: solid 1px #7FAAFF; background-color: #C5D9FF; padding: 2px;">
			<span id="but<?=$i?>"></span>
		</div>
	</form>
                    <div id="div<?=$i?>"></div>
                    <script>
                        
                        chart<?=$i?>=new WidgetUploadImages({                            
                            post_params: {
                              "folder": "<?=base64_encode($folder)?>",
                              "tam_max": "<?=$dimension?>",
                              "thumbnails":"thumbnails_<?=$i?>"
                            },                            
                            button_placeholder_id : "but<?=$i?>",
                            upload_target : 'div<?=$i?>'                            
                        });                
                    </script>
				</td>
			</tr>	
            <tr height="<?=$alto+20?>">
                <td colspan="6" style="vertical-align: top" >
                    <div id="thumbnails_<?=$i?>">
		<?php
			// Read the files from the saved images folder
            
            //echo $archivos
			foreach ($archivos as $file) {
                //echo $file."<br>";
				$archivo =explode("/", $file );
                $filename = $archivo[count($archivo)-1];
                $id_base=base64_encode($folder.$filename);
                //echo $folder."/".$filename."<br>";
				echo '<div style="width:'.$dimension.'px;height:'.$dimension.'px;float: left;margin: 5px;">
                        <div style="position:relative ">
                            <div style="position:absolute;" >
                                <img style=" vertical-align: middle;" src="/gestDocumental/verArchivo?idarchivo='.base64_encode($folder."/".$filename) . '" width="'.$dimension.'" height="'.$dimension.'" />
                            </div>
                            <div style="position:absolute;top:0px;right:0px" >
                                <img src="/images/16x16/button_cancel.gif" style="cursor: pointer" onclick="deleteFile(&quot;'.$id_base.'&quot;,&quot;file_'.$j++.'&quot;)" />
                            </div>
                            <div style="position:absolute;top:20px;right:0px;display:none" >
                                <input type="checkbox" value="'.$folder.'"/"'.$filename.'" name="files[]" />
                            </div>
                        </div>                        
                      </div>';
			}
		?>
	</div>
                </td>
            </tr>
			<? 
            //break;
            }
			?>
            

<script>
    
    function deleteFile(file,idtr)
    {
        if(window.confirm("Realmente desea eliminar este archivo?"))
        {
            Ext.MessageBox.wait('Guardando, Espere por favor', '---');
            Ext.Ajax.request(
            {
                waitMsg: 'Guardando cambios...',
                url: '<?= url_for("gestDocumental/borrarArchivo") ?>',
                params :	{
                    idarchivo:file
                },
                failure:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if(res.err)
                        Ext.MessageBox.alert("Mensaje",'Se presento un error guardando por favor informe al Depto. de Sistemas<br>'+res.err);
                    else
                        Ext.MessageBox.alert("Mensaje",'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>'+res.texto);
                },
                success:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    $("#"+idtr).remove();
                    Ext.MessageBox.hide();
                }
            });
        }
    }
        </script>