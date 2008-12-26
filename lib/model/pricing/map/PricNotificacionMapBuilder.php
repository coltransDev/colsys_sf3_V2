<?php


/**
 * This class adds structure of 'tb_pricnotificaciones' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.pricing.map
 */
class PricNotificacionMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.pricing.map.PricNotificacionMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(PricNotificacionPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(PricNotificacionPeer::TABLE_NAME);
		$tMap->setPhpName('PricNotificacion');
		$tMap->setClassname('PricNotificacion');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_pricnotificaciones_id');

		$tMap->addPrimaryKey('CA_IDNOTIFICACION', 'CaIdnotificacion', 'INTEGER', true, null);

		$tMap->addColumn('CA_TITULO', 'CaTitulo', 'VARCHAR', true, null);

		$tMap->addColumn('CA_MENSAJE', 'CaMensaje', 'VARCHAR', true, null);

		$tMap->addColumn('CA_CADUCIDAD', 'CaCaducidad', 'DATE', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, 15);

	} // doBuild()

} // PricNotificacionMapBuilder
