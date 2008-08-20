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
class RepTarifaMapBuilder {

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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('tb_reptarifas');
		$tMap->setPhpName('RepTarifa');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('OID', 'Oid', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('CA_IDREPORTE', 'CaIdreporte', 'int', CreoleTypes::INTEGER, 'tb_reportes', 'CA_IDREPORTE', true, null);

		$tMap->addForeignKey('CA_IDCONCEPTO', 'CaIdconcepto', 'int', CreoleTypes::INTEGER, 'tb_conceptos', 'CA_IDCONCEPTO', true, null);

		$tMap->addColumn('CA_CANTIDAD', 'CaCantidad', 'double', CreoleTypes::NUMERIC, true, null);

		$tMap->addColumn('CA_NETA_TAR', 'CaNetaTar', 'double', CreoleTypes::NUMERIC, true, null);

		$tMap->addColumn('CA_NETA_MIN', 'CaNetaMin', 'double', CreoleTypes::NUMERIC, true, null);

		$tMap->addColumn('CA_NETA_IDM', 'CaNetaIdm', 'string', CreoleTypes::VARCHAR, true, 3);

		$tMap->addColumn('CA_REPORTAR_TAR', 'CaReportarTar', 'double', CreoleTypes::NUMERIC, true, null);

		$tMap->addColumn('CA_REPORTAR_MIN', 'CaReportarMin', 'double', CreoleTypes::NUMERIC, true, null);

		$tMap->addColumn('CA_REPORTAR_IDM', 'CaReportarIdm', 'string', CreoleTypes::VARCHAR, true, 3);

		$tMap->addColumn('CA_COBRAR_TAR', 'CaCobrarTar', 'double', CreoleTypes::NUMERIC, true, null);

		$tMap->addColumn('CA_COBRAR_MIN', 'CaCobrarMin', 'double', CreoleTypes::NUMERIC, true, null);

		$tMap->addColumn('CA_COBRAR_IDM', 'CaCobrarIdm', 'string', CreoleTypes::VARCHAR, true, 3);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'string', CreoleTypes::VARCHAR, true, 255);

	} // doBuild()

} // RepTarifaMapBuilder
