<?php



class RepAduanaMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.reportes.map.RepAduanaMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(RepAduanaPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(RepAduanaPeer::TABLE_NAME);
		$tMap->setPhpName('RepAduana');
		$tMap->setClassname('RepAduana');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDREPORTE', 'CaIdreporte', 'INTEGER' , 'tb_reportes', 'CA_IDREPORTE', true, null);

		$tMap->addColumn('CA_COORDINADOR', 'CaCoordinador', 'VARCHAR', true, null);

		$tMap->addColumn('CA_TRANSNACARGA', 'CaTransnacarga', 'VARCHAR', true, null);

		$tMap->addColumn('CA_TRANSNATIPO', 'CaTransnatipo', 'VARCHAR', true, null);

		$tMap->addColumn('CA_INSTRUCCIONES', 'CaInstrucciones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

	} 
} 