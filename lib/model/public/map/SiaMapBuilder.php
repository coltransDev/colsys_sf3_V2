<?php



class SiaMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.SiaMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(SiaPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(SiaPeer::TABLE_NAME);
		$tMap->setPhpName('Sia');
		$tMap->setClassname('Sia');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_sia_ca_idsia_seq');

		$tMap->addPrimaryKey('CA_IDSIA', 'CaIdsia', 'INTEGER', true, null);

		$tMap->addColumn('CA_NOMBRE', 'CaNombre', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TEL', 'CaTel', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CONTACTO', 'CaContacto', 'VARCHAR', false, null);

	} 
} 