<?php



class HdeskResponseMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.helpdesk.map.HdeskResponseMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(HdeskResponsePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(HdeskResponsePeer::TABLE_NAME);
		$tMap->setPhpName('HdeskResponse');
		$tMap->setClassname('HdeskResponse');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('helpdesk.tb_responses_id');

		$tMap->addPrimaryKey('CA_IDRESPONSE', 'CaIdresponse', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_IDTICKET', 'CaIdticket', 'INTEGER', 'helpdesk.tb_tickets', 'CA_IDTICKET', true, null);

		$tMap->addColumn('CA_RESPONSETORESPONSE', 'CaResponsetoresponse', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_LOGIN', 'CaLogin', 'VARCHAR', 'control.tb_usuarios', 'CA_LOGIN', true, null);

		$tMap->addColumn('CA_CREATEDAT', 'CaCreatedat', 'TIMESTAMP', true, null);

		$tMap->addColumn('CA_TEXT', 'CaText', 'VARCHAR', false, null);

	} 
} 