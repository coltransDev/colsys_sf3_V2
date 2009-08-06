<?php



class CostoMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.CostoMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(CostoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(CostoPeer::TABLE_NAME);
		$tMap->setPhpName('Costo');
		$tMap->setClassname('Costo');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_costos_id');

		$tMap->addPrimaryKey('CA_IDCOSTO', 'CaIdcosto', 'INTEGER', true, null);

		$tMap->addColumn('CA_COSTO', 'CaCosto', 'VARCHAR', true, null);

		$tMap->addColumn('CA_TRANSPORTE', 'CaTransporte', 'VARCHAR', true, null);

		$tMap->addColumn('CA_IMPOEXPO', 'CaImpoexpo', 'VARCHAR', true, null);

		$tMap->addColumn('CA_MODALIDAD', 'CaModalidad', 'VARCHAR', false, null);

		$tMap->addColumn('CA_COMISIONABLE', 'CaComisionable', 'VARCHAR', false, null);

	} 
} 