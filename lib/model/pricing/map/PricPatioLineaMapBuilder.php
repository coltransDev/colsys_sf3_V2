<?php


/**
 * This class adds structure of 'tb_pricpatioslinea' table to 'propel' DatabaseMap object.
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
class PricPatioLineaMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.pricing.map.PricPatioLineaMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(PricPatioLineaPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(PricPatioLineaPeer::TABLE_NAME);
		$tMap->setPhpName('PricPatioLinea');
		$tMap->setClassname('PricPatioLinea');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDPATIO', 'CaIdpatio', 'INTEGER' , 'tb_pricpatios', 'CA_IDPATIO', true, null);

		$tMap->addForeignPrimaryKey('CA_IDLINEA', 'CaIdlinea', 'VARCHAR' , 'tb_transporlineas', 'CA_IDLINEA', true, null);

		$tMap->addPrimaryKey('CA_TRANSPORTE', 'CaTransporte', 'VARCHAR', true, null);

		$tMap->addPrimaryKey('CA_MODALIDAD', 'CaModalidad', 'VARCHAR', true, null);

		$tMap->addPrimaryKey('CA_IMPOEXPO', 'CaImpoexpo', 'VARCHAR', true, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

	} // doBuild()

} // PricPatioLineaMapBuilder
