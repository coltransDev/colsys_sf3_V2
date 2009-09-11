<?php



class RepAsignacionMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.reportes.map.RepAsignacionMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(RepAsignacionPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(RepAsignacionPeer::TABLE_NAME);
		$tMap->setPhpName('RepAsignacion');
		$tMap->setClassname('RepAsignacion');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDREPORTE', 'CaIdreporte', 'INTEGER' , 'tb_reportes', 'CA_IDREPORTE', true, null);

		$tMap->addForeignPrimaryKey('CA_IDTAREA', 'CaIdtarea', 'INTEGER' , 'notificaciones.tb_tareas', 'CA_IDTAREA', true, null);

	} 
} 