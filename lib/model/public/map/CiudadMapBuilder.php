<?php



class CiudadMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.CiudadMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(CiudadPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(CiudadPeer::TABLE_NAME);
		$tMap->setPhpName('Ciudad');
		$tMap->setClassname('Ciudad');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_IDCIUDAD', 'CaIdciudad', 'VARCHAR', true, null);

		$tMap->addColumn('CA_CIUDAD', 'CaCiudad', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_IDTRAFICO', 'CaIdtrafico', 'VARCHAR', 'tb_traficos', 'CA_IDTRAFICO', false, null);

		$tMap->addColumn('CA_PUERTO', 'CaPuerto', 'VARCHAR', false, null);

	} 
} 