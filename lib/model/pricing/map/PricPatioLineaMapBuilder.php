<?php



class PricPatioLineaMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.pricing.map.PricPatioLineaMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(PricPatioLineaPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(PricPatioLineaPeer::TABLE_NAME);
		$tMap->setPhpName('PricPatioLinea');
		$tMap->setClassname('PricPatioLinea');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDPATIO', 'CaIdpatio', 'INTEGER' , 'tb_pricpatios', 'CA_IDPATIO', true, null);

		$tMap->addForeignPrimaryKey('CA_IDLINEA', 'CaIdlinea', 'VARCHAR' , 'vi_transporlineas', 'CA_IDLINEA', true, null);

		$tMap->addPrimaryKey('CA_TRANSPORTE', 'CaTransporte', 'VARCHAR', true, null);

		$tMap->addPrimaryKey('CA_MODALIDAD', 'CaModalidad', 'VARCHAR', true, null);

		$tMap->addPrimaryKey('CA_IMPOEXPO', 'CaImpoexpo', 'VARCHAR', true, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

	} 
} 