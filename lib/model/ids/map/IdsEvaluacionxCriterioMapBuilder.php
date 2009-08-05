<?php



class IdsEvaluacionxCriterioMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.ids.map.IdsEvaluacionxCriterioMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(IdsEvaluacionxCriterioPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(IdsEvaluacionxCriterioPeer::TABLE_NAME);
		$tMap->setPhpName('IdsEvaluacionxCriterio');
		$tMap->setClassname('IdsEvaluacionxCriterio');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDEVALUACION', 'CaIdevaluacion', 'INTEGER' , 'ids.tb_evaluacion', 'CA_IDEVALUACION', true, null);

		$tMap->addForeignPrimaryKey('CA_IDCRITERIO', 'CaIdcriterio', 'VARCHAR' , 'ids.tb_criterios', 'CA_IDCRITERIO', true, null);

		$tMap->addColumn('CA_VALOR', 'CaValor', 'NUMERIC', true, null);

		$tMap->addColumn('CA_PONDERACION', 'CaPonderacion', 'NUMERIC', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

	} 
} 