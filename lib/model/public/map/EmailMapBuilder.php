<?php



class EmailMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.EmailMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(EmailPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(EmailPeer::TABLE_NAME);
		$tMap->setPhpName('Email');
		$tMap->setClassname('Email');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_emails_id');

		$tMap->addPrimaryKey('CA_IDEMAIL', 'CaIdemail', 'INTEGER', true, null);

		$tMap->addColumn('CA_FCHENVIO', 'CaFchenvio', 'TIMESTAMP', true, null);

		$tMap->addColumn('CA_USUENVIO', 'CaUsuenvio', 'VARCHAR', true, null);

		$tMap->addColumn('CA_TIPO', 'CaTipo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IDCASO', 'CaIdcaso', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FROM', 'CaFrom', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FROMNAME', 'CaFromname', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CC', 'CaCc', 'VARCHAR', false, null);

		$tMap->addColumn('CA_REPLYTO', 'CaReplyto', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ADDRESS', 'CaAddress', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ATTACHMENT', 'CaAttachment', 'VARCHAR', false, null);

		$tMap->addColumn('CA_SUBJECT', 'CaSubject', 'VARCHAR', false, null);

		$tMap->addColumn('CA_BODY', 'CaBody', 'VARCHAR', false, null);

		$tMap->addColumn('CA_BODYHTML', 'CaBodyhtml', 'VARCHAR', false, null);

		$tMap->addColumn('CA_READRECEIPT', 'CaReadreceipt', 'BOOLEAN', false, null);

	} 
} 