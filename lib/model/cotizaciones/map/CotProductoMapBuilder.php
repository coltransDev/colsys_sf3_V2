<?php


/**
 * This class adds structure of 'tb_cotproductos' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.cotizaciones.map
 */
class CotProductoMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.cotizaciones.map.CotProductoMapBuilder';

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

		$tMap = $this->dbMap->addTable('tb_cotproductos');
		$tMap->setPhpName('CotProducto');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDCOTIZACION', 'CaIdcotizacion', 'int' , CreoleTypes::INTEGER, 'tb_cotizaciones', 'CA_IDCOTIZACION', true, null);

		$tMap->addPrimaryKey('CA_IDPRODUCTO', 'CaIdproducto', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CA_TRANSPORTE', 'CaTransporte', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_MODALIDAD', 'CaModalidad', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_ORIGEN', 'CaOrigen', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_DESTINO', 'CaDestino', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_IMPOEXPO', 'CaImpoexpo', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_IMPRIMIR', 'CaImprimir', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_PRODUCTO', 'CaProducto', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_INCOTERMS', 'CaIncoterms', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FRECUENCIA', 'CaFrecuencia', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_TIEMPOTRANSITO', 'CaTiempotransito', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_LOCRECARGOS', 'CaLocrecargos', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_DATOSAG', 'CaDatosag', 'string', CreoleTypes::VARCHAR, false, null);

	} // doBuild()

} // CotProductoMapBuilder
