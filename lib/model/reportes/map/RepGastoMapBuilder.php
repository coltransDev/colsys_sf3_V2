<?php


/**
 * This class adds structure of 'tb_repgastos' table to 'propel' DatabaseMap object.
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
class RepGastoMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.reportes.map.RepGastoMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(RepGastoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(RepGastoPeer::TABLE_NAME);
		$tMap->setPhpName('RepGasto');
		$tMap->setClassname('RepGasto');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('OID', 'Oid', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_IDREPORTE', 'CaIdreporte', 'INTEGER', 'tb_reportes', 'CA_IDREPORTE', true, null);

		$tMap->addForeignKey('CA_IDRECARGO', 'CaIdrecargo', 'INTEGER', 'tb_tiporecargo', 'CA_IDRECARGO', true, null);

		$tMap->addColumn('CA_APLICACION', 'CaAplicacion', 'VARCHAR', true, null);

		$tMap->addColumn('CA_TIPO', 'CaTipo', 'VARCHAR', true, null);

		$tMap->addColumn('CA_NETA_TAR', 'CaNetaTar', 'NUMERIC', true, null);

		$tMap->addColumn('CA_NETA_MIN', 'CaNetaMin', 'NUMERIC', true, null);

		$tMap->addColumn('CA_REPORTAR_TAR', 'CaReportarTar', 'NUMERIC', true, null);

		$tMap->addColumn('CA_REPORTAR_MIN', 'CaReportarMin', 'NUMERIC', true, null);

		$tMap->addColumn('CA_COBRAR_TAR', 'CaCobrarTar', 'NUMERIC', true, null);

		$tMap->addColumn('CA_COBRAR_MIN', 'CaCobrarMin', 'NUMERIC', true, null);

		$tMap->addColumn('CA_IDMONEDA', 'CaIdmoneda', 'VARCHAR', true, 3);

		$tMap->addColumn('CA_DETALLES', 'CaDetalles', 'VARCHAR', true, 3);

		$tMap->addForeignKey('CA_IDCONCEPTO', 'CaIdconcepto', 'INTEGER', 'tb_conceptos', 'CA_IDCONCEPTO', true, null);

	} // doBuild()

} // RepGastoMapBuilder
