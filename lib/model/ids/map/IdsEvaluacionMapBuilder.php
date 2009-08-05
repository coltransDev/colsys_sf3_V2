<?php



class IdsEvaluacionMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.ids.map.IdsEvaluacionMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(IdsEvaluacionPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(IdsEvaluacionPeer::TABLE_NAME);
		$tMap->setPhpName('IdsEvaluacion');
		$tMap->setClassname('IdsEvaluacion');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('ids.tb_evaluacion_id');

		$tMap->addPrimaryKey('CA_IDEVALUACION', 'CaIdevaluacion', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_ID', 'CaId', 'INTEGER', 'ids.tb_ids', 'CA_ID', true, null);

		$tMap->addColumn('CA_CONCEPTO', 'CaConcepto', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TIPO', 'CaTipo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHEVALUACION', 'CaFchevaluacion', 'DATE', true, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', true, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', true, null);

	} 
} 