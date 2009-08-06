<?php



class TraficoGrupoMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.TraficoGrupoMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(TraficoGrupoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TraficoGrupoPeer::TABLE_NAME);
		$tMap->setPhpName('TraficoGrupo');
		$tMap->setClassname('TraficoGrupo');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_grupos_ca_idgrupo_seq');

		$tMap->addPrimaryKey('CA_IDGRUPO', 'CaIdgrupo', 'INTEGER', true, null);

		$tMap->addColumn('CA_DESCRIPCION', 'CaDescripcion', 'VARCHAR', false, 40);

	} 
} 