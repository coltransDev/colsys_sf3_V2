<?php


/**
 * This class adds structure of 'tb_priccabotajes' table to 'propel' DatabaseMap object.
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
class PricCabotajeMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.pricing.map.PricCabotajeMapBuilder';

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

		$tMap = $this->dbMap->addTable('tb_priccabotajes');
		$tMap->setPhpName('PricCabotaje');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('OID', 'Oid', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addPrimaryKey('CA_ORIGEN', 'CaOrigen', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addPrimaryKey('CA_DESTINO', 'CaDestino', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addForeignPrimaryKey('CA_IDLINEA', 'CaIdlinea', 'string' , CreoleTypes::VARCHAR, 'tb_transporlineas', 'CA_IDLINEA', true, null);

		$tMap->addColumn('CA_VLRKILO', 'CaVlrkilo', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_VLRMINIMO', 'CaVlrminimo', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_MAXPESO', 'CaMaxpeso', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_DIMENSIONES', 'CaDimensiones', 'string', CreoleTypes::VARCHAR, false, 100);

	} // doBuild()

} // PricCabotajeMapBuilder
