<?php
require_once(dirname(__FILE__).'/../../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'dev', true);
sfContext::createInstance($configuration)->dispatch();

// Borra las dos líneas siguientes si no utilizas una base de datos
$databaseManager = new sfDatabaseManager($configuration);
$databaseManager->loadConfiguration();

set_time_limit(0);

$inicio  = mktime(0, 0, 0, date("m")-3, 1, date("Y"));
$final = mktime(0, 0, 0, date("m"), -1, date("Y"));

echo "Inicio-> ".date('m-d-Y',$inicio)." -> "."Final->".date('m-d-Y',$final);

$rs = ClientePeer::estadoClientes(date('m-d-Y',$inicio), date('m-d-Y',$final), 'Coltrans');

echo "<table border=1 width=900>";
while($rs->next()) {
	echo "<tr>";
		echo "<td>".$rs->getString("ca_idcliente")."</td>";
		echo "<td>".$rs->getString("ca_fchestado")."</td>";
		echo "<td>".$rs->getString("ca_estado")."</td>";
		echo "<td>".$rs->getString("ca_empresa")."</td>";
		list($year, $month, $day) = sscanf($rs->getString("ca_fchestado"), "%d-%d-%d");
		
		echo "<td>";
		$sb = ClientePeer::estadoClientes(null, date('m-d-Y',mktime(0,0,0,$month,$day-1,$year)), 'Coltrans', $rs->getString("ca_idcliente"));
		echo "<table border=1 width=450>";
		while($sb->next()) {
			echo "<tr>";
				echo "<td>".$sb->getString("ca_idcliente")."</td>";
				echo "<td>".$sb->getString("ca_fchestado")."</td>";
				echo "<td>".$sb->getString("ca_estado")."</td>";
				echo "<td>".$sb->getString("ca_empresa")."</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</td>";
	echo "</tr>";
}
echo "</table>";
