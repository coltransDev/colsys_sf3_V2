<?php


/**
 * This class adds structure of 'tb_tiporecargo' table to 'propel' DatabaseMap object.
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
class TipoRecargoMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.public.map.TipoRecargoMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(TipoRecargoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TipoRecargoPeer::TABLE_NAME);
		$tMap->setPhpName('TipoRecargo');
		$tMap->setClassname('TipoRecargo');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_tiporecargo_id');

		$tMap->addPrimaryKey('CA_IDRECARGO', 'CaIdrecargo', 'INTEGER', true, null);

		$tMap->addColumn('CA_RECARGO', 'CaRecargo', 'VARCHAR', true, null);

		$tMap->addColumn('CA_TIPO', 'CaTipo', 'VARCHAR', true, null);

		$tMap->addColumn('CA_TRANSPORTE', 'CaTransporte', 'VARCHAR', true, null);

		$tMap->addColumn('CA_INCOTERMS', 'CaIncoterms', 'VARCHAR', false, null);

		$tMap->addColumn('CA_REPORTE', 'CaReporte', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IMPOEXPO', 'CaImpoexpo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_APLICACION', 'CaAplicacion', 'VARCHAR', false, null);

	} // doBuild()

} // TipoRecargoMapBuilder
