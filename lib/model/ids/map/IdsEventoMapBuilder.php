<?php



class IdsEventoMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.ids.map.IdsEventoMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(IdsEventoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(IdsEventoPeer::TABLE_NAME);
		$tMap->setPhpName('IdsEvento');
		$tMap->setClassname('IdsEvento');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('ids.tb_eventos_id');

		$tMap->addPrimaryKey('CA_IDEVENTO', 'CaIdevento', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_ID', 'CaId', 'INTEGER', 'ids.tb_ids', 'CA_ID', true, null);

		$tMap->addColumn('CA_EVENTO', 'CaEvento', 'VARCHAR', false, null);

		$tMap->addColumn('CA_REFERENCIA', 'CaReferencia', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_IDCRITERIO', 'CaIdcriterio', 'INTEGER', 'ids.tb_criterios', 'CA_IDCRITERIO', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', true, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', true, null);

	} 
} 