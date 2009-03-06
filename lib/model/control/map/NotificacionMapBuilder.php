<?php


/**
 * This class adds structure of 'control.tb_notificaciones' table to 'propel' DatabaseMap object.
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
class NotificacionMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.control.map.NotificacionMapBuilder';

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

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('control.tb_notificaciones_id');

		$tMap->addPrimaryKey('CA_IDNOTIFICACION', 'CaIdnotificacion', 'INTEGER', true, null);

		$tMap->addColumn('CA_URL', 'CaUrl', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TITULO', 'CaTitulo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TEXTO', 'CaTexto', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_LOGIN', 'CaLogin', 'VARCHAR', 'control.tb_usuarios', 'CA_LOGIN', false, null);

		$tMap->addColumn('CA_LIMITE', 'CaLimite', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_LEIDO', 'CaLeido', 'BOOLEAN', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IDEMAIL', 'CaIdemail', 'INTEGER', false, null);

	} // doBuild()

} // NotificacionMapBuilder
