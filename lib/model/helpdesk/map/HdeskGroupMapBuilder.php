<?php



class HdeskGroupMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.helpdesk.map.HdeskGroupMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(HdeskGroupPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(HdeskGroupPeer::TABLE_NAME);
		$tMap->setPhpName('HdeskGroup');
		$tMap->setClassname('HdeskGroup');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('helpdesk.tb_groups_id');

		$tMap->addPrimaryKey('CA_IDGROUP', 'CaIdgroup', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_IDDEPARTAMENT', 'CaIddepartament', 'INTEGER', 'control.tb_departamentos', 'CA_IDDEPARTAMENTO', true, null);

		$tMap->addColumn('CA_NAME', 'CaName', 'VARCHAR', false, null);

		$tMap->addColumn('CA_MAXRESPONSETIME', 'CaMaxresponsetime', 'INTEGER', false, null);

	} 
} 