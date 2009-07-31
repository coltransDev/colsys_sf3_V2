<?php



class HdeskKBaseMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.helpdesk.map.HdeskKBaseMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(HdeskKBasePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(HdeskKBasePeer::TABLE_NAME);
		$tMap->setPhpName('HdeskKBase');
		$tMap->setClassname('HdeskKBase');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('helpdesk.tb_kbase_id');

		$tMap->addPrimaryKey('CA_IDKBASE', 'CaIdkbase', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_IDCATEGORY', 'CaIdcategory', 'INTEGER', 'helpdesk.tb_kbasecategory', 'CA_IDCATEGORY', true, null);

		$tMap->addForeignKey('CA_LOGIN', 'CaLogin', 'VARCHAR', 'control.tb_usuarios', 'CA_LOGIN', true, null);

		$tMap->addColumn('CA_CREATEDAT', 'CaCreatedat', 'TIMESTAMP', true, null);

		$tMap->addColumn('CA_TEXT', 'CaText', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TITLE', 'CaTitle', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PRIVATE', 'CaPrivate', 'BOOLEAN', false, null);

	} 
} 