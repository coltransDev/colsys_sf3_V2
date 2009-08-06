<?php



class BodegaMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.BodegaMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(BodegaPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(BodegaPeer::TABLE_NAME);
		$tMap->setPhpName('Bodega');
		$tMap->setClassname('Bodega');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_bodegas_ca_idbodega_seq');

		$tMap->addPrimaryKey('CA_IDBODEGA', 'CaIdbodega', 'INTEGER', true, null);

		$tMap->addColumn('CA_NOMBRE', 'CaNombre', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TIPO', 'CaTipo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TRANSPORTE', 'CaTransporte', 'VARCHAR', false, null);

	} 
} 