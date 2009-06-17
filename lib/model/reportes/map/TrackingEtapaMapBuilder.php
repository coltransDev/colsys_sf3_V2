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
class TrackingEtapaMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.reportes.map.TrackingEtapaMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(TrackingEtapaPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TrackingEtapaPeer::TABLE_NAME);
		$tMap->setPhpName('TrackingEtapa');
		$tMap->setClassname('TrackingEtapa');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_IDETAPA', 'CaIdetapa', 'VARCHAR', true, null);

		$tMap->addColumn('CA_IMPOEXPO', 'CaImpoexpo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TRANSPORTE', 'CaTransporte', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DEPARTAMENTO', 'CaDepartamento', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ETAPA', 'CaEtapa', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ORDEN', 'CaOrden', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TTL', 'CaTtl', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CLASS', 'CaClass', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TEMPLATE', 'CaTemplate', 'VARCHAR', false, null);

		$tMap->addColumn('CA_MESSAGE', 'CaMessage', 'VARCHAR', false, null);

		$tMap->addColumn('CA_MESSAGE_DEFAULT', 'CaMessageDefault', 'VARCHAR', false, null);

		$tMap->addColumn('CA_INTRO', 'CaIntro', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TITLE', 'CaTitle', 'VARCHAR', false, null);

	} // doBuild()

} // TrackingEtapaMapBuilder
