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
class SdnAddressMapBuilder {

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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('tb_sdnaddress');
		$tMap->setPhpName('SdnAddress');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_UID', 'CaUid', 'double' , CreoleTypes::NUMERIC, 'tb_sdn', 'CA_UID', true, null);

		$tMap->addPrimaryKey('CA_UID_ADDRESS', 'CaUidAddress', 'double', CreoleTypes::NUMERIC, true, null);

		$tMap->addColumn('CA_ADDRESS1', 'CaAddress1', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_ADDRESS2', 'CaAddress2', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_ADDRESS3', 'CaAddress3', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CITY', 'CaCity', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_STATE', 'CaState', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_POSTAL', 'CaPostal', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_COUNTRY', 'CaCountry', 'string', CreoleTypes::VARCHAR, false, null);

	} // doBuild()

} // SdnAddressMapBuilder
