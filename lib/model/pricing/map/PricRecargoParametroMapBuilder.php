<?php



class PricRecargoParametroMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.pricing.map.PricRecargoParametroMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(PricRecargoParametroPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(PricRecargoParametroPeer::TABLE_NAME);
		$tMap->setPhpName('PricRecargoParametro');
		$tMap->setClassname('PricRecargoParametro');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDLINEA', 'CaIdlinea', 'VARCHAR' , 'vi_transporlineas', 'CA_IDLINEA', true, null);

		$tMap->addPrimaryKey('CA_TRANSPORTE', 'CaTransporte', 'VARCHAR', true, null);

		$tMap->addPrimaryKey('CA_MODALIDAD', 'CaModalidad', 'VARCHAR', true, null);

		$tMap->addPrimaryKey('CA_IMPOEXPO', 'CaImpoexpo', 'VARCHAR', true, null);

		$tMap->addPrimaryKey('CA_CONCEPTO', 'CaConcepto', 'VARCHAR', true, null);

		$tMap->addColumn('CA_VALOR', 'CaValor', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

	} 
} 