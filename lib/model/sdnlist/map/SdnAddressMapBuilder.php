<?php


/**
 * This class adds structure of 'tb_sdnaddress' table to 'propel' DatabaseMap object.
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
class SdnAddressMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.sdnlist.map.SdnAddressMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(SdnAddressPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(SdnAddressPeer::TABLE_NAME);
		$tMap->setPhpName('SdnAddress');
		$tMap->setClassname('SdnAddress');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_UID', 'CaUid', 'NUMERIC' , 'tb_sdn', 'CA_UID', true, null);

		$tMap->addPrimaryKey('CA_UID_ADDRESS', 'CaUidAddress', 'NUMERIC', true, null);

		$tMap->addColumn('CA_ADDRESS1', 'CaAddress1', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ADDRESS2', 'CaAddress2', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ADDRESS3', 'CaAddress3', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CITY', 'CaCity', 'VARCHAR', false, null);

		$tMap->addColumn('CA_STATE', 'CaState', 'VARCHAR', false, null);

		$tMap->addColumn('CA_POSTAL', 'CaPostal', 'VARCHAR', false, null);

		$tMap->addColumn('CA_COUNTRY', 'CaCountry', 'VARCHAR', false, null);

	} // doBuild()

} // SdnAddressMapBuilder
