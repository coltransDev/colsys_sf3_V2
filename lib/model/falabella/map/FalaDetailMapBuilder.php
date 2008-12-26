<?php


/**
 * This class adds structure of 'tb_faladetails' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.falabella.map
 */
class FalaDetailMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.falabella.map.FalaDetailMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(FalaDetailPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(FalaDetailPeer::TABLE_NAME);
		$tMap->setPhpName('FalaDetail');
		$tMap->setClassname('FalaDetail');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDDOC', 'CaIddoc', 'VARCHAR' , 'tb_falaheader', 'CA_IDDOC', true, null);

		$tMap->addPrimaryKey('CA_SKU', 'CaSku', 'VARCHAR', true, null);

		$tMap->addColumn('CA_VPN', 'CaVpn', 'VARCHAR', false, null);

		$tMap->addColumn('CA_NUM_CONT_PART1', 'CaNumContPart1', 'VARCHAR', false, null);

		$tMap->addColumn('CA_NUM_CONT_PART2', 'CaNumContPart2', 'VARCHAR', false, null);

		$tMap->addColumn('CA_NUM_CONT_SELL', 'CaNumContSell', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CONTAINER_ISO', 'CaContainerIso', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CANTIDAD_PEDIDO', 'CaCantidadPedido', 'INTEGER', false, null);

		$tMap->addColumn('CA_CANTIDAD_MILES', 'CaCantidadMiles', 'INTEGER', false, null);

		$tMap->addColumn('CA_UNIDAD_MEDIDAD_CANTIDAD', 'CaUnidadMedidadCantidad', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DESCRIPCION_ITEM', 'CaDescripcionItem', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CANTIDAD_PAQUETES_MILES', 'CaCantidadPaquetesMiles', 'NUMERIC', false, null);

		$tMap->addColumn('CA_UNIDAD_MEDIDA_PAQUETES', 'CaUnidadMedidaPaquetes', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CANTIDAD_VOLUMEN_MILES', 'CaCantidadVolumenMiles', 'NUMERIC', false, null);

		$tMap->addColumn('CA_UNIDAD_MEDIDA_VOLUMEN', 'CaUnidadMedidaVolumen', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CANTIDAD_PESO_MILES', 'CaCantidadPesoMiles', 'NUMERIC', false, null);

		$tMap->addColumn('CA_UNIDAD_MEDIDA_PESO', 'CaUnidadMedidaPeso', 'VARCHAR', false, null);

	} // doBuild()

} // FalaDetailMapBuilder
