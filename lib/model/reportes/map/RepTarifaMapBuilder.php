<?php


/**
 * This class adds structure of 'tb_reptarifas' table to 'propel' DatabaseMap object.
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
class RepTarifaMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.reportes.map.RepTarifaMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(RepTarifaPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(RepTarifaPeer::TABLE_NAME);
		$tMap->setPhpName('RepTarifa');
		$tMap->setClassname('RepTarifa');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('OID', 'Oid', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_IDREPORTE', 'CaIdreporte', 'INTEGER', 'tb_reportes', 'CA_IDREPORTE', true, null);

		$tMap->addForeignKey('CA_IDCONCEPTO', 'CaIdconcepto', 'INTEGER', 'tb_conceptos', 'CA_IDCONCEPTO', true, null);

		$tMap->addColumn('CA_CANTIDAD', 'CaCantidad', 'NUMERIC', true, null);

		$tMap->addColumn('CA_NETA_TAR', 'CaNetaTar', 'NUMERIC', true, null);

		$tMap->addColumn('CA_NETA_MIN', 'CaNetaMin', 'NUMERIC', true, null);

		$tMap->addColumn('CA_NETA_IDM', 'CaNetaIdm', 'VARCHAR', true, 3);

		$tMap->addColumn('CA_REPORTAR_TAR', 'CaReportarTar', 'NUMERIC', true, null);

		$tMap->addColumn('CA_REPORTAR_MIN', 'CaReportarMin', 'NUMERIC', true, null);

		$tMap->addColumn('CA_REPORTAR_IDM', 'CaReportarIdm', 'VARCHAR', true, 3);

		$tMap->addColumn('CA_COBRAR_TAR', 'CaCobrarTar', 'NUMERIC', true, null);

		$tMap->addColumn('CA_COBRAR_MIN', 'CaCobrarMin', 'NUMERIC', true, null);

		$tMap->addColumn('CA_COBRAR_IDM', 'CaCobrarIdm', 'VARCHAR', true, 3);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', true, 255);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'DATE', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'DATE', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

	} // doBuild()

} // RepTarifaMapBuilder
