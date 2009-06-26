<?php


/**
 * This class adds structure of 'control.tb_usuarios_log' table to 'propel' DatabaseMap object.
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
class UsuarioLogMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.control.map.UsuarioLogMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(UsuarioLogPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(UsuarioLogPeer::TABLE_NAME);
		$tMap->setPhpName('UsuarioLog');
		$tMap->setClassname('UsuarioLog');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('control.tb_usuarios_log_id');

		$tMap->addPrimaryKey('CA_ID', 'CaId', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_LOGIN', 'CaLogin', 'VARCHAR', 'control.tb_usuarios', 'CA_LOGIN', false, null);

		$tMap->addColumn('CA_FCHEVENTO', 'CaFchevento', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_URL', 'CaUrl', 'VARCHAR', false, null);

		$tMap->addColumn('CA_EVENT', 'CaEvent', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IPADDRESS', 'CaIpaddress', 'VARCHAR', false, null);

		$tMap->addColumn('CA_USERAGENT', 'CaUseragent', 'VARCHAR', false, null);

	} // doBuild()

} // UsuarioLogMapBuilder
