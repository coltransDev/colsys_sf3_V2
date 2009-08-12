<?php



class InoEquiposSeaMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.sea.map.InoEquiposSeaMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(InoEquiposSeaPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(InoEquiposSeaPeer::TABLE_NAME);
		$tMap->setPhpName('InoEquiposSea');
		$tMap->setClassname('InoEquiposSea');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_REFERENCIA', 'CaReferencia', 'VARCHAR' , 'tb_inomaestra_sea', 'CA_REFERENCIA', true, null);

		$tMap->addForeignKey('CA_IDCONCEPTO', 'CaIdconcepto', 'INTEGER', 'tb_conceptos', 'CA_IDCONCEPTO', true, null);

		$tMap->addColumn('CA_CANTIDAD', 'CaCantidad', 'INTEGER', false, null);

		$tMap->addPrimaryKey('CA_IDEQUIPO', 'CaIdequipo', 'VARCHAR', true, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

	} 
} 