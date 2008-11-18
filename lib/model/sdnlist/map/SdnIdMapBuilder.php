<?php


/**
 * This class adds structure of 'tb_sdnid' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.sdnlist.map
 */
class SdnIdMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.sdnlist.map.SdnIdMapBuilder';

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

		$tMap = $this->dbMap->addTable('tb_sdnid');
		$tMap->setPhpName('SdnId');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_UID', 'CaUid', 'double' , CreoleTypes::NUMERIC, 'tb_sdn', 'CA_UID', true, null);

		$tMap->addPrimaryKey('CA_UID_ID', 'CaUidId', 'double', CreoleTypes::NUMERIC, true, null);

		$tMap->addColumn('CA_IDTYPE', 'CaIdtype', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_IDNUMBER', 'CaIdnumber', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_IDCOUNTRY', 'CaIdcountry', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_ISSUEDATE', 'CaIssuedate', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_EXPIRATIONDATE', 'CaExpirationdate', 'string', CreoleTypes::VARCHAR, false, null);

	} // doBuild()

} // SdnIdMapBuilder
