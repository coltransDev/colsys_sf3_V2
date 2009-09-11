<?php



class IdsCriterioMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.ids.map.IdsCriterioMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(IdsCriterioPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(IdsCriterioPeer::TABLE_NAME);
		$tMap->setPhpName('IdsCriterio');
		$tMap->setClassname('IdsCriterio');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('ids.tb_criterios_id');

		$tMap->addPrimaryKey('CA_IDCRITERIO', 'CaIdcriterio', 'INTEGER', true, null);

		$tMap->addColumn('CA_TIPO', 'CaTipo', 'VARCHAR', true, null);

		$tMap->addColumn('CA_TIPOCRITERIO', 'CaTipocriterio', 'VARCHAR', true, null);

		$tMap->addColumn('CA_CRITERIO', 'CaCriterio', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ACTIVO', 'CaActivo', 'BOOLEAN', false, null);

		$tMap->addColumn('CA_PONDERACION', 'CaPonderacion', 'INTEGER', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', true, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', true, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'TIMESTAMP', true, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', true, null);

	} 
} 