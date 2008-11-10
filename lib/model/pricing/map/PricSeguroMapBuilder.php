<?php


/**
 * This class adds structure of 'tb_pricseguros' table to 'propel' DatabaseMap object.
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
class PricSeguroMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.pricing.map.PricSeguroMapBuilder';

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

		$tMap = $this->dbMap->addTable('tb_pricseguros');
		$tMap->setPhpName('PricSeguro');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDGRUPO', 'CaIdgrupo', 'int' , CreoleTypes::INTEGER, 'tb_grupos', 'CA_IDGRUPO', true, null);

		$tMap->addPrimaryKey('CA_TRANSPORTE', 'CaTransporte', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_VLRPRIMA', 'CaVlrprima', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_VLRMINIMA', 'CaVlrminima', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_VLROBTENCIONPOLIZA', 'CaVlrobtencionpoliza', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_IDMONEDA', 'CaIdmoneda', 'string', CreoleTypes::VARCHAR, false, 3);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'string', CreoleTypes::VARCHAR, false, null);

	} // doBuild()

} // PricSeguroMapBuilder
