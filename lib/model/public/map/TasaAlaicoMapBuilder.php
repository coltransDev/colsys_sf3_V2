<?php



class TasaAlaicoMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.TasaAlaicoMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(TasaAlaicoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TasaAlaicoPeer::TABLE_NAME);
		$tMap->setPhpName('TasaAlaico');
		$tMap->setClassname('TasaAlaico');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_FECHAINICIAL', 'CaFechainicial', 'DATE', true, null);

		$tMap->addColumn('CA_FECHAFINAL', 'CaFechafinal', 'DATE', true, null);

		$tMap->addColumn('CA_VALORTASA', 'CaValortasa', 'VARCHAR', true, null);

	} 
} 