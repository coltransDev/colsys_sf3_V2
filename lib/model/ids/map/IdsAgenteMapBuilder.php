<?php



class IdsAgenteMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.ids.map.IdsAgenteMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(IdsAgentePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(IdsAgentePeer::TABLE_NAME);
		$tMap->setPhpName('IdsAgente');
		$tMap->setClassname('IdsAgente');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDAGENTE', 'CaIdagente', 'INTEGER' , 'ids.tb_ids', 'CA_ID', true, null);

		$tMap->addColumn('CA_TIPO', 'CaTipo', 'VARCHAR', true, null);

		$tMap->addColumn('CA_ACTIVO', 'CaActivo', 'BOOLEAN', true, null);

	} 
} 