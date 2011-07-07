<?
/*
* Muestra los resultados de la busqueda de la cotización
* @author Andres Botero
*/
?>
<div align="center">
<?



$url = "ids/busqueda?modo=".$modo."&criterio=".$criterio;
if( $cadena ){
	$url.="&cadena=".$cadena;
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

<table class="tableList" width="800px" border="1" id="mainTable">
	<tr>
		<th width="57" scope="col">Identificacion</th>
		<th width="468" scope="col">Nombre</th>
        <?
        if( $modo=="agentes"){
        ?>
        <th width="100" scope="col">Opciones</th>
        <?
        }
        ?>
        <th width="200" scope="col">Ciudad</th>
        
	</tr>
	<?
	foreach( $idsList as $ids ){	
        $identificacion = $ids->getCaIdalterno()?$ids->getCaIdalterno()." ".$ids->getCaDv():$ids->getCaId();

	?>
	<tr>
        <td  ><?=link_to( $identificacion, "ids/verIds?modo=".$modo."&id=".$ids->getCaId())?></td>
        <td ><?=link_to( $ids->getCaNombre(), "ids/verIds?modo=".$modo."&id=".$ids->getCaId())?></td>
        <?
        if( $modo=="agentes"){
            $agente = $ids->getIdsAgente();
        ?>
        <td >
            <?=$agente->getCaTipo()=="Oficial"?$agente->getCaTipo():"<span class='rojo'>".$agente->getCaTipo()."</span>"?>
            <br />
            <?=$agente->getCaActivo()?"Activo":"<span class='rojo'>Inactivo</span>"?>
            <br />
            <?=$agente->getCaTplogistics()?"<span class='rojo'>Agente TPLogistics</span>":""?>
        </td>
        <?
        }
        ?>
        <td >
              <?
                $sucursales = $ids->getIdsSucursal();
                foreach( $sucursales as $sucursal ){
                    echo $sucursal->getCiudad()->getCaCiudad()." ";
                }
                ?>
              </td>
      
	</tr>
	<?
	}
	if( count($idsList)==0 ){
	?>
	<tr>
		<td  colspan="4" ><div align="center"><b>No hay resultados</b></div></td>
	</tr>
	<?
	}
	?>
</table>
<br />
<br />
</div>
