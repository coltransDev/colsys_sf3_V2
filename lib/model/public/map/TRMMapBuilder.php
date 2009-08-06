<?php



class TRMMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.TRMMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(TRMPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TRMPeer::TABLE_NAME);
		$tMap->setPhpName('TRM');
		$tMap->setClassname('TRM');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_FECHA', 'CaFecha', 'DATE', true, null);

		$tMap->addColumn('CA_EURO', 'CaEuro', 'NUMERIC', false, null);

		$tMap->addColumn('CA_PESOS', 'CaPesos', 'NUMERIC', true, null);

		$tMap->addColumn('CA_LIBRA', 'CaLibra', 'NUMERIC', false, null);

		$tMap->addColumn('CA_FSUIZO', 'CaFsuizo', 'NUMERIC', false, null);

		$tMap->addColumn('CA_MARCO', 'CaMarco', 'NUMERIC', false, null);

		$tMap->addColumn('CA_YEN', 'CaYen', 'NUMERIC', false, null);

		$tMap->addColumn('CA_RUPEE', 'CaRupee', 'NUMERIC', false, null);

		$tMap->addColumn('CA_AUSDOLAR', 'CaAusdolar', 'NUMERIC', false, null);

		$tMap->addColumn('CA_CANDOLAR', 'CaCandolar', 'NUMERIC', false, null);

		$tMap->addColumn('CA_CORNORUEGA', 'CaCornoruega', 'NUMERIC', false, null);

		$tMap->addColumn('CA_SINGDOLAR', 'CaSingdolar', 'NUMERIC', false, null);

		$tMap->addColumn('CA_RAND', 'CaRand', 'NUMERIC', false, null);

	} 
} 