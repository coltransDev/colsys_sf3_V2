<?php


/**
 * This class adds structure of 'tb_brk_maestra' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.aduana.map
 */
class AduanaMaestraMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.aduana.map.AduanaMaestraMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(AduanaMaestraPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(AduanaMaestraPeer::TABLE_NAME);
		$tMap->setPhpName('AduanaMaestra');
		$tMap->setClassname('AduanaMaestra');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('CA_FCHREFERENCIA', 'CaFchreferencia', 'DATE', true, null);

		$tMap->addPrimaryKey('CA_REFERENCIA', 'CaReferencia', 'VARCHAR', true, null);

		$tMap->addColumn('CA_ORIGEN', 'CaOrigen', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DESTINO', 'CaDestino', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_IDCLIENTE', 'CaIdcliente', 'INTEGER', 'tb_clientes', 'CA_IDCLIENTE', false, null);

		$tMap->addColumn('CA_VENDEDOR', 'CaVendedor', 'VARCHAR', false, null);

		$tMap->addColumn('CA_COORDINADOR', 'CaCoordinador', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PROVEEDOR', 'CaProveedor', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PEDIDO', 'CaPedido', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PIEZAS', 'CaPiezas', 'INTEGER', false, null);

		$tMap->addColumn('CA_PESO', 'CaPeso', 'NUMERIC', false, null);

		$tMap->addColumn('CA_MERCANCIA', 'CaMercancia', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DEPOSITO', 'CaDeposito', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHARRIBO', 'CaFcharribo', 'DATE', false, null);

		$tMap->addColumn('CA_MODALIDAD', 'CaModalidad', 'INTEGER', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'DATE', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'DATE', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHLIQUIDADO', 'CaFchliquidado', 'DATE', false, null);

		$tMap->addColumn('CA_USULIQUIDADO', 'CaUsuliquidado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCERRADO', 'CaFchcerrado', 'DATE', false, null);

		$tMap->addColumn('CA_USUCERRADO', 'CaUsucerrado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_NOMBRECONTACTO', 'CaNombrecontacto', 'VARCHAR', false, null);

		$tMap->addColumn('CA_EMAIL', 'CaEmail', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ANALISTA', 'CaAnalista', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TRACKINGCODE', 'CaTrackingcode', 'VARCHAR', false, null);

	} // doBuild()

} // AduanaMaestraMapBuilder
