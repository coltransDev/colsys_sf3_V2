<?php



class FleteMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.pricing.map.FleteMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(FletePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(FletePeer::TABLE_NAME);
		$tMap->setPhpName('Flete');
		$tMap->setClassname('Flete');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDTRAYECTO', 'CaIdtrayecto', 'INTEGER' , 'tb_trayectos', 'CA_IDTRAYECTO', true, null);

		$tMap->addForeignPrimaryKey('CA_IDCONCEPTO', 'CaIdconcepto', 'INTEGER' , 'tb_conceptos', 'CA_IDCONCEPTO', true, null);

		$tMap->addColumn('CA_VLRNETO', 'CaVlrneto', 'NUMERIC', true, null);

		$tMap->addColumn('CA_VLRMINIMO', 'CaVlrminimo', 'NUMERIC', false, null);

		$tMap->addColumn('CA_FLETEMINIMO', 'CaFleteminimo', 'NUMERIC', false, null);

		$tMap->addColumn('CA_FCHINICIO', 'CaFchinicio', 'DATE', false, null);

		$tMap->addColumn('CA_FCHVENCIMIENTO', 'CaFchvencimiento', 'DATE', false, null);

		$tMap->addColumn('CA_IDMONEDA', 'CaIdmoneda', 'VARCHAR', false, 3);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_SUGERIDA', 'CaSugerida', 'VARCHAR', false, null);

		$tMap->addColumn('CA_MANTENIMIENTO', 'CaMantenimiento', 'VARCHAR', false, null);

	} 
} 