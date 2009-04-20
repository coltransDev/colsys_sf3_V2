<?php


/**
 * This class adds structure of 'tb_tracking_etapas' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.reportes.map
 */
class TrackingEtapasMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.reportes.map.TrackingEtapasMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(TrackingEtapasPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TrackingEtapasPeer::TABLE_NAME);
		$tMap->setPhpName('TrackingEtapas');
		$tMap->setClassname('TrackingEtapas');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_IDETAPA', 'CaIdetapa', 'VARCHAR', true, null);

		$tMap->addColumn('CA_IMPOEXPO', 'CaImpoexpo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TRANSPORTE', 'CaTransporte', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ETAPA', 'CaEtapa', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ORDEN', 'CaOrden', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TTL', 'CaTtl', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CLASS', 'CaClass', 'VARCHAR', false, null);

	} // doBuild()

} // TrackingEtapasMapBuilder
