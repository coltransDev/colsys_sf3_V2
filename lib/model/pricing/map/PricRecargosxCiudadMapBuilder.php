<?php



class PricRecargosxCiudadMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.pricing.map.PricRecargosxCiudadMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(PricRecargosxCiudadPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(PricRecargosxCiudadPeer::TABLE_NAME);
		$tMap->setPhpName('PricRecargosxCiudad');
		$tMap->setClassname('PricRecargosxCiudad');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_IDTRAFICO', 'CaIdtrafico', 'VARCHAR', true, null);

		$tMap->addForeignPrimaryKey('CA_IDCIUDAD', 'CaIdciudad', 'VARCHAR' , 'tb_ciudades', 'CA_IDCIUDAD', true, null);

		$tMap->addForeignPrimaryKey('CA_IDRECARGO', 'CaIdrecargo', 'INTEGER' , 'tb_tiporecargo', 'CA_IDRECARGO', true, null);

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