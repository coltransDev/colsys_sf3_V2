<?php


/**
 * This class adds structure of 'notificaciones.tb_tareas' table to 'propel' DatabaseMap object.
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
class NotTareaMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.notificaciones.map.NotTareaMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(NotTareaPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(NotTareaPeer::TABLE_NAME);
		$tMap->setPhpName('NotTarea');
		$tMap->setClassname('NotTarea');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('notificaciones.tb_tareas_id');

		$tMap->addPrimaryKey('CA_IDTAREA', 'CaIdtarea', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_IDLISTATAREA', 'CaIdlistatarea', 'INTEGER', 'notificaciones.tb_listatareas', 'CA_IDLISTATAREA', false, null);

		$tMap->addColumn('CA_URL', 'CaUrl', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TITULO', 'CaTitulo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TEXTO', 'CaTexto', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHVENCIMIENTO', 'CaFchvencimiento', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_FCHTERMINADA', 'CaFchterminada', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_PRIORIDAD', 'CaPrioridad', 'INTEGER', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

	} // doBuild()

} // NotTareaMapBuilder
