<?php



class TraficoMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.TraficoMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(TraficoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TraficoPeer::TABLE_NAME);
		$tMap->setPhpName('Trafico');
		$tMap->setClassname('Trafico');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_traficos_ca_idtrafico_seq');

		$tMap->addPrimaryKey('CA_IDTRAFICO', 'CaIdtrafico', 'VARCHAR', true, 6);

		$tMap->addColumn('CA_NOMBRE', 'CaNombre', 'VARCHAR', false, 40);

		$tMap->addColumn('CA_BANDERA', 'CaBandera', 'VARCHAR', false, 30);

		$tMap->addColumn('CA_IDMONEDA', 'CaIdmoneda', 'VARCHAR', false, 3);

		$tMap->addForeignKey('CA_IDGRUPO', 'CaIdgrupo', 'INTEGER', 'tb_grupos', 'CA_IDGRUPO', false, null);

		$tMap->addColumn('CA_LINK', 'CaLink', 'VARCHAR', false, 255);

		$tMap->addColumn('CA_CONCEPTOS', 'CaConceptos', 'VARCHAR', false, 255);

	} 
} 