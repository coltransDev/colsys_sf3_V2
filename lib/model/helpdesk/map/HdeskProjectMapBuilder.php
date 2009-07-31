<?php



class HdeskProjectMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.helpdesk.map.HdeskProjectMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(HdeskProjectPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(HdeskProjectPeer::TABLE_NAME);
		$tMap->setPhpName('HdeskProject');
		$tMap->setClassname('HdeskProject');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('helpdesk.tb_projects_id');

		$tMap->addPrimaryKey('CA_IDPROJECT', 'CaIdproject', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_IDGROUP', 'CaIdgroup', 'INTEGER', 'helpdesk.tb_groups', 'CA_IDGROUP', true, null);

		$tMap->addColumn('CA_NAME', 'CaName', 'VARCHAR', true, null);

		$tMap->addColumn('CA_DESCRIPTION', 'CaDescription', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ACTIVE', 'CaActive', 'VARCHAR', false, null);

	} 
} 