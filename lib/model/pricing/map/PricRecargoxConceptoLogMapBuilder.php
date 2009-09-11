<?php



class PricRecargoxConceptoLogMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.pricing.map.PricRecargoxConceptoLogMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(PricRecargoxConceptoLogPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(PricRecargoxConceptoLogPeer::TABLE_NAME);
		$tMap->setPhpName('PricRecargoxConceptoLog');
		$tMap->setClassname('PricRecargoxConceptoLog');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignKey('CA_IDTRAYECTO', 'CaIdtrayecto', 'INTEGER', 'tb_pricfletes', 'CA_IDTRAYECTO', true, null);

		$tMap->addForeignKey('CA_IDCONCEPTO', 'CaIdconcepto', 'INTEGER', 'tb_pricfletes', 'CA_IDCONCEPTO', true, null);

		$tMap->addForeignKey('CA_IDRECARGO', 'CaIdrecargo', 'INTEGER', 'tb_tiporecargo', 'CA_IDRECARGO', true, null);

		$tMap->addColumn('CA_VLRRECARGO', 'CaVlrrecargo', 'NUMERIC', true, null);

		$tMap->addColumn('CA_APLICACION', 'CaAplicacion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_VLRMINIMO', 'CaVlrminimo', 'NUMERIC', false, null);

		$tMap->addColumn('CA_APLICACION_MIN', 'CaAplicacionMin', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IDMONEDA', 'CaIdmoneda', 'VARCHAR', false, 3);

		$tMap->addColumn('CA_FCHINICIO', 'CaFchinicio', 'DATE', false, null);

		$tMap->addColumn('CA_FCHVENCIMIENTO', 'CaFchvencimiento', 'DATE', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addPrimaryKey('CA_CONSECUTIVO', 'CaConsecutivo', 'INTEGER', true, null);

	} 
} 