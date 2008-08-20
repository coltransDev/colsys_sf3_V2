<?php


/**
 * This class adds structure of 'tb_inoingresos_sea' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.sea.map
 */
class InoIngresosSeaMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.sea.map.InoIngresosSeaMapBuilder';

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

		$tMap = $this->dbMap->addTable('tb_inoingresos_sea');
		$tMap->setPhpName('InoIngresosSea');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_REFERENCIA', 'CaReferencia', 'string' , CreoleTypes::VARCHAR, 'tb_inomaestra_sea', 'CA_REFERENCIA', true, null);

		$tMap->addForeignPrimaryKey('CA_IDCLIENTE', 'CaIdcliente', 'int' , CreoleTypes::INTEGER, 'tb_clientes', 'CA_IDCLIENTE', true, null);

		$tMap->addPrimaryKey('CA_HBLS', 'CaHbls', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addPrimaryKey('CA_FACTURA', 'CaFactura', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_FCHFACTURA', 'CaFchfactura', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_VALOR', 'CaValor', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_RECCAJA', 'CaReccaja', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHPAGO', 'CaFchpago', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_TCAMBIO', 'CaTcambio', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'string', CreoleTypes::VARCHAR, false, null);

	} // doBuild()

} // InoIngresosSeaMapBuilder
