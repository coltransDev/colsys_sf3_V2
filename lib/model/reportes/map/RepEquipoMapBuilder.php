<?php



class RepEquipoMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.reportes.map.RepEquipoMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(RepEquipoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(RepEquipoPeer::TABLE_NAME);
		$tMap->setPhpName('RepEquipo');
		$tMap->setClassname('RepEquipo');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDREPORTE', 'CaIdreporte', 'INTEGER' , 'tb_reportes', 'CA_IDREPORTE', true, null);

		$tMap->addForeignPrimaryKey('CA_IDCONCEPTO', 'CaIdconcepto', 'INTEGER' , 'tb_conceptos', 'CA_IDCONCEPTO', true, null);

		$tMap->addColumn('CA_CANTIDAD', 'CaCantidad', 'NUMERIC', false, null);

		$tMap->addColumn('CA_IDEQUIPO', 'CaIdequipo', 'VARCHAR', false, 12);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

	} 
} 