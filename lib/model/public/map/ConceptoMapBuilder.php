<?php



class ConceptoMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.ConceptoMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(ConceptoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ConceptoPeer::TABLE_NAME);
		$tMap->setPhpName('Concepto');
		$tMap->setClassname('Concepto');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_conceptos_id');

		$tMap->addPrimaryKey('CA_IDCONCEPTO', 'CaIdconcepto', 'INTEGER', true, null);

		$tMap->addColumn('CA_CONCEPTO', 'CaConcepto', 'VARCHAR', true, null);

		$tMap->addColumn('CA_UNIDAD', 'CaUnidad', 'VARCHAR', true, null);

		$tMap->addColumn('CA_TRANSPORTE', 'CaTransporte', 'VARCHAR', true, null);

		$tMap->addColumn('CA_MODALIDAD', 'CaModalidad', 'VARCHAR', true, null);

		$tMap->addColumn('CA_LIMINFERIOR', 'CaLiminferior', 'INTEGER', false, null);

	} 
} 