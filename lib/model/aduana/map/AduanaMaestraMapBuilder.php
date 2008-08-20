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
class AduanaMaestraMapBuilder {

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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('tb_brk_maestra');
		$tMap->setPhpName('AduanaMaestra');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('CA_FCHREFERENCIA', 'CaFchreferencia', 'int', CreoleTypes::DATE, true, null);

		$tMap->addPrimaryKey('CA_REFERENCIA', 'CaReferencia', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_ORIGEN', 'CaOrigen', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_DESTINO', 'CaDestino', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addForeignKey('CA_IDCLIENTE', 'CaIdcliente', 'int', CreoleTypes::INTEGER, 'tb_clientes', 'CA_IDCLIENTE', false, null);

		$tMap->addColumn('CA_VENDEDOR', 'CaVendedor', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_COORDINADOR', 'CaCoordinador', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_PROVEEDOR', 'CaProveedor', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_PEDIDO', 'CaPedido', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_PIEZAS', 'CaPiezas', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CA_PESO', 'CaPeso', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_MERCANCIA', 'CaMercancia', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_DEPOSITO', 'CaDeposito', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHARRIBO', 'CaFcharribo', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_MODALIDAD', 'CaModalidad', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHLIQUIDADO', 'CaFchliquidado', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_USULIQUIDADO', 'CaUsuliquidado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHCERRADO', 'CaFchcerrado', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_USUCERRADO', 'CaUsucerrado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_NOMBRECONTACTO', 'CaNombrecontacto', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_EMAIL', 'CaEmail', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_ANALISTA', 'CaAnalista', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_TRACKINGCODE', 'CaTrackingcode', 'string', CreoleTypes::VARCHAR, false, null);

	} // doBuild()

} // AduanaMaestraMapBuilder
