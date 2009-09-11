<?php



class RepSeguroMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.reportes.map.RepSeguroMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(RepSeguroPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(RepSeguroPeer::TABLE_NAME);
		$tMap->setPhpName('RepSeguro');
		$tMap->setClassname('RepSeguro');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDREPORTE', 'CaIdreporte', 'INTEGER' , 'tb_reportes', 'CA_IDREPORTE', true, null);

		$tMap->addColumn('CA_VLRASEGURADO', 'CaVlrasegurado', 'NUMERIC', true, null);

		$tMap->addColumn('CA_IDMONEDA_VLR', 'CaIdmonedaVlr', 'VARCHAR', true, null);

		$tMap->addColumn('CA_PRIMAVENTA', 'CaPrimaventa', 'NUMERIC', true, null);

		$tMap->addColumn('CA_MINIMAVENTA', 'CaMinimaventa', 'NUMERIC', true, null);

		$tMap->addColumn('CA_IDMONEDA_VTA', 'CaIdmonedaVta', 'VARCHAR', true, null);

		$tMap->addColumn('CA_OBTENCIONPOLIZA', 'CaObtencionpoliza', 'NUMERIC', true, null);

		$tMap->addColumn('CA_IDMONEDA_POL', 'CaIdmonedaPol', 'VARCHAR', true, null);

		$tMap->addColumn('CA_SEGURO_CONF', 'CaSeguroConf', 'VARCHAR', true, null);

	} 
} 