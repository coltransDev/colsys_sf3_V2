<?php



class PricRecargosxLineaLogMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.pricing.map.PricRecargosxLineaLogMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(PricRecargosxLineaLogPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(PricRecargosxLineaLogPeer::TABLE_NAME);
		$tMap->setPhpName('PricRecargosxLineaLog');
		$tMap->setClassname('PricRecargosxLineaLog');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('CA_IDTRAFICO', 'CaIdtrafico', 'VARCHAR', true, null);

		$tMap->addForeignKey('CA_IDLINEA', 'CaIdlinea', 'VARCHAR', 'vi_transporlineas', 'CA_IDLINEA', true, null);

		$tMap->addForeignKey('CA_IDRECARGO', 'CaIdrecargo', 'INTEGER', 'tb_tiporecargo', 'CA_IDRECARGO', true, null);

		$tMap->addForeignKey('CA_IDCONCEPTO', 'CaIdconcepto', 'INTEGER', 'tb_conceptos', 'CA_IDCONCEPTO', true, null);

		$tMap->addColumn('CA_MODALIDAD', 'CaModalidad', 'VARCHAR', true, null);

		$tMap->addColumn('CA_IMPOEXPO', 'CaImpoexpo', 'VARCHAR', true, null);

		$tMap->addColumn('CA_VLRRECARGO', 'CaVlrrecargo', 'NUMERIC', false, null);

		$tMap->addColumn('CA_APLICACION', 'CaAplicacion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_VLRMINIMO', 'CaVlrminimo', 'NUMERIC', false, null);

		$tMap->addColumn('CA_APLICACION_MIN', 'CaAplicacionMin', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHINICIO', 'CaFchinicio', 'DATE', false, null);

		$tMap->addColumn('CA_FCHVENCIMIENTO', 'CaFchvencimiento', 'DATE', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IDMONEDA', 'CaIdmoneda', 'VARCHAR', false, 3);

		$tMap->addPrimaryKey('CA_CONSECUTIVO', 'CaConsecutivo', 'INTEGER', true, null);

	} 
} 