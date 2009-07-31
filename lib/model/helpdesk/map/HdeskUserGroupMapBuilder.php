<?php



class HdeskUserGroupMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.helpdesk.map.HdeskUserGroupMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(HdeskUserGroupPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(HdeskUserGroupPeer::TABLE_NAME);
		$tMap->setPhpName('HdeskUserGroup');
		$tMap->setClassname('HdeskUserGroup');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDGROUP', 'CaIdgroup', 'INTEGER' , 'helpdesk.tb_groups', 'CA_IDGROUP', true, null);

		$tMap->addForeignPrimaryKey('CA_LOGIN', 'CaLogin', 'VARCHAR' , 'control.tb_usuarios', 'CA_LOGIN', true, null);

	} 
} 