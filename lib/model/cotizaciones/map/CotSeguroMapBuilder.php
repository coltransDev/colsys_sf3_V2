<?php


/**
 * This class adds structure of 'tb_cotseguro' table to 'propel' DatabaseMap object.
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
class CotSeguroMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.cotizaciones.map.CotSeguroMapBuilder';

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

		$tMap = $this->dbMap->addTable('tb_cotseguro');
		$tMap->setPhpName('CotSeguro');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignKey('CA_IDCOTIZACION', 'CaIdcotizacion', 'int', CreoleTypes::INTEGER, 'tb_cotizaciones', 'CA_IDCOTIZACION', true, null);

		$tMap->addForeignKey('CA_IDMONEDA', 'CaIdmoneda', 'string', CreoleTypes::VARCHAR, 'tb_monedas', 'CA_IDMONEDA', true, null);

		$tMap->addColumn('CA_PRIMA_TIP', 'CaPrimaTip', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_PRIMA_VLR', 'CaPrimaVlr', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_PRIMA_MIN', 'CaPrimaMin', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_OBTENCION', 'CaObtencion', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_TRANSPORTE', 'CaTransporte', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addPrimaryKey('OID', 'Oid', 'string', CreoleTypes::VARCHAR, true, null);

	} // doBuild()

} // CotSeguroMapBuilder
