<?php


/**
 * This class adds structure of 'tb_repexpo' table to 'propel' DatabaseMap object.
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
class RepExpoMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.reportes.map.RepExpoMapBuilder';

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

		$tMap = $this->dbMap->addTable('tb_repexpo');
		$tMap->setPhpName('RepExpo');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDREPORTE', 'CaIdreporte', 'int' , CreoleTypes::INTEGER, 'tb_reportes', 'CA_IDREPORTE', true, null);

		$tMap->addColumn('CA_PESO', 'CaPeso', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_VOLUMEN', 'CaVolumen', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_PIEZAS', 'CaPiezas', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_DIMENSIONES', 'CaDimensiones', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_VALORCARGA', 'CaValorcarga', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_ANTICIPO', 'CaAnticipo', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_IDSIA', 'CaIdsia', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CA_TIPOEXPO', 'CaTipoexpo', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CA_IDLINEATERRESTRE', 'CaIdlineaterrestre', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CA_MOTONAVE', 'CaMotonave', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_EMISIONBL', 'CaEmisionbl', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_DATOSBL', 'CaDatosbl', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_NUMBL', 'CaNumbl', 'int', CreoleTypes::INTEGER, false, null);

	} // doBuild()

} // RepExpoMapBuilder
