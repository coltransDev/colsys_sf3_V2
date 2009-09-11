<?php



class PricFleteMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.pricing.map.PricFleteMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(PricFletePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(PricFletePeer::TABLE_NAME);
		$tMap->setPhpName('PricFlete');
		$tMap->setClassname('PricFlete');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDTRAYECTO', 'CaIdtrayecto', 'INTEGER' , 'tb_trayectos', 'CA_IDTRAYECTO', true, null);

		$tMap->addForeignPrimaryKey('CA_IDCONCEPTO', 'CaIdconcepto', 'INTEGER' , 'tb_conceptos', 'CA_IDCONCEPTO', true, null);

		$tMap->addColumn('CA_VLRNETO', 'CaVlrneto', 'NUMERIC', false, null);

		$tMap->addColumn('CA_VLRSUGERIDO', 'CaVlrsugerido', 'NUMERIC', false, null);

		$tMap->addColumn('CA_FCHINICIO', 'CaFchinicio', 'DATE', false, null);

		$tMap->addColumn('CA_FCHVENCIMIENTO', 'CaFchvencimiento', 'DATE', false, null);

		$tMap->addColumn('CA_IDMONEDA', 'CaIdmoneda', 'VARCHAR', false, 3);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ESTADO', 'CaEstado', 'INTEGER', false, null);

		$tMap->addColumn('CA_APLICACION', 'CaAplicacion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CONSECUTIVO', 'CaConsecutivo', 'INTEGER', false, null);

	} 
} 