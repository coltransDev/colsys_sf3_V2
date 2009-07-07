<?php


/**
 * This class adds structure of 'notificaciones.tb_notificaciones' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.notificaciones.map
 */
class NotificacionMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.notificaciones.map.NotificacionMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(NotificacionPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(NotificacionPeer::TABLE_NAME);
		$tMap->setPhpName('Notificacion');
		$tMap->setClassname('Notificacion');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDTAREA', 'CaIdtarea', 'INTEGER' , 'notificaciones.tb_tareas', 'CA_IDTAREA', true, null);

		$tMap->addForeignPrimaryKey('CA_IDEMAIL', 'CaIdemail', 'INTEGER' , 'tb_emails', 'CA_IDEMAIL', true, null);

	} // doBuild()

} // NotificacionMapBuilder
