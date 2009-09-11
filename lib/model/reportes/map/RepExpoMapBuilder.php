<?php



class RepExpoMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.reportes.map.RepExpoMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(RepExpoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(RepExpoPeer::TABLE_NAME);
		$tMap->setPhpName('RepExpo');
		$tMap->setClassname('RepExpo');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDREPORTE', 'CaIdreporte', 'INTEGER' , 'tb_reportes', 'CA_IDREPORTE', true, null);

		$tMap->addColumn('CA_PESO', 'CaPeso', 'NUMERIC', false, null);

		$tMap->addColumn('CA_VOLUMEN', 'CaVolumen', 'NUMERIC', false, null);

		$tMap->addColumn('CA_PIEZAS', 'CaPiezas', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DIMENSIONES', 'CaDimensiones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_VALORCARGA', 'CaValorcarga', 'NUMERIC', false, null);

		$tMap->addColumn('CA_ANTICIPO', 'CaAnticipo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IDSIA', 'CaIdsia', 'INTEGER', false, null);

		$tMap->addColumn('CA_TIPOEXPO', 'CaTipoexpo', 'INTEGER', false, null);

		$tMap->addColumn('CA_IDLINEATERRESTRE', 'CaIdlineaterrestre', 'INTEGER', false, null);

		$tMap->addColumn('CA_MOTONAVE', 'CaMotonave', 'VARCHAR', false, null);

		$tMap->addColumn('CA_EMISIONBL', 'CaEmisionbl', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DATOSBL', 'CaDatosbl', 'VARCHAR', false, null);

		$tMap->addColumn('CA_NUMBL', 'CaNumbl', 'INTEGER', false, null);

	} 
} 