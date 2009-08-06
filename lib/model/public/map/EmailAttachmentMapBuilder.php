<?php



class EmailAttachmentMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.EmailAttachmentMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(EmailAttachmentPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(EmailAttachmentPeer::TABLE_NAME);
		$tMap->setPhpName('EmailAttachment');
		$tMap->setClassname('EmailAttachment');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_attachments_id');

		$tMap->addPrimaryKey('CA_IDATTACHMENT', 'CaIdattachment', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_IDEMAIL', 'CaIdemail', 'INTEGER', 'tb_emails', 'CA_IDEMAIL', true, null);

		$tMap->addColumn('CA_EXTENSION', 'CaExtension', 'VARCHAR', true, null);

		$tMap->addColumn('CA_HEADER_FILE', 'CaHeaderFile', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FILESIZE', 'CaFilesize', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CONTENT', 'CaContent', 'BLOB', false, null);

	} 
} 