<?php



class PricRecargosxLineaMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.pricing.map.PricRecargosxLineaMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(PricRecargosxLineaPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(PricRecargosxLineaPeer::TABLE_NAME);
		$tMap->setPhpName('PricRecargosxLinea');
		$tMap->setClassname('PricRecargosxLinea');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_IDTRAFICO', 'CaIdtrafico', 'VARCHAR', true, null);

		$tMap->addForeignPrimaryKey('CA_IDLINEA', 'CaIdlinea', 'VARCHAR' , 'vi_transporlineas', 'CA_IDLINEA', true, null);

		$tMap->addForeignPrimaryKey('CA_IDRECARGO', 'CaIdrecargo', 'INTEGER' , 'tb_tiporecargo', 'CA_IDRECARGO', true, null);

		$tMap->addForeignPrimaryKey('CA_IDCONCEPTO', 'CaIdconcepto', 'INTEGER' , 'tb_conceptos', 'CA_IDCONCEPTO', true, null);

		$tMap->addPrimaryKey('CA_MODALIDAD', 'CaModalidad', 'VARCHAR', true, null);

		$tMap->addPrimaryKey('CA_IMPOEXPO', 'CaImpoexpo', 'VARCHAR', true, null);

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

		$tMap->addColumn('CA_CONSECUTIVO', 'CaConsecutivo', 'INTEGER', false, null);

	} 
} 