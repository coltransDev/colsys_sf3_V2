<?php


/**
 * This class adds structure of 'tb_sdn' table to 'propel' DatabaseMap object.
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
class SdnMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.sdnlist.map.SdnMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(SdnPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(SdnPeer::TABLE_NAME);
		$tMap->setPhpName('Sdn');
		$tMap->setClassname('Sdn');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_UID', 'CaUid', 'NUMERIC', true, null);

		$tMap->addColumn('CA_FIRSTNAME', 'CaFirstname', 'VARCHAR', false, null);

		$tMap->addColumn('CA_LASTNAME', 'CaLastname', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TITLE', 'CaTitle', 'VARCHAR', false, null);

		$tMap->addColumn('CA_SDNTYPE', 'CaSdntype', 'VARCHAR', false, null);

		$tMap->addColumn('CA_REMARKS', 'CaRemarks', 'VARCHAR', false, null);

	} // doBuild()

} // SdnMapBuilder
