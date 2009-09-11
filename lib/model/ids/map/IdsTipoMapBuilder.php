<?php



class IdsTipoMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.ids.map.IdsTipoMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(IdsTipoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(IdsTipoPeer::TABLE_NAME);
		$tMap->setPhpName('IdsTipo');
		$tMap->setClassname('IdsTipo');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_TIPO', 'CaTipo', 'VARCHAR', true, null);

		$tMap->addColumn('CA_NOMBRE', 'CaNombre', 'VARCHAR', true, null);

		$tMap->addColumn('CA_APLICACION', 'CaAplicacion', 'VARCHAR', true, null);

	} 
} 