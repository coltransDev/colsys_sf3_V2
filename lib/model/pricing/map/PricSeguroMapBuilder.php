<?php



class PricSeguroMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.pricing.map.PricSeguroMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(PricSeguroPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(PricSeguroPeer::TABLE_NAME);
		$tMap->setPhpName('PricSeguro');
		$tMap->setClassname('PricSeguro');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDGRUPO', 'CaIdgrupo', 'INTEGER' , 'tb_grupos', 'CA_IDGRUPO', true, null);

		$tMap->addPrimaryKey('CA_TRANSPORTE', 'CaTransporte', 'VARCHAR', true, null);

		$tMap->addColumn('CA_VLRPRIMA', 'CaVlrprima', 'NUMERIC', false, null);

		$tMap->addColumn('CA_VLRMINIMA', 'CaVlrminima', 'NUMERIC', false, null);

		$tMap->addColumn('CA_VLROBTENCIONPOLIZA', 'CaVlrobtencionpoliza', 'NUMERIC', false, null);

		$tMap->addColumn('CA_IDMONEDA', 'CaIdmoneda', 'VARCHAR', false, 3);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

	} 
} 