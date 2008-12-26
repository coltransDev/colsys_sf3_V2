<?php


/**
 * This class adds structure of 'control.tb_log' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.control.map
 */
class LogUsuarioMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.control.map.LogUsuarioMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(LogUsuarioPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(LogUsuarioPeer::TABLE_NAME);
		$tMap->setPhpName('LogUsuario');
		$tMap->setClassname('LogUsuario');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_IDLOG', 'CaIdlog', 'INTEGER', true, null);

		$tMap->addColumn('CA_LOGIN', 'CaLogin', 'VARCHAR', false, 50);

		$tMap->addColumn('CA_EVENT', 'CaEvent', 'VARCHAR', false, 255);

		$tMap->addColumn('CA_MODULE', 'CaModule', 'VARCHAR', false, 100);

		$tMap->addColumn('CA_ACTION', 'CaAction', 'VARCHAR', false, 100);

	} // doBuild()

} // LogUsuarioMapBuilder
