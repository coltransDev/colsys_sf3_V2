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
class EmailMapBuilder {

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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('tb_emails');
		$tMap->setPhpName('Email');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_emails_SEQ');

		$tMap->addPrimaryKey('CA_IDEMAIL', 'CaIdemail', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CA_FCHENVIO', 'CaFchenvio', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('CA_USUENVIO', 'CaUsuenvio', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_TIPO', 'CaTipo', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_IDCASO', 'CaIdcaso', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FROM', 'CaFrom', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FROMNAME', 'CaFromname', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CC', 'CaCc', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_REPLYTO', 'CaReplyto', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_ADDRESS', 'CaAddress', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_ATTACHMENT', 'CaAttachment', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_SUBJECT', 'CaSubject', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_BODY', 'CaBody', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_READRECEIPT', 'CaReadreceipt', 'boolean', CreoleTypes::BOOLEAN, false, null);

	} // doBuild()

} // EmailMapBuilder
