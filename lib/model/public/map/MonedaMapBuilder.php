<?php



class MonedaMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.MonedaMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(MonedaPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(MonedaPeer::TABLE_NAME);
		$tMap->setPhpName('Moneda');
		$tMap->setClassname('Moneda');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_IDMONEDA', 'CaIdmoneda', 'VARCHAR', true, 3);

		$tMap->addColumn('CA_NOMBRE', 'CaNombre', 'VARCHAR', false, null);

		$tMap->addColumn('CA_REFERENCIA', 'CaReferencia', 'VARCHAR', false, 3);

	} 
} 