<?php



class CotArchivoMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.cotizaciones.map.CotArchivoMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(CotArchivoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(CotArchivoPeer::TABLE_NAME);
		$tMap->setPhpName('CotArchivo');
		$tMap->setClassname('CotArchivo');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_cotarchivos_id');

		$tMap->addPrimaryKey('CA_IDARCHIVO', 'CaIdarchivo', 'VARCHAR', true, null);

		$tMap->addForeignKey('CA_IDCOTIZACION', 'CaIdcotizacion', 'INTEGER', 'tb_cotizaciones', 'CA_IDCOTIZACION', true, null);

		$tMap->addColumn('CA_NOMBRE', 'CaNombre', 'VARCHAR', true, null);

		$tMap->addColumn('CA_TAMANO', 'CaTamano', 'NUMERIC', false, null);

		$tMap->addColumn('CA_TIPO', 'CaTipo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DATOS', 'CaDatos', 'BLOB', false, null);

	} 
} 