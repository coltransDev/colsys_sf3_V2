<?php



class InoContratosSeaMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.sea.map.InoContratosSeaMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(InoContratosSeaPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(InoContratosSeaPeer::TABLE_NAME);
		$tMap->setPhpName('InoContratosSea');
		$tMap->setClassname('InoContratosSea');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_REFERENCIA', 'CaReferencia', 'VARCHAR' , 'tb_inoequipos_sea', 'CA_REFERENCIA', true, null);

		$tMap->addForeignPrimaryKey('CA_IDEQUIPO', 'CaIdequipo', 'INTEGER' , 'tb_inoequipos_sea', 'CA_IDEQUIPO', true, null);

		$tMap->addColumn('CA_IDCONTRATO', 'CaIdcontrato', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCONTRATO', 'CaFchcontrato', 'DATE', false, null);

		$tMap->addColumn('CA_INSPECCION_NTA', 'CaInspeccionNta', 'VARCHAR', false, null);

		$tMap->addColumn('CA_INSPECCION_FCH', 'CaInspeccionFch', 'DATE', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

	} 
} 