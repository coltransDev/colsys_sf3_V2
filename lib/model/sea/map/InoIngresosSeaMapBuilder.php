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
class InoIngresosSeaMapBuilder implements MapBuilder {

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
		$this->dbMap = Propel::getDatabaseMap(InoIngresosSeaPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(InoIngresosSeaPeer::TABLE_NAME);
		$tMap->setPhpName('InoIngresosSea');
		$tMap->setClassname('InoIngresosSea');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_REFERENCIA', 'CaReferencia', 'VARCHAR' , 'tb_inomaestra_sea', 'CA_REFERENCIA', true, null);

		$tMap->addForeignPrimaryKey('CA_IDCLIENTE', 'CaIdcliente', 'INTEGER' , 'tb_clientes', 'CA_IDCLIENTE', true, null);

		$tMap->addPrimaryKey('CA_HBLS', 'CaHbls', 'VARCHAR', true, null);

		$tMap->addPrimaryKey('CA_FACTURA', 'CaFactura', 'VARCHAR', true, null);

		$tMap->addColumn('CA_FCHFACTURA', 'CaFchfactura', 'DATE', false, null);

		$tMap->addColumn('CA_VALOR', 'CaValor', 'NUMERIC', false, null);

		$tMap->addColumn('CA_RECCAJA', 'CaReccaja', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHPAGO', 'CaFchpago', 'DATE', false, null);

		$tMap->addColumn('CA_TCAMBIO', 'CaTcambio', 'NUMERIC', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

	} // doBuild()

} // InoIngresosSeaMapBuilder
