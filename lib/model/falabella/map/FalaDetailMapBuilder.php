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
class FalaDetailMapBuilder {

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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('tb_faladetails');
		$tMap->setPhpName('FalaDetail');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDDOC', 'CaIddoc', 'string' , CreoleTypes::VARCHAR, 'tb_falaheader', 'CA_IDDOC', true, null);

		$tMap->addPrimaryKey('CA_SKU', 'CaSku', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_VPN', 'CaVpn', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_NUM_CONT_PART1', 'CaNumContPart1', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_NUM_CONT_PART2', 'CaNumContPart2', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_NUM_CONT_SELL', 'CaNumContSell', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CONTAINER_ISO', 'CaContainerIso', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CANTIDAD_PEDIDO', 'CaCantidadPedido', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CA_CANTIDAD_MILES', 'CaCantidadMiles', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CA_UNIDAD_MEDIDAD_CANTIDAD', 'CaUnidadMedidadCantidad', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_DESCRIPCION_ITEM', 'CaDescripcionItem', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CANTIDAD_PAQUETES_MILES', 'CaCantidadPaquetesMiles', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_UNIDAD_MEDIDA_PAQUETES', 'CaUnidadMedidaPaquetes', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CANTIDAD_VOLUMEN_MILES', 'CaCantidadVolumenMiles', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_UNIDAD_MEDIDA_VOLUMEN', 'CaUnidadMedidaVolumen', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CANTIDAD_PESO_MILES', 'CaCantidadPesoMiles', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_UNIDAD_MEDIDA_PESO', 'CaUnidadMedidaPeso', 'string', CreoleTypes::VARCHAR, false, null);

	} // doBuild()

} // FalaDetailMapBuilder
