<?php


/**
 * This class adds structure of 'tb_attachments' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.public.map
 */
class EmailAttachmentMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.public.map.EmailAttachmentMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('tb_attachments');
		$tMap->setPhpName('EmailAttachment');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_attachments_SEQ');

		$tMap->addPrimaryKey('CA_IDATTACHMENT', 'CaIdattachment', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('CA_IDEMAIL', 'CaIdemail', 'int', CreoleTypes::INTEGER, 'tb_emails', 'CA_IDEMAIL', true, null);

		$tMap->addColumn('CA_EXTENSION', 'CaExtension', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_HEADER_FILE', 'CaHeaderFile', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FILESIZE', 'CaFilesize', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CONTENT', 'CaContent', 'string', CreoleTypes::BLOB, false, null);

	} // doBuild()

} // EmailAttachmentMapBuilder
