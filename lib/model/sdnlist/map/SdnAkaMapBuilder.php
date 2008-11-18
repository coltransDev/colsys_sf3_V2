<?php


/**
 * This class adds structure of 'tb_sdnaka' table to 'propel' DatabaseMap object.
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
class SdnAkaMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.sdnlist.map.SdnAkaMapBuilder';

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

		$tMap = $this->dbMap->addTable('tb_sdnaka');
		$tMap->setPhpName('SdnAka');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_UID', 'CaUid', 'double' , CreoleTypes::NUMERIC, 'tb_sdn', 'CA_UID', true, null);

		$tMap->addPrimaryKey('CA_UID_AKA', 'CaUidAka', 'double', CreoleTypes::NUMERIC, true, null);

		$tMap->addColumn('CA_TYPE', 'CaType', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CATEGORY', 'CaCategory', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FIRSTNAME', 'CaFirstname', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_LASTNAME', 'CaLastname', 'string', CreoleTypes::VARCHAR, false, null);

	} // doBuild()

} // SdnAkaMapBuilder
