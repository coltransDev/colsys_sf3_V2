<div align="center">
<h3>Listado de Cargas</h3>
</div>
<br />

<?
include_component("reportes", "listaReportes", array("impoexpo"=>Constantes::OTMDTA,"transporte"=>Constantes::TERRESTRE));
?>



<div align="left" id="leyenda" >
	<table width="200" border="1" cellspacing="0" cellpadding="0" class="table1">
		<tr>
			<th ><strong>Convenciones</strong></th>
		</tr>
        <tr class="orange1">		
			<td>Nueva Orden</td>
		</tr>
        
		<tr>		
			<td>Sin novedad</td>
		</tr>
		<tr class="green">		
			<td>Nuevo Status</td>
		</tr>
		<tr class="yellow">		
			<td >Pendiente por instrucciones</td>
		</tr>		
		<tr class="blue">		
			<td>Carga embarcada</td>
		</tr>		
		<tr class="orange">		
			<td>Carga entregada</td>
		</tr>
		<tr class="purple">		
			<td>Carga en transporte terrestre</td>
		</tr>		
		<tr class="pink">
			<td>Orden Anulada </td>
		</tr>
	</table>
</div>


