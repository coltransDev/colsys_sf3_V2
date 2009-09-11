<?php



class PricArchivoMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.pricing.map.PricArchivoMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(PricArchivoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(PricArchivoPeer::TABLE_NAME);
		$tMap->setPhpName('PricArchivo');
		$tMap->setClassname('PricArchivo');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_pricarchivos_id');

		$tMap->addPrimaryKey('CA_IDARCHIVO', 'CaIdarchivo', 'VARCHAR', true, null);

		$tMap->addForeignKey('CA_IDTRAFICO', 'CaIdtrafico', 'VARCHAR', 'tb_traficos', 'CA_IDTRAFICO', true, null);

		$tMap->addColumn('CA_NOMBRE', 'CaNombre', 'VARCHAR', true, null);

		$tMap->addColumn('CA_DESCRIPCION', 'CaDescripcion', 'VARCHAR', true, null);

		$tMap->addColumn('CA_TAMANO', 'CaTamano', 'NUMERIC', false, null);

		$tMap->addColumn('CA_TIPO', 'CaTipo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DATOS', 'CaDatos', 'BLOB', false, null);

		$tMap->addColumn('CA_IMPOEXPO', 'CaImpoexpo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TRANSPORTE', 'CaTransporte', 'VARCHAR', false, null);

		$tMap->addColumn('CA_MODALIDAD', 'CaModalidad', 'VARCHAR', false, null);

	} 
} 