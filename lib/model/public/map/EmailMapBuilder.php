<?php


/**
 * This class adds structure of 'tb_emails' table to 'propel' DatabaseMap object.
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
class EmailMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.public.map.EmailMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(EmailPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(EmailPeer::TABLE_NAME);
		$tMap->setPhpName('Email');
		$tMap->setClassname('Email');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_emails_ca_idemail_seq');

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

		$tMap->addColumn('CA_READRECEIPT', 'CaReadreceipt', 'BOOLEAN', false, null);

	} // doBuild()

} // EmailMapBuilder
