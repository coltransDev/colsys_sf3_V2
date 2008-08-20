<?php


/**
 * This class adds structure of 'tb_inoavisos_sea' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.sea.map
 */
class InoAvisosSeaMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.sea.map.InoAvisosSeaMapBuilder';

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

		$tMap = $this->dbMap->addTable('tb_inoavisos_sea');
		$tMap->setPhpName('InoAvisosSea');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_REFERENCIA', 'CaReferencia', 'string' , CreoleTypes::VARCHAR, 'tb_inomaestra_sea', 'CA_REFERENCIA', true, null);

		$tMap->addForeignPrimaryKey('CA_IDCLIENTE', 'CaIdcliente', 'int' , CreoleTypes::INTEGER, 'tb_clientes', 'CA_IDCLIENTE', true, null);

		$tMap->addPrimaryKey('CA_HBLS', 'CaHbls', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addPrimaryKey('CA_IDEMAIL', 'CaIdemail', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CA_FCHAVISO', 'CaFchaviso', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_AVISO', 'CaAviso', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_IDBODEGA', 'CaIdbodega', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CA_FCHLLEGADA', 'CaFchllegada', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_FCHENVIO', 'CaFchenvio', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CA_USUENVIO', 'CaUsuenvio', 'string', CreoleTypes::VARCHAR, false, null);

	} // doBuild()

} // InoAvisosSeaMapBuilder
