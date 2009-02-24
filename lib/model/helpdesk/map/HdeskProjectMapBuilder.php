<?php


/**
 * This class adds structure of 'helpdesk.tb_projects' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.helpdesk.map
 */
class HdeskProjectMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.helpdesk.map.HdeskProjectMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(HdeskProjectPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(HdeskProjectPeer::TABLE_NAME);
		$tMap->setPhpName('HdeskProject');
		$tMap->setClassname('HdeskProject');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('helpdesk.tb_projects_id');

		$tMap->addPrimaryKey('CA_IDPROJECT', 'CaIdproject', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_IDGROUP', 'CaIdgroup', 'INTEGER', 'helpdesk.tb_groups', 'CA_IDGROUP', true, null);

		$tMap->addColumn('CA_NAME', 'CaName', 'VARCHAR', true, null);

		$tMap->addColumn('CA_DESCRIPTION', 'CaDescription', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ACTIVE', 'CaActive', 'VARCHAR', false, null);

	} // doBuild()

} // HdeskProjectMapBuilder
