<?php


/**
 * This class adds structure of 'control.tb_rutinas' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.control.map
 */
class RutinaMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.control.map.RutinaMapBuilder';

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

		$tMap = $this->dbMap->addTable('control.tb_rutinas');
		$tMap->setPhpName('Rutina');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_RUTINA', 'CaRutina', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_OPCION', 'CaOpcion', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_DESCRIPCION', 'CaDescripcion', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_PROGRAMA', 'CaPrograma', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_GRUPO', 'CaGrupo', 'string', CreoleTypes::VARCHAR, false, null);

	} // doBuild()

} // RutinaMapBuilder
