<?php


/**
 * This class adds structure of 'tb_repseguro' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.reportes.map
 */
class RepSeguroMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.reportes.map.RepSeguroMapBuilder';

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

		$tMap = $this->dbMap->addTable('tb_repseguro');
		$tMap->setPhpName('RepSeguro');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDREPORTE', 'CaIdreporte', 'int' , CreoleTypes::INTEGER, 'tb_reportes', 'CA_IDREPORTE', true, null);

		$tMap->addColumn('CA_VLRASEGURADO', 'CaVlrasegurado', 'double', CreoleTypes::NUMERIC, true, null);

		$tMap->addColumn('CA_IDMONEDA_VLR', 'CaIdmonedaVlr', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_PRIMAVENTA', 'CaPrimaventa', 'double', CreoleTypes::NUMERIC, true, null);

		$tMap->addColumn('CA_MINIMAVENTA', 'CaMinimaventa', 'double', CreoleTypes::NUMERIC, true, null);

		$tMap->addColumn('CA_IDMONEDA_VTA', 'CaIdmonedaVta', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_OBTENCIONPOLIZA', 'CaObtencionpoliza', 'double', CreoleTypes::NUMERIC, true, null);

		$tMap->addColumn('CA_IDMONEDA_POL', 'CaIdmonedaPol', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_SEGURO_CONF', 'CaSeguroConf', 'string', CreoleTypes::VARCHAR, true, null);

	} // doBuild()

} // RepSeguroMapBuilder
