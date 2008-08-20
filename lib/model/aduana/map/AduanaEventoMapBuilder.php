<?php


/**
 * This class adds structure of 'tb_brk_evento' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.aduana.map
 */
class AduanaEventoMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.aduana.map.AduanaEventoMapBuilder';

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

		$tMap = $this->dbMap->addTable('tb_brk_evento');
		$tMap->setPhpName('AduanaEvento');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_REFERENCIA', 'CaReferencia', 'string' , CreoleTypes::VARCHAR, 'tb_brk_maestra', 'CA_REFERENCIA', true, null);

		$tMap->addColumn('CA_REALIZADO', 'CaRealizado', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addPrimaryKey('CA_IDEVENTO', 'CaIdevento', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CA_USUARIO', 'CaUsuario', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHEVENTO', 'CaFchevento', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CA_NOTAS', 'CaNotas', 'string', CreoleTypes::VARCHAR, false, null);

	} // doBuild()

} // AduanaEventoMapBuilder
