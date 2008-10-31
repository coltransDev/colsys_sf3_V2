<?php


/**
 * This class adds structure of 'tb_pricrecargosxciudad' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.pricing.map
 */
class PricRecargosxCiudadMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.pricing.map.PricRecargosxCiudadMapBuilder';

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

		$tMap = $this->dbMap->addTable('tb_pricrecargosxciudad');
		$tMap->setPhpName('PricRecargosxCiudad');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_IDTRAFICO', 'CaIdtrafico', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addForeignPrimaryKey('CA_IDCIUDAD', 'CaIdciudad', 'string' , CreoleTypes::VARCHAR, 'tb_ciudades', 'CA_IDCIUDAD', true, null);

		$tMap->addForeignPrimaryKey('CA_IDRECARGO', 'CaIdrecargo', 'int' , CreoleTypes::INTEGER, 'tb_tiporecargo', 'CA_IDRECARGO', true, null);

		$tMap->addPrimaryKey('CA_MODALIDAD', 'CaModalidad', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_VLRRECARGO', 'CaVlrrecargo', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_APLICACION', 'CaAplicacion', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_VLRMINIMO', 'CaVlrminimo', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_APLICACION_MIN', 'CaAplicacionMin', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHINICIO', 'CaFchinicio', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_FCHVENCIMIENTO', 'CaFchvencimiento', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_IDMONEDA', 'CaIdmoneda', 'string', CreoleTypes::VARCHAR, false, 3);

	} // doBuild()

} // PricRecargosxCiudadMapBuilder
