<?php



class PricPatioMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.pricing.map.PricPatioMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(PricPatioPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(PricPatioPeer::TABLE_NAME);
		$tMap->setPhpName('PricPatio');
		$tMap->setClassname('PricPatio');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_pricpatios');

		$tMap->addPrimaryKey('CA_IDPATIO', 'CaIdpatio', 'INTEGER', true, null);

		$tMap->addColumn('CA_NOMBRE', 'CaNombre', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_IDCIUDAD', 'CaIdciudad', 'VARCHAR', 'tb_ciudades', 'CA_IDCIUDAD', false, null);

		$tMap->addColumn('CA_DIRECCION', 'CaDireccion', 'VARCHAR', false, null);

	} 
} 