<?php



class FestivoMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.FestivoMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(FestivoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(FestivoPeer::TABLE_NAME);
		$tMap->setPhpName('Festivo');
		$tMap->setClassname('Festivo');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_FCHFESTIVO', 'CaFchfestivo', 'DATE', true, null);

	} 
} 