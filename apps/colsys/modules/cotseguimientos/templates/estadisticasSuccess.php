<?

include_component("cotizaciones", "chart");
?>
<div align="center">
<br>
<h3>Estadisticas de cotizaciones <?=$fechaInicial?> <?=$fechaFinal?> <br>
<?
if( $usuario ){
	echo "Vendedor: ".$usuario->getCaNombre();
}
if( $sucursal ){
	echo " Sucursal: ".$sucursal;
}
if( isset($origen) ){
	echo "<br> Origen: ".$origen;
}
if( isset($destino) ){
	echo " Destino: ".$destino;
}
?>
</h3>
<br />
<br />
<h1>Cotizaciones con trayectos</h1>
Datos basados en <?=$numcotizaciones?> cotizaciones
<br />
<table>
	<tr>
		<td valign="top">
			<table width="350" border="1" class="tableList">
				<tr>
					<th scope="col">Estado</th>
					<th scope="col">Cantidad de trayectos</th>
					<th scope="col">Cantidad de trayectos con seguimientos</th>
					<th scope="col">Seguimiento</th>
				</tr>
				<?
				$total = 0;
				$total2 = 0;
				
				$dataG="";
				$dataG1="";
				foreach( $rows as $row )
				{
					$dataG.=($dataG!="")?",":"";
					$dataG.='{"opcion":"'.$estados[$row["p_ca_etapa"]].'-'.$row["s_seguimiento"].'","total":'.$row["p_count"].'}';
				?>
				<tr>
					<td><?=$estados[$row["p_ca_etapa"]]?></td>
					<td><?=$row["p_count"]?></td>
					<td><?=$row["s_conseg"]?></td>
					<td><?=$row["s_seguimiento"]?></td>
				</tr>
				<?
				$total+=$row["p_count"];
				$total2+=$row["s_conseg"];
				}
				?>
				<tr>
					<td><b>Total</b></td>
					<td><?=$total?></td>
					<td><?=$total2?></td>
				</tr>
			</table>
		</td>
		<td valign="top">
			<div id="grafica"></div>
		</td>
	</tr>
</table>


<br />
<br />
<h1>Cotizaciones sin trayectos</h1>
<br />
<table>
	<tr>
		<td valign="top">
			<table width="350" border="1" class="tableList">
				<tr>
					<th scope="col">Estado</th>
					<th scope="col">Cantidad de cotizaciones</th>
					<th scope="col">Cantidad de cotizaciones con seguimientos</th>
				</tr>
				<?
				$total = 0;
				$total2 = 0;
				foreach( $rows2 as $row )
				{
					$dataG1.=($dataG1!="")?",":"";
					$dataG1.='{"opcion":"'.$estados[$row["c_ca_etapa"]].'","total":'.$row["c_count"].'}';
				?>
				<tr>
					<td><?=$estados[$row["c_ca_etapa"]]?></td>
					<td><?=$row["c_count"]?></td>
					<td><?=$row["s_conseg"]?></td>
				</tr>
				<?
				$total+=$row["c_count"];
				$total2+=$row["s_conseg"];
				}
				?>

				<tr>
					<td><b>Total</b></td>
					<td><?=$total?></td>
					<td><?=$total2?></td>
				</tr>
			</table>
		</td>
		<td valign="top">
			<div id="grafica1"></div>
		</td>
	</tr>
</table>
</div>
<script type="text/javascript">
Ext.onReady(function(){
Ext.QuickTips.init();
    var chartPanel = new ChartPanel({
        title: "Grafica",
        renderTo:'grafica',
        title: 'Trayectos',
		id:'chart-panel',
		data:[<?=$dataG?>],
		width: 400,
        height: 300
    });

	var chartPanel1 = new ChartPanel({
        title: "Grafica",
        renderTo:'grafica1',
        title: 'Trayectos',
		id:'chart-panel1',
		data:[<?=$dataG1?>],
		width: 400,
        height: 300
    });

//	Ext.getCmp("chart-panel").store.loadData(res.data);
});
</script>