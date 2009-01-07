<?php


/**
 * This class adds structure of 'tb_tracking_users_log' table to 'propel' DatabaseMap object.
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
class TrackingUserLogMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.public.map.TrackingUserLogMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(TrackingUserLogPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TrackingUserLogPeer::TABLE_NAME);
		$tMap->setPhpName('TrackingUserLog');
		$tMap->setClassname('TrackingUserLog');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_tracking_users_log_id');

		$tMap->addPrimaryKey('CA_ID', 'CaId', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_EMAIL', 'CaEmail', 'VARCHAR', 'tb_tracking_users', 'CA_EMAIL', false, null);

		$tMap->addColumn('CA_FCHEVENTO', 'CaFchevento', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_URL', 'CaUrl', 'VARCHAR', false, null);

		$tMap->addColumn('CA_EVENTO', 'CaEvento', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IPADDRESS', 'CaIpaddress', 'VARCHAR', false, null);

	} // doBuild()

} // TrackingUserLogMapBuilder
