<?php


/**
 * This class adds structure of 'helpdesk.tb_groups' table to 'propel' DatabaseMap object.
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
class HdeskGroupMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.helpdesk.map.HdeskGroupMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(HdeskGroupPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(HdeskGroupPeer::TABLE_NAME);
		$tMap->setPhpName('HdeskGroup');
		$tMap->setClassname('HdeskGroup');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('helpdesk.tb_groups_id');

		$tMap->addPrimaryKey('CA_IDGROUP', 'CaIdgroup', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_IDDEPARTAMENT', 'CaIddepartament', 'INTEGER', 'control.tb_departamentos', 'CA_IDDEPARTAMENTO', true, null);

		$tMap->addColumn('CA_NAME', 'CaName', 'VARCHAR', false, null);

	} // doBuild()

} // HdeskGroupMapBuilder
