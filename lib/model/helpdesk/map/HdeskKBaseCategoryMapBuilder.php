<?php



class HdeskKBaseCategoryMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.helpdesk.map.HdeskKBaseCategoryMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(HdeskKBaseCategoryPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(HdeskKBaseCategoryPeer::TABLE_NAME);
		$tMap->setPhpName('HdeskKBaseCategory');
		$tMap->setClassname('HdeskKBaseCategory');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('helpdesk.tb_kbasecategory_id');

		$tMap->addPrimaryKey('CA_IDCATEGORY', 'CaIdcategory', 'INTEGER', true, null);

		$tMap->addColumn('CA_PARENT', 'CaParent', 'INTEGER', true, null);

		$tMap->addColumn('CA_NAME', 'CaName', 'VARCHAR', true, null);

	} 
} 