<?php


/**
 * This class adds structure of 'tb_trms' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.public.map
 */
class TRMMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.public.map.TRMMapBuilder';

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

		$tMap = $this->dbMap->addTable('tb_trms');
		$tMap->setPhpName('TRM');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_FECHA', 'CaFecha', 'int', CreoleTypes::DATE, true, null);

		$tMap->addColumn('CA_EURO', 'CaEuro', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_PESOS', 'CaPesos', 'double', CreoleTypes::NUMERIC, true, null);

		$tMap->addColumn('CA_LIBRA', 'CaLibra', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_FSUIZO', 'CaFsuizo', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_MARCO', 'CaMarco', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_YEN', 'CaYen', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_RUPEE', 'CaRupee', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_AUSDOLAR', 'CaAusdolar', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_CANDOLAR', 'CaCandolar', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_CORNORUEGA', 'CaCornoruega', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_SINGDOLAR', 'CaSingdolar', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_RAND', 'CaRand', 'double', CreoleTypes::NUMERIC, false, null);

	} // doBuild()

} // TRMMapBuilder
