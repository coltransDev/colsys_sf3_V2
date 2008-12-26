<?php


/**
 * This class adds structure of 'tb_tracking_users' table to 'propel' DatabaseMap object.
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
class TrackingUserMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.public.map.TrackingUserMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(TrackingUserPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TrackingUserPeer::TABLE_NAME);
		$tMap->setPhpName('TrackingUser');
		$tMap->setClassname('TrackingUser');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_tracking_users_ca_id_seq');

		$tMap->addPrimaryKey('CA_ID', 'CaId', 'INTEGER', true, null);

		$tMap->addColumn('CA_EMAIL', 'CaEmail', 'VARCHAR', false, null);

		$tMap->addColumn('CA_BLOCKED', 'CaBlocked', 'BOOLEAN', false, null);

		$tMap->addColumn('CA_ACTIVATION_CODE', 'CaActivationCode', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PASSWD', 'CaPasswd', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PASSWORD_EXPIRY', 'CaPasswordExpiry', 'DATE', false, null);

		$tMap->addColumn('CA_ACTIVATED', 'CaActivated', 'BOOLEAN', false, null);

		$tMap->addForeignKey('CA_IDCONTACTO', 'CaIdcontacto', 'INTEGER', 'tb_concliente', 'CA_IDCONTACTO', false, null);

	} // doBuild()

} // TrackingUserMapBuilder
