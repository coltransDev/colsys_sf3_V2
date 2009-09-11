<?php



class RepStatusRespuestaMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.reportes.map.RepStatusRespuestaMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(RepStatusRespuestaPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(RepStatusRespuestaPeer::TABLE_NAME);
		$tMap->setPhpName('RepStatusRespuesta');
		$tMap->setClassname('RepStatusRespuesta');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_repstatusrespuestas_id');

		$tMap->addPrimaryKey('CA_IDREPSTATUSRESPUESTAS', 'CaIdrepstatusrespuestas', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_IDSTATUS', 'CaIdstatus', 'INTEGER', 'tb_repstatus', 'CA_IDSTATUS', true, null);

		$tMap->addColumn('CA_RESPUESTA', 'CaRespuesta', 'VARCHAR', false, null);

		$tMap->addColumn('CA_EMAIL', 'CaEmail', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_LOGIN', 'CaLogin', 'VARCHAR', 'control.tb_usuarios', 'CA_LOGIN', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

	} 
} 